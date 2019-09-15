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
class Elementive_Widget_Accordion extends Widget_Base {

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
		return 'elementive-accordion';
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
		return __( 'Advanced Accordion', 'elementive' );
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
		return 'fas fa-bars';
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
	 * @since 1.1.0
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
			'accordion_title',
			array(
				'label'       => __( 'Title', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Accordion title', 'elementive' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'accordion_icon',
			array(
				'label'   => __( 'Icon', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => '',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'use_elementor_template',
			array(
				'label'        => __( 'Use Elementor template', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$repeater->add_control(
			'accordion_content',
			array(
				'label'      => __( 'Content', 'elementive' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'Accordion Content', 'elementive' ),
				'show_label' => false,
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'use_elementor_template',
							'operator' => '!in',
							'value'    => array(
								'yes',
							),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'elementor_template',
			array(
				'label'      => __( 'Elementor templates', 'elementive' ),
				'type'       => Controls_Manager::SELECT2,
				'multiple'   => false,
				'options'    => Elementive_Helpers::elementive_elementor_templates(),
				'default'    => '',
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'use_elementor_template',
							'operator' => 'in',
							'value'    => array(
								'yes',
							),
						),
					),
				),
			)
		);

		$this->add_control(
			'elementive_accordion',
			array(
				'label'       => __( 'Accordion items', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'accordion_title'   => __( 'Accordion title #1', 'elementive' ),
						'accordion_content' => __( 'Item content. Click the edit button to change this text.', 'elementive' ),
					),
					array(
						'accordion_title'   => __( 'Accordion title #2', 'elementive' ),
						'accordion_content' => __( 'Item content. Click the edit button to change this text.', 'elementive' ),
					),
				),
				'title_field' => '{{{ accordion_title }}}',
				'separator'   => 'before',
			)
		);

		$this->end_controls_section();

		// Start customize title section.
		$this->start_controls_section(
			'section_customize_title',
			array(
				'label' => __( 'Customize title', 'elementive' ),
			)
		);

		$this->add_control(
			'accordion_title_tag',
			array(
				'label'   => __( 'Title HTML Tag', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'default' => 'h3',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'accordion_title_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uk-accordion-title > *',
			)
		);

		$this->add_responsive_control(
			'accordion_icon_size',
			array(
				'label'           => __( 'Icon font size', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'       => array(
					'{{WRAPPER}} .uk-accordion-title i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'separator'       => 'before',
			)
		);

		$this->add_responsive_control(
			'accordion_icon_margin',
			array(
				'label'           => __( 'Icon margin right', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
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
				'selectors'       => array(
					'{{WRAPPER}} .uk-accordion-title i' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_title_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .uk-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		// Start tabs. Will use this tab for normal, hover, active state.
		$this->start_controls_tabs(
			'style_tabs'
		);

		// Start normal tab.
		$this->start_controls_tab(
			'style_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'accordion_title_color',
			array(
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .uk-accordion-title > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'accordion_title_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-accordion-title',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'accordion_title_border_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .uk-accordion-title' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'accordion_title_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .uk-accordion-title',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'accordion_title_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-accordion-title',
				'separator' => 'before',
			)
		);

		// End normal tab.
		$this->end_controls_tab();

		// Start hover tab.
		$this->start_controls_tab(
			'style_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'accordion_title_color_hover',
			array(
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .uk-accordion-title:hover > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'accordion_title_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-accordion-title:hover',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'accordion_title_border_radius_hover',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .uk-accordion-title:hover' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'accordion_title_background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .uk-accordion-title:hover',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'accordion_title_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-accordion-title:hover',
				'separator' => 'before',
			)
		);

		// End hover tab.
		$this->end_controls_tab();

		// Start active tab.
		$this->start_controls_tab(
			'style_active_tab',
			array(
				'label' => __( 'Active', 'elementive' ),
			)
		);

		$this->add_control(
			'accordion_title_color_active',
			array(
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .uk-accordion .uk-open .uk-accordion-title > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'accordion_title_border_active',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-accordion .uk-open .uk-accordion-title',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'accordion_title_border_radius_active',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .uk-accordion .uk-open .uk-accordion-title' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'accordion_title_background_active',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .uk-accordion .uk-open .uk-accordion-title',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'accordion_title_box_shadow_active',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-accordion .uk-open .uk-accordion-title',
				'separator' => 'before',
			)
		);

		// End active tab.
		$this->end_controls_tab();

		// End section customize title.
		$this->end_controls_section();

		// Start customize content section.
		$this->start_controls_section(
			'section_customize_content',
			array(
				'label' => __( 'Customize content', 'elementive' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'accordion_content_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'devices'  => array( 'desktop', 'tablet', 'mobile' ),
				'selector' => '{{WRAPPER}} .uk-accordion-content:not(.elementor-template)',
			)
		);

		$this->add_responsive_control(
			'accordion_content_margin_top',
			array(
				'label'           => __( 'Margin top', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 20,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .uk-accordion-content:not(.elementor-template)' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'separator'       => 'before',
			)
		);

		$this->add_responsive_control(
			'accordion_content_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .uk-accordion-content:not(.elementor-template)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_responsive_control(
			'accordion_content_border_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .uk-accordion-content:not(.elementor-template)' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-left-radius: {{BOTTOM}}{{UNIT}}; border-bottom-right-radius: {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'accordion_content_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-accordion-content:not(.elementor-template)',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'           => 'accordion_content_background',
				'label'          => __( 'Background', 'elementive' ),
				'types'          => array( 'classic', 'gradient' ),
				'selector'       => '{{WRAPPER}} .uk-accordion-content:not(.elementor-template)',
				'separator'      => 'before',
				'fields_options' => array(
					'color' => array(
						'scheme' => array(
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_4,
						),
					),
				),
			)
		);

		$this->add_control(
			'accordion_content_background_color_determine',
			array(
				'label'        => __( 'Determine background color', 'elementive' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'accordion_content_color',
			array(
				'label'      => __( 'Color', 'elementive' ),
				'type'       => Controls_Manager::COLOR,
				'scheme'     => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .uk-accordion-content:not(.elementor-template)' => 'color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'accordion_content_background_color_determine',
							'operator' => '!in',
							'value'    => array(
								'yes',
							),
						),
					),
				),
				'separator'  => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'accordion_content_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .uk-accordion-content:not(.elementor-template)',
				'separator' => 'before',
			)
		);

		// End section customize content.
		$this->end_controls_section();

		// Start customize accordion.
		$this->start_controls_section(
			'section_accordion_settings',
			array(
				'label' => __( 'Accordion settings', 'elementive' ),
			)
		);

		$this->add_control(
			'accordion_multiple',
			array(
				'label'        => __( 'Multiple open items', 'elementive' ),
				'description'  => __( 'Allow multiple open items.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => true,
				'default'      => false,
			)
		);

		$this->add_control(
			'accordion_collapsible',
			array(
				'label'        => __( 'No collapsing', 'elementive' ),
				'description'  => __( 'Allow all items to be closed.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => true,
				'default'      => false,
				'separator'    => 'before',
			)
		);

		$this->add_responsive_control(
			'accordion_item_spacing',
			array(
				'label'           => __( 'Items spacing', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 20,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .uk-accordion > :nth-child(n+2)' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'separator'       => 'before',
			)
		);

		$this->add_control(
			'accordion_hover_transition',
			array(
				'label'       => __( 'Transition duration in milliseconds', 'elementive' ),
				'description' => __( 'Hover & active transition duration time.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'size' => 300,
				),
				'selectors'   => array(
					'{{WRAPPER}} .uk-accordion-title'   => 'transition: color {{SIZE}}ms, background {{SIZE}}ms, border {{SIZE}}ms, border-radius {{SIZE}}ms;;',
					'{{WRAPPER}} .uk-accordion-content' => 'transition: color {{SIZE}}ms, background {{SIZE}}ms, border {{SIZE}}ms, border-radius {{SIZE}}ms;;',
				),
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'accordion_animation_duration',
			array(
				'label'       => __( 'Animation duration in milliseconds', 'elementive' ),
				'description' => __( 'Reveal item directly or with a transition.', 'elementive' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'     => array(
					'size' => 300,
				),
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'accordion_animation_transition',
			array(
				'label'       => __( 'Transition', 'elementive' ),
				'description' => __( 'The transition to use when revealing items.', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'ease',
				'options'     => array(
					'linear'      => __( 'linear', 'elementive' ),
					'ease'        => __( 'ease', 'elementive' ),
					'ease-in'     => __( 'ease-in', 'elementive' ),
					'ease-in-out' => __( 'ease-in-out', 'elementive' ),
					'ease-out'    => __( 'ease-out', 'elementive' ),
				),
			)
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
		$collapsable        = 'false';
		$multiple           = 'false';
		$icon               = '';
		$animation_duration = '';
		$content_background = '';
		$determine_class    = '';

		$allowed_html_accordion_ul = array(
			'uk-accordion' => array(),
			'class'        => array(),
		);

		$allowed_html_accordion_content = array(
			'class' => array(),
		);

		if ( $settings['accordion_collapsible'] ) {
			$collapsable = 'true';
		}

		if ( $settings['accordion_multiple'] ) {
			$multiple = 'true';
		}

		if ( $settings['accordion_animation_duration'] ) {
			$animation_duration = $settings['accordion_animation_duration'];
		} else {
			$animation_duration['size'] = 200;
		}

		// Check and the content background color is rgba. If color is rgba convert it to hex.
		if ( Elementive_Helpers::elementive_check_rgba( $settings['accordion_content_background_color'] ) ) {
			$content_background = Elementive_Helpers::elementive_convert_rgba_to_hex( $settings['accordion_content_background_color'] );
		} else {
			$content_background = $settings['accordion_content_background_color'];
		}

		// Content dark light class.
		if ( ! Elementive_Helpers::elementive_is_hex_light( $content_background ) && $settings['accordion_content_background_color'] && 'yes' === $settings['accordion_content_background_color_determine'] ) {
			$determine_class = 'uk-light';
		} else {
			$determine_class = 'uk-dark';
		}

		$this->add_inline_editing_attributes( 'accordion_content', 'basic' );
		$this->add_render_attribute(
			'elementive_accordion',
			array(
				'uk-accordion' => 'collapsible: ' . esc_attr( $collapsable ) . '; multiple: ' . esc_attr( $multiple ) . '; duration: ' . esc_attr( $animation_duration['size'] ) . '; transition: ' . esc_attr( $settings['accordion_animation_transition'] ) . ';',
				'class'        => 'uk-accordion',
			)
		);

		$this->add_render_attribute(
			'elementive_accordion_content',
			array(
				'class' => 'uk-accordion-content ' . esc_attr( $determine_class ),
			)
		);

		$frontend = new Frontend();

		if ( $settings['elementive_accordion'] ) {
			echo '<ul ' . wp_kses( $this->get_render_attribute_string( 'elementive_accordion' ), $allowed_html_accordion_ul ) . '>';
			foreach ( $settings['elementive_accordion'] as $item ) {
				$icon = $item['accordion_icon'];
				echo '<li id="' . esc_attr( $item['_id'] ) . '">';
				echo '<a class="uk-accordion-title" href="#">';
				echo '<' . esc_attr( $settings['accordion_title_tag'] ) . ' class="uk-flex uk-flex-middle uk-margin-remove">';
				if ( $icon['value'] ) {
					if ( 'svg' === $icon['library'] ) {
						echo '<span class="uk-icon">';
						Icons_Manager::render_icon(
							$item['accordion_icon'],
							array(
								'aria-hidden' => 'true',
							)
						);
						echo '</span>';
					} else {
						Icons_Manager::render_icon(
							$item['accordion_icon'],
							array(
								'aria-hidden' => 'true',
							)
						);
					}
				}
				echo esc_html( $item['accordion_title'] );
				echo '</' . esc_attr( $settings['accordion_title_tag'] ) . '>';
				echo '</a>';
				if ( 'yes' === $item['use_elementor_template'] ) {
					echo '<div class="uk-accordion-content elementor-template">' . $frontend->get_builder_content_for_display( $item['elementor_template'], true ) . '</div>';
				} else {
					echo '<div ' . wp_kses( $this->get_render_attribute_string( 'elementive_accordion_content' ), $allowed_html_accordion_content ) . '>' . wp_kses_post( $item['accordion_content'] ) . '</div>';
				}
				echo '</li>';
			}
			echo '</ul>';
		}
	}
}
