<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dimative.com
 * @since      1.0.0
 *
 * @package    Elementive
 * @subpackage Elementive/public
 */

namespace Elementive\Frontend;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Elementive
 * @subpackage Elementive/public
 * @author     Dimative <contact@dimative.com>
 */
class Elementive_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Elementive_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Elementive_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_style( 'justifiedGallery', ELEMENTIVE_URL . 'frontend/vendors/justifiedgallery/justifiedGallery.min.css', '3.7.0', 'all' );
		wp_register_style( 'swiper', ELEMENTIVE_URL . 'frontend/vendors/swiper/css/swiper.min.css', '4.5.0', 'all' );
		wp_register_style( 'uikit', ELEMENTIVE_URL . 'frontend/vendors/uikit/css/uikit.min.css', '3.2.0', 'all' );
		wp_register_style( 'jarallax', ELEMENTIVE_URL . 'frontend/vendors/jarallax/jarallax.css', '1.11.0', 'all' );
		wp_register_style( 'BeerSlider', ELEMENTIVE_URL . 'frontend/vendors/beerslider/BeerSlider.css', '1.0.3', 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/elementive-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Elementive_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Elementive_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( 'uikit', ELEMENTIVE_URL . 'frontend/vendors/uikit/js/uikit.min.js', '', '3.2.0', true );
		wp_register_script( 'uikit-icons', ELEMENTIVE_URL . 'frontend/vendors/uikit/js/uikit-icons.min.js', '', '3.2.0', true );
		wp_register_script( 'jquery-lettering', ELEMENTIVE_URL . 'frontend/vendors/jquery.lettering-0.6.1.min.js', array( 'jquery' ), '0.6.1', true );
		wp_register_script( 'swiper', ELEMENTIVE_URL . 'frontend/vendors/swiper/js/swiper.min.js', '', '4.5.0', true );
		wp_register_script( 'jquery-justifiedGallery', ELEMENTIVE_URL . 'frontend/vendors/justifiedgallery/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.7.0', true );
		wp_register_script( 'svg-injector', ELEMENTIVE_URL . 'frontend/vendors/svg-injector.min.js', array( 'jquery' ), '1.1.3', true );
		wp_register_script( 'jarallax', ELEMENTIVE_URL . 'frontend/vendors/jarallax/jarallax.min.js', '', '1.11.0', true );
		wp_register_script( 'jarallax-video', ELEMENTIVE_URL . 'frontend/vendors/jarallax/jarallax-video.min.js', '', '1.11.0', true );
		wp_register_script( 'jarallax-element', ELEMENTIVE_URL . 'frontend/vendors/jarallax/jarallax-element.min.js', '', '1.11.0', true );
		wp_register_script( 'vivus', ELEMENTIVE_URL . 'frontend/vendors/vivus.min.js', '', '0.4.4', true );
		wp_register_script( 'jquery-tilt', ELEMENTIVE_URL . 'frontend/vendors/tilt.jquery.js', array( 'jquery' ), '1.1.19', true );
		wp_register_script( 'circle-progress', ELEMENTIVE_URL . 'frontend/vendors/circle-progress.min.js', array( 'jquery' ), '1.2.2', true );
		wp_register_script( 'bounty', ELEMENTIVE_URL . 'frontend/vendors/bounty.js', array(), '1.1.0', true );
		wp_register_script( 'anime', ELEMENTIVE_URL . 'frontend/vendors/anime.min.js', '', '3.1.0', false );
		wp_register_script( 'BeerSlider', ELEMENTIVE_URL . 'frontend/vendors/beerslider/BeerSlider.js', '', '1.0.3', false );

		wp_enqueue_script( 'typewriterjs', ELEMENTIVE_URL . 'frontend/vendors/typewriterjs/core.js', '', '2.7.1', false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/elementive-public.js', array( 'jquery' ), $this->version, false );

	}

}
