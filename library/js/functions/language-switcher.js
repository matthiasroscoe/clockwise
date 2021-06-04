function languageSwitcher() {
    if ($('.js-lang-switcher').length) {
        $('.js-lang-switcher').on('click', function(e) {
            e.preventDefault();
    
            $(this).toggleClass('is-active');
            $(this).siblings('.js-langs').toggleClass('is-active');
        })
    }
}