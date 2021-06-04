jQueryInit();

if (! isBrowserIE()) {
    barbaInit();
}
locationsLoadMore();
meetingRoomsLoadMore();

if (isBrowserIE()) {
    init();
}

// These functions run on every page load with Barba
function init() {
    $(document).ready(function() {
        
        gsap.registerPlugin(ScrollToPlugin, DrawSVGPlugin, MorphSVGPlugin);
        
        // IE bug fixes
        ieFixes();
        
        // General/Global js
        customCursor();
        buttonHoverAnimation();
        initTopbar();
        stickyHeader();
        initCookieBanner();
        toggleNav();
        toggleNavSubMenus();
        initSelectric();
        fadeInOnScroll();
        languageSwitcher();
        toggleFullScreenModals();
        initMeetingRoomModals();
        scrollToTop();
        matchHeight();
        
        // Hero module
        getUserCoordinates();
        toggleFullScreenVideo();
        heroScrollDownLinks();
        heroImgParallax();
        heroRegionsDropdown();
        
        // Slick sliders
        slickNavigation();
        heroSlider();
        hoverBannerMobileSlider();
        testimonialVideoSlider();
        meetingRoomsSlider();
        quotesSlider();
        comparePlansSlider();
        clientLogosSlider();
        imageSlider();
        pricingColumnsSlider();
        teamMembersSlider();
        neighbourhoodSlider();
        
        // Misc modules
        // neighbourhoodStickyIntro();
        amenitiesToggleAll();
        regionsMapSVGMorph();
        hoverBannerBackgroundTransitions();
        deskSizeRangeSlider();
        updateLocationsDropdownFilter();
        toggleTestimonialVideoModals(); 
        triggerTestimonialVideoAutoplay();
        aePostGridFilter(); 
        eventsFilter();
        jobVacanciesFilter();
        hubspotFormAccordion();
        getHubspotForm();
        locationIndexFilter();
        locationsGridFilter();
        showAllLocationsAccordions();
        meetingRoomsFilter();
        showBarGraphOnScroll();
        mobileToggleGraphs();
        benefitsTabs();
        initGoogleMap();
        initFooterReveal();
        copyRefereeLink();
        
        // Cost calculator
        if ($('section.calculator').length) {
            costCalculatorModal();
            costCalculatorTabs();
            costCalculatorFilterReset();
            updateCalculatorFilterLocations();
        }
    })
}