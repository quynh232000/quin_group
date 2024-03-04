const swiper = new Swiper('.swipper-banner', {
    // Optional parameters
    // direction: 'vertical',
    loop: true,
    autoplay: {
        delay: 5000,
      },

    // If we need pagination
    pagination: {
        el: '.swipper-banner .swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swipper-banner .swiper-button-next',
        prevEl: '.swipper-banner .swiper-button-prev',
    },

    // And if we need scrollbar
    // scrollbar: {
    //     el: '.swiper-scrollbar',
    // },
});
const swiperCollection = new Swiper('.swipper-banner-collection', {
    // Optional parameters
    // direction: 'vertical',
    loop: true,
    autoplay: {
        delay: 5000,
      },

    // If we need pagination
    pagination: {
        el: '.swipper-banner-collection .swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swipper-banner-collection .swiper-button-next',
        prevEl: '.swipper-banner-collection .swiper-button-prev',
    },

    // And if we need scrollbar
    // scrollbar: {
    //     el: '.swiper-scrollbar',
    // },
});
// const swiperCategory = new Swiper(".categories-wrapper", {
//     slidesPerView: 7,
//     spaceBetween: 0,
//     freeMode: true,
//     // auto
//     // autoplay: {
//     //     delay: 5000,
//     //     disableOnInteraction: false,
//     // },
//     loop:true,
//     loopedSlides: 50,
//     pagination: {
//         el: ".categories-wrapper .swiper-pagination",
//         clickable: true,
//     },
//     navigation: {
//         nextEl: '.categories-wrapper .swiper-button-next',
//         prevEl: '.categories-wrapper .swiper-button-prev',
//     },
//     breakpoints: {
//         // when window width is <= 499px
//         370: {
//             slidesPerView: 2,
//             spaceBetweenSlides: 50
//         },
//         500: {
//             slidesPerView: 3,
//             spaceBetweenSlides: 50
//         },
//         860: {
//             slidesPerView: 5,
//             spaceBetweenSlides: 50
//         },
//         // when window width is <= 999px
//         1200: {
//             slidesPerView: 7,
//             spaceBetweenSlides: 50
//         }
//     }
// });
const swiperMegaSale = new Swiper(".mega-swipper-products", {
    slidesPerView: 5,
    spaceBetween: 10,
    // auto
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    loop:true,
    loopedSlides: 50,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    speed: 2000,
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        // when window width is <= 499px
        370: {
            slidesPerView: 2,
            spaceBetweenSlides: 50
        },
        500: {
            slidesPerView: 3,
            spaceBetweenSlides: 50
        },
        860: {
            slidesPerView: 4,
            spaceBetweenSlides: 50
        },
        // when window width is <= 999px
        1200: {
            slidesPerView: 5,
            spaceBetweenSlides: 50
        }
    }

   
});
const swiperCollectionBrand = new Swiper('.swiper-collection-brand', {
    // Optional parameters
    // direction: 'vertical',
    slidesPerView: 5,
    loop: true,
    autoplay: {
        delay: 8000,
    },

    // If we need pagination
    pagination: {
        el: '.swiper-collection-brand .swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-collection-brand .swiper-button-next',
        prevEl: '.swiper-collection-brand .swiper-button-prev',
    },
    breakpoints: {
        // when window width is <= 499px
        370: {
            slidesPerView: 2,
            spaceBetweenSlides: 50
        },
        500: {
            slidesPerView: 3,
            spaceBetweenSlides: 50
        },
        860: {
            slidesPerView: 4,
            spaceBetweenSlides: 50
        },
        // when window width is <= 999px
        1200: {
            slidesPerView: 5,
            spaceBetweenSlides: 50
        }
    }
});