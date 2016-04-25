void function(window){;
$webapp={"var":{}};
requirejs([
    'jquery',
    'js/masonry.pkgd',
    'reanimator-app/index/views/projectsView',
    'reanimator-app/index/views/journalsView',
    'reanimator-app/index/views/slideView',
    'js/slick.min',
    'js/slideshow',
    'domReady!'
], function ($, Masonry, ProjectView, JournalView, SlideView) {
    'use strict';


    var projectView = new ProjectView();
    projectView.setElement($('.masonry'));
    projectView.on('masonryInit', function () {
        new Masonry('.masonry', {
            columnWidth:  '.grid-sizer',
            itemSelector: '.item'
        });

    }, this);


    var journalView = new JournalView();
    journalView.setElement($('.slider-block'));
    journalView.on('slickInit', function () {
        jQuery('.slick-slider').slick({
            infinite:       true,
            slidesToShow:   5,
            slidesToScroll: 5,
            dots:           false,
            draggable:      true,
            arrows:         false,
            slide:          '.slide',
            autoplay:       true,
            autoplaySpeed:  5000,
            responsive:     [
                {
                    breakpoint: 1200,
                    settings:   {
                        slidesToShow:   4,
                        slidesToScroll: 4
                    }
                }, {
                    breakpoint: 800,
                    settings:   {
                        slidesToShow:   3,
                        slidesToScroll: 3
                    }
                }, {
                    breakpoint: 600,
                    settings:   {
                        slidesToShow:   2,
                        slidesToScroll: 2
                    }
                }
            ]
        });

        var slideView = new SlideView();
        slideView.setElement($('.promo-slider'));
        slideView.on('slideInit', function () {
            $('.promo-slider').fadeGallery({
                slides: '.slide',
                event: 'click',
                autoRotation: true,
                autoHeight: false,
                switchTime: 5000,
                animSpeed: 500,
                useSwipe: true,
                pauseOnHover: false
            });

        }, this);



    });


});;
}(window)