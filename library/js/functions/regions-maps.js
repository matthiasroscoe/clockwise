/**
 * Regions module SVG morphing
 */

function regionsMapSVGMorph() {
    if ($('.regions__maps').length > 0) {
        
        // Center SVG shapes, set container min-height on init
        const svgContainer = $('.regions__maps');
        setupContainer();
        updateLocationIcons();
        
        $(window).on('resize', function() {
            setupContainer();
            updateLocationIcons();
        });        

        // Update module when svg shape clicked
        $('.unselected path').click(function(e) {
            const termID = $(this).attr('id');
            updateModule(termID);
            updateSelectric(termID);
        });

        // Update module when sub-nav region clicked
        $('.js-regions-link').on('click', function(e) {
            e.preventDefault();
            
            if ( ! $(this).hasClass('is-active') ) {
                const termID = $(this).data('term-id');
                updateModule(termID);
                updateSelectric(termID);
            }
        })
        
        // Update module when select changed
        $('.js-select-region').on('change', function() {
            const termID = $(this).val();
            updateModule(termID);
        })

        function updateModule(termID) {
            morphMap(termID);
            updateLocations(termID);
            updateLocationIcons(termID);
            updateRegionsSubNav(termID);
            updateAllLocationsLink(termID);
        }

        function updateLocations(termID) {
            $('.js-regions-locations.is-active').removeClass('is-active');
            setTimeout(function() {
                $(`.js-regions-locations[data-term-id="${termID}"]`).addClass('is-active');
            }, 500);
        }

        function updateAllLocationsLink(termID) {
            const newLocationHref = $(`.js-regions-locations[data-term-id="${termID}"]`).data('url');
            $('.js-all-locations-link').attr('href', newLocationHref);
        }

        function updateRegionsSubNav(termID) {
            $('.js-regions-link.is-active').removeClass('is-active');
            $(`.js-regions-link[data-term-id="${termID}"]`).addClass('is-active');
        }

        function updateSelectric(termID) {
            $('.js-select-region').val(termID).change().selectric('refresh');
        }

        function morphMap(termID) {
            // Vars for the original element that we are morphing
            const selectedPath = $('#selected-path'),
                  selectedPathParent = selectedPath.parent();
            
            // vars for the path that we are morphing into
            const containerWidth = svgContainer.innerWidth(),
                  containerHeight = svgContainer.height(),
                  newPath = $(`.unselected #${termID}`),
                  newPathParentWidth = newPath.parent()[0].getBoundingClientRect().width,
                  newPathParentHeight = newPath.parent()[0].getBoundingClientRect().height,
                  selectedPathParentXPos = (containerWidth - newPathParentWidth) / 2,
                  selectedPathParentYPos = (containerHeight - newPathParentHeight) / 2;

            // Morph paths
            if (newPath > '') {
                gsap.to(selectedPathParent, {
                    duration: 1.3,
                    width: newPathParentWidth + 'px',
                    ease: Power3.easeInOut,
                });
                
                gsap.to(selectedPath, {
                    duration: 1.3,
                    morphSVG: newPath,
                    x: selectedPathParentXPos,
                    y: selectedPathParentYPos,
                    ease: Power3.easeInOut,
                });
            }
        }

        function setupContainer() {
            const containerWidth = svgContainer.innerWidth(),
                  containerHeight = svgContainer.height(),
                  svgs = svgContainer.find('g');
            
            svgs.each(function(i, item) {
                const svgWidth = item.getBoundingClientRect().width,
                      svgHeight = item.getBoundingClientRect().height,
                      xPos = (containerWidth - svgWidth) / 2,
                      yPos = (containerHeight - svgHeight) / 2;

                $(item).find('path').css('transform', `translate(${xPos}px, ${yPos}px)`);
            })
            // Set container min-height on init
            svgContainer.css('min-height', svgContainer.height() + 'px');
        }

        // Update clockwise logo icons that sit on top of svgs
        function updateLocationIcons(termID) {
            const region = termID || $('.js-regions-locations.is-active').data('term-id'),
                  iconDataEl = $(`.js-reg-map-icons-data[data-term-id="${region}"`);

            if (iconDataEl.length) {
                let delayTime = .2;
                for (let index = 1; index < 9; index++) {
                    const coords = iconDataEl.data(`icon-${index}`);
                    if (coords) {
                        const xPos = parseFloat(coords.split(' ')[0]),
                              yPos = parseFloat(coords.split(' ')[1]);

                        const middleXPos = parseFloat(svgContainer.width() / 2);
                        const middleYPos = parseFloat(svgContainer.height() / 2);
    
                        $(`.js-reg-map-icon-${index}`).addClass('is-active');
        
                        gsap.to(`.js-reg-map-icon-${index}`, {
                            x: middleXPos + xPos,
                            y: middleYPos + yPos,
                            duration: 1.1,
                            delay: delayTime,
                            ease: Power3.easeInOut,
                        });

                        delayTime += .05;
                    } else {
                        $(`.js-reg-map-icon-${index}`).removeClass('is-active');
                    }
                }
            } else {
                // If no icon data, remove icons
                $(`.js-reg-map-icon`).removeClass('is-active');
            }
        }

    }
}
