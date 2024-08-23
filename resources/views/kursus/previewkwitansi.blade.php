<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="192x192"
        href="https://masjidagungalazhar.com/assets/images/favicon/android-icon-192x192.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi {{ $pembayaran->pendaftaran->murid->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }

        .kwitansi {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 60px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .logo-title {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 80px;
            margin-right: 20px;
        }

        .title {
            text-align: left;
        }

        .title h1 {
            margin: 0;
            font-size: 26px;
        }

        .title p {
            margin: 0;
            font-size: 18px;
        }

        .document-info {
            text-align: right;
            font-size: 14px;
            line-height: 5px;
        }

        .info {
            margin-bottom: 20px;
            line-height: 30px;
        }

        .info-row {
            display: flex;
            margin-bottom: 10px;
        }

        .info-label {
            width: 150px;
            font-weight: bold;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
            font-size: 14px;
            line-height: 5px;
        }

        .signature-line {
            border-top: 1px solid black;
            width: 160px;
            margin-left: auto;
            margin-bottom: 1px;
        }

        .note {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="kwitansi">
        <div class="header">
            <div class="logo-title">
                <img src="{{ asset('storage/logo-maa.png') }}" alt="Logo MAA" class="logo">
                <div class="title">
                    <h1>KWITANSI</h1>
                    <p>Kursus Al Azhar</p>
                </div>
            </div>
            <div class="document-info">
                <p>No : {{ $nomor_kwitansi }}</p>
                <p>Tanggal : {{ now()->locale('id')->isoFormat('D/MMMM/YYYY') }}</p>
            </div>
        </div>

        <div class="info">
            <div class="info-row">
                <span class="info-label">Telah Terima Dari</span>
                <span>&nbsp&nbsp: {{ $pembayaran->pendaftaran->murid->nama }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Uang Sejumlah</span>
                <span>&nbsp&nbsp: Rp
                    {{ number_format($pembayaran->pendaftaran->jadwal->kategori->biaya, 0, ',', '.') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Untuk Pembayaran</span>
                <span>&nbsp&nbsp: {{ $pembayaran->pendaftaran->jadwal->kategori->nama_kursus }}
                    ({{ strtoupper($pembayaran->pendaftaran->jadwal->kategori->jenis_kursus) }}) |
                    {{ $pembayaran->pendaftaran->jadwal->hari }} ({{ $pembayaran->pendaftaran->jadwal->jam_mulai }}
                    s.d{{ $pembayaran->pendaftaran->jadwal->jam_selesai }})
                    <br>&nbsp&nbsp&nbsp&nbspGuru: {{ $pembayaran->pendaftaran->jadwal->kategori->guru->nama }} |
                    Iuran : {{ \Carbon\Carbon::parse($pembayaran->tanggal)->locale('id')->isoFormat('MMMM YYYY') }} |
                    Metode Pembayaran :
                    {{ $pembayaran->metode_pembayaran == '1. Tunai' ? 'Tunai' : ($pembayaran->metode_pembayaran == '2. Transfer Bank' ? 'Transfer Bank' : 'Kartu Kredit') }}
                </span>
            </div>
        </div>

        <div class="signature">
            <p>Jakarta, {{ now()->locale('id')->isoFormat('D MMMM YYYY') }}</p>
            <br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="signature-line"></div>
            <p>Kepala Kursus Al Azhar</p>
        </div>

        <div class="note">
            Kwitansi ini adalah bukti pembayaran sah yang dikeluarkan oleh Kursus Al Azhar.
        </div>
    </div>
</body>

</html>
