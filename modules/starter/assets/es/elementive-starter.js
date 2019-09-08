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
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
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

                text_rotator.on('reachEnd', function(){
                    text_rotator.slideTo(1, 300);
                    console.log('end');
                });

                text_rotator.on('slideNextTransitionStart', function() {
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
                    });;
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
        elementive_starter.run_text_animation();
    });
    
    $(window).on('load', function() {
        elementive_starter.reviews();
    });

    if ( window.elementorFrontend ) {
        $( window ).on( 'elementor/frontend/init', function() {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/elementive-text.default', elementive_starter.run_lettering_chars );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/elementive-animated-text.default', elementive_starter.run_text_animation );
        } );
    }

})(jQuery);