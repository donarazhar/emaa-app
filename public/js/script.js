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



