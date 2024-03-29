<?php
/**
 * Team Member Widget for Elementive
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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Text_Shadow;

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
class Elementive_Widget_Team_Member extends Widget_Base {






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
		return 'elementive-team-member';
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
		return __( 'Elementive Team Member', 'elementive' );
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
		return array( 'uikit', 'jquery-tilt' );
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
			'image',
			array(
				'label'   => __( 'Choose image', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'second_image',
			array(
				'label'        => __( 'Second image', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'image_second',
			array(
				'label'     => __( 'Choose second image', 'elementive' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url'   => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'second_image' => 'yes',
				),
			)
		);

		$this->add_control(
			'name',
			array(
				'label' => __( 'Name', 'elementive' ),
				'type'  => Controls_Manager::TEXT,
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
			'description',
			array(
				'label'       => __( 'Description', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'default'     => '',
				'placeholder' => __( 'Type your description here', 'elementive' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
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
			'social_url',
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

		$this->add_control(
			'social',
			array(
				'label'       => __( 'Social Icons', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(),
				'title_field' => __( 'Social icon', 'elementive' ),
				'separator'   => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Image', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'image_kenburns',
			array(
				'label'        => __( 'Kenburs effect', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'image_full',
			array(
				'label'        => __( 'Fullwidth image', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'image_second_transition',
			array(
				'label'     => __( 'Second image transition', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'uk-transition-fade',
				'options'   => array(
					'uk-transition-fade'                => __( 'Fade', 'elementive' ),
					'uk-transition-scale-up'            => __( 'Scale up', 'elementive' ),
					'uk-transition-scale-down'          => __( 'Scale down', 'elementive' ),
					'uk-transition-slide-top'           => __( 'Slide top', 'elementive' ),
					'uk-transition-slide-bottom'        => __( 'Slide bottom', 'elementive' ),
					'uk-transition-slide-left'          => __( 'Slide left', 'elementive' ),
					'uk-transition-slide-right'         => __( 'Slide right', 'elementive' ),
					'uk-transition-slide-top-small'     => __( 'Slide top small', 'elementive' ),
					'uk-transition-slide-bottom-small'  => __( 'Slide bottom small', 'elementive' ),
					'uk-transition-slide-left-small'    => __( 'Slide left small', 'elementive' ),
					'uk-transition-slide-right-small'   => __( 'Slide right small', 'elementive' ),
					'uk-transition-slide-top-medium'    => __( 'Slide top medium', 'elementive' ),
					'uk-transition-slide-bottom-medium' => __( 'Slide bottom medium', 'elementive' ),
					'uk-transition-slide-left-medium'   => __( 'Slide left medium', 'elementive' ),
					'uk-transition-slide-right-medium'  => __( 'Slide right medium', 'elementive' ),
				),
				'condition' => array(
					'image_content_transition' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image_size',
				'default'   => 'full',
				'exclude'   => array( 'custom' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'     => __( 'Alignment', 'elementive' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'uk-text-left',
				'toggle'    => true,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'           => __( 'Margin bottom', 'elementive' ),
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
				'selectors'       => array(
					'{{WRAPPER}} .elementive-member-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-member-image' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->start_controls_tabs(
			'style_image_tabs'
		);

		$this->start_controls_tab(
			'style_image_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .elementive-member-image',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .elementive-member-image',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_image_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .elementive-team-member:hover .elementive-member-image',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_box_shadow_hover',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .elementive-team-member:hover .elementive-member-image',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content_name',
			array(
				'label' => __( 'Name', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_name_margin',
			array(
				'label'           => __( 'Margin', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'      => array( 'px', '%', 'em' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'default'         => array(
					'isLinked' => false,
				),
				'selectors'       => array(
					'{{WRAPPER}} h3.team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_name_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} h3.team-member-name',
			)
		);

		$this->start_controls_tabs(
			'content_name_tabs'
		);

		$this->start_controls_tab(
			'content_name_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'content_name_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-team-member h3.team-member-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'content_name_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} h3.team-member-name',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_name_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'content_name_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-team-member:hover h3.team-member-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'content_name_shadow_hover',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-team-member:hover h3.team-member-name',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content_title',
			array(
				'label' => __( 'Title', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_title_margin',
			array(
				'label'           => __( 'Margin', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'      => array( 'px', '%', 'em' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'       => array(
					'{{WRAPPER}} span.team-member-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_title_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} span.team-member-title',
			)
		);

		$this->start_controls_tabs(
			'content_title_tabs'
		);

		$this->start_controls_tab(
			'content_title_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'content_title_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-team-member span.team-member-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'content_title_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} span.team-member-title',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_title_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'content_title_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-team-member:hover span.team-member-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'content_title_shadow_hover',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-team-member:hover span.team-member-title',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content_description',
			array(
				'label' => __( 'Description', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_description_margin',
			array(
				'label'           => __( 'Margin', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'      => array( 'px', '%', 'em' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'default'         => array(
					'isLinked' => false,
				),
				'selectors'       => array(
					'{{WRAPPER}} p.team-member-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_description_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} p.team-member-description',
			)
		);

		$this->start_controls_tabs(
			'content_description_tabs'
		);

		$this->start_controls_tab(
			'content_description_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'content_description_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-team-member p.team-member-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'content_description_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} p.team-member-description',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_description_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'content_description_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-team-member:hover p.team-member-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'content_description_shadow_hover',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-team-member:hover p.team-member-description',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content_social',
			array(
				'label' => __( 'Social Icons', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_social_margin',
			array(
				'label'           => __( 'Margin', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'      => array( 'px', '%', 'em' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'default'         => array(
					'top'      => 20,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'       => array(
					'{{WRAPPER}} ul.team-member-social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_font_size',
			array(
				'label'           => __( 'Font size', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px', '%' ),
				'range'           => array(
					'px' => array(
						'min'  => 10,
						'max'  => 30,
						'step' => 1,
					),
					'%' => array(
						'min' => 40,
						'max' => 100,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'       => array(
					'{{WRAPPER}} ul.team-member-social li a i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_font_diameter',
			array(
				'label'           => __( 'Diameter', 'elementive' ),
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
					'{{WRAPPER}} .elementive-team-member ul.team-member-social li a i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_font_radius',
			array(
				'label'           => __( 'Border radius', 'elementive' ),
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
					'{{WRAPPER}} .elementive-team-member ul.team-member-social li a' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_margin',
			array(
				'label'           => __( 'Icon margin', 'elementive' ),
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
					'{{WRAPPER}} .elementive-team-member ul.team-member-social li' => 'margin: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'content_social_tabs'
		);

		$this->start_controls_tab(
			'content_social_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'content_social_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-team-member ul.team-member-social li a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_social_background',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .elementive-team-member ul.team-member-social li a',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_social_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'content_social_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-team-member ul.team-member-social li a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_social_background_hover',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .elementive-team-member ul.team-member-social li a:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content_inside',
			array(
				'label' => __( 'Content image', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'image_content',
			array(
				'label'        => __( 'Pull content', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'image_content_name',
			array(
				'label'        => __( 'Pull name', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'image_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_content_title',
			array(
				'label'        => __( 'Pull title', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'image_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_content_description',
			array(
				'label'        => __( 'Pull description', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'image_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_content_social',
			array(
				'label'        => __( 'Pull social', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'image_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_content_transition',
			array(
				'label'        => __( 'Enable transition', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'image_content_transition_value',
			array(
				'label'     => __( 'Hover transition', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'uk-transition-fade',
				'options'   => array(
					'uk-transition-fade'                => __( 'Fade', 'elementive' ),
					'uk-transition-scale-up'            => __( 'Scale up', 'elementive' ),
					'uk-transition-scale-down'          => __( 'Scale down', 'elementive' ),
					'uk-transition-slide-top'           => __( 'Slide top', 'elementive' ),
					'uk-transition-slide-bottom'        => __( 'Slide bottom', 'elementive' ),
					'uk-transition-slide-left'          => __( 'Slide left', 'elementive' ),
					'uk-transition-slide-right'         => __( 'Slide right', 'elementive' ),
					'uk-transition-slide-top-small'     => __( 'Slide top small', 'elementive' ),
					'uk-transition-slide-bottom-small'  => __( 'Slide bottom small', 'elementive' ),
					'uk-transition-slide-left-small'    => __( 'Slide left small', 'elementive' ),
					'uk-transition-slide-right-small'   => __( 'Slide right small', 'elementive' ),
					'uk-transition-slide-top-medium'    => __( 'Slide top medium', 'elementive' ),
					'uk-transition-slide-bottom-medium' => __( 'Slide bottom medium', 'elementive' ),
					'uk-transition-slide-left-medium'   => __( 'Slide left medium', 'elementive' ),
					'uk-transition-slide-right-medium'  => __( 'Slide right medium', 'elementive' ),
				),
				'condition' => array(
					'image_content_transition' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_content_position',
			array(
				'label'     => __( 'Content position', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'uk-position-cover',
				'options'   => array(
					'uk-position-cover'         => __( 'Cover', 'elementive' ),
					'uk-position-top'           => __( 'Top', 'elementive' ),
					'uk-position-left'          => __( 'Left', 'elementive' ),
					'uk-position-right'         => __( 'Right', 'elementive' ),
					'uk-position-bottom'        => __( 'Bottom', 'elementive' ),
					'uk-position-top-left'      => __( 'Top left', 'elementive' ),
					'uk-position-top-center'    => __( 'Top center', 'elementive' ),
					'uk-position-top-right'     => __( 'Top right', 'elementive' ),
					'uk-position-center'        => __( 'Center', 'elementive' ),
					'uk-position-center-left'   => __( 'Center left', 'elementive' ),
					'uk-position-center-right'  => __( 'Center right', 'elementive' ),
					'uk-position-bottom-left'   => __( 'Bottom left', 'elementive' ),
					'uk-position-bottom-center' => __( 'Bottom center', 'elementive' ),
					'uk-position-bottom-right'  => __( 'Bottom right', 'elementive' ),
				),
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'image_content_width',
			array(
				'label'           => __( 'Width', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( '%', 'px' ),
				'range'           => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 100,
					'unit' => '%',
				),
				'tablet_default'  => array(
					'size' => 100,
					'unit' => '%',
				),
				'mobile_default'  => array(
					'size' => 100,
					'unit' => '%',
				),
				'condition'       => array(
					'image_content_position!' => 'uk-position-cover',
				),
				'selectors'       => array(
					'{{WRAPPER}} .member-image-content' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_content_align',
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
				'condition' => array(
					'image_content_position' => 'uk-position-cover',
				),
				'default'   => 'uk-flex-bottom',
				'toggle'    => true,
				'condition' => array(
					'image_content_position' => 'uk-position-cover',
				),
			)
		);

		$this->add_responsive_control(
			'content_in_padding',
			array(
				'label'           => __( 'Padding', 'elementive' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'      => array( 'px', '%', 'em' ),
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
					'{{WRAPPER}} .member-image-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'       => 'before',
			)
		);

		$this->add_control(
			'content_in_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .member-image-content' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_in_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .member-image-content',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'content_in_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .member-image-content',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'content_in_box_shadow',
				'label'     => __( 'Box Shadow', 'elementive' ),
				'selector'  => '{{WRAPPER}} .member-image-content',
				'separator' => 'before',
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

		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-member-content' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'style_content_tabs'
		);

		$this->start_controls_tab(
			'style_content_normal_tab',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .elementive-member-content',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .elementive-member-content',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_content_hover_tab',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background_hover',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .team-member-content-background-hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border_hover',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .elementive-team-member:hover .elementive-member-content',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			array(
				'label' => __( 'Tilt', 'elementive' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'tilt',
			array(
				'label'        => __( 'Enable tilt effect', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'separator'    => 'after',
			)
		);

		$this->add_control(
			'tilt_max',
			array(
				'label'          => __( 'Max tilt', 'elementive' ),
				'description'    => __( 'Maximum tilt effect value', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'        => array(
					'unit' => 'px',
					'size' => 20,
				),
			)
		);

		$this->add_control(
			'tilt_perspective',
			array(
				'label'          => __( 'Perspective', 'elementive' ),
				'description'    => __( 'Transform perspective, the lower the more extreme the tilt gets.', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 100,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'        => array(
					'unit' => 'px',
					'size' => 1000,
				),
			)
		);

		$this->add_control(
			'tilt_scale',
			array(
				'label'          => __( 'Scale', 'elementive' ),
				'description'    => __( '1 = 100%, 1.5 = 150%, etc ...', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 0.5,
						'max'  => 1.5,
						'step' => 0.1,
					),
				),
				'default'        => array(
					'unit' => 'px',
					'size' => 1,
				),
			)
		);

		$this->add_control(
			'tilt_parallax',
			array(
				'label'        => __( 'Parallax effect', 'elementive' ),
				'description'  => __( 'Add parallax effect with inner elements that have to pop out.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'tilt_transition',
			array(
				'label'        => __( 'Transition', 'elementive' ),
				'description'  => __( 'Set a transition on enter/exit.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'tilt_speed',
			array(
				'label'          => __( 'Speed', 'elementive' ),
				'description'    => __( 'Speed of the enter/exit transition.', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 10,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'        => array(
					'unit' => 'px',
					'size' => 300,
				),
				'condition'      => array(
					'tilt_transition' => 'yes',
				),
			)
		);

		$this->add_control(
			'tilt_axis',
			array(
				'label'       => __( 'Disable axis', 'elementive' ),
				'description' => __( 'What axis should be disabled. Can be X or Y.', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'null',
				'options'     => array(
					'null' => __( 'None', 'elementive' ),
					'x'    => __( 'X', 'elementive' ),
					'y'    => __( 'Y', 'elementive' ),
				),
			)
		);

		$this->add_control(
			'tilt_reset',
			array(
				'label'        => __( 'Reset', 'elementive' ),
				'description'  => __( 'If the tilt effect has to be reset on exit.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'tilt_glare',
			array(
				'label'        => __( 'Glare', 'elementive' ),
				'description'  => __( 'Enables glare effect.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'tilt_glare_value',
			array(
				'label'          => __( 'Max glare', 'elementive' ),
				'description'    => __( 'Maximum galre effect value. From 0 - 1.', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'        => array(
					'unit' => 'px',
					'size' => 1,
				),
				'condition'      => array(
					'tilt_glare' => 'yes',
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

		// Allowed Tags.
		$allowed_attr_class = array(
			'class' => array(),
		);

		// Allowed Tags.
		$allowed_attr_link = array(
			'rel'    => array(),
			'target' => array(),
		);

		// Wrapper Classes.
		$classes_wrapper = array( 'elementive-team-member' );

		$classes_wrapper[] = esc_attr( $settings['alignment'] );
		$classes_wrapper[] = 'uk-transition-toggle';
		$classes_wrapper[] = 'uk-animation-toggle';

		if ( 'yes' === $settings['tilt'] ) {
			$classes_wrapper[] = 'run-tilt-js';
		}

		if ( 'yes' === $settings['tilt_parallax'] ) {
			$classes_wrapper[] = 'tilt-parallax';
		}

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$tilt_transition       = 'false';
		$tilt_transition_speed = '300';
		$tilt_reset            = 'false';
		$tilt_glare            = 'false';
		$tilt_glare_value      = '1';

		// Tilt effect attrs.
		if ( 'yes' === $settings['tilt_transition'] ) {
			$tilt_transition       = 'true';
			$tilt_transition_speed = $settings['tilt_speed']['size'];
		}

		if ( 'yes' === $settings['tilt_reset'] ) {
			$tilt_reset = 'true';
		}

		$this->add_render_attribute(
			'wrapper',
			array(
				'class'                 => esc_attr( join( ' ', $classes_wrapper ) ),
				'data-tilt-maxTilt'     => esc_attr( $settings['tilt_max']['size'] ),
				'data-tilt-perspective' => esc_attr( $settings['tilt_perspective']['size'] ),
				'data-tilt-scale'       => esc_attr( $settings['tilt_scale']['size'] ),
				'data-tilt-transition'  => esc_attr( $tilt_transition ),
				'data-tilt-speed'       => esc_attr( $tilt_transition_speed ),
				'data-tilt-disableAxis' => esc_attr( $settings['tilt_axis'] ),
				'data-tilt-transition'  => esc_attr( $tilt_reset ),
				'data-tilt-transition'  => esc_attr( $tilt_glare ),
				'data-tilt-maxGlare'    => esc_attr( $tilt_glare_value ),
			)
		);

		// Member Image Classes.
		$classes_image = array( 'elementive-member-image' );

		if ( 'yes' === $settings['image_content'] && ( 'yes' === $settings['image_content_name'] || 'yes' === $settings['image_content_title'] || 'yes' === $settings['image_content_description'] || 'yes' === $settings['image_content_social'] ) ) {
			$classes_image[] = 'uk-position-relative';
		}

		if ( 'yes' === $settings['image_full'] ) {
			$classes_image[] = 'uk-width-1-1';
			$classes_image[] = 'team-member-image-full';
		}

		$classes_image[] = '';
		$classes_image[] = 'uk-inline-clip';

		$classes_image = array_map( 'esc_attr', $classes_image );

		$this->add_render_attribute(
			'image',
			array(
				'class' => esc_attr( join( ' ', $classes_image ) ),
			)
		);

		// Member Image Tag Classes.
		$classes_image_tag = array( 'team-member-image' );

		if ( 'yes' === $settings['image_kenburns'] ) {
			$classes_image_tag[] = 'uk-transition-scale-up';
			$classes_image_tag[] = 'uk-transition-opaque';
		}

		$classes_image_tag = array_map( 'esc_attr', $classes_image_tag );

		// Member Image Second Tag Classes.
		$classes_image_tag_second = array( 'team-member-image-second', 'uk-position-cover', 'uk-transition-scale-up', $settings['image_second_transition'] );

		$classes_image_tag_second = array_map( 'esc_attr', $classes_image_tag_second );

		// Image content.
		$classes_image_content = array( 'member-image-content', 'uk-position-z-index', 'uk-flex', 'uk-width-1-1', 'uk-flex-row' );

		$classes_image_content[] = esc_attr( $settings['image_content_position'] );

		if ( 'uk-position-cover' === $settings['image_content_position'] ) {
			$classes_image_content[] = esc_attr( $settings['image_content_align'] );
		}

		if ( 'yes' === $settings['image_content_transition'] ) {
			$classes_image_content[] = esc_attr( $settings['image_content_transition_value'] );
		}

		$classes_image_content = array_map( 'esc_attr', $classes_image_content );

		$this->add_render_attribute(
			'image_content',
			array(
				'class' => esc_attr( join( ' ', $classes_image_content ) ),
			)
		);

		// Member Content Classes.
		$classes_content = array( 'elementive-member-content', 'uk-inline-clip' );

		$classes_content = array_map( 'esc_attr', $classes_content );

		$this->add_render_attribute(
			'content',
			array(
				'class' => esc_attr( join( ' ', $classes_content ) ),
			)
		);

		?>
		<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?>>
			<div <?php echo wp_kses( $this->get_render_attribute_string( 'image' ), $allowed_attr_class ); ?> tabindex="0">
				<div class="uk-position-relative">
					<?php echo wp_get_attachment_image( $settings['image']['id'], $settings['image_size_size'], '', array( 'class' => esc_attr( join( ' ', $classes_image_tag ) ) ) ); ?>
					<?php echo wp_get_attachment_image( $settings['image_second']['id'], $settings['image_size_size'], '', array( 'class' => esc_attr( join( ' ', $classes_image_tag_second ) ) ) ); ?>
					<?php
					if ( ( 'yes' === $settings['image_content'] && ( 'yes' === $settings['image_content_name'] || 'yes' === $settings['image_content_title'] || 'yes' === $settings['image_content_description'] || 'yes' === $settings['image_content_social'] ) ) && ( $settings['name'] || $settings['title'] || $settings['description'] || $settings['social'] ) ) {
						?>
						<div <?php echo wp_kses( $this->get_render_attribute_string( 'image_content' ), $allowed_attr_class ); ?>>
							<div class="image-content-wrapper uk-width-1-1">
							<?php
							if ( 'yes' === $settings['image_content_name'] && $settings['name'] ) {
								?>
								<h3 class="team-member-name"><?php echo esc_attr( $settings['name'] ); ?></h3>
								<?php
							}
							if ( 'yes' === $settings['image_content_title'] && $settings['title'] ) {
								?>
								<span class="team-member-title uk-display-block"><?php echo esc_attr( $settings['title'] ); ?></span>
								<?php
							}
							if ( 'yes' === $settings['image_content_description'] && $settings['description'] ) {
								?>
								<p class="team-member-description"><?php echo esc_attr( $settings['description'] ); ?></p>
								<?php
							}
							if ( 'yes' === $settings['image_content_social'] && $settings['social'] ) {
								?>
								<ul class="team-member-social">
								<?php
								foreach ( $settings['social'] as $social ) {
									$target   = $social['social_url']['is_external'] ? ' target="_blank"' : '';
									$nofollow = $social['social_url']['nofollow'] ? ' rel="nofollow"' : '';
									?>
									<li>
										<a href="<?php echo esc_url( $social['social_url']['url'] ); ?>" <?php echo wp_kses( $target . $nofollow, $allowed_attr_link ); ?>>
											<?php Icons_Manager::render_icon( $social['social_icon'], array( 'aria-hidden' => 'true' ) ); ?>
										</a>
									</li>
									<?php
								}
								?>
								</ul>
								<?php
							}
							?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
			if ( ( 'yes' !== $settings['image_content'] && ( 'yes' !== $settings['image_content_name'] || 'yes' !== $settings['image_content_title'] || 'yes' !== $settings['image_content_description'] || 'yes' !== $settings['image_content_social'] ) ) && ( $settings['name'] || $settings['title'] || $settings['description'] || $settings['social'] ) ) {
				?>
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'content' ), $allowed_attr_class ); ?>>
					<div class="uk-position-z-index uk-position-relative">
					<?php
					if ( $settings['name'] && ( 'yes' !== $settings['image_content'] || ( 'yes' === $settings['image_content'] && 'yes' !== $settings['image_content_name'] ) ) ) {
						?>
						<h3 class="team-member-name"><?php echo esc_attr( $settings['name'] ); ?></h3>
						<?php
					}
					if ( $settings['title'] && ( 'yes' !== $settings['image_content'] || ( 'yes' === $settings['image_content'] && 'yes' !== $settings['image_content_title'] ) ) ) {
						?>
						<span class="team-member-title uk-display-block"><?php echo esc_attr( $settings['title'] ); ?></span>
						<?php
					}
					if ( $settings['description'] && ( 'yes' !== $settings['image_content'] || ( 'yes' === $settings['image_content'] && 'yes' !== $settings['image_content_description'] ) ) ) {
						?>
						<p class="team-member-description"><?php echo esc_attr( $settings['description'] ); ?></p>
						<?php
					}
					if ( 'yes' !== $settings['image_content'] || ( 'yes' === $settings['image_content'] && 'yes' !== $settings['image_content_social'] ) ) {
						if ( $settings['social'] ) {
							?>
							<ul class="team-member-social">
							<?php
							foreach ( $settings['social'] as $social ) {
								$target   = $social['social_url']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $social['social_url']['nofollow'] ? ' rel="nofollow"' : '';
								?>
								<li>
									<a href="<?php echo esc_url( $social['social_url']['url'] ); ?>" <?php echo wp_kses( $target . $nofollow, $allowed_attr_link ); ?>>
										<?php Icons_Manager::render_icon( $social['social_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									</a>
								</li>
								<?php
							}
							?>
							</ul>
							<?php
						}
					}
					?>
					</div>
					<div class="team-member-content-background-hover uk-position-cover uk-transition-fade"></div>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}

