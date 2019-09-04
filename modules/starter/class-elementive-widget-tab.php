<?php
/**
 * Elementive Advanced Tabs Widget
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
use Elementive\Includes\Elementive_Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Inline Editing Widget.
 *
 * @since      1.0.0
 * @package    Elementive
 * @subpackage Elementive/Modules/Starter
 * @author     Dimative <contact@dimative.com>
 */
class Elementive_Widget_Tab extends Widget_Base {

	/**
	 * Content template disable.
	 *
	 * @var boolean
	 */
	protected $_has_template_content = false;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'elementive-tabs';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Advanced Tabs', 'elementive' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fas fa-folder';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'elementive-starter' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementive' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label'       => __( 'Title', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Tab title', 'elementive' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_icon',
			[
				'label'   => __( 'Icon', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => '',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'use_elementor_template',
			[
				'label'        => __( 'Use Elementor template', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label'      => __( 'Content', 'elementive' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'Tab Content', 'elementive' ),
				'show_label' => false,
				'conditions' => [
					'terms' => [
						[
							'name'     => 'use_elementor_template',
							'operator' => '!in',
							'value'    => [
								'yes',
							],
						],
					],
				],
			]
		);

		$repeater->add_control(
			'elementor_template',
			[
				'label'      => __( 'Elementor templates', 'elementive' ),
				'type'       => Controls_Manager::SELECT2,
				'multiple'   => false,
				'options'    => Elementive_Helpers::elementive_elementor_templates(),
				'default'    => '',
				'conditions' => [
					'terms' => [
						[
							'name'     => 'use_elementor_template',
							'operator' => 'in',
							'value'    => [
								'yes',
							],
						],
					],
				],
			]
		);

		$this->add_control(
			'elementive_tab',
			[
				'label'       => __( 'Tab items', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'tab_title'   => __( 'Tab title #1', 'elementive' ),
						'tab_content' => __( 'Item content. Click the edit button to change this text.', 'elementive' ),
					],
					[
						'tab_title'   => __( 'Tab title #2', 'elementive' ),
						'tab_content' => __( 'Item content. Click the edit button to change this text.', 'elementive' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();

		// Start customize tab bar section.
		$this->start_controls_section(
			'section_customize_tab_tab',
			[
				'label' => __( 'Customize title bar', 'elementive' ),
			]
		);

		$this->add_control(
			'tab_bar_modifiers',
			[
				'label'   => __( 'Modifiers', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'uk-tab-default',
				'options' => [
					'uk-tab-default' => __( 'Default', 'elementive' ),
					'uk-tab-left'    => __( 'Left', 'elementive' ),
					'uk-tab-right'   => __( 'Right', 'elementive' ),
				],
			]
		);

		$this->add_control(
			'tab_bar_alignment',
			[
				'label'      => __( 'Alignment', 'elementive' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '',
				'options'    => [
					'uk-flex-center'        => __( 'Center', 'elementive' ),
					'uk-flex-left'          => __( 'Left', 'elementive' ),
					'uk-flex-right'         => __( 'Right', 'elementive' ),
					'uk-child-width-expand' => __( 'Expand', 'elementive' ),
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'tab_bar_modifiers',
							'operator' => 'in',
							'value'    => [
								'uk-tab-default',
							],
						],
					],
				],
			]
		);

		$this->add_control(
			'tab_bar_responsive',
			[
				'label'       => __( 'Responsive', 'elementive' ),
				'description' => __( 'When to switch to horizontal mode - a breakpoint (e.g. @s, @m, @l, @xl)', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => [
					'@s'     => __( 'Small', 'elementive' ),
					'@m'     => __( 'Medium', 'elementive' ),
					'@l'     => __( 'Large', 'elementive' ),
					'@xl'    => __( 'Extra Large', 'elementive' ),
				],
				'conditions'  => [
					'terms' => [
						[
							'name'     => 'tab_bar_modifiers',
							'operator' => 'in',
							'value'    => [
								'uk-tab-left',
								'uk-tab-right',
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'tab_item_spacing_left',
			[
				'label'           => __( 'Items spacing left', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .uk-tab > li:not(:first-child)' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'separator'       => 'before',
				'conditions'      => [
					'terms' => [
						[
							'name'     => 'tab_bar_modifiers',
							'operator' => 'in',
							'value'    => [
								'uk-tab-default',
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'tab_item_spacing_top',
			[
				'label'           => __( 'Items spacing top', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .uk-tab > li:not(:first-child)' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
				'separator'       => 'before',
				'conditions'      => [
					'terms' => [
						[
							'name'     => 'tab_bar_modifiers',
							'operator' => 'in',
							'value'    => [
								'uk-tab-left',
								'uk-tab-right',
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'tab_content_margin_top',
			[
				'label'           => __( 'Content margin top', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} ul.uk-tab' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'conditions'      => [
					'terms' => [
						[
							'name'     => 'tab_bar_modifiers',
							'operator' => 'in',
							'value'    => [
								'uk-tab-default',
							],
						],
					],
				],
				'separator'       => 'before',
			]
		);

		$this->add_control(
			'tab_content_margin_horizontal',
			[
				'label'       => __( 'Content margin horizontal', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => [
					''                  => __( 'Default', 'elementive' ),
					'uk-grid-small'     => __( 'Small', 'elementive' ),
					'uk-grid-medium'    => __( 'Medium', 'elementive' ),
					'uk-grid-large'     => __( 'Large', 'elementive' ),
					'uk-grid-collapse'  => __( 'Collapse', 'elementive' ),
				],
				'conditions'  => [
					'terms' => [
						[
							'name'     => 'tab_bar_modifiers',
							'operator' => 'in',
							'value'    => [
								'uk-tab-left',
								'uk-tab-right',
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'tab_bar_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-tab::before',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_bar_border_radius',
			[
				'label'      => __( 'Tab bar border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices'    => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'  => [
					'{{WRAPPER}} .uk-tab::before' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_bar_background',
				'label'     => __( 'Tab bar background', 'elementive' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .uk-tab::before',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'tab_bar_box_shadow',
				'label'     => __( 'Tab bar box shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-tab::before',
				'separator' => 'before',
			]
		);

		// End customize tab bar section.
		$this->end_controls_section();

		// Start customize title section.
		$this->start_controls_section(
			'section_customize_title',
			[
				'label' => __( 'Customize title', 'elementive' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_title_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uk-tab > li > a > .tab-title',
			]
		);

		$this->add_responsive_control(
			'tab_icon_size',
			[
				'label'           => __( 'Icon font size', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'       => [
					'{{WRAPPER}} .uk-tab > li > a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator'       => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_icon_margin',
			[
				'label'           => __( 'Icon margin right', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => [ 'px' ],
				'range'           => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'tablet_default'  => [
					'size' => 10,
					'unit' => 'px',
				],
				'mobile_default'  => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors'       => [
					'{{WRAPPER}} .uk-tab > li > a i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_title_padding',
			[
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices'    => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'  => [
					'{{WRAPPER}} .uk-tab > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		// Start tabs. Will use this tab for normal, hover, active state.
		$this->start_controls_tabs(
			'style_tabs'
		);

		// Start normal tab.
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'elementive' ),
			]
		);

		$this->add_control(
			'tab_title_color',
			[
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .uk-tab > li > a > *' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'tab_title_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-tab > li > a',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_title_border_radius',
			[
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices'    => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'  => [
					'{{WRAPPER}} .uk-tab > li > a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_title_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .uk-tab > li > a',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'tab_title_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-tab > li > a',
				'separator' => 'before',
			]
		);

		// End normal tab.
		$this->end_controls_tab();

		// Start hover tab.
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'elementive' ),
			]
		);

		$this->add_control(
			'tab_title_color_hover',
			[
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .uk-tab > li > a:hover > *' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'tab_title_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-tab > li > a:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_title_border_radius_hover',
			[
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices'    => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'  => [
					'{{WRAPPER}} .uk-tab > li > a:hover' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_title_background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .uk-tab > li > a:hover',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'tab_title_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-tab > li > a:hover',
				'separator' => 'before',
			]
		);

		// End hover tab.
		$this->end_controls_tab();

		// Start active tab.
		$this->start_controls_tab(
			'style_active_tab',
			[
				'label' => __( 'Active', 'elementive' ),
			]
		);

		$this->add_control(
			'tab_title_color_active',
			[
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .uk-tab > li.uk-active > a > *' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'tab_title_border_active',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-tab > li.uk-active > a',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_title_border_radius_active',
			[
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices'    => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'  => [
					'{{WRAPPER}} .uk-tab > li.uk-active > a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_title_background_active',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .uk-tab > li.uk-active > a',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'tab_title_box_shadow_active',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-tab > li.uk-active > a',
				'separator' => 'before',
			]
		);

		// End active tab.
		$this->end_controls_tab();

		// End section customize title.
		$this->end_controls_section();

		// Start customize content section.
		$this->start_controls_section(
			'section_customize_content',
			[
				'label' => __( 'Customize content', 'elementive' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_content_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'devices'  => [ 'desktop', 'tablet', 'mobile' ],
				'selector' => '{{WRAPPER}} .uk-switcher li .elementive-tab-content',
			]
		);

		$this->add_responsive_control(
			'tab_content_padding',
			[
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices'    => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'  => [
					'{{WRAPPER}} .uk-switcher li .elementive-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'tab_content_border_radius',
			[
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices'    => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'  => [
					'{{WRAPPER}} .uk-switcher li .elementive-tab-content' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'tab_content_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-switcher li .elementive-tab-content',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'tab_content_background',
				'label'          => __( 'Background', 'elementive' ),
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}} .uk-switcher li .elementive-tab-content ',
				'separator'      => 'before',
				'fields_options' => [
					'color' => [
						'scheme' => [
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_4,
						],
					],
				],
			]
		);

		$this->add_control(
			'tab_content_background_color_determine',
			[
				'label'        => __( 'Detemine background color', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'tab_content_color',
			[
				'label'      => __( 'Color', 'elementive' ),
				'type'       => Controls_Manager::COLOR,
				'scheme'     => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors'  => [
					'{{WRAPPER}} .uk-switcher li .elementive-tab-content' => 'color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'tab_content_background_color_determine',
							'operator' => '!in',
							'value'    => [
								'yes',
							],
						],
					],
				],
				'separator'  => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'tab_content_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-switcher li .elementive-tab-content',
				'separator' => 'before',
			]
		);

		// End section customize content.
		$this->end_controls_section();

		// Start customize accordion.
		$this->start_controls_section(
			'section_tab_settings',
			[
				'label' => __( 'Tab settings', 'elementive' ),
			]
		);

		$this->add_control(
			'tab_hover_transition',
			[
				'label'       => __( 'Transition duration in milliseconds', 'elementive' ),
				'description' => __( 'Hover & active transition duration time.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					],
				],
				'default'     => [
					'size' => 300,
				],
				'selectors'   => [
					'{{WRAPPER}} .uk-tab > li > a' => 'transition: color {{SIZE}}ms, background {{SIZE}}ms, border {{SIZE}}ms, border-radius {{SIZE}}ms;;',
					'{{WRAPPER}} .uk-switcher li'  => 'transition: color {{SIZE}}ms, background {{SIZE}}ms, border {{SIZE}}ms, border-radius {{SIZE}}ms;;',
				],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'tab_animation_in',
			[
				'label'       => __( 'Animation in', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'uk-animation-fade',
				'options'     => [
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

		$this->add_control(
			'tab_animation_out',
			[
				'label'       => __( 'Animation out', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'uk-animation-fade',
				'options'     => [
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

		$this->add_control(
			'tab_animation_duration',
			[
				'label'       => __( 'Animation duration in milliseconds', 'elementive' ),
				'description' => __( 'The animation duration.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					],
				],
				'default'     => [
					'size' => 200,
				],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'tab_animation_transition',
			[
				'label'       => __( 'Transition', 'elementive' ),
				'description' => __( 'The transition to use when revealing items.', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'ease',
				'options'     => [
					'linear'      => __( 'linear', 'elementive' ),
					'ease'        => __( 'ease', 'elementive' ),
					'ease-in'     => __( 'ease-in', 'elementive' ),
					'ease-in-out' => __( 'ease-in-out', 'elementive' ),
					'ease-out'    => __( 'ease-out', 'elementive' ),
				],
			]
		);

		// End section customize accortion.
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings           = $this->get_settings_for_display();
		$icon               = '';
		$animation_duration = '';
		$content_background = '';
		$determine_class    = '';
		$alignment_class    = '';
		$connect_attr       = '';
		$tab_title_class    = '';

		if ( 'uk-tab-left' === $settings['tab_bar_modifiers'] || 'uk-tab-right' === $settings['tab_bar_modifiers'] ) {
			$connect_attr = 'connect: #' . $this->get_id();
		}

		if ( 'uk-tab-default' === $settings['tab_bar_modifiers'] || 'uk-tab-bottom' === $settings['tab_bar_modifiers'] ) {
			$alignment_class = $settings['tab_bar_alignment'];
		}

		if ( $settings['tab_animation_duration'] ) {
			$animation_duration = $settings['tab_animation_duration'];
		} else {
			$animation_duration['size'] = 200;
		}

		// Check and the content background color is rgba. If color is rgba convert it to hex.
		if ( Elementive_Helpers::elementive_check_rgba( $settings['tab_content_background_color'] ) ) {
			$content_background = Elementive_Helpers::elementive_convert_rgba_to_hex( $settings['tab_content_background_color'] );
		} else {
			$content_background = $settings['tab_content_background_color'];
		}

		// Content dark light class.
		if ( ! Elementive_Helpers::elementive_is_hex_light( $content_background ) && $settings['tab_content_background_color'] && 'yes' === $settings['tab_content_background_color_determine'] ) {
			$determine_class = 'uk-light';
		} else {
			$determine_class = 'uk-dark';
		}

		if ( 'uk-tab-left' === $settings['tab_bar_modifiers'] || 'uk-tab-right' === $settings['tab_bar_modifiers'] ) {
			$tab_title_class = 'uk-width-1-1';
		} else {
			$tab_title_class = 'uk-height-1-1';
		}

		$this->add_render_attribute(
			'elementive_tab',
			[
				'class'  => 'uk-tab ' . esc_attr( $settings['tab_bar_modifiers'] ) . ' ' . esc_attr( $alignment_class ),
				'uk-tab' => 'animation: ' . esc_attr( $settings['tab_animation_in'] ) . ', ' . esc_attr( $settings['tab_animation_out'] ) . '; duration: ' . esc_attr( $settings['tab_animation_duration']['size'] ) . '; ' . esc_attr( $connect_attr ) . ';',
			]
		);

		$this->add_render_attribute(
			'elementive_tab_switcher',
			[
				'id'          => $this->get_id(),
				'class'       => 'uk-switcher',
				'uk-switcher' => '',
			]
		);

		$this->add_render_attribute(
			'elementive_tab_content',
			[
				'class' => 'elementive-tab-content ' . esc_attr( $determine_class ),
			]
		);

		$this->add_render_attribute(
			'elementive_tab_grid',
			[
				'class'   => 'uk-grid ' . esc_attr( $settings['tab_content_margin_horizontal'] ),
				'uk-grid' => '',
			]
		);

		$this->add_render_attribute(
			'elementive_tab_title',
			[
				'class' => 'uk-flex uk-flex-middle ' . esc_attr( $tab_title_class ),
				'href'  => '#',
			]
		);

		$frontend = new Frontend();

		if ( $settings['elementive_tab'] ) {
			// Start left or right modifier grid class.
			if ( 'uk-tab-left' === $settings['tab_bar_modifiers'] || 'uk-tab-right' === $settings['tab_bar_modifiers'] ) {
				echo '<div ' . wp_kses(
					$this->get_render_attribute_string( 'elementive_tab_grid' ),
					[
						'class'   => [],
						'uk-grid' => [],
					]
				) . '>';
			}
			// Start left or right modifier class for tab bar.
			if ( 'uk-tab-left' === $settings['tab_bar_modifiers'] ) {
				echo '<div class ="uk-width-auto' . esc_attr( $settings['tab_bar_responsive'] ) . ' uk-first-column">';
			} elseif ( 'uk-tab-right' === $settings['tab_bar_modifiers'] ) {
				echo '<div class ="uk-width-auto' . esc_attr( $settings['tab_bar_responsive'] ) . ' uk-flex-last' . esc_attr( $settings['tab_bar_responsive'] ) . '">';
			}
			echo '<ul ' . wp_kses(
				$this->get_render_attribute_string( 'elementive_tab' ),
				[
					'class'  => [],
					'uk-tab' => [],
				]
			) . '>';
			foreach ( $settings['elementive_tab'] as $item ) {
				$icon = $item['tab_icon'];
				echo '<li class="uk-flex uk-flex-middle">';
				echo '<a ' . wp_kses( $this->get_render_attribute_string( 'elementive_tab_title' ), [ 'class' => [] ] ) . '>';
				echo '<span class="uk-flex uk-flex-middle">';
				if ( $icon['value'] ) {
					if ( 'svg' === $icon['library'] ) {
						echo '<span class="uk-icon">';
						Icons_Manager::render_icon(
							$item['tab_icon'],
							[
								'aria-hidden' => 'true',
							]
						);
						echo '</span>';
					} else {
						Icons_Manager::render_icon(
							$item['tab_icon'],
							[
								'aria-hidden' => 'true',
							]
						);
					}
				}
				echo '<span class="tab-title">' . esc_html( $item['tab_title'] ) . '</span>';
				echo '</span></a></li>';
			}
			echo '</ul>';

			// End left or right modifier class for tab bar.
			if ( 'uk-tab-left' === $settings['tab_bar_modifiers'] || 'uk-tab-right' === $settings['tab_bar_modifiers'] ) {
				echo '</div>';
			}

			// Start left or right modifier class for tab content.
			if ( 'uk-tab-left' === $settings['tab_bar_modifiers'] ) {
				echo '<div class ="uk-width-expand' . esc_attr( $settings['tab_bar_responsive'] ) . '">';
			} elseif ( 'uk-tab-right' === $settings['tab_bar_modifiers'] ) {
				echo '<div class ="uk-width-expand' . esc_attr( $settings['tab_bar_responsive'] ) . ' uk-first-column">';
			}
			echo '<ul ' . wp_kses(
				$this->get_render_attribute_string( 'elementive_tab_switcher' ),
				[
					'id'          => [],
					'class'       => [],
					'uk-switcher' => [],
				]
			) . '>';
			foreach ( $settings['elementive_tab'] as $item ) {

				echo '<li>';
				if ( 'yes' === $item['use_elementor_template'] ) {
					echo '<div class="tab-content-template">' . $frontend->get_builder_content_for_display( $item['elementor_template'], true ) . '</div>';
				} else {
					echo '<div ' . wp_kses( $this->get_render_attribute_string( 'elementive_tab_content' ), [ 'class' => [] ] ) . '>' . wp_kses_post( $item['tab_content'] ) . '</div>';
				}
				echo '</li>';
			}
			echo '</ul>';

			// End left or right modifier class for tab content.
			if ( 'uk-tab-left' === $settings['tab_bar_modifiers'] || 'uk-tab-right' === $settings['tab_bar_modifiers'] ) {
				echo '</div>';
			}
			// End left or right modifier grid class.
			if ( 'uk-tab-left' === $settings['tab_bar_modifiers'] || 'uk-tab-right' === $settings['tab_bar_modifiers'] ) {
				echo '</div>';
			}
		}
	}
}
