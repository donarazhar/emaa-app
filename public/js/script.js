// Ambil elemen-elemen yang diperlukan dari DOM
const menu = document.querySelector('.menu');
const hamburgerMenu = document.querySelector('.hamburger-menu');
const iconBars = document.querySelector('.fa-bars');
const iconClose = document.querySelector('.fa-xmark');

// Tambahkan event listener untuk mengatur tampilan menu
menu.addEventListener('click', toggleMenu);
hamburgerMenu.addEventListener('click', toggleMenu);
