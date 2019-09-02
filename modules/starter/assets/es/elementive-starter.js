/*------------------------------------------------------------------
[Master Script File for Elementive Starter]

Project:		 Elementive - Custom Elementive Widgets by Dimative.
Version:		 1.0
Author: 		 Dimative
Author URI:      https://dimative.com/
-------------------------------------------------------------------*/

jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var elementive_starter = {

        /** Reviews */
        reviews: function() {
            console.log('aaa');
            
        },

        /** Lightbox */
        lightbox: function() {
        },

        /** Checkout */
        checkout: function() {
        },

    }  

    $(window).on('load', function() {
        elementive_starter.reviews();
        elementive_starter.lightbox();
        elementive_starter.checkout();
    });

});