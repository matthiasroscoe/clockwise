function matchHeight() {
    $('.js-matchHeight').matchHeight();
    
    if ($(window).innerWidth() < 992) {
        $('.js-matchHeight-mob').matchHeight();
    }
}