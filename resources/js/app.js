import './bootstrap';
import Alpine from 'alpinejs';
import Swiper, { Navigation, Pagination, Autoplay } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 2, // Mostra 2 slides por vez
        spaceBetween: 30, // Espaçamento entre os slides
        loop: true, // Ativa o loop infinito
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 3000, // Troca automática a cada 3 segundos
            disableOnInteraction: false, // Continua o autoplay após interação
        },
    });
});
