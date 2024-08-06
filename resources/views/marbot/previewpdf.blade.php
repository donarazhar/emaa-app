<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $marbot->user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="px-12 py-8 max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <img src="{{ asset('storage/logo-maa.png') }}" alt="Logo MAA"
                    class="w-16 h-16 object-cover rounded-full mr-4">
                <div class="text-gray-700 font-semibold text-lg">Masjid Agung Al Azhar</div>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-md mb-2 uppercase">Data Lengkap {{ $marbot->user->name }}</div>
                <div class="text-sm">Pertanggal: {{ now()->format('d/m/Y') }}</div>
            </div>
        </div>

        <div class="border-b-2 border-gray-300 pb-8 mb-82">
            <div class="flex items-start mb-8">
                <div class="text-left mr-2">
                    <img src="{{ $marbot->foto ? url('storage/' . $marbot->foto) : url('storage/file-user/no-image.jpg') }}"
                        alt="Foto Marbot" class="w-32 h-32 object-cover rounded-full">
                </div>

                <table class="w-full text-left mb-8 border-collapse">
                    <tbody>

                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Email</th>
                            <td class="py-1 text-gray-700">{{ $marbot->user->email }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">No. Handphone</th>
                            <td class="py-1 text-gray-700">{{ $marbot->phone }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Jenis Kelamin</th>
                            <td class="py-1 text-gray-700">{{ $marbot->jenkel }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">TTL</th>
                            <td class="py-1 text-gray-700">{{ $marbot->tlahir }},
                                {{ \Carbon\Carbon::parse($marbot->tgl_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Golongan Darah</th>
                            <td class="py-1 text-gray-700">{{ $marbot->goldar }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Status Pernikahan</th>
                            <td class="py-1 text-gray-700">{{ $marbot->status_nikah }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Status Kepegawaian</th>
                            <td class="py-1 text-gray-700">{{ $marbot->status_pegawai }}</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <th class="text-gray-700 font-bold py-1">Alamat</th>
                            <td class="py-1 text-gray-700">{{ $marbot->alamat }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="border-b-2 border-gray-300 pb-2 mb-2">
                <h2 class="text-2xl font-bold mb-4">Informasi Keluarga</h2>
                <table class="w-full text-left mb-2 border-collapse">
                    <thead>
                        <tr>
                            <th class="text-gray-700 font-bold py-2">Foto</th>
                            <th class="text-gray-700 font-bold py-2">Nama</th>
                            <th class="text-gray-700 font-bold py-2">Hubungan</th>
                            <th class="text-gray-700 font-bold py-2">Jenkel</th>
                            <th class="text-gray-700 font-bold py-2">TTL</th>
                            <th class="text-gray-700 font-bold py-2">No. HP</th>
                            <th class="text-gray-700 font-bold py-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marbot->keluargas as $keluarga)
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="py-1 text-gray-700">
                                    <img src="{{ $keluarga->foto_keluarga ? url('storage/' . $keluarga->foto_keluarga) : url('storage/file-user/no-image.jpg') }}"
                                        alt="Foto Keluarga" class="w-16 h-16 object-cover rounded-lg">
                                </td>
                                <td class="py-1 text-gray-700">{{ $keluarga->nama }}</td>
                                <td class="py-1 text-gray-700">{{ $keluarga->tipe_hubungan }}</td>
                                <td class="py-1 text-gray-700">{{ $keluarga->jenkel }}</td>
                                <td class="py-1 text-gray-700">{{ $keluarga->tlahir }},
                                    {{ \Carbon\Carbon::parse($keluarga->tgl_lahir)->format('d-m-Y') }}</td>

                                <td class="py-1 text-gray-700">{{ $keluarga->no_kontak }}</td>
                                <td class="py-1 text-gray-700">{{ $keluarga->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-b-2 border-gray-300 pb-2 mb-2">
                <h2 class="text-2xl font-bold mb-4">Riwayat Kepegawaian</h2>
                <table class="w-full text-left mb-2 border-collapse">
                    <thead>
                        <tr>
                            <th class="text-gray-700 font-bold py-2">Jenis Riwayat</th>
                            <th class="text-gray-700 font-bold py-2">Nama</th>
                            <th class="text-gray-700 font-bold py-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marbot->riwayatkepegawaians as $riwayat)
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="py-1 text-gray-700">{{ $riwayat->jenis_riwayat }}</td>
                                <td class="py-1 text-gray-700">{{ $riwayat->nama }}</td>
                                <td class="py-1 text-gray-700">{{ $riwayat->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-b-2 border-gray-300 pb-8 mb-8">
                <h2 class="text-2xl font-bold mb-4">Riwayat Kesehatan</h2>
                <table class="w-full text-left mb-8 border-collapse">
                    <thead>
                        <tr>
                            <th class="text-gray-700 font-bold py-2">Jenis Riwayat</th>
                            <th class="text-gray-700 font-bold py-2">Nama</th>
                            <th class="text-gray-700 font-bold py-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marbot->kesehatans as $kesehatan)
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="py-1 text-gray-700">{{ $kesehatan->jenis_riwayat }}</td>
                                <td class="py-1 text-gray-700">{{ $kesehatan->nama }}</td>
                                <td class="py-1 text-gray-700">{{ $kesehatan->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t-2 border-gray-300 pt-2 mb-2">
                <div class="text-gray-700 text-sm">Data ini bersifat rahasia dan tidak dapat diperjual belikan dan
                    dimilikai
                    sepenuhnya oleh Masjid Agung Al Azhar yang beralamat di Jalan Sisingamangaraja Kebayoran Baru,
                    Jakarta.
                </div>
            </div>
</body>

</html>
