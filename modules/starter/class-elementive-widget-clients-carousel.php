<?php
/**
 * Clients Widget
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
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

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
class Elementive_Widget_Clients_Carousel extends Widget_Base {

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
		return 'elementive-clients-carousel';
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
		return __( 'Clients Carousel', 'elementive' );
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
			'client_logo',
			array(
				'label'   => __( 'Choose Image', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'client_name',
			array(
				'label'       => __( 'Title', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Client Name', 'elementive' ),
				'placeholder' => __( 'Type your client name here', 'elementive' ),
			)
		);

		$repeater->add_control(
			'client_link',
			array(
				'label'         => __( 'Link', 'elementive' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-client.com', 'elementive' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);

		$this->add_control(
			'clients',
			array(
				'label'       => __( 'Clients List', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(),
				'title_field' => '{{{ client_name }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Carousel', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'max_width',
			array(
				'label'           => __( 'Logo max width', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 600,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 120,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 120,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 120,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-clients-grid .elementive-client-grid-logo img' => 'max-width : {{SIZE}}{{UNIT}};',
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

		$this->add_control(
			'grayscale',
			array(
				'label'        => __( 'Crayscale', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'opacity',
			array(
				'label'      => __( 'Opacity', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'size' => 0.5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-clients-grid .elementive-client-grid-logo' => 'opacity : {{SIZE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'grayscale_hover',
			array(
				'label'        => __( 'Crayscale', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'opacity_hover',
			array(
				'label'      => __( 'Opacity', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-clients-grid .elementive-client-grid-logo:hover' => 'opacity : {{SIZE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
				'label'     => __( 'Border Style', 'elementive' ),
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

		$allowed_tags_link = array(
			'target' => array(),
			'rel'    => array(),
		);

		$allowed_html_wrapper = array(
			'class'   => array(),
			'uk-grid' => array(),
		);

		$wrapper_classes = array( 'elementive-clients-grid' );
		$wrapper_classes = array_map( 'esc_attr', $wrapper_classes );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class'           => esc_attr( join( ' ', $wrapper_classes ) ),
			)
		);

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

		if ( $settings['clients'] ) {
			?>
			<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_html_wrapper ); ?>>
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'carousel' ), array( 'class' => array() ) ); ?>>
					<div <?php echo wp_kses( $this->get_render_attribute_string( 'carousel_wrapper' ), array( 'class' => array() ) ); ?>>
						<?php
						foreach ( $settings['clients'] as $client ) {
							// Get Targets.
							$target   = $client['client_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $client['client_link']['nofollow'] ? ' rel="nofollow"' : '';

							?>
							<div class="swiper-slide uk-text-center">
								<div <?php echo wp_kses( $this->get_render_attribute_string( 'logo' ), $allowed_html_logo ); ?>>
								<?php
								if ( $client['client_link']['url'] ) {
									echo '<a href="' . esc_url( $item['client_link']['url'] ) . '"' . wp_kses( $target . $nofollow, $allowed_html_link ) . '>';
									echo wp_get_attachment_image( $client['client_logo']['id'], 'full' );
									echo '</a>';
								} else {
									echo wp_get_attachment_image( $client['client_logo']['id'], 'full' );
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
