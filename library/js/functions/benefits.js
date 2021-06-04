function benefitsTabs() {
    if ($('.benefits').length) {
        $('.js-benefit-tab').on('click', function(e) {
            if (! $(this).hasClass('is-active')) {

                // Update tab
                $(this).siblings().removeClass('is-active');
                $(this).addClass('is-active');

                // Update lists
                const listNum = $(this).data('list');
                $('.benefits__list.is-active').removeClass('is-active');
                $(`.benefits__list--${listNum}`).addClass('is-active');
            }
        })
    }
}