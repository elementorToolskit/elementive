/*------------------------------------------------------------------
[Master Script File for Elementive Starter]

Project:		 Elementive - Custom Elementive Widgets by Dimative.
Version:		 1.0
Author: 		 Dimative
Author URI:      https://dimative.com/
-------------------------------------------------------------------*/

/**
 * File custom.js.
 *
 */
"use strict";

;

(function ($) {

    'use strict';

    // Functions Object
    var elementive_starter = {

        /** Reviews */
        reviews: function() {
            console.log('aaa');
            
        },

        /**
         * Jarallax Init.
         */
        run_jarallax: function() {
            var el = $('.jarallax');
            if ( el.length ) {
                el.jarallax({
                    speed: 1
                });
            }
        },

        /** Add span tag into all words */
        run_lettering_chars: function() {
            var el = $('.elementive-text-content');
            if ( el.hasClass('has-text-color-animation') ) {
                el.lettering();
            }
        },

        /**
         * Justified Gallery Init
         */
        run_justified_gallery: function() {

            var jgallery = $('.elementive-justified-gallery');
            if ( jgallery.length ) {
                var id, row_height, max_row_height, lastrow, fixed_height, show_captions, margin, border, randomize, swipebox;

                jgallery.each(function (index, el) {
                    row_height = $(this).data('row-height');
                    max_row_height = $(this).data('row-height-max');
                    lastrow = $(this).data('last-row');
                    show_captions = $(this).data('captions');
                    margin = $(this).data('row-margins');
                    randomize = $(this).data('randomize');

                    $(el).justifiedGallery({
                        rowHeight			: row_height,
                        maxRowHeight		: max_row_height,
                        lastRow				: lastrow,
                        captions			: show_captions,
                        margins				: margin,
                        randomize			: randomize,
                        cssAnimation        : false,
                    });

                    console.log( 'jGallery Ran ====>' );
                });
            }
            
        },
        /**
         * SVG Shape
         */
        run_svg_shape: function() {
            var el = $('.svg-process');
            el.each( function() {
                var targetId = '#change';
                var newPath  = $(this).data('url');
                UIkit.svg($(this)).svg.then(function(svg,) { 
                    svg.setAttribute("data-img-paths", "aaaa");
                    console.log(svg);
                    $(svg).find(targetId).attr('xlink:href', newPath);
                    svg.querySelector('path').style.stroke = 'red';
                })
            });
            var path = document.querySelector('.path-1');
            anime({
                targets: path,
                d: [
                    {value: 'M146,-225.4C190.7,-198.4,229.5,-160.5,247.1,-114.9C264.7,-69.4,261,-16.2,247.8,31.5C234.5,79.2,211.7,121.5,179.5,151.5C147.2,181.4,105.4,199.1,62.6,210.4C19.8,221.6,-24,226.4,-67.5,218.8C-111,211.1,-154.1,191,-185.9,158.7C-217.6,126.3,-238,81.7,-242.2,36.3C-246.5,-9.2,-234.7,-55.5,-212.2,-93.6C-189.7,-131.8,-156.5,-161.8,-119.3,-192.2C-82.2,-222.5,-41.1,-253.3,4.8,-260.7C50.6,-268.1,101.3,-252.3,146,-225.4Z'},
                    {value: 'M145.8,-224.9C183.9,-202.4,206.1,-153.4,199,-108.6C191.8,-63.8,155.3,-23.4,142.2,15.6C129.1,54.6,139.4,92.1,127.9,117.6C116.4,143.1,83.1,156.4,49.6,164.1C16.1,171.7,-17.7,173.7,-61.5,176C-105.2,178.4,-158.8,181.2,-191.9,157.9C-225.1,134.7,-237.7,85.3,-227.8,43C-217.9,0.7,-185.4,-34.5,-169.1,-80.2C-152.9,-125.9,-152.9,-182,-127.5,-210.2C-102,-238.4,-51,-238.7,1.4000000000000004,-240.9C53.9,-243.2,107.8,-247.4,145.8,-224.9Z'},
                    {value: 'M74.4,-132.5C100.2,-99.3,127.4,-84.9,136,-63C144.7,-41.1,134.7,-11.6,146.6,32.8C158.5,77.2,192.2,136.5,182.5,171.1C172.7,205.7,119.5,215.6,72,216.4C24.5,217.2,-17.2,208.8,-57.2,196.4C-97.2,183.9,-135.5,167.3,-155.9,138.2C-176.3,109.1,-178.7,67.6,-188.4,24.8C-198.1,-17.9,-215,-61.9,-197.1,-85.3C-179.1,-108.8,-126.3,-111.6,-87.7,-138.9C-49,-166.3,-24.5,-218.1,-0.10000000000000009,-218C24.3,-217.9,48.7,-165.7,74.4,-132.5Z'},
                    {value: 'M134.1,-208.7C162.6,-190.4,166.8,-134.2,161.4,-90.1C155.9,-46,140.8,-14,134.1,17.9C127.4,49.8,129.1,81.6,121.6,124.6C114.2,167.6,97.7,222,66,236.8C34.3,251.7,-12.6,227.1,-59.7,210.2C-106.9,193.3,-154.3,184,-162.6,152.9C-170.8,121.8,-139.8,68.7,-141.5,23.4C-143.2,-21.8,-177.6,-59.3,-178.3,-91.2C-179,-123.1,-146,-149.5,-110.7,-164.7C-75.3,-179.9,-37.7,-183.9,7.6,-195.7C52.8,-207.5,105.6,-227,134.1,-208.7Z'},
                    {value: 'M133.7,-205C176.9,-180.2,218.1,-149.3,235.5,-108.4C253,-67.4,246.8,-16.4,235.9,31.4C225.1,79.2,209.7,123.7,179.2,150.9C148.8,178.1,103.4,187.9,59.6,199C15.7,210.1,-26.7,222.6,-57.1,207.7C-87.6,192.7,-106.1,150.4,-123,115.3C-139.9,80.2,-155.1,52.3,-158.8,23.1C-162.6,-6.1,-155,-36.7,-137.2,-57.3C-119.5,-78,-91.7,-88.6,-67.1,-121.9C-42.5,-155.2,-21.3,-211.1,12,-229.7C45.2,-248.4,90.5,-229.8,133.7,-205Z'},
                ],
                easing: 'easeOutQuad',
                duration: 5000,
                loop: true
            });
        },

        /**
         * Typed init.
         * Used it for animated text widget.
         */
        run_text_animation: function() {
            var el = $('.elementive-text-rotator');
            var children = $('.elementive-content-item');
            var el_child = el.children(children);
            var items = el_child.children( 'span' );
            if ( el.length ) {
                var text_rotator = new Swiper (el, {
                    delay: 3000,
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    loop: true,
                    on: {
                        init: function () {
                            if ( el.hasClass('chars') ) {
                                el.lettering();
                            } else if( el.hasClass('words') ) {
                                el.lettering('words');
                            } else if( el.hasClass('lines') ) {
                                el.lettering('lines');
                            }
                        },

                        slideChangeTransitionStart: function() {
                            console.log('Change Start');
                        },

                        slideChangeTransitionEnd: function() {
                            console.log('Change End');
                        },

                        slideChange: function() {
                            console.log('Change');
                        },
                        
                        slideNextTransitionStart: function() {
                            console.log('Next');
                        },
                    },
                });

                text_rotator.on('slideChangeTransitionStart', function () {
                    anime.timeline({loop: false})
                    .add({
                        targets: text_rotator.slides[text_rotator.activeIndex].getElementsByTagName('div'),
                        scale: [4,1],
                        opacity: [0,1],
                        translateZ: 0,
                        easing: "easeOutExpo",
                        delay: 3000,
                        endDelay: 3000,
                        duration: 1000,
                        delay: (el, i) => 70*i,
                    }).add({
                        targets: text_rotator.slides[text_rotator.activeIndex].getElementsByTagName('div'),
                        scale: [1,4],
                        opacity: [1,0],
                        translateZ: 0,
                        easing: "easeOutExpo",
                        delay: 3000,
                        endDelay: 1000,
                        duration: 1000,
                        delay: (el, i) => 70*i,
                        complete: function(anim) {
                            text_rotator.slideNext();
                        }
                    });
                });
                

                var scroll_spy = UIkit.scrollspy(el);

                UIkit.util.on(el, 'inview', (e) => {
                    console.log('inview works');
                    text_rotator.slideNext();
                })
            }
        },

    }  

    $(document).ready(function () {
        elementive_starter.run_lettering_chars();
    });
    
    $(window).on('load', function() {
        elementive_starter.run_justified_gallery();
        elementive_starter.reviews();
        elementive_starter.run_svg_shape();
        elementive_starter.run_jarallax();
    });

    if ( window.elementorFrontend ) {
        $( window ).on( 'elementor/frontend/init', function() {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/elementive-text.default', elementive_starter.run_lettering_chars );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/elementive-justified-gallery.default', elementive_starter.run_justified_gallery );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/elementive-icon-box.default', elementive_starter.run_jarallax );
            elementorFrontend.hooks.addAction(
                'panel/open_editor/widget/elementive-justified-gallery',
                function( panel, model, view ) {
                    console.log('fjkdjafkljdklsaf');
                }
            );
            console.log('Elementor Init Works.');
        } );
        
    }

})(jQuery);