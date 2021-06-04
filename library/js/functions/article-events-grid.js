/**
 * Article/Events grid filter for article_events_grid module.
 * Appears on Community page
 */

function aePostGridFilter() {
    if ($('.js-ae-filter').length) {
        $('.js-ae-filter').on('click', function(e) {
            e.preventDefault();
    
            if (! $(this).hasClass('is-active')) {
                // Update filter
                $('.js-ae-filter.is-active').removeClass('is-active');
                $(this).addClass('is-active');
    
                // Update grids
                const postType = $(this).data('post-type');
                $('.js-posts-container.is-active').removeClass('is-active');
                setTimeout(function() {
                    $(`.js-posts-container[data-post-type='${postType}']`).addClass('is-active');
    
                    initFooterReveal();
                }, 500);
            }
        })
    }
};

function eventsFilter() {
    if ($('.js-ae-filter').length) {
        $('.js-events-pill').on('click', function(e) {
            e.preventDefault();
    
            if (! $(this).hasClass('is-active')) {
                const eventsToShow = $(this).data('term-id');
                if (eventsToShow) {
    
                    // Update events filter
                    $('.js-events-pill').removeClass('is-active');
                    $(this).addClass('is-active');
    
                    // Update events posts
                    const data = {
                        action: 'filter_events',
                        term: eventsToShow,
                    };
                    const container = $('.js-posts');
    
                    $.ajax({
                        type: 'POST',
                        dataType: 'html',
                        url: scriptVars.ajaxUrl,
                        data: data,
                        success: function(response) {
                            console.log(response);
                            container.addClass('is-faded');
                            setTimeout(function() {
                                container.empty();
                                container.append(response);
                                container.removeClass('is-faded');
    
                                
                            }, 400)
                        }
                    })
                }
            }
        })
    }
}