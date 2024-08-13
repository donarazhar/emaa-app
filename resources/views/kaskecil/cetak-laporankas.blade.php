<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="192x192"
        href="https://masjidagungalazhar.com/assets/images/favicon/android-icon-192x192.png">
    <title>Cetak Per {{ date('d-m-Y', strtotime($periodeawal)) }} s.d {{ date('d-m-Y', strtotime($periodeakhir)) }}
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #000;
        }

        .header {
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

        .header small {
            font-size: 16px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            font-size: 14px;
            page-break-inside: auto;
            table-layout: auto;
            /* Menyesuaikan ukuran kolom sesuai konten */
        }

        th,
        td {
            border: 1px solid black;
            text-align: left;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }

        th[colspan="2"] {
            text-align: center;
        }

        .signature {
            width: 100%;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 50px;
            page-break-inside: avoid;
        }

        .signature div {
            width: 45%;
        }

        .signature p {
            margin: 0;
        }

        .signature p strong {
            display: block;
            margin-top: 50px;
        }

        .jumlah {
            text-align: right;
            font-weight: bold;
        }

        .total {
            text-align: center;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div class="header">
        Yayasan Pesantren Islam Al Azhar<br>
        Masjid Agung Al Azhar<br>
        <small>Kas Kecil Per {{ date('d-m-Y', strtotime($periodeawal)) }} s.d
            {{ date('d-m-Y', strtotime($periodeakhir)) }}</small>
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Akun AAS</th>
                <th>Mata Anggaran</th>
                <th colspan="2">URAIAN</th>

                <th colspan="2">Besaran (Rp)</th>
            </tr>
            <tr>
                <th colspan="4"></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalsPerAkunAAS = [];
                $currentKodeAAS = null;
                $currentTotal = 0;
                $totalKeseluruhan = 0;
                $rowIndex = 1;
            @endphp
            @foreach ($pengeluaranbulanini as $d)
                {{-- Periksa perubahan pada kode AAS --}}
                @if ($currentKodeAAS !== $d->matanggaran->aas->kode_aas)
                    {{-- Tampilkan total untuk kode AAS sebelumnya --}}
                    @if ($currentKodeAAS !== null)
                        <tr>
                            <td></td>
                            <td colspan="4" class="jumlah">Jumlah</td>
                            <td colspan="2" style="text-align: right;">
                                {{ number_format($currentTotal, 0, ',', '.') }}</td>
                        </tr>
                        @php
                            $totalsPerAkunAAS[$currentKodeAAS] = $currentTotal;
                            $currentTotal = 0;
                        @endphp
                    @endif

                    {{-- Update currentKodeAAS --}}
                    @php
                        $currentKodeAAS = $d->matanggaran->aas->kode_aas;
                    @endphp
                @endif

                {{-- Tambahkan jumlah untuk total per akun AAS --}}
                @php
                    $currentTotal += $d->jumlah;
                    $totalKeseluruhan += $d->jumlah;
                @endphp

                {{-- Tampilkan baris untuk setiap item dalam akun AAS --}}
                <tr>
                    <td>{{ $rowIndex++ }}.</td>
                    <td>{{ $d->matanggaran->aas->kode_aas }}</td>
                    <td>{{ $d->matanggaran->kode_matanggaran }}</td>
                    <td>{{ $d->matanggaran->aas->nama_aas }}</td>
                    <td>{{ $d->perincian }}</td>
                    <td>{{ number_format($d->jumlah, 0, ',', '.') }}</td>
                    <td></td> <!-- Kolom kosong untuk menempatkan jumlah semua per akun -->
                </tr>
            @endforeach

            {{-- Tampilkan total untuk kode AAS terakhir --}}
            @if ($currentKodeAAS !== null)
                <tr>
                    <td></td>
                    <td colspan="4" class="jumlah">Jumlah</td>
                    <td colspan="2" style="text-align: right;">
                        {{ number_format($currentTotal, 0, ',', '.') }}</td>
                </tr>
                @php
                    $totalsPerAkunAAS[$currentKodeAAS] = $currentTotal;
                @endphp
            @endif
        </tbody>
        <tr>
            <th colspan="4"></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tfoot>
            <tr>
                <td></td>
                <td colspan="4" class="total"><b>Total Keseluruhan</b></td>
                <td><b>{{ number_format($totalKeseluruhan, 0, ',', '.') }}</b></td>
                <td style="text-align: right;"><b>{{ number_format($totalKeseluruhan, 0, ',', '.') }}</b></td>
            </tr>
        </tfoot>
    </table>

    <!-- Tanda Tangan -->
    <div class="signature">
        <div>
            <p>Mengetahui,<br>
                Kepala Kantor Masjid Agung Al Azhar<br><br><br>
                <strong>H. Tatang Komara</strong>
            </p>
        </div>
        <div>
            <p>
                Jakarta, {{ date('d-m-Y') }}<br>
                Dibuat oleh,<br>
                Tata Usaha<br><br><br>
                <strong>Donarsi Yosianto</strong>
            </p>
        </div>
    </div>

</body>

</html>
