void function(window){;
$webapp={"var":{}};
requirejs([
    'jquery',
    'js/jcf',
    'js/image-resize',
    'js/jcf.scrollable',
    'js/slideshow',
    'js/jquery.leanModal.min',
    'domReady!'
], function ($, jcf, ImageStretcher) {
    'use strict';

    var slider = $('.big-slider');
    slider.fadeGallery({
        slides:       '.slide',
        event:        'click',
        autoRotation: false,
        autoHeight:   false,
        animSpeed:    350,
        pagerLinks:   '.pagination li',
        useSwipe:     true,
    });


    slider.on('click touchend', function () {
        setTimeout(function () {
            dynamicImg();
            var img = slider.find('.center-image').eq(slider.find('.active').data('number'));
            var url = '/project/' + img.data('project') + '/' + img.data('slide');
            window.top.history.pushState(null, 'Project', url);
        }, 500);

    });


    var dynamicImg = function () {
        var curAnnotation = $('.active').find('.center-image');
        var curId = curAnnotation.data('slide');
        var curPrj = curAnnotation.data('type');
        var annotImg = curAnnotation.children('.imageSlide');
        if (annotImg.length === 0) {
            annotImg = $('<img class = "imageSlide" style:"visibility:hidden;" src="/uploads/' + curPrj + 's/' + curId + '" alt="image description" />').hide();
            curAnnotation.append(annotImg);
            $('.active .center-image').each(function () {
                ImageStretcher.add({
                    container: this,
                    image:     'img'
                });
            });
            annotImg.one('load', function () {
                annotImg.show();
            });

        }
    };


    (function () {
        $('.big-slider .slide').each(function () {
            var slide      = $(this),
                opener     = slide.find('.btn-share'),
                showBlock  = slide.find('.social-networks'),
                page       = $(window),
                isAnimated = false;

            function openBlock() {
                if (!isAnimated) {
                    isAnimated = true;
                    opener.fadeOut(200, function () {
                        showBlock.fadeIn(400, function () {
                            page.on('click', handleOutsideClick);
                            isAnimated = false;
                        });
                    });
                }
            }

            function closeBlock() {
                if (!isAnimated) {
                    isAnimated = true;
                    showBlock.fadeOut(200, function () {
                        opener.fadeIn(400, function () {
                            page.off('click', handleOutsideClick);
                            isAnimated = false;
                        });
                    });
                }
            }

            function handleOutsideClick(e) {
                var isInsideClick = showBlock.is(e.target) || showBlock.find(e.target).length > 0;
                if (!isInsideClick) {
                    closeBlock();
                }
            }

            opener.on('click', function (e) {
                e.preventDefault();
                openBlock();
            });

        });
    })();



    $('.btn-close').click(function (e) {
        if (window.top !== window) {
            e.preventDefault();
            window.top.$('body').trigger('sirotov-frame-close');
        }
    });


    dynamicImg();

});
;
}(window)