<x-filament::breadcrumbs :breadcrumbs="[
    '/admin/kas-kecil-aas' => 'Master Mata Anggaran',
    '' => 'List',
]" />
<div class="flex justify-between mt-1">
    <div class="font-bold text-3xl">Data Akun Matanggaran
    </div>
    <div>
        {{ $data }}
    </div>
</div>
<div>
    <form wire:submit="save" class="w-full max-w-sm flex mt-2">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="fileInput">
                Pilih berkas
            </label>
            <input class"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline" id="fileInput" type="file" wire:model="file">
        </div>
        <div class="flex items-center justify-between mt-3">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full shadow focus:outline-none focus:shadow-outline">
                Unggah
            </button>
        </div>
    </form>
</div>
