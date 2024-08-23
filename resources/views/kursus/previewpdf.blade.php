<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="192x192"
        href="https://masjidagungalazhar.com/assets/images/favicon/android-icon-192x192.png">
    <title>Pendaftaran {{ $pendaftaran->murid->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="px-12 py-8 max-w-4xl mx-auto bg-white shadow-md">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <img src="{{ asset('storage/logo-maa.png') }}" alt="Logo MAA"
                    class="w-16 h-16 object-cover rounded-full mr-4">
                <div class="text-gray-700 font-semibold text-lg uppercase">Kursus Al Azhar</div>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-md">Cetak Formulir</div>
                <div class="text-sm">Per : {{ now()->locale('id')->isoFormat('D/MMMM/YYYY') }}</div>
            </div>
        </div>

        <!-- Data Pendaftaran -->
        <div class="border-b-2 border-gray-300 pb-4 mb-4">
            <table class="w-full text-left mb-4 border-collapse">
                <tbody>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Tgl. Daftar</th>
                        <td class="py-1 text-gray-700">
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal)->format('d/m/Y') }}</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Status</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Data Murid -->
        <div class="border-b-2 border-gray-300 pb-4 mb-4">
            <h2 class="text-xl font-bold mb-4">Data Murid</h2>
            <table class="w-full text-left mb-4 border-collapse">
                <tbody>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Nama</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->murid->nama }}</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Alamat</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->murid->alamat }}</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Jenis Kelamin</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->murid->jenkel }}</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Email</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->murid->email }}</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Nomor Telepon</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->murid->nomor_telepon }}</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Tanggal Pendaftaran</th>
                        <td class="py-1 text-gray-700">
                            {{ \Carbon\Carbon::parse($pendaftaran->murid->tanggal)->format('d/m/Y') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Data Kursus -->
        <div class="border-b-2 border-gray-300 pb-4 mb-4">
            <h2 class="text-xl font-bold mb-4">Data Kursus</h2>
            <table class="w-full text-left mb-4 border-collapse">
                <tbody>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Nama Guru</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->jadwal->kategori->guru->nama }}</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Nama Kursus</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->jadwal->kategori->nama_kursus }}</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Durasi</th>
                        <td class="py-1 text-gray-700">{{ $pendaftaran->jadwal->kategori->durasi }} menit</td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Biaya perbulan</th>
                        <td class="py-1 text-gray-700">Rp
                            {{ number_format($pendaftaran->jadwal->kategori->biaya, 0, ',', ',') }}
                        </td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Jenis Kursus</th>
                        <td class="py-1 text-gray-700">{{ strtoupper($pendaftaran->jadwal->kategori->jenis_kursus) }}
                        </td>
                    </tr>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <th class="text-gray-700 font-bold py-1">Ruang Kelas</th>
                        <td class="py-1 text-gray-700">{{ strtoupper($pendaftaran->jadwal->ruang_kelas) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="border-t-2 border-gray-300 pt-2 mt-8">
            <div class="text-gray-700 text-xs">Data ini bersifat rahasia dan tidak dapat diperjual belikan dan dimiliki
                sepenuhnya oleh Kursus Al Azhar.</div>
        </div>
    </div>
</body>

</html>
