<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\CarUnit;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Select::make('car_id')
                    ->relationship('car', 'name')
                    ->searchable()
                    ->live()
                    ->required(),
                DateTimePicker::make('start_date')
                    ->live()
                    ->required(),
                DateTimePicker::make('end_date')
                    ->live()
                    ->required(),
                // Alert ketika tidak ada unit yang tersedia
                \Filament\Forms\Components\Placeholder::make('no_units_available')
                    ->label('⚠️ Semua Unit Tidak Tersedia')
                    ->content(fn ($get) => new \Illuminate\Support\HtmlString('<div style="color: #ef4444; font-weight: bold;">' . self::getNoUnitsMessage($get) . '</div>'))
                    ->visible(fn ($get) => self::isNoUnitsAvailable($get)),
                // Saran tanggal alternatif
                \Filament\Forms\Components\Placeholder::make('suggested_dates')
                    ->label('💡 Tanggal Alternatif yang Tersedia')
                    ->content(fn ($get) => new \Illuminate\Support\HtmlString(self::getSuggestedDatesMessage($get)))
                    ->visible(fn ($get) => self::isNoUnitsAvailable($get) && self::getSuggestedDates($get) !== null),
                Toggle::make('unlock_car_unit')
                    ->label('🔓 Buka Kunci Ganti Unit (Darurat/Mogok)')
                    ->helperText('Aktifkan ini hanya jika Anda terpaksa harus mengganti mobil ke unit lain (misal: mobil sebelumnya mogok).')
                    ->visible(fn (?\Illuminate\Database\Eloquent\Model $record) => $record && $record->car_unit_id !== null && in_array($record->status, ['pending', 'menunggu pembayaran', 'disetujui', 'berjalan']))
                    ->live()
                    ->dehydrated(false),
                Select::make('car_unit_id')
                    ->label('Pilih Unit Mobil')
                    ->disabled(fn (?\Illuminate\Database\Eloquent\Model $record, callable $get) => $record && $record->car_unit_id !== null && in_array($record->status, ['pending', 'menunggu pembayaran', 'disetujui', 'berjalan']) && !$get('unlock_car_unit'))
                    ->relationship('carUnit', 'license_plate', function (\Illuminate\Database\Eloquent\Builder $query, $get, ?\Illuminate\Database\Eloquent\Model $record) {
                        $carId = $get('car_id');
                        if ($carId) {
                            $query->where('car_id', $carId);
                        }

                        // Filter: exclude mobil yang maintenance dan dikunci admin
                        $query->where(function ($q) {
                            $q->where('status', '!=', 'maintenance')
                              ->orWhere(function ($q) {
                                  $q->where('status', '=', 'maintenance')
                                    ->where('locked_by', null);
                              });
                        });

                        $startDate = $get('start_date');
                        $endDate = $get('end_date');
                        if ($startDate && $endDate) {
                            $query->whereDoesntHave('bookings', function ($q) use ($startDate, $endDate, $record) {
                                $q->where(function ($q) use ($startDate, $endDate) {
                                    $q->whereBetween('start_date', [$startDate, $endDate])
                                      ->orWhereBetween('end_date', [$startDate, $endDate])
                                      ->orWhere(function ($q) use ($startDate, $endDate) {
                                          $q->where('start_date', '<=', $startDate)
                                            ->where('end_date', '>=', $endDate);
                                      });
                                })->where('status', '!=', 'dibatalkan')->where('status', '!=', 'selesai');
                                // Exclude current booking dari conflict check saat editing
                                if ($record && $record->id) {
                                    $q->where('id', '!=', $record->id);
                                }
                            });
                        }
                    })
                    ->getOptionLabelFromRecordUsing(fn (\App\Models\CarUnit $record) => "{$record->license_plate} (Warna: {$record->color})")
                    ->preload()
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set, callable $get, ?\Illuminate\Database\Eloquent\Model $record) {
                        if ($state && $record) {
                            $paymentMethod = $record->payment_method;
                            if (in_array($paymentMethod, ['midtrans', 'tunai'])) {
                                $set('status', 'disetujui');
                            }
                        }
                    })
                    ->helperText(fn ($get) => self::getCarUnitHelperText($get))
                    ->required(),
                TextInput::make('pickup_location')
                    ->required(),
                Toggle::make('with_driver')
                    ->label('Dengan Supir')
                    ->live()
                    ->required(),
                Select::make('driver_id')
                    ->label('Pilih Supir')
                    ->relationship(
                        'driver',
                        'name',
                        fn ($query) => $query->where('status', 'available')
                    )
                    ->getOptionLabelFromRecordUsing(fn (\App\Models\Driver $record) => "{$record->name} - {$record->phone}")
                    ->visible(fn ($get) => $get('with_driver'))
                    ->required(fn ($get) => $get('with_driver'))
                    ->preload()
                    ->searchable()
                    ->helperText('Hanya supir yang status "available" yang bisa dipilih'),
                Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'transfer' => 'Transfer Manual',
                        'midtrans' => 'Midtrans (Gateway)',
                        'tunai' => 'Tunai (Di Tempat / Supir)',
                    ])
                    ->required(),
                Select::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'unpaid' => 'Belum Lunas / Belum Bayar',
                        'partial' => 'DP (Dibayar Sebagian)',
                        'paid' => 'Lunas (Dibayar Penuh)',
                    ])
                    ->default('unpaid')
                    ->required(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('deposit_amount')
                    ->label('Jumlah Deposit')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->live(onBlur: true)
                    ->helperText('Uang jaminan yang akan dikembalikan setelah selesai.'),
                Select::make('deposit_status')
                    ->label('Status Deposit')
                    ->options([
                        'pending' => 'Pending (Belum Dibayar)',
                        'held' => 'Held (Ditahan)',
                        'refunded' => 'Refunded (Dikembalikan)',
                        'forfeited' => 'Forfeited (Hangus)',
                    ])
                    ->default('pending')
                    ->visible(fn ($get) => (float) $get('deposit_amount') > 0)
                    ->required(fn ($get) => (float) $get('deposit_amount') > 0),
                TextInput::make('dp_amount')
                    ->label('Jumlah DP / Dibayar Sebagian')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->live(onBlur: true)
                    ->helperText('Isi nominal uang yang sudah diterima jika pembayaran baru sebagian.'),
                \Filament\Forms\Components\Placeholder::make('sisa_pembayaran')
                    ->label('Sisa Pembayaran (Kekurangan)')
                    ->content(function ($get) {
                        $total = (float) $get('total_price') ?: 0;
                        $dp = (float) $get('dp_amount') ?: 0;
                        $sisa = max(0, $total - $dp);
                        return new \Illuminate\Support\HtmlString('<strong style="font-size: 1.1rem; color: #eab308;">Rp ' . number_format($sisa, 0, ',', '.') . '</strong>');
                    }),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'menunggu pembayaran' => 'Menunggu pembayaran',
                        'disetujui' => 'Disetujui',
                        'berjalan' => 'Berjalan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                        'pending_review' => 'Pending Review (Damage)',
                    ])
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('actual_return_date')
                    ->label('Waktu Pengembalian Aktual')
                    ->helperText('Diisi saat mobil dikembalikan oleh penyewa'),
                TextInput::make('penalty_fee')
                    ->label('Denda Keterlambatan')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),
                Select::make('cancel_category')
                    ->label('Kategori Pembatalan')
                    ->options([
                        'exception' => 'Exception - Pihak Rental (100%)',
                        'force_majeure' => 'Force Majeure - Emergency (100%)',
                        'damage' => 'Damage/Kerusakan (Manual Review)',
                        'normal' => 'Normal - Customer (Timing-Based)',
                    ])
                    ->visible(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review']))
                    ->required(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review']))
                    ->live(),
                Textarea::make('cancelled_reason')
                    ->label('Alasan Pembatalan Detail')
                    ->visible(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review']))
                    ->helperText(fn ($get) => match ($get('cancel_category')) {
                        'exception' => 'Armada/supir kurang, pelayanan jelek. Refund 100%.',
                        'force_majeure' => 'Bencana alam, situasi emergency. Refund 100%.',
                        'damage' => 'Deskripsi kerusakan/kecelakaan. Pending review.',
                        'normal' => '>7 hari: 100%, 3-7 hari: 50%, <3 hari: 0%',
                        default => '',
                    })
                    ->required(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review'])),
                Toggle::make('is_customer_fault')
                    ->label('Kesalahan customer?')
                    ->visible(fn ($get) => $get('cancel_category') === 'damage')
                    ->live(),
                Toggle::make('insurance_claimed')
                    ->label('Sudah klaim asuransi?')
                    ->visible(fn ($get) => $get('cancel_category') === 'damage'),
                Textarea::make('damage_description')
                    ->label('Deskripsi Kerusakan')
                    ->visible(fn ($get) => $get('cancel_category') === 'damage'),
                Select::make('refund_method')
                    ->label('Metode Refund')
                    ->visible(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review']))
                    ->options([
                        'bank_transfer' => 'Transfer Bank',
                        'wallet_credit' => 'Wallet Credit',
                    ])
                    ->default('bank_transfer'),
                Select::make('cancelled_by_user_id')
                    ->label('Dibatalkan/Diapprove oleh')
                    ->visible(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review']))
                    ->relationship('cancelledByAdmin', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('refund_percentage')
                    ->label('Persentase Refund (%)')
                    ->visible(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review']))
                    ->disabled(),
                TextInput::make('refund_amount')
                    ->label('Jumlah Refund (Rp)')
                    ->visible(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review']))
                    ->disabled()
                    ->numeric()
                    ->prefix('Rp'),
                Toggle::make('refund_override')
                    ->label('Override Policy')
                    ->visible(fn ($get) => in_array($get('status'), ['dibatalkan', 'pending_review']))
                    ->live(),
                Textarea::make('override_reason')
                    ->label('Alasan Override')
                    ->visible(fn ($get) => $get('refund_override') && in_array($get('status'), ['dibatalkan', 'pending_review'])),
            ]);
    }

    /**
     * Cek apakah tidak ada unit yang tersedia
     */
    private static function isNoUnitsAvailable($get): bool
    {
        $carId = $get('car_id');
        $startDate = $get('start_date');
        $endDate = $get('end_date');

        if (!$carId || !$startDate || !$endDate) {
            return false;
        }

        $availableCount = CarUnit::where('car_id', $carId)
            ->where(function ($q) {
                $q->where('status', '!=', 'maintenance')
                  ->orWhere(function ($q) {
                      $q->where('status', '=', 'maintenance')
                        ->where('locked_by', null);
                  });
            })
            ->whereDoesntHave('bookings', function ($q) use ($startDate, $endDate) {
                $q->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($q) use ($startDate, $endDate) {
                          $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                      });
                })->where('status', '!=', 'dibatalkan')->where('status', '!=', 'selesai');
            })
            ->count();

        return $availableCount === 0;
    }

    /**
     * Get pesan ketika tidak ada unit tersedia
     */
    private static function getNoUnitsMessage($get): string
    {
        $startDate = $get('start_date');
        $endDate = $get('end_date');

        if ($startDate && $endDate) {
            $formatted = Carbon::parse($startDate)->translatedFormat('d M Y') . ' - ' . Carbon::parse($endDate)->translatedFormat('d M Y');
            return "Maaf, semua unit untuk periode <strong>$formatted</strong> sudah terboking. Silakan coba tanggal lain atau lihat saran tanggal alternatif di bawah.";
        }

        return 'Silakan isi tanggal untuk melihat ketersediaan unit.';
    }

    /**
     * Get saran tanggal yang tersedia
     */
    private static function getSuggestedDates($get): ?array
    {
        $carId = $get('car_id');
        $startDate = $get('start_date');

        if (!$carId || !$startDate) {
            return null;
        }

        // Ambil unit pertama untuk cari tanggal alternatif
        $unit = CarUnit::where('car_id', $carId)->first();

        if (!$unit) {
            return null;
        }

        $suggestions = [];
        $dateToCheck = Carbon::parse($startDate);

        for ($i = 0; $i < 5; $i++) {
            $nextAvailable = $unit->findNextAvailableDate($dateToCheck, $carId);
            if ($nextAvailable) {
                $suggestions[] = $nextAvailable;
                $dateToCheck = Carbon::parse($nextAvailable['end_date'])->addDay();
            }
        }

        return count($suggestions) > 0 ? $suggestions : null;
    }

    /**
     * Get formatted saran tanggal untuk ditampilkan
     */
    private static function getSuggestedDatesMessage($get): string
    {
        $suggestions = self::getSuggestedDates($get);

        if (!$suggestions) {
            return '<p style="color: #666;">Tidak ada tanggal alternatif yang ditemukan dalam 30 hari ke depan.</p>';
        }

        $html = '<div style="background: #f0f9ff; border-left: 4px solid #0ea5e9; padding: 12px; border-radius: 4px;">';
        $html .= '<p style="margin: 0 0 8px 0; font-weight: 500;">Silakan pilih salah satu tanggal berikut:</p>';
        $html .= '<ul style="margin: 0; padding-left: 20px;">';

        foreach ($suggestions as $suggestion) {
            $html .= '<li style="margin: 4px 0;">' . $suggestion['formatted'] . '</li>';
        }

        $html .= '</ul></div>';

        return $html;
    }

    /**
     * Get helper text untuk car_unit_id
     */
    private static function getCarUnitHelperText($get): string
    {
        $carId = $get('car_id');
        $startDate = $get('start_date');
        $endDate = $get('end_date');

        if (!$carId || !$startDate || !$endDate) {
            return 'Isi Car, Start Date, dan End Date terlebih dahulu untuk melihat unit yang tersedia.';
        }

        // Hitung total unit yang tersedia
        $totalAvailable = CarUnit::where('car_id', $carId)
            ->where(function ($q) {
                $q->where('status', '!=', 'maintenance')
                  ->orWhere(function ($q) {
                      $q->where('status', '=', 'maintenance')
                        ->where('locked_by', null);
                  });
            })
            ->whereDoesntHave('bookings', function ($q) use ($startDate, $endDate) {
                $q->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($q) use ($startDate, $endDate) {
                          $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                      });
                })->where('status', '!=', 'dibatalkan')->where('status', '!=', 'selesai');
            })
            ->count();

        if ($totalAvailable > 0) {
            return "✅ Ada {$totalAvailable} unit yang tersedia untuk periode ini.";
        }

        return '❌ Tidak ada unit yang tersedia untuk periode ini.';
    }

    private function getReasonHelper($category)
    {
        return '';
    }
}

