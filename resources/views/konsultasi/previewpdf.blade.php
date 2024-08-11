<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="192x192"
        href="https://masjidagungalazhar.com/assets/images/favicon/android-icon-192x192.png">
    <title>Cetak Formulir Konsultasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="px-12 py-8 max-w-4xl mx-auto bg-white shadow-md">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <img src="{{ asset('storage/logo-maa.png') }}" alt="Logo MAA"
                    class="w-16 h-16 object-cover rounded-full mr-4">
                <div class="text-gray-700 font-semibold text-lg">Masjid Agung Al Azhar</div>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-md mb-2 uppercase">Data Lengkap Konsultasi</div>
                <div class="text-sm">Per: {{ now()->locale('id')->isoFormat('D/MMMM/YYYY') }}
                </div>
            </div>
        </div>

        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-xl font-bold mb-4">FORMULIR KONSULTASI</h2>
            <p class="text-gray-700 mb-4">Ditulis dengan huruf cetak</p>
            <div class="flex items-start mb-8">
                <table class="w-full text-left mb-8 border-collapse">
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Nama Lengkap</th>
                            <td class="py-1 text-gray-700">{{ $konsultasi->nama_jamaah }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Tempat / Tanggal Lahir</th>
                            <td class="py-1 text-gray-700">{{ $konsultasi->tempat_lahir_jamaah }},
                                {{ \Carbon\Carbon::parse($konsultasi->tgl_lahir_jamaah)->locale('id')->isoFormat('D/MMMM/YYYY') }}

                            </td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Alamat</th>
                            <td class="py-1 text-gray-700">{{ $konsultasi->alamat }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Nomor Telepon</th>
                            <td class="py-1 text-gray-700">{{ $konsultasi->no_hp }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Pendidikan Terakhir</th>
                            <td class="py-1 text-gray-700">{{ $konsultasi->pendidikan }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Pekerjaan</th>
                            <td class="py-1 text-gray-700">{{ $konsultasi->pekerjaan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <table class="w-full text-left mb-8 border-collapse">
                <thead>
                    <tr>
                        <th class="text-gray-700 font-bold py-2">No</th>
                        <th class="text-gray-700 font-bold py-2">Nama Konsultan</th>
                        <th class="text-gray-700 font-bold py-2">Bidang Konsultasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="py-2 text-gray-700">1</td>
                        <td class="py-2 text-gray-700">{{ $konsultasi->imam->nama_imam }}</td>
                        <td class="py-2 text-gray-700">{{ $konsultasi->jeniskonsultasi->nama_jenis_konsultasi }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-xl font-bold mb-4">Deskripsi Masalah</h2>
            <p class="text-gray-700">{{ $konsultasi->deskripsi_masalah }}</p>
        </div>

        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-xl font-bold mb-4">Kesimpulan dan Saran Konsultasi</h2>
            <p class="text-gray-700">{{ $konsultasi->kesimpulan_saran }}</p><br><br>
        </div>

        <div class="flex justify-between pt-8">
            <div>
                <div class="text-gray-700 text-sm">Konsultan,</div><br><br>
                <div class="text-gray-700 text-sm mt-4">(_________________)</div>
                <div class="text-gray-700 text-xs">Nama Jelas dan Tanda Tangan</div>
            </div>
            <div>
                <div class="text-gray-700 text-sm">Yang Berkonsultasi,</div><br><br>
                <div class="text-gray-700 text-sm mt-4">(_________________)</div>
                <div class="text-gray-700 text-xs">Nama Jelas dan Tanda Tangan</div>
            </div>
        </div>

        <div class="border-t-2 border-gray-300 pt-2 mt-8">
            <div class="text-gray-700 text-xs">Data ini bersifat rahasia dan tidak dapat diperjual belikan dan dimiliki
                sepenuhnya oleh Masjid Agung Al Azhar yang beralamat di Jalan Sisingamangaraja Kebayoran Baru, Jakarta.
            </div>
        </div>
    </div>
</body>

</html>
