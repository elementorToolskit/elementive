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
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

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
class Elementive_Widget_Animations {

	/**
	 * Controls and Sections.
	 *
	 * Register new Elementor sections and controls.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function elementive_animations_controls( $element, $section_id, $args ) {
		if ( '_section_responsive' !== $section_id ) {
			return;
		}

		$element->start_controls_section(
			'elementive_animations_section',
			array(
				'tab'   => Controls_Manager::TAB_ADVANCED,
				'label' => __( 'Elementive Animations', 'elementive' ),
			)
		);

		$element->add_control(
			'elementive_animations',
			array(
				'label'        => __( 'Enable animations', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'elementive' ),
				'label_off'    => __( 'Hide', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$element->add_control(
			'elementive_widget_animation',
			array(
				'label'       => __( 'Animation', 'elementive' ),
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
				'condition'   => array(
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_widget_animation_offset_top',
			array(
				'label'       => __( 'Offset top', 'elementive' ),
				'description' => __( 'Top offset before triggering in view.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 120,
				),
				'condition'   => array(
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_widget_animation_offset_left',
			array(
				'label'       => __( 'Offset left', 'elementive' ),
				'description' => __( 'Left offset before triggering in view.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'   => array(
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_widget_animation_delay',
			array(
				'label'       => __( 'Delay', 'elementive' ),
				'description' => __( 'Delay time in ms..', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'   => array(
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_enable_aos',
			array(
				'label'        => __( 'Use AOS animation', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'elementive' ),
				'label_off'    => __( 'Hide', 'elementive' ),
				'return_value' => 'yes',
				'condition'    => array(
					'elementive_animations' => 'yes',
				),
				'separator'    => 'before',
				'default'      => '',
			)
		);

		$element->add_control(
			'elementive_aos_animation',
			array(
				'label'     => __( 'Animations', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => array(
					'fade'            => __( 'Fade', 'elementive' ),
					'fade-up'         => __( 'Fade up', 'elementive' ),
					'fade-down'       => __( 'Fade down', 'elementive' ),
					'fade-left'       => __( 'Fade left', 'elementive' ),
					'fade-right'      => __( 'Fade right', 'elementive' ),
					'fade-up-right'   => __( 'Fade up right', 'elementive' ),
					'fade-up-left'    => __( 'Fade up left', 'elementive' ),
					'fade-down-right' => __( 'Fade down right', 'elementive' ),
					'fade-down-left'  => __( 'Fade down left', 'elementive' ),
					'flip-up'         => __( 'Flip up', 'elementive' ),
					'flip-down'       => __( 'Flip down', 'elementive' ),
					'flip-left'       => __( 'Flip left', 'elementive' ),
					'flip-right'      => __( 'Flip right', 'elementive' ),
					'slide-up'        => __( 'Slide up', 'elementive' ),
					'slide-down'      => __( 'Slide down', 'elementive' ),
					'slide-left'      => __( 'Slide left', 'elementive' ),
					'slide-right'     => __( 'Slide right', 'elementive' ),
					'zoom-in'         => __( 'Zoom in', 'elementive' ),
					'zoom-in-up'      => __( 'Zoom in up', 'elementive' ),
					'zoom-in-down'    => __( 'Zoom in down', 'elementive' ),
					'zoom-in-left'    => __( 'Zoom in left', 'elementive' ),
					'zoom-in-right'   => __( 'Zoom in right', 'elementive' ),
					'zoom-out'        => __( 'Zoom out', 'elementive' ),
					'zoom-out-up'     => __( 'Zoom out up', 'elementive' ),
					'zoom-out-down'   => __( 'Zoom out down', 'elementive' ),
					'zoom-out-left'   => __( 'Zoom out left', 'elementive' ),
					'zoom-out-right'  => __( 'Zoom out right', 'elementive' ),
				),
				'condition' => array(
					'elementive_enable_aos' => 'yes',
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_aos_offset',
			array(
				'label'       => __( 'Offset', 'elementive' ),
				'description' => __( 'Offset (in px) from the original trigger point.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 120,
				),
				'condition'   => array(
					'elementive_enable_aos' => 'yes',
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_aos_delay',
			array(
				'label'       => __( 'Delay', 'elementive' ),
				'description' => __( 'Values from 0 to 3000, with step 50ms.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 3000,
						'step' => 40,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'   => array(
					'elementive_enable_aos' => 'yes',
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_aos_duration',
			array(
				'label'       => __( 'Duration', 'elementive' ),
				'description' => __( 'Values from 0 to 3000, with step 50ms.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 3000,
						'step' => 50,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 400,
				),
				'condition'   => array(
					'elementive_enable_aos' => 'yes',
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_aos_mirror',
			array(
				'label'        => __( 'Mirror', 'elementive' ),
				'description'  => __( 'Whether elements should animate out while scrolling past them.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'elementive_enable_aos' => 'yes',
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_aos_once',
			array(
				'label'        => __( 'Once', 'elementive' ),
				'description'  => __( 'Whether animation should happen only once - while scrolling down.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'elementive_enable_aos' => 'yes',
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_aos_anchor',
			array(
				'label'       => __( 'Anchor placements', 'elementive' ),
				'description' => __( 'Defines which position of the element regarding to window should trigger the animation.', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'bottom-bottom',
				'options'     => array(
					'top-center'    => __( 'Top center', 'elementive' ),
					'top-bottom'    => __( 'Top bottom', 'elementive' ),
					'top-top'       => __( 'Top top', 'elementive' ),
					'center-bottom' => __( 'Center bottom', 'elementive' ),
					'center-center' => __( 'Center center', 'elementive' ),
					'center-top'    => __( 'Center top', 'elementive' ),
					'bottom-bottom' => __( 'Bottom bottom', 'elementive' ),
					'bottom-center' => __( 'Bottom center', 'elementive' ),
					'bottom-top'    => __( 'Bottom top', 'elementive' ),
				),
				'condition'   => array(
					'elementive_enable_aos' => 'yes',
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->add_control(
			'elementive_aos_easing',
			array(
				'label'     => __( 'Easing functions', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ease-in-out',
				'options'   => array(
					'linear'            => __( 'Linear', 'elementive' ),
					'ease'              => __( 'Ease', 'elementive' ),
					'ease-in'           => __( 'Ease in', 'elementive' ),
					'ease-out'          => __( 'Ease out', 'elementive' ),
					'ease-in-out'       => __( 'Ease in out', 'elementive' ),
					'ease-in-back'      => __( 'Ease in back', 'elementive' ),
					'ease-out-back'     => __( 'Ease out back', 'elementive' ),
					'ease-in-out-back'  => __( 'Ease in out back', 'elementive' ),
					'ease-in-sine'      => __( 'Ease in sine', 'elementive' ),
					'ease-out-sine'     => __( 'Ease out sine', 'elementive' ),
					'ease-in-out-sine'  => __( 'Ease in out sine', 'elementive' ),
					'ease-in-quad'      => __( 'Ease in quad', 'elementive' ),
					'ease-out-quad'     => __( 'Ease out quad', 'elementive' ),
					'ease-in-out-quad'  => __( 'Ease in out quad', 'elementive' ),
					'ease-in-cubic'     => __( 'Ease in cubic', 'elementive' ),
					'ease-out-cubic'    => __( 'Ease out cubic', 'elementive' ),
					'ease-in-out-cubic' => __( 'Ease in out cubic', 'elementive' ),
					'ease-in-quart'     => __( 'Ease in quart', 'elementive' ),
					'ease-out-quart'    => __( 'Ease out quart', 'elementive' ),
					'ease-in-out-quart' => __( 'Ease in out quart', 'elementive' ),
				),
				'condition' => array(
					'elementive_enable_aos' => 'yes',
					'elementive_animations' => 'yes',
				),
			)
		);

		$element->end_controls_section();
	}

	public function elementive_animations_attr( $element ) {

		if ( 'yes' === $element->get_settings( 'elementive_enable_aos' ) && 'yes' === $element->get_settings( 'elementive_animations' ) ) {

			$offset   = $element->get_settings( 'elementive_aos_offset' );
			$delay    = $element->get_settings( 'elementive_aos_delay' );
			$duration = $element->get_settings( 'elementive_aos_duration' );
			$mirror   = 'false';
			$once     = 'true';

			if ( 'yes' === $element->get_settings( 'elementive_aos_mirror' ) ) {
				$mirror = 'true';
			}

			if ( 'yes' === $element->get_settings( 'elementive_aos_once' ) ) {
				$once = 'true';
			}

			$element->add_render_attribute(
				'_wrapper',
				array(
					'class'                     => 'run-elementive-aos',
					'data-aos'                  => esc_attr( $element->get_settings( 'elementive_aos_animation' ) ),
					'data-aos-offset'           => esc_attr( $offset['size'] ),
					'data-aos-delay'            => esc_attr( $delay['size'] ),
					'data-aos-duration'         => esc_attr( $duration['size'] ),
					'data-aos-easing'           => esc_attr( $element->get_settings( 'elementive_aos_easing' ) ),
					'data-aos-mirror'           => esc_attr( $mirror ),
					'data-aos-once'             => esc_attr( $once ),
					'data-aos-anchor-placement' => esc_attr( $element->get_settings( 'elementive_aos_anchor' ) ),
				)
			);
		}

		if ( 'yes' !== $element->get_settings( 'elementive_enable_aos' ) && 'yes' === $element->get_settings( 'elementive_animations' ) ) {
			$offset_top  = $element->get_settings( 'elementive_widget_animation_offset_top' );
			$offset_left = $element->get_settings( 'elementive_widget_animation_offset_left' );
			$delay       = $element->get_settings( 'elementive_widget_animation_delay' );

			$element->add_render_attribute(
				'_wrapper',
				array(
					'uk-scrollspy' => 'cls:' . esc_attr( $element->get_settings( 'elementive_widget_animation' ) ) . '; offset-top:' . esc_attr( $offset_top['size'] ) . '; offset-left:' . esc_attr( $offset_left['size'] ) . '; delay:' . esc_attr( $delay['size'] ),
				)
			);
		}

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
		add_action( 'elementor/element/before_section_start', array( $this, 'elementive_animations_controls' ), 10, 3 );
		add_action( 'elementor/frontend/widget/before_render', array( $this, 'elementive_animations_attr' ) );
	}
}
