<?php
/**
 * Gruop Images
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
class Elementive_Widget_Group_Images extends Widget_Base {

	/**
	 * Content template disable.
	 *
	 * @var boolean
	 */
	protected $_has_template_content = false;

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
		return 'elementive-group-images';
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
		return __( 'Group Images', 'elementive' );
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
		return [ 'elementive' ];
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
				'label' => __( 'Images', 'elementive' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'exclude' => [],
				'include' => [ 'custom' ],
				'default' => 'large',
			]
		);

		$repeater->add_control(
			'object_fit',
			[
				'label'   => __( 'Object fit', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover'   => __( 'Cover', 'elementive' ),
					'contain' => __( 'Contain', 'elementive' ),
					'fill'    => __( 'Fill', 'elementive' ),
					'none'    => __( 'None', 'elementive' ),
				],
			]
		);

		$repeater->add_responsive_control(
			'transform',
			[
				'label'              => __( 'Transform', 'elementive' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => [ 'top', 'right' ],
				'devices'            => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default'    => [
					'top'      => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'tablet_default'     => [
					'top'      => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'mobile_default'     => [
					'top'      => '',
					'right'    => '0',
					'unit'     => '0',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementive-group-image-item' => 'transform: translate3d({{RIGHT}}{{UNIT}}, {{TOP}}{{UNIT}}, 0{{UNIT}});',
				],
			]
		);

		$repeater->add_responsive_control(
			'width',
			[
				'label'           => __( 'Width (px)', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 500,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementive-group-image-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'height',
			[
				'label'           => __( 'Height (px)', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 500,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementive-group-image-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'custom_animation',
			[
				'label'       => __( 'Custom Animation', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'uk-animation-fade',
				'options'     => [
					'none'                             => __( 'None', 'elementive' ),
					'uk-animation-fade'                => __( 'Fade', 'elementive' ),
					'uk-animation-scale-up'            => __( 'Scale up', 'elementive' ),
					'uk-animation-scale-down'          => __( 'Scale down', 'elementive' ),
					'uk-animation-slide-top'           => __( 'Slide top', 'elementive' ),
					'uk-animation-slide-bottom'        => __( 'Slide bottom', 'elementive' ),
					'uk-animation-slide-left'          => __( 'Slide left', 'elementive' ),
					'uk-animation-slide-right'         => __( 'Slide right', 'elementive' ),
					'uk-animation-slide-top-small'     => __( 'Slide top small', 'elementive' ),
					'uk-animation-slide-bottom-small'  => __( 'Slide bottom small', 'elementive' ),
					'uk-animation-slide-left-small'    => __( 'Slide left small', 'elementive' ),
					'uk-animation-slide-right-small'   => __( 'Slide right small', 'elementive' ),
					'uk-animation-slide-top-medium'    => __( 'Slide top medium', 'elementive' ),
					'uk-animation-slide-bottom-medium' => __( 'Slide bottom medium', 'elementive' ),
					'uk-animation-slide-left-medium'   => __( 'Slide left medium', 'elementive' ),
					'uk-animation-slide-right-medium'  => __( 'Slide right medium', 'elementive' ),
				],
			]
		);

		$repeater->add_control(
			'parallax_x',
			[
				'label'   => __( 'Parallax on X axis', 'elementive' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => -1000,
				'max'     => 1000,
				'step'    => 1,
				'default' => 0,
			]
		);

		$repeater->add_control(
			'parallax_y',
			[
				'label'   => __( 'Parallax on Y axis', 'elementive' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => -1000,
				'max'     => 1000,
				'step'    => 1,
				'default' => 0,
			]
		);

		$repeater->add_control(
			'box_shadow',
			[
				'label'   => __( 'Box shadow', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'uk-box-shadow-none',
				'options' => [
					'uk-box-shadow-none'   => __( 'none', 'elementive' ),
					'uk-box-shadow-small'  => __( 'Small', 'elementive' ),
					'uk-box-shadow-medium' => __( 'Medium', 'elementive' ),
					'uk-box-shadow-large'  => __( 'Large', 'elementive' ),
					'uk-box-shadow-xlarge' => __( 'X Large', 'elementive' ),
				],
			]
		);

		$repeater->add_control(
			'radius',
			[
				'label'      => __( 'radius', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'size' => 0,
					'unit' => 'px',
					'size' => 0,
					'unit' => '%',
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementive-group-image-item img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'images',
			[
				'label'       => __( 'Images', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [],
				'title_field' => 'image',
			]
		);

		$this->add_responsive_control(
			'wrapper_height',
			[
				'label'           => __( 'Wrapper height (px)', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min'  => 0,
						'max'  => 1500,
						'step' => 1,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 500,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 500,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .elementive-group-images' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'scrollspy',
			[
				'label'        => __( 'Scrollspy', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => 'true',
			]
		);

		$this->add_control(
			'lightbox',
			[
				'label'        => __( 'Lightbox', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => 'false',
			]
		);

		$this->add_control(
			'video',
			[
				'label'       => __( 'Video URL', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Youtube or Vimeo URL', 'elementive' ),
				'conditions'  => [
					'terms' => [
						[
							'name'     => 'lightbox',
							'value'    => 'true',
						],
					],
				],
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
		$settings = $this->get_settings_for_display();
		$counter  = 0;

		if ( $settings['images'] ) {
			echo '<div class="elementive-group-images uk-flex uk-flex-middle" uk-scrollspy="cls: uk-animation-slide-bottom; target: .item; delay: 200; repeat: false">';
			foreach ( $settings['images'] as $image ) {
				$counter++;
				echo '<div class="item elementor-repeater-item-' . esc_attr( $image['_id'] ) . '" uk-scrollspy-class="' . esc_attr( $image['custom_animation'] ) . '">';
				echo '<div class="elementive-group-image-wrapper" uk-parallax="y: ' . esc_attr( $image['parallax_y'] ) . '; x: ' . esc_attr( $image['parallax_x'] ) . '; easing: -2">';
				echo '<div class="elementive-group-image-item uk-position-relative ' . esc_attr( $image['object_fit'] ) . ' ' . esc_attr( $image['box_shadow'] ) . '">';
				if ( count( $settings['images'] ) === $counter && 'true' === $settings['lightbox'] && $settings['video'] ) {
					?>
					<div class="uk-position-cover uk-position-z-index" uk-lightbox>
						<a class="elementive-group-image-button uk-icon" href="<?php echo esc_url( $settings['video'] ); ?>"><span uk-icon="icon: play; ratio: 2"></span></a>
					</div>
					<?php
				}
				echo wp_get_attachment_image( $image['image']['id'], 'full' );
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		}
	}
}
