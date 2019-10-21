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

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
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
		return array( 'elementive-starter' );
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
		return array( 'uikit', 'uikit-icons' );
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
		return array( 'uikit' );
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
			array(
				'label' => __( 'Images', 'elementive' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'thumbnail',
				'exclude' => array(),
				'include' => array( 'custom' ),
				'default' => 'large',
			)
		);

		$repeater->add_control(
			'object_fit',
			array(
				'label'   => __( 'Object fit', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => array(
					'cover'   => __( 'Cover', 'elementive' ),
					'contain' => __( 'Contain', 'elementive' ),
					'fill'    => __( 'Fill', 'elementive' ),
					'none'    => __( 'None', 'elementive' ),
				),
			)
		);

		$repeater->add_responsive_control(
			'transform',
			array(
				'label'              => __( 'Transform', 'elementive' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => array( 'px' ),
				'allowed_dimensions' => array( 'top', 'right' ),
				'devices'            => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default'    => array(
					'top'      => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'tablet_default'     => array(
					'top'      => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'mobile_default'     => array(
					'top'      => '',
					'right'    => '0',
					'unit'     => '0',
					'isLinked' => false,
				),
				'selectors'          => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementive-group-image-item' => 'transform: translate3d({{RIGHT}}{{UNIT}}, {{TOP}}{{UNIT}}, 0{{UNIT}});',
				),
			)
		);

		$repeater->add_responsive_control(
			'width',
			array(
				'label'           => __( 'Width (px)', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 500,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 500,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 500,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementive-group-image-item' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$repeater->add_responsive_control(
			'height',
			array(
				'label'           => __( 'Height (px)', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 500,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 500,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 500,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementive-group-image-item' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$repeater->add_control(
			'custom_animation',
			array(
				'label'       => __( 'Custom Animation', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'uk-animation-fade',
				'options'     => array(
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
				),
			)
		);

		$repeater->add_control(
			'parallax_x',
			array(
				'label'   => __( 'Parallax on X axis', 'elementive' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => -1000,
				'max'     => 1000,
				'step'    => 1,
				'default' => 0,
			)
		);

		$repeater->add_control(
			'parallax_y',
			array(
				'label'   => __( 'Parallax on Y axis', 'elementive' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => -1000,
				'max'     => 1000,
				'step'    => 1,
				'default' => 0,
			)
		);

		$repeater->add_control(
			'box_shadow',
			array(
				'label'   => __( 'Box shadow', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'uk-box-shadow-none',
				'options' => array(
					'uk-box-shadow-none'   => __( 'none', 'elementive' ),
					'uk-box-shadow-small'  => __( 'Small', 'elementive' ),
					'uk-box-shadow-medium' => __( 'Medium', 'elementive' ),
					'uk-box-shadow-large'  => __( 'Large', 'elementive' ),
					'uk-box-shadow-xlarge' => __( 'X Large', 'elementive' ),
				),
			)
		);

		$repeater->add_control(
			'radius',
			array(
				'label'      => __( 'radius', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 0,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementive-group-image-item' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'images',
			array(
				'label'       => __( 'Images', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(),
				'title_field' => 'image',
			)
		);

		$this->add_responsive_control(
			'wrapper_height',
			array(
				'label'           => __( 'Wrapper height (px)', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1500,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 500,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 500,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 500,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-group-images' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'scrollspy',
			array(
				'label'        => __( 'Scrollspy', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'lightbox',
			array(
				'label'        => __( 'Lightbox', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'video',
			array(
				'label'       => __( 'Video URL', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Youtube or Vimeo URL', 'elementive' ),
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'lightbox',
							'value'    => 'true',
						),
					),
				),
			)
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
				echo '<div class="elementive-group-image-wrapper">';
				echo '<div uk-parallax="y: ' . esc_attr( $image['parallax_y'] ) . '; x: ' . esc_attr( $image['parallax_x'] ) . '; easing: -2">';
				echo '<div class="elementive-group-image-item uk-overflow-hidden uk-position-relative ' . esc_attr( $image['object_fit'] ) . ' ' . esc_attr( $image['box_shadow'] ) . '">';
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
				echo '</div>';
			}
			echo '</div>';
		}
	}
}
