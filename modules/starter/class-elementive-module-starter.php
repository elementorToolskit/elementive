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

namespace Elementive\Modules\Starter;

use Elementive\Modules\Starter;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Elementive
 * @subpackage Elementive/Modules/Starter
 * @author     Dimative <contact@dimative.com>
 */
class Elementive_Module_Starter {

	/**
	 * Widgets Styles.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function starter_widgets_styles() {
		$suffix           = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$direction_suffix = is_rtl() ? '-rtl' : '';
		wp_enqueue_style(
			'elementive-starter',
			ELEMENTIVE_MODULES_URL . 'starter/assets/css/elementive-starter' . $direction_suffix . $suffix . '.css',
			array(),
			ELEMENTIVE_VERSION
		);
	}

	/**
	 * Widgets Scripts.
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function starter_widgets_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script(
			'elementive-starter-js',
			ELEMENTIVE_MODULES_URL . 'starter/assets/js/elementive-starter' . $suffix . '.js',
			array(
				'jquery',
				'uikit',
				'uikit-icons',
			),
			ELEMENTIVE_VERSION,
			true
		);

		wp_localize_script(
			'elementive-starter-js',
			'ElementiveStarterFrontendConfig', // This is used in the js file to group all of your scripts together.
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'elementive-starter-js' ),
			)
		);
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_starter_widgets() {
		// Register Widgets.
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Hello_World() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Tab() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Text_Rotator() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Typewriter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Group_Images() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Justified_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Shape_Mask() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Icon_Box_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Clients_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Clients_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Starter\Elementive_Widget_Testimonials_Carousel() );
	}

	/**
	 * Register Widgets Category
	 *
	 * Register new Elementor widgets category.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_starter_category() {
		// Add element category in panel.
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'elementive-starter', // This is the name of your addon's category and will be used to group your widgets/elements in the Edit sidebar pane!
			array(
				'title' => esc_html__( 'Elementive Starter', 'elementive' ), // The title of your modules category - keep it simple and short!
				'icon'  => 'font',
			),
			1
		);
	}

	/**
	 * Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		// Register widgets category.
		add_action( 'elementor/init', array( $this, 'register_starter_category' ) );
		// Register widget scripts.
		add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'starter_widgets_scripts' ), 998 );
		// Register widget styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'starter_widgets_styles' ), 998 );
		// Register widgets.
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_starter_widgets' ) );
	}
}
