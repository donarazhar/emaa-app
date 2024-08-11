<x-filament::breadcrumbs :breadcrumbs="[
    '/admin/kas-kecil-aas' => 'Pengeluaran Kas Kecil',
    '' => 'List',
]" />

<div class="flex justify-between mt-1">
    <div class="font-bold text-3xl">Pengeluaran Kas Kecil</div>
    <div>
        <!-- Tombol toggle untuk form upload dengan ikon -->
        <button id="toggleButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-4 rounded mt-0"
            onclick="toggleUploadForm()">
            <i class="fas fa-upload"></i> <!-- Ganti dengan ikon sesuai kebutuhan -->
        </button>
        <!-- Tombol aksi selalu ditampilkan -->
        {{ $data }}

    </div>
</div>

<!-- Form upload yang disembunyikan secara default -->
<div id="uploadFileView" class="mt-0" style="display: none;">
    <div class="bg-gray-800 p-0 shadow rounded">
        <form wire:submit="save" class="w-full max-w-sm flex mt-0 text-sm">
            <div class="mb-0">
                <label class="block text-gray-700 font-bold mb-0 text-sm" for="fileInput">
                    Pilih berkas
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-0 px-0 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm"
                    id="fileInput" type="file" wire:model="file">
            </div>
            <div class="flex items-center justify-between mt-3">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-gray-800 font-bold py-3 px-3 rounded-full shadow focus:outline-none focus:shadow-outline text-sm">
                    Unggah
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleUploadForm() {
        var formView = document.getElementById('uploadFileView');
        var button = document.getElementById('toggleButton');

        if (formView.style.display === 'none') {
            formView.style.display = 'block';
            button.innerHTML = '<i class="fas fa-times"></i>'; // Ganti ikon jika form ditampilkan
        } else {
            formView.style.display = 'none';
            button.innerHTML = '<i class="fas fa-upload"></i>'; // Ganti ikon jika form disembunyikan
        }
    }
</script>

<!-- Tambahkan Font Awesome CDN di header Anda jika belum ada -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
