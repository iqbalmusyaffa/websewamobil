<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }} - AutoRent</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            background: white;
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
        }

        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 30px;
            border-bottom: 3px solid #0ea5e9;
            margin-bottom: 30px;
        }

        .company-info h1 {
            color: #0ea5e9;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .company-info p {
            color: #666;
            font-size: 12px;
            margin: 2px 0;
        }

        .invoice-meta {
            text-align: right;
        }

        .invoice-meta h2 {
            font-size: 20px;
            color: #0ea5e9;
            margin-bottom: 10px;
        }

        .meta-item {
            margin-bottom: 6px;
            font-size: 12px;
        }

        .meta-item strong {
            color: #333;
        }

        /* Body */
        .invoice-body {
            padding: 20px 30px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #0ea5e9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e5e7eb;
        }

        .info-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .info-item {
            font-size: 12px;
            line-height: 1.6;
            flex: 1;
        }

        .info-item strong {
            color: #0ea5e9;
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table thead {
            background: #f0f9ff;
            border-bottom: 2px solid #0ea5e9;
        }

        table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            color: #0ea5e9;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .text-right {
            text-align: right;
        }

        .amount {
            font-weight: bold;
            color: #1f2937;
        }

        /* Summary */
        .summary-section {
            display: flex;
            justify-content: flex-end;
            margin: 30px 0;
        }

        .summary-box {
            width: 340px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px solid #0ea5e9;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.1);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 12px;
            gap: 20px;
            padding: 0 2px;
        }

        .summary-item strong {
            color: #1f2937;
            flex-shrink: 0;
            font-weight: 600;
        }

        .summary-item span {
            text-align: right;
            flex-shrink: 0;
            color: #1f2937;
            font-weight: 500;
            min-width: 130px;
        }

        .summary-item.total {
            border-top: 2px solid #0ea5e9;
            padding: 12px 2px 0 2px;
            margin-top: 10px;
            margin-bottom: 0;
            font-size: 13px;
            font-weight: bold;
            color: #0ea5e9;
            background: rgba(14, 165, 233, 0.08);
            margin-left: -20px;
            margin-right: -20px;
            padding-left: 22px;
            padding-right: 22px;
        }

        .summary-item.total span {
            color: #0ea5e9;
            font-size: 13px;
            font-weight: bold;
        }

        /* Note Box */
        .note-box {
            background: #fef08a;
            border: 1px solid #facc15;
            padding: 12px;
            margin: 20px 0;
            font-size: 11px;
            color: #713f12;
        }

        /* Terms */
        .terms-section {
            background: #f9fafb;
            padding: 15px;
            border-left: 3px solid #0ea5e9;
            margin-top: 25px;
            font-size: 11px;
            color: #555;
            line-height: 1.5;
        }

        .terms-title {
            font-weight: bold;
            color: #0ea5e9;
            margin-bottom: 8px;
            font-size: 11px;
        }

        .terms-text ul {
            margin-left: 15px;
            margin-top: 5px;
        }

        .terms-text li {
            margin-bottom: 4px;
        }

        /* Footer */
        .invoice-footer {
            display: flex;
            justify-content: space-between;
            padding: 30px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            margin-top: 30px;
        }

        .footer-item {
            text-align: center;
            font-size: 11px;
            flex: 1;
        }

        .footer-item strong {
            display: block;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #999;
            min-height: 30px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #dbeafe;
            color: #0c4a6e;
        }

        .status-completed {
            background: #dcfce7;
            color: #15803d;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <table style="width: 100%; margin-bottom: 30px; border-bottom: 2px solid #f1f5f9; padding-bottom: 20px;">
            <tr>
                <td style="vertical-align: top; width: 50%;">
                    <div class="invoice-logo">
                        <h1>AUTORENT</h1>
                        <p style="margin-top: 5px; color: #64748b; font-size: 13px;">PT AutoRent Indonesia<br>
                        Jl. Sudirman No. 123, Jakarta<br>
                        info@autorent.com<br>
                        www.autorent.com</p>
                    </div>
                </td>
                <td style="vertical-align: top; width: 50%; text-align: right;">
                    <table style="width: auto; margin-left: auto; border: none;">
                        <tr>
                            <td style="text-align: right; padding-right: 15px; border: none; vertical-align: top;">
                                <h2 style="font-size: 24px; color: #0ea5e9; margin: 0 0 10px 0; font-weight: 800;">INVOICE</h2>
                                <div style="color: #475569; font-size: 14px; margin-bottom: 5px;"><strong>No:</strong> #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
                                <div style="color: #475569; font-size: 14px; margin-bottom: 10px;"><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                                <div>
                                    <span class="status-badge {{ match($booking->status) {
                                        'menunggu pembayaran' => 'status-pending',
                                        'disetujui' => 'status-approved',
                                        'berjalan' => 'status-approved',
                                        'selesai' => 'status-completed',
                                        'dibatalkan' => 'status-cancelled',
                                        default => 'status-pending'
                                    } }}" style="display: inline-block;">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </td>
                            <td style="border: none; padding: 0; vertical-align: top; width: 75px;">
                                @php
                                    $qrUrl = route('invoice.validate', $booking->id);
                                    $qrCodeImg = base64_encode(file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=75x75&data=' . urlencode($qrUrl)));
                                @endphp
                                <img src="data:image/png;base64,{{ $qrCodeImg }}" alt="QR" width="75" height="75" style="border: 1px solid #ccc; padding: 3px; border-radius: 4px; background: white; margin-top: 5px;">
                                <div style="font-size: 8px; color: #64748b; text-align: center; margin-top: 3px;">Scan Validasi</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Body -->
        <div class="invoice-body">
            <!-- Customer Info -->
            <div class="section">
                <div class="section-title">Informasi Pemesan</div>
                <div class="info-grid">
                    <div class="info-item">
                        <strong>Nama Pemesan</strong>
                        {{ $booking->user->name }}
                    </div>
                    <div class="info-item">
                        <strong>Email</strong>
                        {{ $booking->user->email }}
                    </div>
                    <div class="info-item">
                        <strong>Lokasi Pengambilan</strong>
                        {{ $booking->pickup_location }}
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="section">
                <div class="section-title">Detail Penyewaan</div>
                <table>
                    <thead>
                        <tr>
                            <th>Deskripsi</th>
                            <th class="text-right">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kendaraan</td>
                            <td class="text-right">{{ $booking->car->brand }} {{ $booking->car->name }}</td>
                        </tr>
                        <tr>
                            <td>Plat Nomor Kendaraan</td>
                            <td class="text-right" style="font-weight: bold;">{{ $booking->carUnit ? $booking->carUnit->license_plate : 'Belum Ditentukan' }}</td>
                        </tr>
                        <tr>
                            <td>Odometer Awal (Km)</td>
                            <td class="text-right">{{ $booking->carUnit ? number_format($booking->carUnit->current_odometer, 0, ',', '.') . ' Km' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Warna / Tahun Kendaraan</td>
                            <td class="text-right">{{ $booking->carUnit ? $booking->carUnit->color . ' / ' . $booking->carUnit->year : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Bahan Bakar</td>
                            <td class="text-right">{{ $booking->car->fuel_type ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tipe Transmisi</td>
                            <td class="text-right">{{ $booking->car->transmission ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td class="text-right">{{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Berakhir</td>
                            <td class="text-right">{{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Durasi Sewa</td>
                            <td class="text-right">
                                @php
                                    $start = \Carbon\Carbon::parse($booking->start_date);
                                    $end = \Carbon\Carbon::parse($booking->end_date);
                                    $days = $start->diffInDays($end) + 1;
                                @endphp
                                {{ $days }} Hari
                            </td>
                        </tr>
                        <tr>
                            <td><strong>{{ $booking->with_driver ? 'Dengan Sopir' : 'Lepas Kunci (Tanpa Sopir)' }}</strong></td>
                            <td class="text-right"><strong>Rp {{ number_format($booking->with_driver ? $booking->car->price_with_driver : $booking->car->price_without_driver, 0, ',', '.') }}/Hari</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
<br>
<br>
<br>
<br>
<br>
<br>
            <!-- Pricing -->
            <div class="section">
                <div class="section-title">Rincian Biaya</div>
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Harga Satuan</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sewa {{ $booking->with_driver ? 'dengan Sopir' : 'Lepas Kunci' }}</td>
                            @php
                                $start = \Carbon\Carbon::parse($booking->start_date);
                                $end = \Carbon\Carbon::parse($booking->end_date);
                                $days = $start->diffInDays($end) + 1;
                                $dailyPrice = $booking->with_driver ? $booking->car->price_with_driver : $booking->car->price_without_driver;
                                $basePrice = $days * $dailyPrice;
                            @endphp
                            <td class="text-right">{{ $days }} hari</td>
                            <td class="text-right">Rp {{ number_format($dailyPrice, 0, ',', '.') }}</td>
                            <td class="text-right amount">Rp {{ number_format($basePrice, 0, ',', '.') }}</td>
                        </tr>

                        @if($booking->addons->isNotEmpty())
                            @foreach($booking->addons as $addon)
                                <tr>
                                    <td>{{ $addon->name }}</td>
                                    <td class="text-right">{{ $days }} hari</td>
                                    <td class="text-right">Rp {{ number_format($addon->pivot['price'] / $days, 0, ',', '.') }}</td>
                                    <td class="text-right amount">Rp {{ number_format($addon->pivot['price'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endif

                        @if($booking->addon_amount > 0)
                            <tr style="background: #f0f9ff;">
                                <td colspan="3" style="text-align: right;"><strong>Subtotal Add-ons:</strong></td>
                                <td class="text-right amount">Rp {{ number_format($booking->addon_amount, 0, ',', '.') }}</td>
                            </tr>
                        @endif

                        @if($booking->discount_amount > 0)
                            <tr style="background: #dcfce7;">
                                <td colspan="3" style="text-align: right;"><strong>Diskon Promo {{ $booking->promoCode ? '(' . $booking->promoCode->code . ')' : '' }}:</strong></td>
                                <td class="text-right amount" style="color: #15803d;">-Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div class="summary-section">
                <div class="summary-box">
                    <div class="summary-item">
                        <strong>Subtotal:</strong>
                        <span>Rp {{ number_format($basePrice, 0, ',', '.') }}</span>
                    </div>
                    @if($booking->addon_amount > 0)
                        <div class="summary-item">
                            <strong>Layanan Tambahan:</strong>
                            <span>Rp {{ number_format($booking->addon_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    @if($booking->discount_amount > 0)
                        <div class="summary-item">
                            <strong>Diskon Promo:</strong>
                            <span>-Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    @if($booking->deposit_amount > 0)
                        <div class="summary-item">
                            <strong>Uang Deposit (Jaminan):</strong>
                            <span>Rp {{ number_format($booking->deposit_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="summary-item total">
                        <strong>TOTAL BIAYA SEWA:</strong>
                        <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                    @if($booking->dp_amount > 0)
                        <div class="summary-item" style="margin-top: 10px; color: #15803d; font-size: 13px;">
                            <strong style="color: #15803d;">Sudah Dibayar (DP):</strong>
                            <span>-Rp {{ number_format($booking->dp_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-item total" style="background: #fee2e2; border-top: 2px solid #ef4444; color: #b91c1c; margin-top: 5px;">
                            <strong style="color: #b91c1c;">SISA PEMBAYARAN:</strong>
                            <span style="color: #b91c1c;">Rp {{ number_format(max(0, $booking->total_price - $booking->dp_amount), 0, ',', '.') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            @if($booking->with_driver)
                <div class="note-box">
                    <strong>Biaya Tidak Termasuk dalam Harga Sewa Sopir:</strong><br>
                    • Uang makan sopir selama perjalanan<br>
                    • Biaya tol (jika melewati jalan tol)<br>
                    • Tiket parkir di seluruh lokasi tujuan<br>
                    • Tiket pelabuhan/penyeberangan (jika antar pulau)
                </div>
            @endif

            <!-- Terms & Conditions -->
            <div class="terms-section">
                <div class="terms-title">SYARAT & KETENTUAN PENYEWAAN</div>
                <div class="terms-text">
                    <ul>
                        <li><strong>Pembayaran DP:</strong> Minimal 50% dari total harga sewa harus dibayarkan untuk mengkonfirmasi pemesanan</li>
                        <li><strong>Pembayaran Lunas:</strong> Sisa pembayaran harus diselesaikan sebelum pengambilan kendaraan</li>
                        <li><strong>Syarat Penyewaan:</strong> Peminjam harus menyiapkan KTP Asli/Identitas Resmi, usia minimum 21 tahun, memiliki SIM yang masih berlaku, tidak ada catatan pelanggaran lalu lintas berat</li>
                        <li><strong>Kebijakan Pembatalan:</strong> 3 hari sebelumnya refund 100% (-Rp 75.000), 1-3 hari sebelumnya refund 50%, hari H tidak ada refund, timeline refund 6-9 hari kerja</li>
                        <li><strong>Tanggung Jawab Penyewa:</strong> Menjaga kondisi kendaraan, bertanggung jawab atas kerusakan, mengembalikan tepat waktu dalam kondisi bersih, biaya denda keterlambatan Rp 500.000/jam</li>
                        <li><strong>Uang Deposit/Jaminan:</strong> Khusus untuk pembayaran tunai, uang deposit wajib diserahkan saat pengambilan unit di lapangan. Uang deposit akan dikembalikan 100% secara penuh saat mobil dikembalikan dengan selamat, indikator bensin sesuai, dan tidak ada pelanggaran/kerusakan.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div class="footer-item">
                <p>Pemesan</p>
                <strong></strong>
                <p style="margin-top: 3px;">{{ $booking->user->name }}</p>
            </div>
            <div class="footer-item">
                <p>Disetujui oleh</p>
                <strong></strong>
            </div>
            <div class="footer-item">
                <p>PT AutoRent Indonesia</p>
                <strong></strong>
            </div>
        </div>

        <!-- Generated Info -->
        <div style="padding: 15px 30px; text-align: center; font-size: 10px; color: #64748b; border-top: 1px solid #e5e7eb; margin-top: 20px;">
            <p style="margin-bottom: 8px;">
                <strong style="color: #334155;">DOKUMEN RESMI DAN SAH.</strong><br>
                Validasi keaslian dokumen ini dengan memindai (Scan) QR Code di pojok kanan atas atau kunjungi tautan berikut:<br>
                <a href="{{ route('invoice.validate', $booking->id) }}" style="color: #0ea5e9; text-decoration: none;">{{ route('invoice.validate', $booking->id) }}</a>
            </p>
            <p>Dokumen ini dicetak oleh sistem AutoRent pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
            <p>Invoice #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }} | {{ $booking->user->email }}</p>
        </div>

        <div style="page-break-before: always;"></div>

        <!-- Vehicle Inspection Form (Field Unit) -->
        <div class="invoice-container" style="border-top: none;">
            <div class="section" style="margin-top: 0;">
                <div class="section-title" style="background: #0ea5e9; color: white; padding: 10px; text-align: center;">Formulir Inspeksi & Serah Terima Kendaraan (Di Lapangan)</div>
                <div style="margin-bottom: 15px; font-size: 12px; color: #475569;">
                    <strong>No. Invoice:</strong> #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                    <strong>Plat Nomor:</strong> {{ $booking->carUnit ? $booking->carUnit->license_plate : 'Belum Ditetapkan' }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                    <strong>Penyewa:</strong> {{ $booking->user->name }}
                </div>
                <table style="margin-top: 15px;">
                    <thead>
                        <tr>
                            <th width="35%">Item Pemeriksaan</th>
                            <th width="32.5%" style="text-align: center;">Saat Penyerahan (Keluar)</th>
                            <th width="32.5%" style="text-align: center;">Saat Pengembalian (Masuk)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 15px 10px;"><strong>Angka Odometer (Km)</strong></td>
                            <td align="center" style="padding: 15px 10px;">Km: ____________________</td>
                            <td align="center" style="padding: 15px 10px;">Km: ____________________</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 10px;"><strong>Level BBM (Indikator Bensin)</strong></td>
                            <td align="center" style="padding: 15px 10px;">_____ / _____ Bar</td>
                            <td align="center" style="padding: 15px 10px;">_____ / _____ Bar</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 10px;"><strong>Eksterior (Body Baret/Penyok)</strong></td>
                            <td align="center" style="padding: 15px 10px;">[ &nbsp; ] Mulus &nbsp;&nbsp; [ &nbsp; ] Ada Baret</td>
                            <td align="center" style="padding: 15px 10px;">[ &nbsp; ] Mulus &nbsp;&nbsp; [ &nbsp; ] Ada Baret</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 10px;"><strong>Interior & Kebersihan Kabin</strong></td>
                            <td align="center" style="padding: 15px 10px;">[ &nbsp; ] Bersih &nbsp;&nbsp; [ &nbsp; ] Kotor/Bau</td>
                            <td align="center" style="padding: 15px 10px;">[ &nbsp; ] Bersih &nbsp;&nbsp; [ &nbsp; ] Kotor/Bau</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 10px;"><strong>Kelengkapan (STNK, Ban Serep)</strong></td>
                            <td align="center" style="padding: 15px 10px;">[ &nbsp; ] Lengkap &nbsp;&nbsp; [ &nbsp; ] Tidak</td>
                            <td align="center" style="padding: 15px 10px;">[ &nbsp; ] Lengkap &nbsp;&nbsp; [ &nbsp; ] Tidak</td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 10px;"><strong>Catatan / Keterangan Kerusakan</strong></td>
                            <td><br><br><br></td>
                            <td><br><br><br></td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 10px;"><strong>Tanda Tangan Petugas & Penyewa</strong></td>
                            <td align="center"><br><br><br>____________________</td>
                            <td align="center"><br><br><br>____________________</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
