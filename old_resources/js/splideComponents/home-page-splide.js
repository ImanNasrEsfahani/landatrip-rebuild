import Splide from "@splidejs/splide/dist/js/splide";
import {AutoScroll} from "@splidejs/splide-extension-auto-scroll";


console.log("Home-page js")
document.addEventListener("DOMContentLoaded", function () {

    if (document.querySelector(".group-splide")) {
        let groupsplide = new Splide(".group-splide", {
            perPage: 2,
            arrows: false,
            pagination: false,
            gap: "1rem",
            // padding:20,
            autoScroll: {
                speed: 0.5,
            },
            breakpoints: {
                576: { perPage: 1 },
                992: { perPage: 2 },
            },
        });
        groupsplide.mount();
    }

    if (document.getElementById("deals-splide")) {
        let dealsSplide = new Splide("#deals-splide", {
            type: 'loop',
            perPage: 4,
            arrows: false,
            pagination: false,
            gap: "1rem",
            // padding:20,
            autoScroll: {
                speed: 0.5,
            },
            breakpoints: {
                576: { perPage: 1 },
                992: { perPage: 2 },
                1420: { perPage: 3 },
            },
        });
        dealsSplide.mount({AutoScroll});
    }

    // if (document.querySelector(".certificate-splide")) {
    //     let certificatesplide = new Splide(".certificate-splide", {
    //         perPage: 3,
    //         arrows: false,
    //         pagination: false,
    //         gap: "1rem",
    //         autoScroll: {
    //             speed: 0.5,
    //         },
    //         breakpoints: {
    //             576: { perPage: 1 },
    //             1200: { perPage: 2 },
    //         },
    //     });
    //     certificatesplide.mount();
    // }

    // if (document.querySelector(".gallery-splide")) {
    //     let gallerysplide = new Splide(".gallery-splide", {
    //         perPage: 3,
    //         arrows: false,
    //         pagination: false,
    //         gap: "1rem",
    //         autoScroll: {
    //             speed: 0.5,
    //         },
    //         breakpoints: {
    //             576: { perPage: 1 },
    //             1250: { perPage: 2 },
    //         },
    //     });
    //     gallerysplide.mount();
    // }

    // Comment Carousel
    if (document.getElementById('comment-carousel')) {
        const splide_comment = new Splide('#comment-carousel', {
            type: 'loop',
            // drag: 'free',
            classes:{
                prev  : 'splide__arrow--prev contents',
                next  : 'splide__arrow--next contents',
            },
            autoplay:false,
            rewind:true,
            arrows: true,
            pagination: false,
            gap: '0.9rem',
            autoWidth: false,
            isNavigation: false,
            fixedWidth: "100%",
            perPage: 1,
        });
        splide_comment.mount();
    }
    if (document.getElementById('social_media')) {
        const social_media = new Splide('#social_media', {
            type: 'loop',
            perMove: 1,
            autoplay: true,
            arrows: false,
            pagination: false,
            gap: '0.9rem',
            perPage: 4,
            breakpoints: {
                576: {perPage: 1},
                992: {perPage: 2},
            },
        });
        social_media.mount();
    }


    if(document.querySelectorAll(".group-splide").length > 0) {
        let groupsplide = new Splide('.group-splide', {
            perPage: 2,
            arrows: false,
            pagination: false,
            gap: '1rem',
            // padding:20,
            autoScroll: {
                speed: 0.5
            },
            breakpoints: {
                900: {
                    perPage: 1,
                },
            }

        });
        groupsplide.mount();
    }



    if(document.querySelectorAll(".profile-certificate-splide").length > 0) {
        let profileCertificateSplide = new Splide('.profile-certificate-splide', {
            perPage: 5,
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
        profileCertificateSplide.mount();
    }

});


//old version


// comment-splide
// if (document.getElementsByClassName('comment-splide')) {
//     const comment = new Splide('.comment-splide', {
//         padding: 0,
//         type: 'loop',
//         drag: 'free',
//         autoHeight: true,
//         perPage: 2,
//         isNavigation: false,
//         arrows: false,
//         pagination: false,
//         gap: '1rem',
//         autoScroll: {
//             speed: 0.5
//         },
//         breakpoints: {
//             576: {perPage: 1},
//             992: {perPage: 2},
//         },
//     });
//     comment.mount({AutoScroll});
// }

//certificate-splide
// if (document.getElementsByClassName('certificate-splide')) {
//     const certificate = new Splide('.certificate-splide', {
//         padding: 0,
//         type: 'loop',
//         drag: 'free',
//         autoHeight: true,
//         perPage: 3,
//         isNavigation: false,
//         arrows: false,
//         pagination: false,
//         gap: '1rem',
//         autoScroll: {
//             speed: 0.5
//         },
//         breakpoints: {
//             576: {perPage: 1},
//             992: {perPage: 2},
//         },
//     });
//     certificate.mount({AutoScroll});
//  Gallery Tour Page Carousel
// if (document.getElementById('main-carousel') && document.getElementById('thumbnail-carousel')) {
//     const main = new Splide('#main-carousel', {
//         type: 'fade',
//         rewind: true,
//         pagination: false,
//         arrows: false,
//         perPage: 4,
//     });
//     const thumbnails = new Splide('#thumbnail-carousel', {
//         fixedWidth: 100,
//         fixedHeight: 60,
//         gap: 10,
//         rewind: true,
//         pagination: false,
//         isNavigation: true,
//         focus: 'center',
//         breakpoints: {
//             600: {
//                 fixedWidth: 60,
//                 fixedHeight: 44,
//             },
//         },
//     });
//     main.sync(thumbnails);
//     main.mount();
//     thumbnails.mount();
// }
// }
