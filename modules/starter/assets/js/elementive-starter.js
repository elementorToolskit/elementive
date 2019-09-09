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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

;

(function ($) {
  'use strict'; // Functions Object

  var elementive_starter = {
    /** Reviews */
    reviews: function reviews() {
      console.log('aaa');
    },

    /** Add span tag into all words */
    run_lettering_chars: function run_lettering_chars() {
      var el = $('.elementive-text-content');

      if (el.hasClass('has-text-color-animation')) {
        new SplitText(el, {
          type: "chars"
        });
      }
    },

    /**
     * Justified Gallery Init
     */
    run_justified_gallery: function run_justified_gallery() {
      var jgallery = $('.elementive-justified-gallery');

      if (jgallery.length) {
        var id, row_height, max_row_height, lastrow, fixed_height, show_captions, margin, border, randomize, swipebox;
        jgallery.each(function (index, el) {
          row_height = $(this).data('row-height');
          max_row_height = $(this).data('row-height-max');
          lastrow = $(this).data('last-row');
          show_captions = $(this).data('captions');
          margin = $(this).data('row-margins');
          randomize = $(this).data('randomize');
          $(el).justifiedGallery({
            rowHeight: row_height,
            maxRowHeight: max_row_height,
            lastRow: lastrow,
            captions: show_captions,
            margins: margin,
            randomize: randomize,
            cssAnimation: false
          });
          console.log('jGallery Ran ====>');
        });
      }
    },

    /**
     * Typed init.
     * Used it for animated text widget.
     */
    run_text_animation: function run_text_animation() {
      var el = $('.elementive-text-rotator');
      var children = $('.elementive-content-item');
      var el_child = el.children(children);
      var items = el_child.children('span');

      if (el.length) {
        var text_rotator = new Swiper(el, {
          delay: 3000,
          effect: 'fade',
          fadeEffect: {
            crossFade: true
          },
          loop: true,
          on: {
            init: function init() {
              if (el.hasClass('chars')) {
                new SplitText(el_child, {
                  type: 'chars'
                });
              } else if (el.hasClass('words')) {
                new SplitText(el_child, {
                  type: 'words',
                  wordsClass: 'aaa'
                });
              } else if (el.hasClass('lines')) {
                new SplitText(el_child, {
                  type: 'lines',
                  linesClass: 'animate'
                });
              }
            },
            slideChangeTransitionStart: function slideChangeTransitionStart() {
              console.log('Change Start');
            },
            slideChangeTransitionEnd: function slideChangeTransitionEnd() {
              console.log('Change End');
            },
            slideChange: function slideChange() {
              console.log('Change');
            },
            slideNextTransitionStart: function slideNextTransitionStart() {
              console.log('Next');
            }
          }
        });
        text_rotator.on('slideChangeTransitionStart', function () {
          var _anime$timeline$add$a;

          anime.timeline({
            loop: false
          }).add(_defineProperty({
            targets: text_rotator.slides[text_rotator.activeIndex].getElementsByTagName('div'),
            scale: [4, 1],
            opacity: [0, 1],
            translateZ: 0,
            easing: "easeOutExpo",
            delay: 3000,
            endDelay: 3000,
            duration: 1000
          }, "delay", function delay(el, i) {
            return 70 * i;
          })).add((_anime$timeline$add$a = {
            targets: text_rotator.slides[text_rotator.activeIndex].getElementsByTagName('div'),
            scale: [1, 4],
            opacity: [1, 0],
            translateZ: 0,
            easing: "easeOutExpo",
            delay: 3000,
            endDelay: 1000,
            duration: 1000
          }, _defineProperty(_anime$timeline$add$a, "delay", function delay(el, i) {
            return 70 * i;
          }), _defineProperty(_anime$timeline$add$a, "complete", function complete(anim) {
            text_rotator.slideNext();
          }), _anime$timeline$add$a));
        });
        var scroll_spy = UIkit.scrollspy(el);
        UIkit.util.on(el, 'inview', function (e) {
          console.log('inview works');
          text_rotator.slideNext();
        });
      }
    }
  };
  $(document).ready(function () {
    elementive_starter.run_lettering_chars();
  });
  $(window).on('load', function () {
    elementive_starter.run_justified_gallery();
    elementive_starter.reviews();
  });

  if (window.elementorFrontend) {
    $(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/elementive-text.default', elementive_starter.run_lettering_chars);
      elementorFrontend.hooks.addAction('frontend/element_ready/elementive-justified-gallery.default', elementive_starter.run_justified_gallery);
      elementorFrontend.hooks.addAction('panel/open_editor/widget/elementive-justified-gallery', function (panel, model, view) {
        console.log('fjkdjafkljdklsaf');
      });
      console.log('Elementor Init Works.');
    });
  }
})(jQuery);