import "slick-carousel"

jQuery('.qualifications-list').slick({
    slidesToShow: 2,
    vertical: false,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1
            }
        }
    ]
})