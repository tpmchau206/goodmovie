$(document).ready(function () {
    $(".top-movie").slick({
        centerPadding: '4vw',
        slidesToShow: 5,
        slidesToScroll: 5,
        draggable: false,
        infinite: true,
        centerMode: false,

        prevArrow: '<button type="button" class="slick-prev"><i class="bi bi-chevron-compact-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="bi bi-chevron-compact-right"></i></button>',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: true,
                    centerPadding: '2vw',
                    slidesToScroll: 5,
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 900,
                settings: {
                    arrows: true,
                    centerPadding: '2vw',
                    slidesToScroll: 4,
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerPadding: '2vw',
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            }
        ]
    });
});
