<?php
/**
 * Pricing Widget
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
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Elementor pricing widget
 *
 * Elementor widget for Eelementive.
 *
 * @since 1.0.0
 */
class Elementive_Widget_Pricing extends Widget_Base {

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
		return 'elementive-pricing';
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
		return __( 'Pricing', 'elementive' );
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
			'use_image',
			array(
				'label'        => __( 'Use image', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'elementive' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'use_image!' => 'yes',
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => __( 'Choose Image', 'elementive' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'use_image' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image_size',
				'default'   => 'medium',
				'exclude'   => array( 'custom' ),
				'separator' => 'before',
				'default'   => 'full',
				'condition' => array(
					'use_image' => 'yes',
				),
			)
		);

		$this->add_control(
			'price',
			array(
				'label'   => __( 'Price', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '$35', 'elementive' ),
			)
		);

		$this->add_control(
			'price_description',
			array(
				'label'   => __( 'Price description', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '/mo', 'elementive' ),
			)
		);

		$this->add_control(
			'price_title',
			array(
				'label'   => __( 'Title', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Startup', 'elementive' ),
			)
		);

		$this->add_control(
			'price_sub_title',
			array(
				'label'   => __( 'Sub title', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'All the basics for starting a small website or blog.', 'elementive' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'feature_item',
			array(
				'label'       => __( 'Feature', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'List Title', 'elementive' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'features',
			array(
				'label'       => __( 'Feature list', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'feature_item' => __( '15 Projects & Tasks', 'elementive' ),
					),
					array(
						'feature_item' => __( '30GB Cloud Storage', 'elementive' ),
					),
				),
				'title_field' => '{{{ feature_item }}}',
			)
		);

		$this->add_control(
			'price_link',
			array(
				'label'         => __( 'Button', 'elementive' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'elementive' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);

		$this->add_control(
			'button_label',
			array(
				'label'   => __( 'Button Label', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Get Started', 'elementive' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			array(
				'label'   => __( 'Icon', 'elementive' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'pricing_icon_margin',
			array(
				'label'           => __( 'Margin', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'size_units'      => array( 'px', '%', 'em' ),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_icon_size',
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
					'icon[library]!' => 'svg',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'icon[library]' => 'svg',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-icon svg' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-icon svg' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'icon_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-icon',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_border',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'icon_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-icon',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'icon_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-icon',
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
					'{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-icon svg' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'icon_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-icon-hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'icon_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-icon',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'icon_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-icon',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_header',
			array(
				'label'   => __( 'Header', 'elementive' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'pricing_header_margin',
			array(
				'label'           => __( 'Margin', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'size_units'      => array( 'px', '%', 'em' ),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title typography', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-pricing .elementive-pricing-title h3',
			)
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			array(
				'label'      => __( 'Title margin bottom', 'elementive' ),
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
				'selectors'  => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-title h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => __( 'Sub title typography', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-pricing .elementive-pricing-title p',
			)
		);

		$this->add_responsive_control(
			'sub_title_margin_bottom',
			array(
				'label'      => __( 'Sub title margin bottom', 'elementive' ),
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
				'selectors'  => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-title p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'header_background',
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
			'pricing_header_padding',
			array(
				'label'           => __( 'Padding', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'size_units'      => array( 'px', '%', 'em' ),
				'condition' => array(
					'header_background' => 'yes',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_header_border',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'condition' => array(
					'header_background' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-header' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'style_tabs_header'
		);

		$this->start_controls_tab(
			'style_normal_tab_header',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-title h3' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'sub_title_color',
			array(
				'label'     => __( 'Sub title color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-title p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'header_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'header_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-header',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'header_border',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'header_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-header',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'header_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'header_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-header',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab_header',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'title_color_hover',
			array(
				'label'     => __( 'Title color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-title h3' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'sub_title_color_hover',
			array(
				'label'     => __( 'Sub title color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-title p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'header_background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'header_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-header-hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'header_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'header_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-header',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'header_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'header_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-header',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_price',
			array(
				'label'   => __( 'Price', 'elementive' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'pricing_price_margin',
			array(
				'label'           => __( 'Margin', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'size_units'      => array( 'px', '%', 'em' ),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'price_align',
			array(
				'label'     => __( 'Vertical align', 'elementive' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'uk-flex-top' => array(
						'title' => __( 'Top', 'elementive' ),
						'icon'  => 'eicon-v-align-top',
					),
					'uk-flex-middle' => array(
						'title' => __( 'Middle', 'elementive' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'uk-flex-bottom' => array(
						'title' => __( 'Bottom', 'elementive' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'   => 'uk-flex-bottom',
				'toggle'    => true,
			)
		);

		$this->add_control(
			'price_direction',
			array(
				'label'   => __( 'Direction', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'flex-row',
				'options' => array(
					'flex-row'    => __( 'Flex Row', 'elementive' ),
					'flex-row'    => __( 'Flex Row', 'elementive' ),
				),
			)
		);

		$this->add_control(
			'price_justify',
			array(
				'label'   => __( 'Justify content', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'flex-start',
				'options' => array(
					'flex-start'    => __( 'Flex Start', 'elementive' ),
					'flex-end'      => __( 'Flex End', 'elementive' ),
					'center'        => __( 'Center', 'elementive' ),
					'space-between' => __( 'Space Between', 'elementive' ),
					'space-around'  => __( 'Space Around', 'elementive' ),
					'space-evenly'  => __( 'Space', 'elementive' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'label'    => __( 'Price typography', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-pricing .elementive-pricing-price .price',
			)
		);

		$this->add_responsive_control(
			'price_margin_bottom',
			array(
				'label'      => __( 'Price margin bottom', 'elementive' ),
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
				'selectors'  => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-price .price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_description_typography',
				'label'    => __( 'Price description typography', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-pricing .elementive-pricing-price .price-description',
			)
		);

		$this->add_responsive_control(
			'price_description_margin_bottom',
			array(
				'label'      => __( 'Price description margin bottom', 'elementive' ),
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
				'selectors'  => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-price .price-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'price_background',
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
			'pricing_price_padding',
			array(
				'label'           => __( 'Padding', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'size_units'      => array( 'px', '%', 'em' ),
				'condition' => array(
					'price_background' => 'yes',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_price_border_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'condition' => array(
					'price_background' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-price' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'style_tabs_price'
		);

		$this->start_controls_tab(
			'style_normal_tab_price',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Price color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-price .price' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'price_description_color',
			array(
				'label'     => __( 'Price description color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-pricing .elementive-pricing-price .price-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'price_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'price_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-price',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'price_border',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'price_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-price',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'price_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'price_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-price',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab_price',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'price_color_hover',
			array(
				'label'     => __( 'Price color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-price .price' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'price_description_color_hover',
			array(
				'label'     => __( 'Price description color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-price .price-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'price_background_hover',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'condition' => array(
					'price_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing .elementive-pricing-price-hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'price_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'condition' => array(
					'price_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-price',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'price_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'condition' => array(
					'price_background' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .elementive-pricing:hover .elementive-pricing-price',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render_price( $settings ) {

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

		$target   = $settings['price_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['price_link']['nofollow'] ? ' rel="nofollow"' : '';

		// Wrapper Classes.
		$classes_wrapper = array( 'elementive-pricing', 'uk-inline-clip', 'uk-transition-toggle' );

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class'  => esc_attr( join( ' ', $classes_wrapper ) ),
				tabindex => 0,
			)
		);

		// Price Classes.
		$classes_price = array( 'uk-position-relative', 'uk-flex', $settings['price_align'], $settings['price_justify'] );

		$classes_price = array_map( 'esc_attr', $classes_price );

		$this->add_render_attribute(
			'price',
			array(
				'class'  => esc_attr( join( ' ', $classes_price ) ),
			)
		);

		?>
		<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?>>
			<?php
			if ( $settings['price_title'] || $settings['price_sub_title'] || $settings['icon']['value'] && $settings['image']['url'] ) {
				?>
				<div class="elementive-pricing-header uk-position-relative uk-width-1-1 uk-overflow-hidden">
					<div class="elementive-pricing-header-hover uk-transition-fade uk-position-cover"></div>
					<?php
					if ( $settings['icon']['value'] || $settings['image']['url'] ) {
						?>
						<div class="elementive-pricing-icon uk-overflow-hidden uk-position-relative uk-flex-inline">
							<?php
							if ( 'yes' === $settings['icon_background'] ) {
								?>
								<div class="elementive-pricing-icon-hover uk-transition-fade uk-position-cover"></div>	
								<div class="uk-position-center">
									<?php
									if ( 'yes' === $settings['use_image'] ) {
										echo wp_get_attachment_image( $settings['image']['id'], $settings['image_size_size'] );
									} else {
										Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
									}
									?>
								</div>
								<?php
							} else {
								if ( 'yes' === $settings['use_image'] ) {
									echo wp_get_attachment_image( $settings['image']['id'], $settings['image_size_size'] );
								} else {
									Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
								}
							}
							?>
						</div>
						<?php
					}

					if ( $settings['price_title'] || $settings['price_sub_title'] ) {
						?>
						<div class="elementive-pricing-title uk-position-relative">
							<?php
							if ( $settings['price_title'] ) {
								echo '<h3>' . esc_html( $settings['price_title'] ) . '</h3>';
							}
							if ( $settings['price_sub_title'] ) {
								echo '<p>' . esc_html( $settings['price_sub_title'] ) . '</p>';
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}

			if ( $settings['price'] || $settings['price_description'] ) {
				?>
				<div class="elementive-pricing-price uk-position-relative uk-overflow-hidden">
					<div class="elementive-pricing-price-hover uk-transition-fade uk-position-cover"></div>
					<div <?php echo wp_kses( $this->get_render_attribute_string( 'price' ), $allowed_attr_class ); ?>>
					<?php
					if ( $settings['price'] ) {
						echo '<span class="price">' . esc_html( $settings['price'] ) . '</span>';
					}
					if ( $settings['price_description'] ) {
						echo '<span class="price-description">' . esc_html( $settings['price_description'] ) . '</span>';
					}
					?>
					</div>
				</div>
				<?php
			}

			if ( $settings['features'] ) {
				?>
				<div class="elementive-pricing-content">
					<ul class="elementive-pricing-feature">
						<?php
						foreach ( $settings['features'] as $feature ) {
							?>
							<li class="elementive-pricing-feature"><?php echo esc_html( $feature['feature_item'] ); ?></li>
							<?php
						}
						?>
					</ul>
				</div>
				<?php
			}

			if ( $settings['price_link']['url'] && $settings['button_label'] ) {
				?>
				<div class="elementive-pricing-footer">
					<a href="<?php echo esc_url( $settings['price_link']['url'] ); ?>" <?php echo wp_kses( $target . $nofollow, $allowed_html_link ); ?>><?php echo esc_html( $settings['button_label'] ); ?></a>
				</div>
				<?php
			}
			?>

		</div>
		<?php
	}
}
