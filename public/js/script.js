// Ambil elemen-elemen yang diperlukan dari DOM
const menu = document.querySelector('.menu');
const hamburgerMenu = document.querySelector('.hamburger-menu');

// Tambahkan event listener untuk mengatur tampilan menu
menu.addEventListener('click', displayMenu);
hamburgerMenu.addEventListener('click', displayMenu);


const iconBars = document.querySelector('.fa-bars');
const iconClose = document.querySelector('.fa-xmark');

function displayMenu(){
    if(menu.classList.contains('absolute')){
        menu.classList.add('hidden');
        iconBars.style.display ='inline';
        iconClose.style.display ='none';

        menu.classList.remove('absolute');
        menu.classList.remove('top-14');
        menu.classList.remove('w-full');
        menu.classList.remove('left-0');
        menu.classList.remove('bg-blue-950');
        menu.classList.remove('divide-blue-900');
        menu.classList.remove('divide-y-2');

    }else{
        menu.classList.remove('hidden');
        iconBars.style.display ='none';
        iconClose.style.display ='inline';
        
        menu.classList.add('absolute');
        menu.classList.add('top-14');
        menu.classList.add('w-full');
        menu.classList.add('left-0');
        menu.classList.add('bg-blue-950');
        menu.classList.add('divide-blue-900');
        menu.classList.add('divide-y-2');
        
    }
}


