// Ambil elemen-elemen yang diperlukan dari DOM
const menu = document.querySelector('.menu');
const hamburgerMenu = document.querySelector('.hamburger-menu');
const iconBars = document.querySelector('.fa-bars');
const iconClose = document.querySelector('.fa-xmark');

// Tambahkan event listener untuk mengatur tampilan menu
menu.addEventListener('click', toggleMenu);
hamburgerMenu.addEventListener('click', toggleMenu);

// Fungsi untuk menampilkan atau menyembunyikan menu
function toggleMenu() {
    if (menu.classList.contains('absolute')) {
        menu.classList.add('hidden');
        iconBars.style.display = 'inline';
        iconClose.style.display = 'none';

        menu.classList.remove('absolute', 'top-14', 'w-full', 'left-0', 'bg-slate-800', 'divide-gray-900', 'divide-y-2');
    } else {
        menu.classList.remove('hidden');
        iconBars.style.display = 'none';
        iconClose.style.display = 'inline';

        menu.classList.add('absolute', 'top-14', 'w-full', 'left-0', 'bg-slate-800', 'divide-gray-900', 'divide-y-2');
    }
}

// JS Bottom Nav
function change(icon) {
    // Hapus kelas clicked-icon dari semua ikon
    document.querySelectorAll('.clicked-icon').forEach(el => {
        el.classList.remove('clicked-icon');
        el.nextElementSibling.style.display = 'none'; // Sembunyikan teks
    });
    
    // Tambahkan kelas clicked-icon pada ikon yang diklik
    icon.classList.add('clicked-icon');
    icon.nextElementSibling.style.display = 'block'; // Tampilkan teks
}
