<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Thermal - {{ $booking->booking_code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            background-color: #fff;
            width: 58mm; /* Ukuran kertas thermal */
            padding: 2mm;
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .text-lg { font-size: 16px; }
        .mb-1 { margin-bottom: 2px; }
        .mb-2 { margin-bottom: 5px; }
        .mt-2 { margin-top: 5px; }
        .mt-4 { margin-top: 10px; }
        
        .divider {
            border-bottom: 1px dashed #000;
            margin: 5px 0;
        }
        
        .flex { display: flex; }
        .justify-between { justify-content: space-between; }
        
        .qr-wrapper {
            display: flex;
            justify-content: center;
            margin: 10px 0;
        }
        
        @media print {
            body {
                width: 58mm;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }

        .highlight-box {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            margin: 5px 0;
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>
<body onload="window.print()">

    <!-- ================= TIKET PENUMPANG ================= -->
    <div class="text-center mb-2">
        <h2 class="font-bold text-lg mb-1">AUTORENT</h2>
        <p>TIKET PENUMPANG</p>
    </div>

    <div class="divider"></div>

    <div class="text-left mb-2">
        <p>KODE: <strong>{{ $booking->booking_code }}</strong></p>
        <p>TGL CETAK: {{ now()->format('d/m/y H:i') }} WIB</p>
        <p>TGL PESAN: {{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/y H:i') }} WIB</p>
        <p>KASIR: {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 15)) : 'WEB' }}</p>
    </div>

    <div class="divider"></div>

    <div class="text-left mb-2">
        <p class="font-bold">Penumpang:</p>
        <p>{{ $booking->user->name ?? 'Tamu' }} ({{ $booking->quantity }} Org)</p>
    </div>

    <div class="text-left mb-2">
        <p class="font-bold">Keberangkatan:</p>
        <p>{{ \Carbon\Carbon::parse($booking->travel_date)->translatedFormat('l, d M Y') }} - {{ \Carbon\Carbon::parse($booking->route->departure_time)->format('H:i') }} WIB</p>
    </div>

    <div class="text-left mb-2">
        <p class="font-bold">Kedatangan (Est):</p>
        <p>{{ \Carbon\Carbon::parse($booking->travel_date)->translatedFormat('l, d M Y') }} - {{ \Carbon\Carbon::parse($booking->route->arrival_time)->format('H:i') }} WIB</p>
    </div>

    <div class="text-left mb-2">
        <p class="font-bold">Driver & Kendaraan:</p>
        <p>{{ $booking->driver_name ?? '-' }} / {{ $booking->license_plate ?? '-' }}</p>
    </div>

    <div class="text-left mb-2">
        <p class="font-bold">Rute & Titik Kumpul:</p>
        <p>{{ $booking->route->origin_city ?? '-' }} -> {{ $booking->route->destination_city ?? '-' }}</p>
        <p class="mt-2 text-xs"><strong>Jemput:</strong> {{ $booking->pickup_address ?? '-' }}</p>
        <p class="text-xs"><strong>Turun:</strong> {{ $booking->dropoff_address ?? '-' }}</p>
    </div>

    <div class="text-left mb-2">
        <p class="font-bold">Nomor Kursi:</p>
        <p>
            @php $seats = is_string($booking->seat_numbers) ? json_decode($booking->seat_numbers, true) : $booking->seat_numbers; @endphp
            {{ implode(', ', $seats ?? []) }}
        </p>
    </div>

    <div class="divider"></div>

    <div class="flex justify-between mb-1">
        <span>TOTAL</span>
        <span class="font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between">
        <span>STATUS</span>
        <span class="font-bold">{{ $booking->payment_status == 'paid' ? 'LUNAS' : 'BLM LUNAS' }}</span>
    </div>

    <div class="divider"></div>

    <div class="qr-wrapper">
        {!! QrCode::size(120)->margin(0)->generate(route('shuttle.validate', $booking->booking_code)) !!}
    </div>
    
    <div class="text-center mb-2">
        <p>Scan QR untuk Validasi Boarding</p>
    </div>

    <div class="divider"></div>

    <div class="text-left mt-2 mb-2" style="font-size: 10px;">
        <p class="font-bold">Info Penting:</p>
        <p>- Bagasi maks 15kg/penumpang.</p>
        <p>- Hadir maks 30 mnt sblm jadwal.</p>
        <p>- Tiket hangus jika terlambat.</p>
        <p class="mt-2 font-bold">Bantuan CS: 0812-3456-7890</p>
    </div>

    <div class="divider"></div>

    <div class="text-center mt-2 mb-4">
        <p>Terima kasih telah menggunakan</p>
        <p>AutoRent Shuttle</p>
        <p>www.autorent.com</p>
    </div>

    <!-- ================= KUPON MAKAN ================= -->
    @if($booking->include_meal || $booking->include_snack)
        <div style="border-bottom: 1px dashed #000; margin: 15px 0;"></div>
        <div class="text-center mb-2" style="margin-top: -12px;">
            <span style="background: #fff; padding: 0 5px; font-size: 10px;">✂ Potong di sini ✂</span>
        </div>

        <div class="text-center mt-4 mb-2">
            <h2 class="font-bold text-lg mb-1">AUTORENT</h2>
            <p>KUPON RUMAH MAKAN</p>
        </div>

        <div class="divider"></div>

        <div class="text-left mb-2">
            <p>KODE: <strong>{{ $booking->booking_code }}</strong></p>
            <p>TGL KBRGKT: {{ \Carbon\Carbon::parse($booking->travel_date)->format('d/m/y') }}</p>
        </div>

        <div class="text-left mb-2">
            <p class="font-bold">Data Penumpang:</p>
            <p>{{ $booking->user->name ?? 'Tamu' }}</p>
            <p>Telp: {{ $booking->user->phone ?? '-' }}</p>
            <p>Jumlah: {{ $booking->quantity }} Orang</p>
        </div>

        <div class="highlight-box text-left" style="padding: 5px;">
            @if($booking->include_meal)
                <p>MAKAN: <strong>YA ({{ $booking->meal_upgrade ? 'UPGRADE' : 'STANDAR' }})</strong></p>
                <p>MENU : {{ $booking->meal_name ?? '....................' }}</p>
            @endif
            @if($booking->include_snack)
                <p>SNACK: <strong>YA</strong></p>
            @endif
        </div>

        <div class="qr-wrapper">
            {!! QrCode::size(100)->margin(0)->generate(route('shuttle.validate', $booking->booking_code)) !!}
        </div>
        
        <div class="text-center mb-2">
            <p>Scan QR untuk</p>
            <p>Validasi & Tukar Makan</p>
        </div>

        <div class="divider"></div>
        <div class="text-center mt-2">
            <p>Berikan potongan kupon ini ke</p>
            <p>kasir rumah makan AutoRent.</p>
        </div>
    @endif

    <!-- Padding for tearing paper -->
    <div style="height: 15mm;"></div>

    <div class="no-print text-center" style="margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px; font-size: 14px; cursor: pointer; background: #0ea5e9; color: white; border: none; border-radius: 5px;">Cetak Ulang</button>
        <br><br>
        <a href="{{ route('shuttle.show', $booking->booking_code) }}" style="color: #64748b; text-decoration: none;">Kembali</a>
    </div>
</body>
</html>
