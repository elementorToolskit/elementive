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
  'use strict'; // Functions Object

  var elementive_starter = {
    /** Reviews */
    reviews: function reviews() {
      console.log('aaa');
    },

    /** Add span tag into all words */
    run_lettering_chars: function run_lettering_chars() {
      var text_content = $('.elementive-text-content');

      if (text_content.hasClass('has-text-color-animation')) {
        text_content.lettering();
      }
    },

    /**
     * Typed init.
     * Used it for animated text widget.
     */
    run_typed: function run_typed() {
      var el = $('.elementive-run-typed');

      if (el.length) {
        console.log('aaaaaaaaaaaaa');
      }
    }
  };
  $(document).ready(function () {
    elementive_starter.run_lettering_chars();
    elementive_starter.run_typed();
  });
  $(window).on('load', function () {
    elementive_starter.reviews();
  });

  if (window.elementorFrontend) {
    $(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/elementive-text.default', elementive_starter.run_lettering_chars);
      elementorFrontend.hooks.addAction('frontend/element_ready/elementive-text.default', elementive_starter.run_typed);
      elementorFrontend.hooks.addAction('panel/open_editor/elementive-text/elementive-text', elementive_starter.run_typed);
    });
  }
})(jQuery);