window.onload = () => {


    // setTimeout(() => {
    $(".intro-section").removeClass("inactive")
    // }, 200);


    setTimeout(() => {
        $(".intro-title").addClass("moveOut");
        $(".intro-bg").addClass("removeOverlay");
    }, 1500);


    setTimeout(() => {
        var swiperBanner = new Swiper('.swiper-banner', {
            loop: true,
            speed: 2000,
            autoplay: {
                delay: 2000
            }
        })
        swiperBanner.on('slideChange', function () {
            // $(".progress-bar").removeClass("active")
            $(".progress-bar").addClass("active")
            setTimeout(() => {
                $(".progress-bar").removeClass("active")
            }, 4000);
        })
        $(".intro-section").addClass("hide")
        $(".home-page").removeClass("inactive");
        $(".progress-bar").addClass("active-first")
        setTimeout(() => {
            $(".progress-bar").removeClass("active-first")
        }, 1990);
    }, 3000);
}