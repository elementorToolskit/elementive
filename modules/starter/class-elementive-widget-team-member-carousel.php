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
class Elementive_Widget_Team_Member_Carousel extends Widget_Base {






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
		return 'elementive-team-member-carousel';
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
		return __( 'Team Member Carousel', 'elementive' );
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
				'label'   => __( 'Choose image', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
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

		$repeater->add_control(
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
			'description',
			array(
				'label'       => __( 'Description', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'default'     => '',
				'placeholder' => __( 'Type your description here', 'elementive' ),
			)
		);

		$repeater->add_control(
			'social_icon_1',
			array(
				'label'   => __( 'Social icon 1', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-globe',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'social_url_1',
			array(
				'label'         => __( 'Social link 1', 'elementive' ),
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
			'social_icon_2',
			array(
				'label'   => __( 'Social icon 1', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-globe',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'social_url_2',
			array(
				'label'         => __( 'Social link 2', 'elementive' ),
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
			'social_icon_3',
			array(
				'label'   => __( 'Social icon 3', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-globe',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'social_url_3',
			array(
				'label'         => __( 'Social link 3', 'elementive' ),
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
			'social_icon_4',
			array(
				'label'   => __( 'Social icon 4', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-globe',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'social_url_4',
			array(
				'label'         => __( 'Social link 4', 'elementive' ),
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
			'team_member',
			array(
				'label'       => __( 'Team member', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(),
				'title_field' => '{{{ name }}}',
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
				'default'   => 'medium',
				'exclude'   => array( 'custom' ),
				'separator' => 'before',
				'default'   => 'full',
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

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class' => esc_attr( join( ' ', $classes_wrapper ) ),
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

		if ( $settings['team_member'] ) {
			?>
			<div class="elementive-testimonials-carousel">
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'carousel' ), array( 'class' => array() ) ); ?>>
					<div <?php echo wp_kses( $this->get_render_attribute_string( 'carousel_wrapper' ), array( 'class' => array() ) ); ?>>
					<?php
					foreach ( $settings['team_member'] as $team ) {
						$target_1   = $team['social_url_1']['is_external'] ? ' target="_blank"' : '';
						$nofollow_1 = $team['social_url_1']['nofollow'] ? ' rel="nofollow"' : '';
						$target_2   = $team['social_url_2']['is_external'] ? ' target="_blank"' : '';
						$nofollow_2 = $team['social_url_2']['nofollow'] ? ' rel="nofollow"' : '';
						$target_3   = $team['social_url_3']['is_external'] ? ' target="_blank"' : '';
						$nofollow_3 = $team['social_url_3']['nofollow'] ? ' rel="nofollow"' : '';
						$target_4   = $team['social_url_4']['is_external'] ? ' target="_blank"' : '';
						$nofollow_4 = $team['social_url_4']['nofollow'] ? ' rel="nofollow"' : '';
						?>
						<div class="swiper-slide">
							<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?>>
								<div <?php echo wp_kses( $this->get_render_attribute_string( 'image' ), $allowed_attr_class ); ?> tabindex="0">
									<div class="uk-position-relative">
										<?php echo wp_get_attachment_image( $team['image']['id'], $settings['image_size_size'], '', array( 'class' => esc_attr( join( ' ', $classes_image_tag ) ) ) ); ?>
										<?php echo wp_get_attachment_image( $team['image_second']['id'], $settings['image_size_size'], '', array( 'class' => esc_attr( join( ' ', $classes_image_tag_second ) ) ) ); ?>
										<?php
										if ( ( 'yes' === $settings['image_content'] && ( 'yes' === $settings['image_content_name'] || 'yes' === $settings['image_content_title'] || 'yes' === $settings['image_content_description'] || 'yes' === $settings['image_content_social'] ) ) && ( $team['name'] || $team['title'] || $team['description'] || ( $team['social_url_1']['url'] || $team['social_url_2']['url'] || $team['social_url_3']['url'] || $team['social_url_4']['url'] ) ) ) {
											?>
											<div <?php echo wp_kses( $this->get_render_attribute_string( 'image_content' ), $allowed_attr_class ); ?>>
												<div class="image-content-wrapper uk-width-1-1">
												<?php
												if ( 'yes' === $settings['image_content_name'] && $team['name'] ) {
													?>
													<h3 class="team-member-name"><?php echo esc_attr( $team['name'] ); ?></h3>
													<?php
												}
												if ( 'yes' === $settings['image_content_title'] && $team['title'] ) {
													?>
													<span class="team-member-title uk-display-block"><?php echo esc_attr( $team['title'] ); ?></span>
													<?php
												}
												if ( 'yes' === $settings['image_content_description'] && $team['description'] ) {
													?>
													<p class="team-member-description"><?php echo esc_attr( $team['description'] ); ?></p>
													<?php
												}
												if ( 'yes' === $settings['image_content_social'] && ( $team['social_url_1']['url'] || $team['social_url_2']['url'] || $team['social_url_3']['url'] || $team['social_url_4']['url'] ) ) {
													?>
													<ul class="team-member-social">
													<?php
													if ( $team['social_url_1']['url'] && $team['social_icon_1'] ) {
														?>
														<li>
															<a href="<?php echo esc_url( $team['social_url_1']['url'] ); ?>" <?php echo wp_kses( $target_1 . $nofollow_1, $allowed_attr_link ); ?>>
																<?php Icons_Manager::render_icon( $team['social_icon_1'], array( 'aria-hidden' => 'true' ) ); ?>
															</a>
														</li>
														<?php
													}
													if ( $team['social_url_2']['url'] && $team['social_icon_2'] ) {
														?>
														<li>
															<a href="<?php echo esc_url( $team['social_url_2']['url'] ); ?>" <?php echo wp_kses( $target_2 . $nofollow_2, $allowed_attr_link ); ?>>
																<?php Icons_Manager::render_icon( $team['social_icon_2'], array( 'aria-hidden' => 'true' ) ); ?>
															</a>
														</li>
														<?php
													}
													if ( $team['social_url_3']['url'] && $team['social_icon_3'] ) {
														?>
														<li>
															<a href="<?php echo esc_url( $team['social_url_3']['url'] ); ?>" <?php echo wp_kses( $target_3 . $nofollow_3, $allowed_attr_link ); ?>>
																<?php Icons_Manager::render_icon( $team['social_icon_3'], array( 'aria-hidden' => 'true' ) ); ?>
															</a>
														</li>
														<?php
													}
													if ( $team['social_url_4']['url'] && $team['social_icon_4'] ) {
														?>
														<li>
															<a href="<?php echo esc_url( $team['social_url_4']['url'] ); ?>" <?php echo wp_kses( $target_4 . $nofollow_4, $allowed_attr_link ); ?>>
																<?php Icons_Manager::render_icon( $team['social_icon_4'], array( 'aria-hidden' => 'true' ) ); ?>
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
								if ( $team['name'] || $team['title'] || $team['description'] || ( $team['social_url_1']['url'] || $team['social_url_2']['url'] || $team['social_url_3']['url'] || $team['social_url_4']['url'] ) ) {
									?>
									<div <?php echo wp_kses( $this->get_render_attribute_string( 'content' ), $allowed_attr_class ); ?>>
										<div class="uk-position-z-index uk-position-relative">
										<?php
										if ( $team['name'] && ( 'yes' !== $settings['image_content'] || ( 'yes' === $settings['image_content'] && 'yes' !== $settings['image_content_name'] ) ) ) {
											?>
											<h3 class="team-member-name"><?php echo esc_attr( $team['name'] ); ?></h3>
											<?php
										}
										if ( $team['title'] && ( 'yes' !== $settings['image_content'] || ( 'yes' === $settings['image_content'] && 'yes' !== $settings['image_content_title'] ) ) ) {
											?>
											<span class="team-member-title uk-display-block"><?php echo esc_attr( $team['title'] ); ?></span>
											<?php
										}
										if ( $team['description'] && ( 'yes' !== $settings['image_content'] || ( 'yes' === $settings['image_content'] && 'yes' !== $settings['image_content_description'] ) ) ) {
											?>
											<p class="team-member-description"><?php echo esc_attr( $team['description'] ); ?></p>
											<?php
										}
										if ( ( $team['social_url_1']['url'] || $team['social_url_2']['url'] || $team['social_url_3']['url'] || $team['social_url_4']['url'] ) && ( 'yes' !== $settings['image_content'] || ( 'yes' === $settings['image_content'] && 'yes' !== $settings['image_content_social'] ) ) ) {
											?>
											<ul class="team-member-social">
											<?php
											if ( $team['social_url_1']['url'] && $team['social_icon_1'] ) {
												?>
												<li>
													<a href="<?php echo esc_url( $team['social_url_1']['url'] ); ?>" <?php echo wp_kses( $target_1 . $nofollow_1, $allowed_attr_link ); ?>>
														<?php Icons_Manager::render_icon( $team['social_icon_1'], array( 'aria-hidden' => 'true' ) ); ?>
													</a>
												</li>
												<?php
											}
											if ( $team['social_url_2']['url'] && $team['social_icon_2'] ) {
												?>
												<li>
													<a href="<?php echo esc_url( $team['social_url_2']['url'] ); ?>" <?php echo wp_kses( $target_2 . $nofollow_2, $allowed_attr_link ); ?>>
														<?php Icons_Manager::render_icon( $team['social_icon_2'], array( 'aria-hidden' => 'true' ) ); ?>
													</a>
												</li>
												<?php
											}
											if ( $team['social_url_3']['url'] && $team['social_icon_3'] ) {
												?>
												<li>
													<a href="<?php echo esc_url( $team['social_url_3']['url'] ); ?>" <?php echo wp_kses( $target_3 . $nofollow_3, $allowed_attr_link ); ?>>
														<?php Icons_Manager::render_icon( $team['social_icon_3'], array( 'aria-hidden' => 'true' ) ); ?>
													</a>
												</li>
												<?php
											}
											if ( $team['social_url_4']['url'] && $team['social_icon_4'] ) {
												?>
												<li>
													<a href="<?php echo esc_url( $team['social_url_4']['url'] ); ?>" <?php echo wp_kses( $target_4 . $nofollow_4, $allowed_attr_link ); ?>>
														<?php Icons_Manager::render_icon( $team['social_icon_4'], array( 'aria-hidden' => 'true' ) ); ?>
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
										<div class="team-member-content-background-hover uk-position-cover uk-transition-fade"></div>
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
				</div>
			</div>
			<?php
		}
	}
}

