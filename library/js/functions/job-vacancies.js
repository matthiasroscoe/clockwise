/**
 * Job vacancies filter for Careers page
 */

function jobVacanciesFilter() {
    if ($('.js-vacancies-filter-submit').length) {
        $('.js-vacancies-filter-submit').on('click', function(e) {
            e.preventDefault();
    
            const container = $('.js-vacancies-grid');
    
            let data = {
                action: 'filter_vacancies',
                region: $('.js-vacancy-regions').val(),
                location: $('.js-vacancy-locations').val(),
                jobType: $('.js-vacancy-job-types').val(),
                sortBy: $('.js-sort-by').val(),
            };
    
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: scriptVars.ajaxUrl,
                data: data,
                success: function(response) {
                    container.addClass('is-faded');
                    setTimeout(function() {
                        container.empty();
                        container.append(response);
                        container.removeClass('is-faded');
    
                        
                        initFooterReveal();
                    }, 400)
                }
            })
        });

        $('.js-vacancies-filter-reset').on('click', function(e) {
            e.preventDefault();
    
            $('.js-vacancy-regions, .js-vacancy-locations, .js-vacancy-job-types, .js-sort-by')
                .val(null).change().selectric('refresh');
    
            $('.js-vacancies-filter-submit').trigger('click');
        })
    }
}