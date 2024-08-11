<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="192x192"
        href="https://masjidagungalazhar.com/assets/images/favicon/android-icon-192x192.png">
    <title>Piagam Pengislaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 210mm;
            height: 297mm;
            margin: auto;
            position: relative;
            box-sizing: border-box;
            padding: 0;
        }

        .absolute {
            position: absolute;
            text-align: left;
        }

        .number {
            top: 85mm;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            font-size: 19pt;
        }

        .date1 {
            top: 95mm;
            left: 30%;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .date2 {
            top: 95mm;
            left: 70%;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .info {
            top: 105mm;
            left: 75%;
            transform: translateX(-50%);
            text-align: left;
            width: 60%;
            font-size: 16pt;
            line-height: 0.5;
        }

        .left-day {
            top: 180mm;
            left: 60%;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .right-date {
            top: 190mm;
            left: 30%;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .right-clock {
            top: 190mm;
            right: 20%;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .center-name {
            top: 200mm;
            left: 50%;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .hijri {
            top: 210mm;
            left: 75%;
            text-align: left;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .gregorian {
            top: 220mm;
            left: 75%;
            text-align: left;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .imam-name {
            top: 280mm;
            left: 75%;
            transform: translateX(-50%);
            font-size: 16pt;
        }

        .witnesses {
            top: 290mm;
            left: 85%;
            transform: translateX(-50%);
            text-align: left;
            width: 80%;
            font-size: 16pt;
            line-height: 0.5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="absolute number">{{ $pengislaman->no_urut }}</div>
        <div class="absolute date1">{{ $pengislaman->hari }}</div>
        <div class="absolute date2">
            {{ \Carbon\Carbon::parse($pengislaman->tgl)->locale('id')->isoFormat('DD MMMM YYYY') }}</div>

        <div class="absolute info">
            <p>{{ $pengislaman->nama }}</p>
            <p>{{ $pengislaman->jenkel }}</p>
            <p>{{ $pengislaman->tlahir }},
                {{ \Carbon\Carbon::parse($pengislaman->tgllahir)->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
            <p>{{ $pengislaman->agama_semula }}</p>
            <p>{{ $pengislaman->pekerjaan }}</p>
            <p>{{ $pengislaman->alamat1 }}</p>
            <p>{{ $pengislaman->alamat2 }}</p>
        </div>
        <div class="absolute left-day">{{ $pengislaman->hari }}</div>
        <div class="absolute right-date">
            {{ \Carbon\Carbon::parse($pengislaman->tgl)->locale('id')->isoFormat('DD MMMM YYYY') }}
        </div>
        <div class="absolute right-clock"> {{ substr($pengislaman->jam, 0, 5) }} </div>
        <div class="absolute center-name">{{ $pengislaman->nama_baru }}</div>
        <div class="absolute hijri">{{ $pengislaman->tgl_hijriah }} {{ $pengislaman->tahun_hijriah }}</div>
        <div class="absolute gregorian">
            {{ \Carbon\Carbon::parse($pengislaman->tgl)->locale('id')->isoFormat('DD MMMM YYYY') }}</div>
        <div class="absolute imam-name">{{ $pengislaman->imam->nama_imam }}</div>

        <div class="absolute witnesses">
            <p>{{ $pengislaman->saksi1 }}</p>
            <p>{{ $pengislaman->saksi2 }}</p>
            <p>{{ $pengislaman->saksi3 }}</p>
        </div>
    </div>
</body>

</html>
