<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="192x192"
        href="https://masjidagungalazhar.com/assets/images/favicon/android-icon-192x192.png">
    <title>Cetak Surat Penggantian Kas Kecil</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: white;
            margin: 0;
            padding: 20px;
            color: hsl(0, 0%, 0%);
            font-size: 14px;
        }

        #header {
            display: flex;
            align-items: center;
        }

        #logo {
            width: 100px;
            margin-right: 20px;
        }

        #kop-surat {
            flex-grow: 1;
            text-align: center;
        }

        #kop-surat div {
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }

        #alamat {
            font-size: 14px;
            color: hsl(125, 100%, 36%);
        }

        #title {
            font-size: 20px;
            font-weight: bold;
            color: hsl(125, 100%, 36%);
        }

        h2#subjudul {
            font-size: 28px;
            font-weight: bold;
            color: hsl(125, 100%, 36%);
            margin: 0;
            padding: 0;
        }

        hr {
            margin: 5px 0;
            height: 1px;
            background-color: hsl(125, 100%, 36%);
            border: 1px solid hsl(125, 100%, 36%);
            /* Tambahkan border untuk memastikan garis dicetak */
        }

        hr#tebal {
            margin: 5px 0;
            height: 2px;
            background-color: hsl(125, 100%, 36%);
            border: 1px solid hsl(125, 100%, 36%);
        }

        p {
            margin: 2px 0;
            line-height: 130%;
            font-size: inherit;
        }

        p#jumlah {
            font-size: 18px;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }

        .right {
            text-align: right;
        }

        /* Gaya khusus untuk pencetakan */
        @media print {
            hr {
                border: 1px solid hsl(125, 100%, 36%);
            }
        }
    </style>
</head>

<body>
    <div id="header">
        <img id="logo" src="{{ asset('storage/logo-maa.png') }}" alt="Logo MAA">
        <div id="kop-surat">
            <div id="title">Yayasan Pesantren Islam Al Azhar</div>
            <h2 id="subjudul">Masjid Agung Al Azhar</h2>
            <div id="alamat">Jl. Sisingamangaraja Kebayoran Baru Jakarta Selatan 12110 Telp. 021-72783683</div>
            <div id="alamat">Website: www.masjidagungalazhar.com | Email: masjidagungalazhar@gmail.com</div>
        </div>
    </div>

    <hr>
    <hr id="tebal">
    <br>
    <div>
        <p class="right"><strong>Jakarta,
                {{ \Carbon\Carbon::parse($transaksi->tanggal)->locale('id')->isoFormat('DD/MMMM/YYYY') }}</strong>
        </p>
        <table>
            <tr>
                <td style="width: 20%;"><strong>Nomor</strong></td>
                <td style="width: 80%;">
                    <strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/YPIA-MAA/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2024</strong>
                </td>
            </tr>
            <tr>
                <td><strong>Lamp</strong></td>
                <td><strong>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lembar</strong></td>
            </tr>
            <tr>
                <td><strong>Perihal</strong></td>
                <td><strong>: {{ $transaksi->perincian }}</strong></td>
            </tr>
        </table>
        <br><br>
        <p>Yang terhormat,<br><strong>Pengurus YPI Al Azhar</strong><br>di Tempat<br><br></p>

        <p><i>Assalamualaikum Warrahmatullahi Wabarakatuh,<br><br></i></p>

        <p class="justify">Salam ta'zim kami sampaikan semoga Allah SWT senantiasa melimpahkan rahmat, taufiq dan
            hidayahNya serta memberikan kesehatan kepada kita semua sehingga dapat menjalankan tugas dan aktifitas
            sehari-hari.<br><br></p>

        <p class="justify">Bersama ini kami sampaikan laporan penggantian Kas Kecil Masjid Agung Al Azhar
            <strong>{{ \Carbon\Carbon::parse($transaksi->tanggal)->locale('id')->isoFormat('MMMM YYYY') }}</strong>
            sebagai berikut:<br><br>
        </p>

        <p id="jumlah" class="center"><strong>sebesar Rp.
                {{ number_format($transaksi->jumlah, 0, ',', '.') }},-<br><br></strong></p>

        <p class="justify"><i>Terlampir kwitansi</i></p>

        <p class="justify">Demikian ini kami sampaikan, atas perhatiannya kami ucapkan terima kasih.<br><br><br></p>

        <p class="justify"><i>Billahit Taufiq wal Hidayah</i></p>
        <p class="justify"><i>Wassalamualaikum Warrahmatullahi Wabarakatuh</i></p>
        <br><br><br>
        <p class="right">Masjid Agung Al Azhar<br>Kepala Kantor<br><br><br><br><br><strong>Haji Tatang Komara</strong>
        </p>
    </div>
</body>

</html>
