import Splide from "@splidejs/splide/dist/js/splide";
import {AutoScroll} from "@splidejs/splide-extension-auto-scroll";
import ActiveMenuLink from "active-menu-link";
// Include Lightbox
import PhotoSwipeLightbox from "photoswipe/lightbox";
console.log("Tour-page-splide js")

document.addEventListener("DOMContentLoaded", function () {

    if(document.querySelectorAll(".gallery-splide").length > 0) {
        let gallerysplide = new Splide('.gallery-splide', {
            perPage: 3,
            arrows: false,
            pagination: false,
            gap: '1rem',
            autoScroll: {
                speed: 0.5
            },
            breakpoints: {
                576: {perPage: 1},
                992: {perPage: 2},
            },
        });
        gallerysplide.mount();
    }


    if(document.querySelectorAll(".certificate-splide").length > 0) {
        let certificatesplide = new Splide('.certificate-splide', {
            perPage: 3,
            arrows: false,
            pagination: false,
            gap: '1rem',
            autoScroll: {
                speed: 0.5
            },
            breakpoints: {
                576: {perPage: 1},
                992: {perPage: 2},
            },
        });
        certificatesplide.mount();
    }
});



new ActiveMenuLink(".tour-navbar", {
    // selector of menu item
    itemTag: "li",
    // active class
    activeClass: "active",
    // in pixels
    scrollOffset: 0,
    // duration in ms
    scrollDuration: 500,
    // easing function
    ease: "out-circ",
    // specifies the header height
    headerHeight: null,
    // string
    default: null,
    // shows hash tag
    showHash: true
});


const lightbox = new PhotoSwipeLightbox({
    // may select multiple "galleries"
    gallery: '#gallery--getting-started',

    // Elements within gallery (slides)
    children: 'a',

    // setup PhotoSwipe Core dynamic import
    pswpModule: () => import('../../../node_modules/photoswipe/dist/photoswipe.esm.js'),

    imageClickAction: 'close',
    tapAction: 'close',
});
lightbox.init();
