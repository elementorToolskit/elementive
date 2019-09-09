<?php
/**
 * Justified Gallery Widget
 *
 * @link       https://dimative.com
 * @since      1.0.0
 *
 * @package    Elementive
 * @subpackage Elementive/Modules/Starter
 */

namespace Elementive\Modules\Starter;

use Elementor\Frontend;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Color;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Elementive_Widget_Justified_Gallery extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'elementive-justified-gallery';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Justified Gallery', 'elementive' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'elementive-starter' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'jquery-justifiedGallery', 'uikit' ];
	}

	/**
	 * Retrieve the list of style dependencies the element requires.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Element styles dependencies.
	 */
	public function get_style_depends() {
		return [ 'justifiedGallery', 'uikit' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Gallery', 'elementive' ),
			]
		);

		$this->add_control(
			'gallery',
			[
				'label'   => __( 'Add Images', 'elementive' ),
				'type'    => Controls_Manager::GALLERY,
				'default' => [],
			]
		);

		$this->add_control(
			'row_height',
			[
				'label'   => __( 'Row height', 'elementive' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'default' => 200,
			]
		);

		$this->add_control(
			'row_height_max',
			[
				'label'   => __( 'Row max height', 'elementive' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 500,
				'step'    => 1,
				'default' => 300,
			]
		);

		$this->add_control(
			'margins',
			[
				'label'   => __( 'Margins', 'elementive' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 50,
				'step'    => 1,
				'default' => 0,
			]
		);

		$this->add_control(
			'last_row',
			[
				'label'   => __( 'Last row', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'justify',
				'options' => [
					'nojustify'  => __( 'No Justify', 'elementive' ),
					'justify'    => __( 'Justify', 'elementive' ),
					'hide'       => __( 'Hide', 'elementive' ),
				],
			]
		);

		$this->add_control(
			'randomize',
			[
				'label'        => __( 'Randomize', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'captions',
			[
				'label'        => __( 'Captions', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings             = $this->get_settings_for_display();
		$randomize            = 'false';
		$captions             = 'false';
		$allowed_html_wrapper = [
			'class'               => [],
			'data-row-height'     => [],
			'data-row-height-max' => [],
			'data-last-row'       => [],
			'data-randomize'      => [],
			'data-row-margins'    => [],
			'data-captions'       => [],
		];
		if ( 'yes' === $settings['randomize'] ) {
			$randomize = 'true';
		}

		if ( 'yes' === $settings['captions'] ) {
			$captions = 'true';
		}

		$this->add_render_attribute(
			'wrapper',
			[
				'class'               => [ 'elementive-justified-gallery' ],
				'data-row-height'     => esc_attr( $settings['row_height'] ),
				'data-row-height-max' => esc_attr( $settings['row_height_max'] ),
				'data-last-row'       => esc_attr( $settings['last_row'] ),
				'data-randomize'      => esc_attr( $randomize ),
				'data-row-margins'    => esc_attr( $settings['margins'] ),
				'data-captions'       => esc_attr( $captions ),
				'uk-lightbox'         => '',
			]
		);

		if ( $settings['gallery'] ) {
			echo '<div ' . wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_html_wrapper ) . '>';
			foreach ( $settings['gallery'] as $image ) {
				echo '<a class="elementive-justified-gallery-item uk-inline-clip uk-transition-toggle" data-elementor-open-lightbox="no" href="' . esc_url( $image['url'] ) . '" data-caption="' . esc_html( wp_get_attachment_caption( $image['id'] ) ) . '">';
				?>
				<div class="uk-transition-fade uk-position-z-index uk-position-cover uk-overlay uk-overlay-primary">
					<?php
					if ( 'true' === $captions ) {
						if ( wp_get_attachment_caption( $image['id'] ) ) {
							echo '<span class="jg-caption uk-position-bottom uk-padding-small uk-dark"> ' . esc_html( wp_get_attachment_caption( $image['id'] ) ) . '</span>';
						} else {
							echo '<span class="uk-position-center uk-dark" uk-overlay-icon></span>';
						}
					} else {
						echo '<span class="uk-position-center uk-dark" uk-overlay-icon></span>';
					}
					?>
				</div>
				<?php
				echo wp_get_attachment_image( $image['id'], 'full', '', [ 'class' => 'uk-transition-scale-up uk-transition-opaque' ] );
				echo '</a>';
			}
			echo '</div>';
		}

	}
}
