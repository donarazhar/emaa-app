// Fungsi Swiper Pagination
        var swiper = new Swiper('.swiper-container', {
            loop: true, // enable looping
            autoplay: {
                delay: 3000, // autoplay delay in milliseconds
                disableOnInteraction: false, // enable autoplay even when user interacts with swiper
            },
            pagination: {
                el: '.swiper-pagination', // pagination element selector
                clickable: true, // enable pagination clickable
            },
        });

// Fungsi untuk membuka tab dengan nama yang diberikan
function openTab(tabName) {
    // Sembunyikan semua bagian konten
    document.querySelectorAll('section[id^="content-"]').forEach(section => {
        section.classList.add('hidden');
    });

    // Hapus kelas aktif dari semua tab
    document.querySelectorAll('button[id^="tab-"]').forEach(tab => {
        tab.classList.remove('bg-blue-500', 'text-white');
        tab.classList.add('text-gray-600');
    });

    // Tampilkan bagian konten yang dipilih
    document.getElementById(`content-${tabName}`).classList.remove('hidden');

    // Tambahkan kelas aktif ke tab yang dipilih
    document.getElementById(`tab-${tabName}`).classList.add('bg-blue-500', 'text-white');
}

