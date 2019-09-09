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

        /** Add span tag into all words */
        run_lettering_chars: function() {
            var el = $('.elementive-text-content');
            if ( el.hasClass('has-text-color-animation') ) {
                new SplitText(el, {type:"chars"});
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
                                new SplitText(el_child, {
                                    type: 'chars'
                                });
                            } else if( el.hasClass('words') ) {
                                new SplitText(el_child, {
                                    type:'words',
                                    wordsClass: 'aaa',
                                });
                            } else if( el.hasClass('lines') ) {
                                new SplitText(el_child, {
                                    type:'lines',
                                    linesClass: 'animate',
                                });
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
    });

    if ( window.elementorFrontend ) {
        $( window ).on( 'elementor/frontend/init', function() {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/elementive-text.default', elementive_starter.run_lettering_chars );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/elementive-justified-gallery.default', elementive_starter.run_justified_gallery );
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