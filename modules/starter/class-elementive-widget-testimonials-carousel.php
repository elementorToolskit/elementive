<?php
/**
 * Testimonials Carousel Widget for Elementive.
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
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;
use Elementor\Repeater;

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
class Elementive_Widget_Testimonials_Carousel extends Widget_Base {

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
		return 'elementive-testimonials-carousel';
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
		return __( 'Testimonials Carousel', 'elementive' );
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
		return array( 'uikit', 'swiper' );
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
		return array( 'uikit', 'swiper' );
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
				'label' => __( 'Content', 'elementive' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Avatar', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'name',
			array(
				'label' => __( 'Name', 'elementive' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label' => __( 'Title', 'elementive' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'testimonials',
			array(
				'label'       => __( 'Testimonials', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'default'     => '',
				'placeholder' => __( 'Type your testimonials here', 'elementive' ),
			)
		);

		$this->add_control(
			'testimonials_carousel',
			array(
				'label'       => __( 'Testimonials list', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(),
				'title_field' => '{{{ name }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			array(
				'label' => __( 'Image', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'image_position',
			array(
				'label'   => __( 'Image position', 'elementive' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'image-left' => array(
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'eicon-h-align-left',
					),
					'image-top' => array(
						'title' => __( 'Top', 'elementive' ),
						'icon'  => 'eicon-v-align-top',
					),
					'image-bottom' => array(
						'title' => __( 'Bottom', 'elementive' ),
						'icon'  => 'eicon-v-align-bottom',
					),
					'image-right' => array(
						'title' => __( 'Right', 'elementive' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default' => 'image-top',
				'toggle'  => true,
			)
		);

		$this->add_control(
			'text_align',
			array(
				'label'      => __( 'Alignment', 'elementive' ),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => array(
					'uk-text-left' => array(
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'fa fa-align-left',
					),
					'uk-text-center' => array(
						'title' => __( 'Center', 'elementive' ),
						'icon'  => 'fa fa-align-center',
					),
					'uk-text-right' => array(
						'title' => __( 'Right', 'elementive' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'    => 'uk-text-center',
				'toggle'     => true,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'image_position',
							'value'    => 'image-top',
						),
						array(
							'name'     => 'image_position',
							'value'    => 'image-bottom',
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image_size',
				'default'   => 'thumbnail',
				'separator' => 'none',
				'exclude'   => array( 'custom' ),
			)
		);

		$this->add_responsive_control(
			'image_margin_top',
			array(
				'label'      => __( 'Margin top', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 33,
				),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'image_position',
							'value' => 'image-bottom',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-testimonials-user' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonials-arrow' => 'margin-top: -{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin_bottom',
			array(
				'label'      => __( 'Margin bottom', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 33,
				),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'image_position',
							'value' => 'image-top',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-testimonials-user' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonials-arrow' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin_left',
			array(
				'label'      => __( 'Margin left', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 33,
				),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'image_position',
							'value' => 'image-right',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-testimonials-user-image' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonials-arrow' => 'margin-left: -{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin_right',
			array(
				'label'      => __( 'Margin right', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 33,
				),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'image_position',
							'value' => 'image-left',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-testimonials-user-image' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonials-arrow' => 'margin-right: -{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonials-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .testimonials-image',
			)
		);

		$this->add_responsive_control(
			'image_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .testimonials-image' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_width',
			array(
				'label'      => __( 'Image width', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 30,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 80,
				),
				'selectors'  => array(
					'{{WRAPPER}} .testimonials-image' => 'max-width: {{SIZE}}{{UNIT}}; height: auto;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .testimonials-image',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			array(
				'label' => __( 'Content', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .testimonials-content blockquote p',
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .testimonials-content blockquote p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonials-content blockquote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonials-content blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'show_arrow',
			array(
				'label'        => __( 'Show arrow', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'elementive' ),
				'label_off'    => __( 'Hide', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'arrow_background_color',
			array(
				'label'     => __( 'Background color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'condition' => array(
					'show_arrow' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .testimonials-content blockquote' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .testimonials-arrow' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'content_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .testimonials-content blockquote',
				'separator' => 'before',
				'condition' => array(
					'show_arrow!' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'show_arrow!' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .testimonials-content blockquote',
			)
		);

		$this->add_responsive_control(
			'content_border',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .testimonials-content blockquote' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .testimonials-content blockquote',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name',
			array(
				'label' => __( 'Name', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .testimonials-name',
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .testimonials-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'name_position',
			array(
				'label'      => __( 'Name & title position', 'elementive' ),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => array(
					'name-top' => array(
						'title' => __( 'Top', 'elementive' ),
						'icon'  => 'eicon-v-align-top',
					),
					'name-bottom' => array(
						'title' => __( 'Bottom', 'elementive' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'    => 'name-top',
				'toggle'     => true,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'image_position',
							'value'    => 'image-left',
						),
						array(
							'name'     => 'image_position',
							'value'    => 'image-right',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => __( 'Title', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .testimonials-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .testimonials-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel',
			array(
				'label' => __( 'Carousel', 'elementive' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'vertical_align',
			array(
				'label'   => __( 'Vertical align', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'uk-flex-top',
				'options' => array(
					'uk-flex-top'    => __( 'Top', 'elementive' ),
					'uk-flex-middle' => __( 'Middle', 'elementive' ),
					'uk-flex-bottom' => __( 'Bottom', 'elementive' ),
				),
			)
		);

		$this->add_control(
			'auto_play',
			array(
				'label'        => __( 'Enable auto play', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'true',
				'default'      => '',
				'separator'    => 'after',
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'           => __( 'Columns', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array(),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'range'           => array(
					'px' => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				),
				'desktop_default' => array(
					'size' => 3,
				),
				'tablet_default'  => array(
					'size' => 2,
				),
				'mobile_default'  => array(
					'size' => 1,
				),
			)
		);

		$this->add_responsive_control(
			'margins',
			array(
				'label'           => __( 'Column margin', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array(),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'desktop_default' => array(
					'size' => 30,
				),
				'tablet_default'  => array(
					'size' => 30,
				),
				'mobile_default'  => array(
					'size' => 0,
				),
			)
		);

		$this->add_control(
			'overflow',
			array(
				'label'        => __( 'Overflow', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => '',
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'        => __( 'Loop', 'elementive' ),
				'description'  => __( 'Set to yes to enable continuous loop mode', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => '',
			)
		);

		$this->add_control(
			'centered',
			array(
				'label'        => __( 'Centered slider', 'elementive' ),
				'description'  => __( 'If yes, then active slide will be centered, not always on the left side.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => '',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'          => __( 'Speed', 'elementive' ),
				'description'    => __( 'Speed of the enter/exit transition.', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'range'          => array(
					'px' => array(
						'min'  => 10,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'        => array(
					'size' => 500,
				),
			)
		);

		$this->add_control(
			'navigation',
			array(
				'label'        => __( 'Navigation', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'separator'    => 'before',
				'default'      => '',
			)
		);

		$this->add_responsive_control(
			'navigation_diameter_width',
			array(
				'label'           => __( 'Diameter', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 30,
						'max'  => 200,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 40,
					'unit' => 'px',
				),
				'condition'       => array(
					'navigation' => 'true',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation ' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'navigation_icon_width',
			array(
				'label'           => __( 'Icon width', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 5,
						'max'  => 20,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 10,
					'unit' => 'px',
				),
				'condition'       => array(
					'navigation' => 'true',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'navigation_radius',
			array(
				'label'          => __( 'Border radius', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'devices'        => array( 'desktop', 'tablet', 'mobile' ),
				'condition'      => array(
					'navigation' => 'true',
				),
				'selectors'      => array(
					'{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'navigation_tabs',
			array(
				'condition' => array(
					'navigation' => 'true',
				),
			)
		);

		$this->start_controls_tab(
			'navigation_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'navigation_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'condition' => array(
					'navigation' => 'true',
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation svg' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'navigation_border',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'navigation_diameter' => 'yes',
				),
				'condition' => array(
					'navigation' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'navigation_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'navigation_diameter' => 'yes',
				),
				'condition' => array(
					'navigation' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'navigation_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'navigation_diameter' => 'yes',
				),
				'condition' => array(
					'navigation' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'navigation_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'navigation_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'condition' => array(
					'navigation' => 'true',
				),
				'selectors' => array(
					'{{WRAPPER}}  .elementive-carousel .elementive-carousel-navigation:hover svg' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'navigation_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'navigation' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'navigation_background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'navigation' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation .navigation-background-hover',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'navigation_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'navigation' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .elementive-carousel-navigation:hover',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pagination',
			array(
				'label'        => __( 'Pagination', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'separator'    => 'before',
				'default'      => '',
			)
		);

		$this->add_control(
			'pagination_bullet_align',
			array(
				'label'     => __( 'Bullet align', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'uk-text-center',
				'options'   => array(
					'uk-text-center' => __( 'Center', 'elementive' ),
					'uk-text-left'   => __( 'Left', 'elementive' ),
					'uk-text-right'  => __( 'Right', 'elementive' ),
				),
				'condition' => array(
					'pagination' => 'true',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_bottom',
			array(
				'label'           => __( 'Bottom size', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 0,
					'unit' => 'px',
				),
				'condition'       => array(
					'pagination' => 'true',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-carousel .elementive-carousel-pagination ' => 'bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_bullet_margin',
			array(
				'label'           => __( 'Bullet margin', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 3,
					'unit' => 'px',
				),
				'condition'       => array(
					'pagination' => 'true',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet ' => 'margin: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_bullet_width',
			array(
				'label'           => __( 'Bullet width', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 3,
						'max'  => 20,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 5,
					'unit' => 'px',
				),
				'condition'       => array(
					'pagination' => 'true',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet ' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_bullet_height',
			array(
				'label'           => __( 'Bullet height', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 5,
					'unit' => 'px',
				),
				'condition'       => array(
					'pagination' => 'true',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet ' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_radius',
			array(
				'label'          => __( 'Border radius', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'devices'        => array( 'desktop', 'tablet', 'mobile' ),
				'condition'      => array(
					'pagination' => 'true',
				),
				'selectors'      => array(
					'{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'pagination_tabs',
			array(
				'condition' => array(
					'pagination' => 'true',
				),
			)
		);

		$this->start_controls_tab(
			'pagination_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'pagination_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'condition' => array(
					'pagination' => 'true',
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pagination_border',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'pagination_diameter' => 'yes',
				),
				'condition' => array(
					'pagination' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'pagination_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'pagination_diameter' => 'yes',
				),
				'condition' => array(
					'pagination' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_hover_tab',
			array(
				'label' => __( 'Active', 'elementive' ),
			)
		);

		$this->add_responsive_control(
			'pagination_diameter_width_active',
			array(
				'label'           => __( 'Bullet width', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 5,
						'max'  => 40,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 8,
					'unit' => 'px',
				),
				'condition'       => array(
					'pagination' => 'true',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'pagination_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'condition' => array(
					'pagination' => 'true',
				),
				'selectors' => array(
					'{{WRAPPER}}  .elementive-carousel .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pagination_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'pagination' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet-active',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'pagination_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'pagination' => 'true',
				),
				'selector'  => '{{WRAPPER}} .elementive-carousel .swiper-pagination-bullet-active',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// End carousel navigation section.
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

		// Wrapper Classes.
		$allowed_tags_wrapper = array(
			'class' => array(),
		);
		$classes_wrapper      = array( 'elementive-testimonials', 'uk-flex' );

		if ( 'image-left' === $settings['image_position'] || 'image-right' === $settings['image_position'] ) {

			$classes_wrapper[] = 'uk-flex-row';
		}

		if ( 'image-left' === $settings['image_position'] ) {
			$classes_wrapper[] = 'uk-flex-row-reverse';
		}

		if ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) {

			$classes_wrapper[] = 'uk-flex-column';
		}

		if ( 'image-top' === $settings['image_position'] ) {
			$classes_wrapper[] = 'uk-flex-column-reverse';
		}

		$classes_wrapper[] = esc_attr( $settings['image_position'] );
		$classes_wrapper[] = esc_attr( $settings['text_align'] );

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class' => esc_attr( join( ' ', $classes_wrapper ) ),
			)
		);

		// User Classes.
		$allowed_tags_user = array(
			'class' => array(),
		);
		$classes_user      = array( 'elementive-testimonials-user', 'uk-flex-middle' );

		if ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) {
			$classes_user[] = 'uk-width-1-1';
		}

		if ( 'uk-text-center' === $settings['text_align'] ) {
			$classes_user[] = 'uk-inline-flex';
		} else {
			$classes_user[] = 'uk-flex';
		}

		if ( 'yes' === $settings['show_arrow'] && ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-center' === $settings['text_align'] ) {
			$classes_user[] = 'uk-position-relatiive';
		}

		$classes_user = array_map( 'esc_attr', $classes_user );

		$this->add_render_attribute(
			'user',
			array(
				'class' => esc_attr( join( ' ', $classes_user ) ),
			)
		);

		// Зэрэгцүүлэлт баруун үед хэрэглэгчийн нэр болон албан тушаал бас зургуудад класс оруулах шаардалаар үүсгэв.
		$allowed_tags_user_content_image = array(
			'class' => array(),
		);
		$classes_user_content_image      = array( 'uk-width-auto' );

		if ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-right' === $settings['text_align'] ) {
			$classes_user_content_image[] = 'uk-flex-last';
		}

		if ( 'yes' === $settings['show_arrow'] && ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && ( 'uk-text-left' === $settings['text_align'] || 'uk-text-right' === $settings['text_align'] ) ) {
			$classes_user_content_image[] = 'uk-position-relative';
		}

		$classes_user_content_image = array_map( 'esc_attr', $classes_user_content_image );

		$this->add_render_attribute(
			'user_content_image',
			array(
				'class' => esc_attr( join( ' ', $classes_user_content_image ) ),
			)
		);

		$allowed_tags_user_content_text = array(
			'class' => array(),
		);
		$classes_user_content_text      = array( 'uk-flex-1', 'uk-width-expand' );

		if ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-right' === $settings['text_align'] ) {
			$classes_user_content_text[] = 'uk-flex-first';
			$classes_user_content_text[] = 'uk-text-right';
		} elseif ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-center' === $settings['text_align'] ) {
			$classes_user_content_text[] = 'uk-text-center';
		} else {
			$classes_user_content_text[] = 'uk-text-left';
		}

		$classes_user_content_text = array_map( 'esc_attr', $classes_user_content_text );

		$this->add_render_attribute(
			'user_content_text',
			array(
				'class' => esc_attr( join( ' ', $classes_user_content_text ) ),
			)
		);

		// Classes for name and title.
		$allowed_tags_name = array(
			'class' => array(),
		);
		$classes_name      = array( 'testimonials-name', 'uk-display-block' );

		if ( ( 'image-right' === $settings['image_position'] || 'image-left' === $settings['image_position'] ) && 'name-bottom' === $settings['name_position'] ) {
			$classes_name[] = 'uk-margin-top';
		}

		if ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-center' === $settings['text_align'] ) {
			$classes_name[] = 'uk-margin-top';
			$classes_name[] = 'uk-text-center';
		}

		if ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-left' === $settings['text_align'] ) {
			$classes_name[] = 'uk-margin-left';
		}

		if ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-right' === $settings['text_align'] ) {
			$classes_name[] = 'uk-margin-right';
		}

		$classes_name = array_map( 'esc_attr', $classes_name );

		$this->add_render_attribute(
			'name',
			array(
				'class' => esc_attr( join( ' ', $classes_name ) ),
			)
		);

		// Classes for title.
		$allowed_tags_title = array(
			'class' => array(),
		);
		$classes_title      = array( 'testimonials-title', 'uk-display-block' );

		if ( ( 'image-right' === $settings['image_position'] || 'image-left' === $settings['image_position'] ) && 'name-top' === $settings['name_position'] ) {
			$classes_title[] = 'uk-margin-bottom';
		}

		if ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-center' === $settings['text_align'] ) {
			$classes_title[] = 'uk-text-center';
		}

		if ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-left' === $settings['text_align'] ) {
			$classes_title[] = 'uk-margin-left';
		}

		if ( ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-right' === $settings['text_align'] ) {
			$classes_title[] = 'uk-margin-right';
		}

		$classes_title = array_map( 'esc_attr', $classes_title );

		$this->add_render_attribute(
			'title',
			array(
				'class' => esc_attr( join( ' ', $classes_title ) ),
			)
		);

		// Image Classes.
		$allowed_tags_image = array(
			'class' => array(),
		);
		$classes_image      = array( 'elementive-testimonials-user-image' );

		$classes_image = array_map( 'esc_attr', $classes_image );

		$this->add_render_attribute(
			'image',
			array(
				'class' => esc_attr( join( ' ', $classes_image ) ),
			)
		);

		// Content Classes.
		$allowed_tags_content = array(
			'class' => array(),
		);
		$allowed_html_content = array(
			'strong' => array(),
			'b'      => array(),
			'em'     => array(),
			'i'      => array(),
			'span'   => array(
				'class' => array(),
			),

		);
		$classes_content = array( 'testimonials-content' );

		if ( 'image-top' === $settings['image_position'] || 'image-top' === $settings['image_position'] ) {
			$classes_content[] = 'uk-width-1-1';
		} else {
			$classes_content[] = 'uk-width-expand';
		}

		if ( 'yes' === $settings['show_arrow'] ) {
			$classes_content[] = 'show-arrow';
		}

		$classes_content = array_map( 'esc_attr', $classes_content );

		$this->add_render_attribute(
			'content',
			array(
				'class' => esc_attr( join( ' ', $classes_content ) ),
			)
		);

		// Carousel Values.
		// Slider default values.
		$overflow   = '';
		$autoplay   = 'false';
		$pagination = 'false';
		$navigation = 'false';
		$loop       = 'false';
		$centered   = 'false';

		if ( 'true' === $settings['overflow'] ) {
			$overflow = 'carousel-disable-overlfow';
		}

		if ( 'true' === $settings['loop'] ) {
			$loop = $settings['loop'];
		}

		if ( 'true' === $settings['pagination'] ) {
			$pagination = $settings['pagination'];
		}

		if ( 'true' === $settings['navigation'] ) {
			$navigation = $settings['navigation'];
		}

		if ( 'true' === $settings['auto_play'] ) {
			$autoplay = $settings['auto_play'];
		}

		if ( 'true' === $settings['centered'] ) {
			$centered = $settings['centered'];
		}

		$this->add_render_attribute(
			'carousel',
			array(
				'class'               => array( 'elementive-carousel', 'swiper-container', $overflow ),
				'data-auto-play'      => esc_attr( $autoplay ),
				'data-column-desktop' => esc_attr( $settings['columns']['size'] ),
				'data-column-tablet'  => esc_attr( $settings['columns_tablet']['size'] ),
				'data-column-mobile'  => esc_attr( $settings['columns_mobile']['size'] ),
				'data-margin-desktop' => esc_attr( $settings['margins']['size'] ),
				'data-margin-tablet'  => esc_attr( $settings['margins_tablet']['size'] ),
				'data-margin-mobile'  => esc_attr( $settings['margins_mobile']['size'] ),
				'data-speed'          => esc_attr( $settings['speed']['size'] ),
				'data-loop'           => esc_attr( $loop ),
				'data-pagination'     => esc_attr( $pagination ),
				'data-navigation'     => esc_attr( $navigation ),
				'data-centered'       => esc_attr( $centered ),
			)
		);

		$this->add_render_attribute(
			'carousel_wrapper',
			array(
				'class'               => 'swiper-wrapper ' . esc_attr( $settings['vertical_align'] ),
				'tabindex'            => '0',
			)
		);

		$logo_classes      = array( 'elementive-client-grid-logo' );
		$allowed_html_logo = array(
			'class'      => array(),
			'uk-tooltip' => array(),
		);

		$logo_classes = array_map( 'esc_attr', $logo_classes );

		$this->add_render_attribute(
			'logo',
			array(
				'class'      => esc_attr( join( ' ', $logo_classes ) ),
			)
		);

		if ( $settings['testimonials_carousel'] ) {
			?>
			<div class="elementive-testimonials-carousel">
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'carousel' ), array( 'class' => array() ) ); ?>>
					<div <?php echo wp_kses( $this->get_render_attribute_string( 'carousel_wrapper' ), array( 'class' => array() ) ); ?>>
						<?php
						foreach ( $settings['testimonials_carousel'] as $testimonials ) {
							?>
							<div class="swiper-slide">
								<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_tags_wrapper ); ?>>
									<div <?php echo wp_kses( $this->get_render_attribute_string( 'content' ), $allowed_tags_content ); ?>>
										<blockquote>
											<?php
											if ( ( 'image-right' === $settings['image_position'] || 'image-left' === $settings['image_position'] ) && 'name-top' === $settings['name_position'] ) {
												?>
												<cite <?php echo wp_kses( $this->get_render_attribute_string( 'name' ), $allowed_tags_name ); ?>><?php echo esc_html( $testimonials['name'] ); ?></cite>
												<span <?php echo wp_kses( $this->get_render_attribute_string( 'title' ), $allowed_tags_title ); ?>><?php echo esc_html( $testimonials['title'] ); ?></span>
												<?php
											}
											?>
											<p class="uk-margin-remove"><?php echo wp_kses( $testimonials['testimonials'], $allowed_html_content ); ?></p>
											<?php
											if ( ( 'image-right' === $settings['image_position'] || 'image-left' === $settings['image_position'] ) && 'name-bottom' === $settings['name_position'] ) {
												?>
												<cite <?php echo wp_kses( $this->get_render_attribute_string( 'name' ), $allowed_tags_name ); ?>><?php echo esc_html( $testimonials['name'] ); ?></cite>
												<span <?php echo wp_kses( $this->get_render_attribute_string( 'title' ), $allowed_tags_title ); ?>><?php echo esc_html( $testimonials['title'] ); ?></span>
												<?php
											}
											?>
										</blockquote>
									</div>
									<?php
									if ( 'image-left' === $settings['image_position'] || 'image-right' === $settings['image_position'] ) {
										?>
										<div <?php echo wp_kses( $this->get_render_attribute_string( 'image' ), $allowed_tags_image ); ?>>
											<div class="uk-position-relative">
												<?php echo wp_get_attachment_image( $testimonials['image']['id'], $settings['image_size_size'], '', array( 'class' => 'testimonials-image' ) ); ?>
												<?php
												if ( 'yes' === $settings['show_arrow'] ) {
													?>
													<div class="testimonials-arrow"></div>
													<?php
												}
												?>
											</div>
										</div>
										<?php
									} else {
										?>
										<div <?php echo wp_kses( $this->get_render_attribute_string( 'user' ), $allowed_tags_user ); ?>>
											<div <?php echo wp_kses( $this->get_render_attribute_string( 'user_content_image' ), $allowed_tags_user_content_image ); ?>>
												<?php echo wp_get_attachment_image( $testimonials['image']['id'], $settings['image_size_size'], '', array( 'class' => 'testimonials-image' ) ); ?>
												<?php
												if ( 'yes' === $settings['show_arrow'] && ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && ( 'uk-text-left' === $settings['text_align'] || 'uk-text-right' === $settings['text_align'] ) ) {
													?>
													<div class="testimonials-arrow"></div>
													<?php
												}
												?>
											</div>
											<div <?php echo wp_kses( $this->get_render_attribute_string( 'user_content_text' ), $allowed_tags_user_content_text ); ?>>
												<cite <?php echo wp_kses( $this->get_render_attribute_string( 'name' ), $allowed_tags_name ); ?>><?php echo esc_html( $testimonials['name'] ); ?></cite>
												<span <?php echo wp_kses( $this->get_render_attribute_string( 'title' ), $allowed_tags_title ); ?>><?php echo esc_html( $testimonials['title'] ); ?></span>
											</div>
											<?php
											if ( 'yes' === $settings['show_arrow'] && ( 'image-top' === $settings['image_position'] || 'image-bottom' === $settings['image_position'] ) && 'uk-text-center' === $settings['text_align'] ) {
												?>
												<div class="testimonials-arrow"></div>
												<?php
											}
											?>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<?php
						}
						?>
					</div>
					<?php
					if ( 'true' === $settings['pagination'] ) {
						?>
						<div class="swiper-pagination elementive-carousel-pagination  <?php echo esc_attr( $settings['pagination_bullet_align'] ); ?>"></div>
						<?php
					}

					if ( 'true' === $settings['navigation'] ) {
						?>
						<a href="" class="elementive-carousel-navigation uk-hidden-hover elementive-carousel-button-next uk-inline-clip uk-transition-toggle uk-position-center-right uk-position-z-index uk-text-center uk-svg" tabindex="0">
							<span class="uk-transform-center uk-position-center uk-position-z-index" uk-slidenav-next></span>
							<span class="navigation-background-hover uk-position-cover uk-transition-fade"></span>
						</a>
						<a href="" class="elementive-carousel-navigation uk-hidden-hover elementive-carousel-button-prev uk-inline-clip uk-transition-toggle uk-position-center-left uk-position-z-index uk-text-center uk-svg" tabindex="0">
							<span class="uk-transform-center uk-position-center uk-position-z-index" uk-slidenav-previous></span>
							<span class="navigation-background-hover uk-position-cover uk-transition-fade"></span>
						</a>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
	}
}
