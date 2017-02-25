new WOW().init();
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 30,
    autoplay: true,
    nav: false,
    dotClass: false,
    autoplayTimeout: 4000,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
});