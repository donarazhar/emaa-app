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

