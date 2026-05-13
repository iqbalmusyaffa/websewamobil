<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }} - AutoRent</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .print-only {
            display: none;
        }

        @media print {
            body {
                background: white;
            }
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            .invoice-container {
                box-shadow: none;
                border: none;
                margin: 0;
                padding: 0;
                page-break-after: always;
            }
        }

        .header {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .print-buttons {
            background: white;
            padding: 15px 20px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .print-buttons button {
            background: #0ea5e9;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }

        .print-buttons button:hover {
            background: #0284c7;
        }

        .invoice-container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            padding: 40px;
            border-bottom: 3px solid #0ea5e9;
        }

        .company-info h1 {
            color: #0ea5e9;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .company-info p {
            color: #666;
            font-size: 13px;
        }

        .invoice-meta {
            text-align: right;
        }

        .invoice-meta h2 {
            font-size: 24px;
            color: #0ea5e9;
            margin-bottom: 15px;
        }

        .meta-item {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .meta-item strong {
            color: #333;
        }

        .invoice-body {
            padding: 40px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #0ea5e9;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 20px;
        }

        .info-item {
            font-size: 14px;
            line-height: 1.8;
        }

        .info-item strong {
            color: #0ea5e9;
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        /* Details Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 13px;
        }

        table thead {
            background: #f0f9ff;
            border-bottom: 2px solid #0ea5e9;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            color: #0ea5e9;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        table tr:hover {
            background: #f9fafb;
        }

        .text-right {
            text-align: right;
        }

        .amount {
            font-weight: bold;
            color: #1f2937;
        }

        /* Summary Section */
        .summary-section {
            display: flex;
            justify-content: flex-end;
            margin: 30px 0;
        }

        .summary-box {
            width: 350px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px solid #0ea5e9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(14, 165, 233, 0.15);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            font-size: 14px;
            gap: 20px;
            padding: 0 5px;
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
            min-width: 140px;
        }

        .summary-item.total {
            border-top: 2px solid #0ea5e9;
            padding: 16px 5px 0 5px;
            margin-top: 12px;
            margin-bottom: 0;
            font-size: 15px;
            font-weight: bold;
            color: #0ea5e9;
            background: rgba(14, 165, 233, 0.05);
            margin-left: -20px;
            margin-right: -20px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .summary-item.total span {
            color: #0ea5e9;
            font-size: 16px;
        }

        /* Terms Section */
        .terms-section {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            border-left: 4px solid #0ea5e9;
        }

        .terms-title {
            font-weight: bold;
            color: #0ea5e9;
            margin-bottom: 12px;
            font-size: 13px;
        }

        .terms-text {
            font-size: 12px;
            color: #555;
            line-height: 1.7;
        }

        .terms-text ul {
            margin-left: 20px;
            margin-top: 8px;
        }

        .terms-text li {
            margin-bottom: 6px;
        }

        /* Footer */
        .invoice-footer {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            padding: 40px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        .footer-item {
            text-align: center;
            font-size: 13px;
        }

        .footer-item strong {
            display: block;
            margin-top: 20px;
            height: 40px;
            border-top: 1px solid #999;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .note-box {
            background: #fef08a;
            border: 1px solid #facc15;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 13px;
            color: #713f12;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .invoice-header {
                flex-direction: column;
                gap: 20px;
            }

            .invoice-meta {
                text-align: left;
            }

            table {
                font-size: 12px;
            }

            table th, table td {
                padding: 8px;
            }

            .invoice-footer {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="no-print print-buttons">
        <button onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
        <button onclick="window.history.back()">← Kembali</button>
    </div>

    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <h1>🚗 AutoRent</h1>
                <p><strong>Layanan Rental Mobil Terpercaya</strong></p>
                <p style="margin-top: 10px;">📞 (021) 1234-5678</p>
                <p>📧 info@autorent.com</p>
                <p>🌐 www.autorent.com</p>
            </div>
            <div class="invoice-meta">
                <h2>INVOICE</h2>
                <div class="meta-item"><strong>Invoice No:</strong> #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="meta-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                <div class="meta-item">
                    <strong>Status:</strong>
                    <span class="status-badge {{ match($booking->status) {
                        'menunggu pembayaran' => 'status-pending',
                        'disetujui' => 'status-approved',
                        'berjalan' => 'status-approved',
                        'selesai' => 'status-completed',
                        'dibatalkan' => 'status-cancelled',
                        default => 'status-pending'
                    } }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="invoice-body">
            <!-- Customer Info -->
            <div class="section">
                <div class="section-title">📋 Informasi Pemesan</div>
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
                <div class="section-title">🚗 Detail Penyewaan</div>
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

            <!-- Pricing Details -->
            <div class="section">
                <div class="section-title">💰 Rincian Biaya</div>
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
                    <div class="summary-item total">
                        <strong>TOTAL:</strong>
                        <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            @if($booking->with_driver)
                <div class="note-box">
                    <strong>⚠️ Biaya Tidak Termasuk dalam Harga Sewa Sopir:</strong><br>
                    • Uang makan sopir selama perjalanan<br>
                    • Biaya tol (jika melewati jalan tol)<br>
                    • Tiket parkir di seluruh lokasi tujuan<br>
                    • Tiket pelabuhan/penyeberangan (jika antar pulau)
                </div>
            @endif

            <!-- Terms & Conditions -->
            <div class="terms-section">
                <div class="terms-title">📌 SYARAT & KETENTUAN</div>
                <div class="terms-text">
                    <ul>
                        <li><strong>Pembayaran DP:</strong> Minimal 50% dari total harga sewa harus dibayarkan untuk mengkonfirmasi pemesanan</li>
                        <li><strong>Pembayaran Lunas:</strong> Sisa pembayaran harus diselesaikan sebelum pengambilan kendaraan</li>
                        <li><strong>Syarat Penyewaan:</strong>
                            <ul style="margin-top: 5px;">
                                <li>Peminjam harus menyiapkan KTP Asli/Identitas Resmi saat pengambilan kendaraan</li>
                                <li>Usia minimum pengemudi: 21 tahun</li>
                                <li>Memiliki SIM yang masih berlaku</li>
                                <li>Tidak ada catatan pelanggaran lalu lintas berat</li>
                            </ul>
                        </li>
                        <li><strong>Kebijakan Pembatalan:</strong>
                            <ul style="margin-top: 5px;">
                                <li>Pembatalan 3 hari sebelumnya: Refund 100% (minus biaya admin Rp 75.000)</li>
                                <li>Pembatalan 1-3 hari sebelumnya: Refund 50%</li>
                                <li>Pembatalan hari H: Tidak ada refund</li>
                                <li>Timeline refund: 6-9 hari kerja setelah verifikasi</li>
                            </ul>
                        </li>
                        <li><strong>Tanggung Jawab Penyewa:</strong>
                            <ul style="margin-top: 5px;">
                                <li>Menjaga kondisi kendaraan dengan baik</li>
                                <li>Bertanggung jawab atas kerusakan yang disebabkan kelalaian</li>
                                <li>Mengembalikan kendaraan tepat waktu dan dalam kondisi bersih</li>
                                <li>Biaya denda keterlambatan: Rp 500.000 per jam</li>
                            </ul>
                        </li>
                        <li><strong>Asuransi & Jaminan:</strong>
                            <ul style="margin-top: 5px;">
                                <li>Setiap kendaraan sudah diasuransikan</li>
                                <li>Penyewa diminta memberikan deposit/jaminan untuk kerusakan darurat</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div class="footer-item">
                <p>Pemesan</p>
                <strong></strong>
                <p style="margin-top: 5px; font-size: 12px;">{{ $booking->user->name }}</p>
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

        <!-- Print Footer -->
        <div style="padding: 20px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #e5e7eb;">
            <p>Dokumen ini dicetak oleh sistem AutoRent pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
            <p>Invoice #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }} | {{ $booking->user->email }}</p>
        </div>
    </div>
</body>
</html>
