/**
 * Copies the referee page URL to user's clipboard
 */

function copyRefereeLink() {
    if ($('.c-hbspt-form[data-form="referal_form"]').length) {
        $(document).on('click', '.js-copy-referee-link', function(e) {
            e.preventDefault();
    
            const refereeLink = document.querySelector('.referee-sharing__link');
            refereeLink.select();
            document.execCommand('copy');
            
            $(this).text('Copied');
        })
    }
}