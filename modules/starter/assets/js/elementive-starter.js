"use strict";

/*------------------------------------------------------------------
[Master Script File for Elementive Starter]

Project:		 Elementive - Custom Elementive Widgets by Dimative.
Version:		 1.0
Author: 		 Dimative
Author URI:      https://dimative.com/
-------------------------------------------------------------------*/
jQuery(document).ready(function ($) {
  'use strict'; // Functions Object

  var elementive_starter = {
    /** Reviews */
    reviews: function reviews() {
      console.log('aaa');
    },

    /** Lightbox */
    lightbox: function lightbox() {},

    /** Checkout */
    checkout: function checkout() {}
  };
  $(window).on('load', function () {
    elementive_starter.reviews();
    elementive_starter.lightbox();
    elementive_starter.checkout();
  });
});