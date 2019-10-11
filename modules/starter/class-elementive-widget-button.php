<?php
/**
 * Buttons Widget
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
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Elementive Buttonw Widget.
 *
 * Elementor widget for elementive.
 *
 * @since 1.0.0
 */
class Elementive_Widget_Button extends Widget_Base {

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
		return 'elementive-button';
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
		return __( 'Button', 'elementive' );
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
		return array( 'uikit' );
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
			'button_type',
			array(
				'label'   => __( 'Button type', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'elementive-button-type-default',
				'options' => array(
					'elementive-button-type-full'    => __( 'Full', 'elementive' ),
					'elementive-button-type-icon'    => __( 'Icon', 'elementive' ),
					'elementive-button-type-default' => __( 'Default', 'elementive' ),
				),
			)
		);

		$this->add_control(
			'button_icon',
			array(
				'label'     => __( 'Button icon', 'elementive' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'button_type!' => 'elementive-button-type-full',
				),
			)
		);

		$this->add_control(
			'svg_color',
			array(
				'label'        => __( 'Disable SVG color', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'button_icon[library]' => 'svg',
					'button_type!'         => 'elementive-button-type-full',
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Button text', 'elementive' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Button', 'elementive' ),
				'separator' => 'before',
				'condition' => array(
					'button_type!' => 'elementive-button-type-icon',
				),
			)
		);

		$this->add_control(
			'link_type',
			array(
				'label'        => __( 'Link to lightbox', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'lightbox_type',
			array(
				'label'     => __( 'Lightbox type', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'video',
				'options'   => array(
					'video' => __( 'Video', 'elementive' ),
					'image' => __( 'Image', 'elementive' ),
				),
				'condition' => array(
					'link_type' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_url',
			array(
				'label'     => __( 'Choose Image', 'elementive' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url'   => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'link_type'     => 'yes',
					'lightbox_type' => 'image',
				),
			)
		);

		$this->add_control(
			'video_url',
			array(
				'label'         => __( 'Video link', 'elementive' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'Please add your youtube, vimeo video URL', 'elementive' ),
				'show_external' => false,
				'default'       => array(
					'url'         => '',
					'nofollow'    => true,
				),
				'condition'     => array(
					'link_type'     => 'yes',
					'lightbox_type' => 'video',
				),
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'         => __( 'Button link', 'elementive' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'elementive' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'condition'     => array(
					'link_type!'     => 'yes',
				),
			)
		);

		$this->add_control(
			'inline_button',
			array(
				'label'        => __( 'Enable inline button', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'condition'    => array(
					'button_type' => 'elementive-button-type-full',
				),
				'default'      => '',
				'separator'    => 'before',
			)
		);

		$this->add_responsive_control(
			'button_margin_right',
			array(
				'label'           => __( 'Button margin right', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
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
				'condition'       => array(
					'inline_button' => 'yes',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => 'margin-right: {{SIZE}}{{UNIT}}; display: inline-flex; width: auto;',
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
				'label'     => __( 'Icon position', 'elementive' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left' => array(
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'elementive' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => true,
			)
		);

		$this->add_responsive_control(
			'margin_right',
			array(
				'label'           => __( 'Icon margin right', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'desktop_default' => array(
					'size' => 10,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 10,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 10,
					'unit' => 'px',
				),
				'condition'       => array(
					'icon_position' => 'left',
					'button_type!'  => 'elementive-button-type-icon',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-button .elementive-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'margin_left',
			array(
				'label'           => __( 'Icon margin left', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'desktop_default' => array(
					'size' => 10,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 10,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 10,
					'unit' => 'px',
				),
				'condition'       => array(
					'icon_position' => 'right',
					'button_type!'  => 'elementive-button-type-icon',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-button .elementive-button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_icon_size',
			array(
				'label'      => __( 'Icon font size', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition'  => array(
					'button_icon[library]!' => 'svg',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-button .elementive-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_svg_size',
			array(
				'label'      => __( 'SVG width', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'condition'  => array(
					'button_icon[library]' => 'svg',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-button .elementive-button-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_background',
			array(
				'label'        => __( 'Enable icon background', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_responsive_control(
			'button_icon_diameter',
			array(
				'label'      => __( 'Icon diameter', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 30,
				),
				'condition'  => array(
					'icon_background' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-button .elementive-button-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_icon_radius',
			array(
				'label'      => __( 'Icon radius', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 30,
				),
				'condition'  => array(
					'icon_background' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-button .elementive-button-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab_icon',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-button .elementive-button-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementive-button .elementive-button-icon svg' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_backgroun_color',
			array(
				'label'     => __( 'Background color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'icon_background' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-button .elementive-button-icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab_icon',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'icon_color_hover',
			array(
				'label'     => __( 'Icon color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-button:hover .elementive-button-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementive-button:hover .elementive-button-icon svg' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_backgroun_color_hover',
			array(
				'label'     => __( 'Background color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'condition'  => array(
					'icon_background' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-button:hover .elementive-button-icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			array(
				'label' => __( 'Button', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementive-button .elementive-button-text',
			)
		);

		$this->add_control(
			'text_button',
			array(
				'label'        => __( 'Enable text button', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'animated_border',
			array(
				'label'        => __( 'Enable animated border', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'animated_border_height',
			array(
				'label'      => __( 'Animated border height', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 2,
				),
				'condition'  => array(
					'text_button'     => 'yes',
					'animated_border' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-button-animated-border::after' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'animated_border_padding',
			array(
				'label'      => __( 'Animated border padding', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 40,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'text_button'     => 'yes',
					'animated_border' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-button-animated-border' => 'padding-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'button_radius',
			array(
				'label'      => __( 'Button radius', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
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
				'default'    => array(
					'unit' => 'px',
					'size' => 3,
				),
				'condition'  => array(
					'text_button!' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '20',
					'bottom'   => '10',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'condition'  => array(
					'text_button!' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'style_tabs_button'
		);

		$this->start_controls_tab(
			'style_normal_tab_button',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'     => __( 'Border color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'condition' => array(
					'text_button'     => 'yes',
					'animated_border' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-button-animated-border::after' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'       => 'background_button',
				'label'      => __( 'Background', 'elementive' ),
				'types'      => array( 'classic', 'gradient' ),
				'condition'  => array(
					'text_button!' => 'yes',
				),
				'selector'   => '{{WRAPPER}} .elementive-button',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'       => 'button_border_normal',
				'label'      => __( 'Border', 'elementive' ),
				'condition'  => array(
					'text_button!' => 'yes',
				),
				'selector'   => '{{WRAPPER}} .elementive-button',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'       => 'box_shadow_button',
				'label'      => __( 'Box Shadow', 'elementive' ),
				'condition'  => array(
					'text_button!' => 'yes',
				),
				'selector'   => '{{WRAPPER}} .elementive-button',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab_button',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'button_color_hover',
			array(
				'label'     => __( 'Text color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_border_color_hover',
			array(
				'label'     => __( 'Border color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'condition' => array(
					'text_button'     => 'yes',
					'animated_border' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-button-animated-border:hover::after' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'       => 'background_button_hover',
				'label'      => __( 'Background', 'elementive' ),
				'types'      => array( 'classic', 'gradient' ),
				'condition'  => array(
					'text_button!' => 'yes',
				),
				'selector'   => '{{WRAPPER}} .elementive-button .elementive-button-hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'       => 'button_border_hover',
				'label'      => __( 'Border', 'elementive' ),
				'condition'  => array(
					'text_button!' => 'yes',
				),
				'selector'   => '{{WRAPPER}} .elementive-button:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'       => 'box_shadow_button_hover',
				'label'      => __( 'Box Shadow', 'elementive' ),
				'condition'  => array(
					'text_button!' => 'yes',
				),
				'selector'   => '{{WRAPPER}} .elementive-button:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		$allowed_html_link = array(
			'target' => array(),
			'rel'    => array(),
		);

		// Wrapper Classes.
		$classes_wrapper = array( 'elementive-button', 'uk-flex-middle', 'uk-position-relative', 'uk-transition-toggle' );

		$classes_wrapper[] = $settings['button_type'];

		if ( 'svg' === $settings['button_icon']['library'] ) {
			$classes_wrapper[] = 'with-svg-icon';
		} else {
			$classes_wrapper[] = 'with-font-icon';
		}

		if ( 'yes' === $settings['svg_color'] ) {
			$classes_wrapper[] = 'uk-svg';
		}

		if ( 'elementive-button-type-full' === $settings['button_type'] ) {
			$classes_wrapper[] = 'uk-flex';
			$classes_wrapper[] = 'uk-text-center';
		} else {
			$classes_wrapper[] = 'uk-inline-flex';
		}

		if ( 'elementive-button-type-icon' !== $settings['button_type'] ) {
			$classes_wrapper[] = 'uk-overflow-hidden';
		}

		if ( 'yes' === $settings['text_button'] ) {
			$classes_wrapper[] = 'elementive-button-type-text';
		}

		if ( 'yes' === $settings['animated_border'] ) {
			$classes_wrapper[] = 'elementive-button-animated-border';
		}

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$target   = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
		$link     = '';

		if ( 'yes' === $settings['link_type'] ) {

			if ( 'video' === $settings['lightbox_type'] ) {
				$link = $settings['video_url'];
			} elseif ( 'image' === $settings['lightbox_type'] ) {
				$link = $settings['image_url']['url'];
			} else {
				$link = $settings['button_link']['url'];
			}
		} else {
			$link = $settings['button_link']['url'];
		}
		$this->add_render_attribute(
			'wrapper',
			array(
				'class'    => esc_attr( join( ' ', $classes_wrapper ) ),
				'tabindex' => '0',
			)
		);

		// Open lightbox div.
		if ( 'yes' === $settings['link_type'] ) {
			echo '<div uk-lightbox>';
		}
		?>
		<a <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?> href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" <?php echo wp_kses( $target . $nofollow, $allowed_html_link ); ?>>
			<?php
			if ( $link ) {
				?>
				<span class="elementive-button-content uk-position-relative uk-flex uk-flex-middle uk-position-z-index uk-text-center">
					<?php
					if ( 'left' === $settings['icon_position'] && 'elementive-button-type-full' !== $settings['button_type'] && $settings['button_icon']['value'] ) {
						?>
						<span class="elementive-button-icon uk-inline-flex uk-flex-middle">
							<?php Icons_Manager::render_icon( $settings['button_icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</span>
						<?php
					}
					if ( $settings['button_text'] ) {
						?>
						<span class="elementive-button-text"><?php echo esc_attr( $settings['button_text'] ); ?></span>
						<?php
					}
					if ( 'right' === $settings['icon_position'] && 'elementive-button-type-full' !== $settings['button_type'] && $settings['button_icon']['value'] ) {
						?>
						<span class="elementive-button-icon uk-inline-flex uk-flex-middle">
							<?php Icons_Manager::render_icon( $settings['button_icon'], array( 'aria-hidden' => 'true' ) ); ?>
						</span>
						<?php
					}
					?>
				</span>
				<?php
			} else {
				?>
				<span class="elementive-button-content uk-position-relative uk-position-z-index"><?php esc_html_e( 'Please add your button URL', 'elementive' ); ?></span>
				<?php
			}
			?>
			<span class="elementive-button-hover uk-position-cover uk-transition-fade"></span>
		</a>
		<?php
		// Close lightbox div.
		if ( 'yes' === $settings['link_type'] ) {
			echo '</div>';
		}
	}
}
