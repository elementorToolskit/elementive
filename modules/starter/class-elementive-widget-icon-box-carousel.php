<?php
/**
 * Icon Box Widget
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Elementive Icon box widget
 *
 * Elementor widget for Elementive.
 *
 * @since 1.0.0
 */
class Elementive_Widget_Icon_Box_Carousel extends Widget_Base {

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
		return 'elementive-icon-box-carousel';
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
		return __( 'Icon Box Carousel', 'elementive' );
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
			'icon',
			array(
				'label'   => __( 'Icon', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Default title', 'elementive' ),
				'placeholder' => __( 'Type your title here', 'elementive' ),
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'default'     => __( 'Default description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.​', 'elementive' ),
				'placeholder' => __( 'Type your description here', 'elementive' ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'         => __( 'Link', 'elementive' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'elementive' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);

		$repeater->add_control(
			'link_text',
			array(
				'label'   => __( 'Link text', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Learn more', 'elementive' ),
			)
		);

		$this->add_control(
			'icon_boxes',
			array(
				'label'       => __( 'Icon box list', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
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
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
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
				'default'    => 'center',
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
			'icon_font_size',
			array(
				'label'           => __( 'Icon font size', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px', '%' ),
				'range'           => array(
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
				'desktop_default' => array(
					'size' => 40,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 40,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 40,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_width',
			array(
				'label'           => __( 'SVG Icon width', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 40,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 40,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 40,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_color_reset',
			array(
				'label'        => __( 'Disable SVG color', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'icon_diameter',
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
			'icon_diameter_width',
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
					'size' => 50,
					'unit' => 'px',
				),
				'condition'       => array(
					'icon_diameter' => 'yes',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-diameter' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_radius',
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
					'icon_diameter' => 'yes',
				),
				'selectors'      => array(
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-diameter' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'icon_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
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
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-diameter' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_border',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'icon_diameter' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box .elementive-icon-diameter',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'icon_diameter' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box .elementive-icon-diameter',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'icon_diameter' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box .elementive-icon-diameter',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'icon_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}}  .elementive-icon-box:hover .elementive-icon-diameter' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'icon_diameter' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box:hover .elementive-icon-diameter',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'icon_diameter' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box:hover .elementive-icon-diameter .icon-background-hover',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'icon_diameter' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box:hover .elementive-icon-diameter',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_heading_style',
			array(
				'label' => __( 'Heading', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'tag',
			array(
				'label'   => __( 'Title tag', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => array(
					'h1'  => __( 'H1', 'elementive' ),
					'h2'  => __( 'H2', 'elementive' ),
					'h3'  => __( 'H3', 'elementive' ),
					'h4'  => __( 'H4', 'elementive' ),
					'h5'  => __( 'H5', 'elementive' ),
					'h6'  => __( 'H6', 'elementive' ),
				),
			)
		);

		$this->add_responsive_control(
			'heading_margin_bottom',
			array(
				'label'           => __( 'Margin bottom', 'elementive' ),
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
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-content .elementive-icon-box-heading',
			)
		);

		$this->start_controls_tabs(
			'heading_tabs'
		);

		$this->start_controls_tab(
			'heading_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-icon-box-content .elementive-icon-box-heading' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'heading_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'heading_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-icon-box:hover .elementive-icon-box-content .elementive-icon-box-heading' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			array(
				'label' => __( 'Description', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-content .elementive-icon-box-description',
			)
		);

		$this->start_controls_tabs(
			'description_tabs'
		);

		$this->start_controls_tab(
			'description_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_responsive_control(
			'description_margin_bottom',
			array(
				'label'           => __( 'Margin bottom', 'elementive' ),
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
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-icon-box-content .elementive-icon-box-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'description_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'description_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-icon-box:hover .elementive-icon-box-content .elementive-icon-box-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link_style',
			array(
				'label' => __( 'Link', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'link_typography',
				'label'    => __( 'Link typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-content .elementive-icon-box-link',
			)
		);

		$this->add_control(
			'link_background_enable',
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
			'link_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'condition'  => array(
					'link_background_enable' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'link_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'condition'  => array(
					'link_background_enable' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-link' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'link_tabs'
		);

		$this->start_controls_tab(
			'link_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'link_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-link' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'link_border',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'link_background_enable' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-link',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'link_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'link_background_enable' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-link',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'link_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'link_background_enable' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-link',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'link_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'link_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}}  .elementive-icon-box:hover .elementive-icon-box-link' => 'color: {{VALUE}} !important',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'link_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'link_background_enable' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box:hover .elementive-icon-box-link',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'link_background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'link_background_enable' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box:hover .elementive-icon-box-link',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'link_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'link_background_enable' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-icon-box:hover .elementive-icon-box-link',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_wrapper_style',
			array(
				'label' => __( 'Wrapper', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-icon-box' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-icon-box',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .elementive-icon-box',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'background_overlay',
			array(
				'label'        => __( 'Enable overlay', 'elementive' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'elementive' ),
				'label_off'    => __( 'Hide', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'conditions'   => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'terms' => array(
										array(
											'name'  => 'background_background',
											'value' => 'classic',
										),
										array(
											'name'     => 'background_image[url]',
											'operator' => '!=',
											'value'    => '',
										),
									),
								),
							),
						),
					),
				),

			)
		);

		$this->add_control(
			'overlay_background_title',
			array(
				'label'     => __( 'Overlay background', 'elementive' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'       => 'overlay_background',
				'label'      => __( 'overlay_background', 'elementive' ),
				'types'      => array( 'classic', 'gradient' ),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'terms' => array(
										array(
											'name'  => 'background_background',
											'value' => 'classic',
										),
										array(
											'name'     => 'background_image[url]',
											'operator' => '!=',
											'value'    => '',
										),
										array(
											'name'     => 'background_overlay',
											'operator' => '===',
											'value'    => 'yes',
										),
									),
								),
							),
						),
					),
				),
				'selector'   => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-overlay',
			)
		);

		$this->add_control(
			'overlay_background_blend',
			array(
				'label'      => __( 'Blend modes', 'elementive' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'elementive-blend-none',
				'options'    => array(
					'elementive-blend-none' => __( 'None', 'elementive' ),
					'uk-blend-multiply'     => __( 'Multiply', 'elementive' ),
					'uk-blend-screen'       => __( 'Screen', 'elementive' ),
					'uk-blend-overlay'      => __( 'Overlay', 'elementive' ),
					'uk-blend-darken'       => __( 'Darken', 'elementive' ),
					'uk-blend-lighten'      => __( 'Lighten', 'elementive' ),
					'uk-blend-color-dodge'  => __( 'Color dodge', 'elementive' ),
					'uk-blend-color-burn'   => __( 'Color burn', 'elementive' ),
					'uk-blend-hard-light'   => __( 'Hard light', 'elementive' ),
					'uk-blend-soft-light'   => __( 'Soft light', 'elementive' ),
					'uk-blend-difference'   => __( 'Difference', 'elementive' ),
					'uk-blend-exclusion'    => __( 'Exclusion', 'elementive' ),
					'uk-blend-hue'          => __( 'Hue', 'elementive' ),
					'uk-blend-saturation'   => __( 'Saturation', 'elementive' ),
					'uk-blend-color'        => __( 'Color', 'elementive' ),
					'uk-blend-luminosity'   => __( 'Luminosity', 'elementive' ),
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'terms' => array(
										array(
											'name'  => 'background_background',
											'value' => 'classic',
										),
										array(
											'name'     => 'background_image[url]',
											'operator' => '!=',
											'value'    => '',
										),
										array(
											'name'     => 'background_overlay',
											'operator' => '===',
											'value'    => 'yes',
										),
									),
								),
							),
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .elementive-icon-box',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'border_hover',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-icon-box:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-hover',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'background_overlay_hover',
			array(
				'label'        => __( 'Enable overlay', 'elementive' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'elementive' ),
				'label_off'    => __( 'Hide', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'conditions'   => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'terms' => array(
										array(
											'name'  => 'background_hover_background',
											'value' => 'classic',
										),
										array(
											'name'     => 'background_hover_image[url]',
											'operator' => '!=',
											'value'    => '',
										),
									),
								),
							),
						),
					),
				),

			)
		);

		$this->add_control(
			'overlay_background_hover_title',
			array(
				'label'     => __( 'Overlay background', 'elementive' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'       => 'overlay_background_hover',
				'label'      => __( 'overlay_background', 'elementive' ),
				'types'      => array( 'classic', 'gradient' ),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'terms' => array(
										array(
											'name'  => 'background_hover_background',
											'value' => 'classic',
										),
										array(
											'name'     => 'background_hover_image[url]',
											'operator' => '!=',
											'value'    => '',
										),
										array(
											'name'     => 'background_overlay_hover',
											'operator' => '===',
											'value'    => 'yes',
										),
									),
								),
							),
						),
					),
				),
				'selector'   => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-hover .elementive-icon-box-hover-overlay',
			)
		);

		$this->add_control(
			'overlay_background_blend_hover',
			array(
				'label'      => __( 'Blend modes', 'elementive' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'elementive-blend-none',
				'options'    => array(
					'elementive-blend-none' => __( 'None', 'elementive' ),
					'uk-blend-multiply'     => __( 'Multiply', 'elementive' ),
					'uk-blend-screen'       => __( 'Screen', 'elementive' ),
					'uk-blend-overlay'      => __( 'Overlay', 'elementive' ),
					'uk-blend-darken'       => __( 'Darken', 'elementive' ),
					'uk-blend-lighten'      => __( 'Lighten', 'elementive' ),
					'uk-blend-color-dodge'  => __( 'Color dodge', 'elementive' ),
					'uk-blend-color-burn'   => __( 'Color burn', 'elementive' ),
					'uk-blend-hard-light'   => __( 'Hard light', 'elementive' ),
					'uk-blend-soft-light'   => __( 'Soft light', 'elementive' ),
					'uk-blend-difference'   => __( 'Difference', 'elementive' ),
					'uk-blend-exclusion'    => __( 'Exclusion', 'elementive' ),
					'uk-blend-hue'          => __( 'Hue', 'elementive' ),
					'uk-blend-saturation'   => __( 'Saturation', 'elementive' ),
					'uk-blend-color'        => __( 'Color', 'elementive' ),
					'uk-blend-luminosity'   => __( 'Luminosity', 'elementive' ),
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'terms' => array(
										array(
											'name'  => 'background_hover_background',
											'value' => 'classic',
										),
										array(
											'name'     => 'background_hover_image[url]',
											'operator' => '!=',
											'value'    => '',
										),
										array(
											'name'     => 'background_overlay_hover',
											'operator' => '===',
											'value'    => 'yes',
										),
									),
								),
							),
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .elementive-icon-box:hover',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
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
						'max'  => 5,
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
					'size' => 20,
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

		$classes           = array( 'elementive-icon-box', 'uk-position-relative', 'uk-transition-toggle', 'uk-inline-clip', 'swiper-slide' );
		$classes_icon      = array( 'elementive-icon-box-icon', 'uk-position-relative', 'uk-position-z-index' );
		$classes_content   = array( 'elementive-icon-box-content', 'uk-position-relative', 'uk-position-z-index' );
		$allowed_html_link = array(
			'target' => array(),
			'rel'    => array(),
		);

		// Classes for wrapper.
		$classes[] = $settings['icon_position'];

		if ( 'icon-top' === $settings['icon_position'] ) {
			$classes[] = $settings['text_align'];
		}

		if ( 'icon-left' === $settings['icon_position'] || 'icon-right' === $settings['icon_position'] ) {
			$classes[]         = 'uk-flex';
			$classes_icon[]    = 'uk-width-auto';
			$classes_content[] = 'uk-flex-1 uk-width-expand';
		}

		if ( 'icon-right' === $settings['icon_position'] ) {
			$classes_content[] = 'uk-flex-first';
		}

		$classes         = array_map( 'esc_attr', $classes );
		$classes_icon    = array_map( 'esc_attr', $classes_icon );
		$classes_content = array_map( 'esc_attr', $classes_content );

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

		$this->add_render_attribute(
			'wrapper',
			array(
				'class'               => esc_attr( join( ' ', $classes ) ),
				'tabindex'            => '0',
			)
		);

		$this->add_render_attribute(
			'icon',
			array(
				'class' => esc_attr( join( ' ', $classes_icon ) ),
			)
		);

		$this->add_render_attribute(
			'content',
			array(
				'class' => esc_attr( join( ' ', $classes_content ) ),
			)
		);

		if ( $settings['icon_boxes'] ) {
			?>
			<div <?php echo wp_kses( $this->get_render_attribute_string( 'carousel' ), array( 'class' => array() ) ); ?>>
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'carousel_wrapper' ), array( 'class' => array() ) ); ?>>
				<?php
				foreach ( $settings['icon_boxes'] as $item ) {
					$class_output = '';
					$icon         = $item['icon'];
					$target       = $item['link']['is_external'] ? ' target="_blank"' : '';
					$nofollow     = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
					?>
					<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), array( 'class' => array() ) ); ?>>
						<div <?php echo wp_kses( $this->get_render_attribute_string( 'icon' ), array( 'class' => array() ) ); ?>>

							<div class="elementive-icon-diameter uk-position-relative uk-overflow-hidden
							<?php
							if ( 'svg' === $icon['library'] && 'yes' === $settings['icon_color_reset'] ) {
								$class_output .= ' uk-svg';
							}

							if ( 'svg' === $icon['library'] && 'yes' === $settings['icon_diameter'] ) {
								$class_output .= ' uk-flex-inline';
							}
							if ( 'svg' !== $icon['library'] && 'yes' === $settings['icon_diameter'] ) {
								$class_output .= ' uk-display-inline-block';
							}
							echo esc_attr( $class_output );
							?>
							">
								<div class="elementive-icon-wrapper uk-position-relative uk-position-z-index uk-align-center">
									<?php Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
								</div>
								<div class="icon-background-hover uk-position-cover uk-transition-fade"></div>
							</div>

						</div>
						<div <?php echo wp_kses( $this->get_render_attribute_string( 'content' ), array( 'class' => array() ) ); ?>>
							<?php
							if ( $item['title'] ) {
								echo '<' . esc_attr( $settings['tag'] ) . ' class="elementive-icon-box-heading">' . esc_html( $item['title'] ) . '</' . esc_attr( $settings['tag'] ) . '>';
							}
							?>
							<?php
							if ( $item['description'] ) {
								echo '<p class="elementive-icon-box-description uk-margin-remove-top">' . esc_html( $item['description'] ) . '</p>';
								if ( $item['link']['url'] && $item['link_text'] ) {
									echo '<a class="uk-link-reset elementive-icon-box-link" href="' . esc_url( $item['link']['url'] ) . '" ' . wp_kses( $target . $nofollow, $allowed_html_link ) . '>' . esc_html( $item['link_text'] ) . '</a>';
								} // End link and link_text exists.
							} // End Description exists.
							?>
						</div>
						<?php
						// Overlay.
						if ( 'yes' === $settings['background_overlay'] && 'classic' === $settings['background_background'] && '' !== $settings['background_image']['url'] ) {
							echo '<div class="elementive-icon-box-overlay uk-position-cover ' . esc_attr( $settings['overlay_background_blend'] ) . '"></div>';
						}
						?>
						<div class="elementive-icon-box-hover uk-position-cover uk-transition-fade">
							<?php
							// Overlay.
							if ( 'yes' === $settings['background_overlay_hover'] && 'classic' === $settings['background_hover_background'] && '' !== $settings['background_hover_image']['url'] ) {
								echo '<div class="elementive-icon-box-hover-overlay uk-position-cover ' . esc_attr( $settings['overlay_background_blend_hover'] ) . '"></div>';
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
				?>
				<?php
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
			<?php
		}
	}
}
