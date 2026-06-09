<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Tiket Travel Shuttle - {{ $booking->booking_code }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0ea5e9;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #0ea5e9;
            margin: 0;
            font-size: 28px;
            letter-spacing: 2px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #64748b;
        }
        .ticket-info {
            width: 100%;
            margin-bottom: 30px;
        }
        .ticket-info td {
            vertical-align: top;
        }
        .info-label {
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 15px;
        }
        .section-title {
            background-color: #f1f5f9;
            padding: 10px 15px;
            font-weight: bold;
            color: #0f172a;
            border-left: 4px solid #0ea5e9;
            margin-bottom: 15px;
        }
        table.details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table.details th, table.details td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: left;
        }
        table.details th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: bold;
            font-size: 13px;
        }
        .text-right {
            text-align: right !important;
        }
        .qr-section {
            text-align: center;
            margin-top: 30px;
        }
        .qr-section img {
            width: 150px;
            height: 150px;
        }
        .meal-coupon {
            margin-top: 40px;
            border: 2px dashed #cbd5e1;
            padding: 20px;
            border-radius: 10px;
            page-break-inside: avoid;
        }
        .meal-coupon h2 {
            margin-top: 0;
            color: #0f172a;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>AUTORENT SHUTTLE</h1>
        <p>E-Tiket Perjalanan Resmi</p>
    </div>

    <table class="ticket-info">
        <tr>
            <td style="width: 50%;">
                <div class="info-label">Kode Booking</div>
                <div class="info-value">{{ $booking->booking_code }}</div>

                <div class="info-label">Nama Pemesan / Penumpang</div>
                <div class="info-value">{{ $booking->user->name ?? 'Tamu' }} ({{ $booking->quantity }} Orang)</div>
            </td>
            <td style="width: 50%; text-align: right;">
                <div class="info-label">Tanggal Pesan</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, H:i') }} WIB</div>

                <div class="info-label">Status Pembayaran</div>
                <div class="info-value" style="color: {{ $booking->payment_status == 'paid' ? '#059669' : '#dc2626' }};">
                    {{ $booking->payment_status == 'paid' ? 'LUNAS' : 'BELUM LUNAS' }}
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Informasi Perjalanan</div>
    <table class="details">
        <tr>
            <th style="width: 50%;">Asal (Keberangkatan)</th>
            <th style="width: 50%;">Tujuan (Kedatangan)</th>
        </tr>
        <tr>
            <td>
                <strong>{{ $booking->route->origin_city ?? '-' }}</strong><br>
                Tanggal: {{ \Carbon\Carbon::parse($booking->travel_date)->translatedFormat('l, d F Y') }}<br>
                Jam: {{ \Carbon\Carbon::parse($booking->route->departure_time)->format('H:i') }} WIB<br>
                <span style="font-size: 12px; color: #64748b;">Lokasi Jemput: {{ $booking->pickup_address ?? '-' }}</span>
            </td>
            <td>
                <strong>{{ $booking->route->destination_city ?? '-' }}</strong><br>
                Jam (Est): {{ \Carbon\Carbon::parse($booking->route->arrival_time)->format('H:i') }} WIB<br><br>
                <span style="font-size: 12px; color: #64748b;">Lokasi Turun: {{ $booking->dropoff_address ?? '-' }}</span>
            </td>
        </tr>
    </table>

    <div class="section-title">Fasilitas & Kendaraan</div>
    <table class="details">
        <tr>
            <th>Pengemudi & Kendaraan</th>
            <th>Nomor Kursi</th>
            <th>Makan & Minum</th>
        </tr>
        <tr>
            <td>
                Sopir: {{ $booking->driver_name ?? 'Menunggu Penugasan' }} ({{ $booking->driver_phone ?? '-' }})<br>
                Mobil: {{ $booking->license_plate ?? '-' }} / Warna: <span style="text-transform: capitalize;">{{ $booking->car_color ?? '-' }}</span>
            </td>
            <td>
                @php $seats = is_string($booking->seat_numbers) ? json_decode($booking->seat_numbers, true) : $booking->seat_numbers; @endphp
                {{ implode(', ', $seats ?? []) }}
            </td>
            <td>
                Snack: {{ $booking->include_snack ? 'Ya' : 'Tidak' }}<br>
                Makan: {{ $booking->include_meal ? 'Ya (' . ($booking->meal_upgrade ? 'Upgrade' : 'Standar') . ')' : 'Tidak' }}
            </td>
        </tr>
    </table>

    <div class="section-title">Total Pembayaran</div>
    <table class="details">
        <tr>
            <td><strong>TOTAL (Rp)</strong></td>
            <td class="text-right"><strong>{{ number_format($booking->total_price, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <div class="qr-section">
        <p style="margin-bottom: 5px; font-weight: bold;">Scan QR Ini ke Petugas untuk Boarding:</p>
        <!-- Use base64 PNG instead of SVG for better DomPDF compatibility -->
        <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(150)->margin(0)->generate(route('shuttle.validate', $booking->booking_code))) }}" alt="QR Code">
    </div>

    @if($booking->include_meal || $booking->include_snack)
    <div class="meal-coupon">
        <h2>Kupon Rumah Makan AutoRent</h2>
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%;">
                    <p><strong>Kode:</strong> {{ $booking->booking_code }}</p>
                    <p><strong>Tanggal Keberangkatan:</strong> {{ \Carbon\Carbon::parse($booking->travel_date)->format('d/m/Y') }}</p>
                    <p><strong>Nama:</strong> {{ $booking->user->name ?? 'Tamu' }} ({{ $booking->quantity }} Orang)</p>
                    <br>
                    @if($booking->include_meal)
                        <p style="font-size: 16px;">MAKAN: <strong>YA ({{ $booking->meal_upgrade ? 'UPGRADE' : 'STANDAR' }})</strong></p>
                    @endif
                    @if($booking->include_snack)
                        <p style="font-size: 16px;">SNACK: <strong>YA</strong></p>
                    @endif
                    <p style="margin-top: 15px; font-size: 12px; color: #64748b;">*Tunjukkan kupon ini di kasir rumah makan yang bekerja sama dengan AutoRent Shuttle.</p>
                </td>
                <td style="width: 30%; text-align: center;">
                    <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->margin(0)->generate(route('shuttle.validate', $booking->booking_code))) }}" alt="QR Code Kupon" style="width: 100px; height: 100px;">
                    <p style="font-size: 10px; margin-top: 5px;">Scan Validasi</p>
                </td>
            </tr>
        </table>
    </div>
    @endif

    <div class="footer">
        <p><strong>Syarat & Ketentuan Perjalanan:</strong></p>
        <p>1. Penumpang diwajibkan hadir di titik kumpul maksimal 30 menit sebelum jam keberangkatan.</p>
        <p>2. Kapasitas bagasi maksimal 15kg per penumpang. Kelebihan bagasi dapat dikenakan biaya tambahan.</p>
        <p>3. E-Tiket ini adalah bukti perjalanan yang sah. Simpan dan tunjukkan kepada petugas / driver saat boarding.</p>
        <br>
        <p>&copy; {{ date('Y') }} AutoRent Shuttle - Sistem Reservasi Online Terpadu</p>
    </div>

</body>
</html>
