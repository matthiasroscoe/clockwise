/**
 * Init selectric
 * @link https://selectric.js.org/
 */

function initSelectric() {
    $('.js-selectric').selectric({
        nativeOnMobile: true,
    });

    // Selectric with custom HTML for options elements
    $('.js-selectric-locations').selectric({
        nativeOnMobile: false,
        onInit: function() {
            setupLocationsDropdown()
        },
        onRefresh: function() {
            setupLocationsDropdown()
        },
    });
}

function setupLocationsDropdown() {
    const select = $('.js-selectric-locations');

    /**
     * Add 'coming soon' next to location names
     */ 
    const comingSoonText = select.data('coming-soon-text');
    const comingSoonHTML = '<span class="coming-soon">' + comingSoonText + '</span>';
    const options = select.children();

    options.each(function(i, item) {
        if ($(item).data('location-status') == 'coming-soon') {
            const text = $(item).html();
            $(`.selectric-js-selectric-locations li[data-index=${i}]`).html(text + comingSoonHTML);
        }
    })

    /**
    * Add sub-regions dropdowns
    */
    const subregionsStr = select.data('subregions');
    if (subregionsStr) {
        const subregions = subregionsStr.split(',');
        
        subregions.forEach(subregion => {
            let subregionAdded = false;

            $('.js-selectric-locations option').each(function(i, item) {
                if ($(item).data('subregion') == subregion) {

                    const selectricItem = $(`.selectric-js-selectric-locations li[data-index=${i}]`);

                    // Create subregion dropdown
                    if (! subregionAdded) {
                        selectricItem.before(`<li class="subregion" data-subregion-toggle="${subregion}">${subregion}<span class="icon"></span><div class="subregion__dropdown d-none" data-subregion=${subregion}></div></li>`);
                        subregionAdded = true;
                    }

                    // Move all subregion locations to subregion dropdown container
                    selectricItem.appendTo($(`.selectric-js-selectric-locations div[data-subregion="${subregion}"]`));

                }
            })
        })

        $('.selectric-js-selectric-locations li[data-subregion-toggle]').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).toggleClass('dropdown-open');
            $(this).find('div').toggleClass('d-none');
        })
    }
}

