<?php
/**
 * Hello World Widget
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
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Elementor Counter Widget.
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Elementive_Widget_Counter extends Widget_Base {

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
		return 'elementive-counter';
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
		return __( 'Counter', 'elementive' );
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
		return array( 'uikit', 'bounty' );
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
				'label' => __( 'Content', 'elementive' ),
			)
		);

		$this->add_control(
			'enable_icon',
			array(
				'label'        => __( 'Enable icon', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'use_image',
			array(
				'label'        => __( 'Use image', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'enable_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'      => __( 'Choose Image', 'elementive' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url'    => Utils::get_placeholder_image_src(),
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'use_image',
							'value'    => 'yes',
						),
						array(
							'name'     => 'enable_icon',
							'value'    => 'yes',
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'       => 'image_size',
				'default'    => 'thumbnail',
				'exclude'    => array( 'custom' ),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'use_image',
							'value'    => 'yes',
						),
						array(
							'name'     => 'enable_icon',
							'value'    => 'yes',
						),
					),
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'      => __( 'Icon', 'elementive' ),
				'type'       => Controls_Manager::ICONS,
				'default'    => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'use_image',
							'value'    => '',
						),
						array(
							'name'     => 'enable_icon',
							'value'    => 'yes',
						),
					),
				),
			)
		);

		$this->add_control(
			'counter_start',
			array(
				'label'   => __( 'Initial value', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$0000',
			)
		);

		$this->add_control(
			'counter_end',
			array(
				'label'   => __( 'Value', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$4321',
			)
		);

		$this->add_control(
			'title',
			array(
				'label' => __( 'Title', 'elementive' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'text',
			array(
				'label'       => __( 'Description', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'placeholder' => __( 'Type your description here', 'elementive' ),
			)
		);

		$this->add_control(
			'delay',
			array(
				'label'      => __( 'Animation delay', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 100,
						'max'  => 5000,
						'step' => 10,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 100,
				),
			)
		);

		$this->add_control(
			'delay_text',
			array(
				'label'      => __( 'Letter animation delay', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 100,
						'max'  => 5000,
						'step' => 10,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			array(
				'label' => __( 'Icon', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_position',
			array(
				'label'   => __( 'Icon position', 'elementive' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'icon-left' => array(
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'eicon-h-align-left',
					),
					'icon-top' => array(
						'title' => __( 'Center', 'elementive' ),
						'icon'  => 'eicon-v-align-top',
					),
					'icon-right' => array(
						'title' => __( 'Right', 'elementive' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default' => 'icon-top',
				'toggle'  => true,
			)
		);

		$this->add_responsive_control(
			'icon_margin_bottom',
			array(
				'label'           => __( 'Icon margin bottom', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 30,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 30,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 30,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-counter-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'terms' => array(
						array(
							'name'     => 'icon_position',
							'value'    => 'icon-top',
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'icon_margin_left',
			array(
				'label'           => __( 'Icon margin left', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 30,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 30,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 30,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-counter-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'terms' => array(
						array(
							'name'     => 'icon_position',
							'value'    => 'icon-right',
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'icon_margin_right',
			array(
				'label'           => __( 'Icon margin right', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 30,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 30,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 30,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-counter-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'terms' => array(
						array(
							'name'     => 'icon_position',
							'value'    => 'icon-left',
						),
					),
				),
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
					'terms' => array(
						array(
							'name'     => 'icon_position',
							'value'    => 'icon-top',
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'           => __( 'Icon size', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 30,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 30,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 30,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-counter-icon .elementive-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementive-counter-icon .elementive-svg-wrapper svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-counter-icon .elementive-icon-wrapper i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'enable_background',
			array(
				'label'        => __( 'Enable background', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_responsive_control(
			'diameter',
			array(
				'label'      => __( 'Diameter', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'  => array(
					'enable_background' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-counter-icon .elementive-counter-icon-wrapper' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementive-counter-icon .elementive-icon-wrapper i' => 'line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'radius',
			array(
				'label'      => __( 'Radius', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'  => array(
					'enable_background' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-counter-icon .elementive-counter-icon-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'       => 'icon_background',
				'label'      => __( 'Background', 'elementive' ),
				'types'      => array( 'classic', 'gradient' ),
				'condition'  => array(
					'enable_background' => 'yes',
				),
				'selector'   => '{{WRAPPER}} .elementive-counter-icon .elementive-counter-icon-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'       => 'icon_border',
				'label'      => __( 'Border', 'elementive' ),
				'condition'  => array(
					'enable_background' => 'yes',
				),
				'selector'   => '{{WRAPPER}} .elementive-counter-icon .elementive-counter-icon-wrapper',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_number',
			array(
				'label' => __( 'Number', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'number_margin',
			array(
				'label'           => __( 'Margin bottom', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px', '%' ),
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
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 10,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-counter-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'number_notice',
			array(
				'label'           => __( 'Note:', 'elementive' ),
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'Number counter based bounty.js. It will convert text to SVG. If you want to change typography options, please save and update page, refresh see changes.', 'elementive' ),
				'content_classes' => '',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'number_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementive-counter-number',
			)
		);

		$this->add_control(
			'number_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-counter-number text' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'number_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-counter-number',
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
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementive-counter-title h3',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-counter-title h3' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-counter-title h3',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			array(
				'label' => __( 'Text', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementive-counter-text p',
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-counter-text p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'text_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-counter-text p',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_wrapper',
			array(
				'label' => __( 'Wrapper', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'wraooer)margin',
			array(
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrapper_border',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-counter' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wrapper_background',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .elementive-counter',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wrapper_border',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .wrapper',
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

		// Allowed Tags.
		$allowed_attr_class = array(
			'class' => array(),
		);

		$allowed_attr_counter = array(
			'class'                       => array(),
			'data-number-start'           => array(),
			'data-number-end'             => array(),
			'data-animation-delay'        => array(),
			'data-letter-animation-delay' => array(),
			'data-line-height'            => array(),
			'data-letter-spacing'         => array(),
		);

		// Wrapper Classes.
		$classes_wrapper = array( 'elementive-counter' );

		if ( 'icon-top' === $settings['icon_position'] ) {
			$classes_wrapper[] = $settings['text_align'];
		}

		if ( 'icon-left' === $settings['icon_position'] || 'icon-right' === $settings['icon_position'] ) {
			$classes_wrapper[] = 'uk-flex';
		}

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class' => esc_attr( join( ' ', $classes_wrapper ) ),
			)
		);

		// Icon Classes.
		$classes_icon = array( 'elementive-counter-icon' );

		if ( 'yes' === $settings['use_image'] ) {
			$classes_icon[] = 'use-image';
		}

		if ( 'icon-top' === $settings['icon_position'] ) {
			$classes[] = $settings['text_align'];
		}

		if ( 'icon-left' === $settings['icon_position'] || 'icon-right' === $settings['icon_position'] ) {
			$classes_icon[] = 'uk-width-auto';
		}

		$classes_icon = array_map( 'esc_attr', $classes_icon );

		$this->add_render_attribute(
			'icon',
			array(
				'class' => esc_attr( join( ' ', $classes_icon ) ),
			)
		);

		// Content Classes.
		$classes_content = array( 'elementive-counter-content' );

		if ( 'icon-left' === $settings['icon_position'] || 'icon-right' === $settings['icon_position'] ) {
			$classes_content[] = 'uk-flex-1 uk-width-expand';
		}

		if ( 'icon-right' === $settings['icon_position'] ) {
			$classes_content[] = 'uk-flex-first';
		}

		$classes_content = array_map( 'esc_attr', $classes_content );

		$this->add_render_attribute(
			'content',
			array(
				'class' => esc_attr( join( ' ', $classes_content ) ),
			)
		);

		// Counter Classes.
		$classes_counter = array( 'run-counter', 'elementive-counter-number' );

		$classes_counter = array_map( 'esc_attr', $classes_counter );

		$this->add_render_attribute(
			'counter',
			array(
				'class'                       => esc_attr( join( ' ', $classes_counter ) ),
				'data-number-start'           => esc_attr( $settings['counter_start'] ),
				'data-number-end'             => esc_attr( $settings['counter_end'] ),
				'data-animation-delay'        => esc_attr( $settings['delay']['size'] ),
				'data-letter-animation-delay' => esc_attr( $settings['delay_text']['size'] ),
				'data-line-height'            => esc_attr( $settings['number_typography_line_height']['size'] ),
				'data-letter-spacing'         => esc_attr( $settings['number_typography_letter_spacing']['size'] ),
			)
		);

		?>
		<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?> uk-match-height=".elementor-widget-wrap">
			<?php
			if ( $settings['image']['id'] || $settings['icon'] ) {
				?>
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'icon' ), $allowed_attr_class ); ?>>
					<?php
					if ( 'yes' === $settings['use_image'] ) {
						?>
						<div class="elementive-image-wrapper elementive-counter-icon-wrapper uk-overflow-hidden uk-display-inline-block">
							<?php
							echo wp_get_attachment_image( $settings['image']['id'], $settings['image_size_size'] );
							?>
						</div>
						<?php
					} else {
						if ( 'svg' === $settings['icon']['library'] ) {
							?>
							<div class="elementive-svg-wrapper elementive-counter-icon-wrapper uk-display-inline-block uk-text-center">
								<?php
								Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
								?>
							</div>
							<?php
						} else {
							?>
							<div class="elementive-icon-wrapper elementive-counter-icon-wrapper uk-display-inline-block uk-text-center">
								<?php
								Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
								?>
							</div>
							<?php
						}
					}
					?>
				</div>
				<?php
			}

			if ( $settings['counter_end'] || $settings['title'] || $settings['text'] ) {
				?>
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'content' ), $allowed_attr_class ); ?>>
					<?php
					if ( $settings['counter_end'] ) {
						?>
						<div <?php echo wp_kses( $this->get_render_attribute_string( 'counter' ), $allowed_attr_counter ); ?>></div>
						<?php
					}
					if ( $settings['title'] ) {
						?>
						<div class="elementive-counter-title">
							<h3><?php echo esc_html( $settings['title'] ); ?></h3>
						</div>
						<?php
					}
					if ( $settings['text'] ) {
						?>
						<div class="elementive-counter-text">
							<p><?php echo esc_html( $settings['text'] ); ?></p>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}
