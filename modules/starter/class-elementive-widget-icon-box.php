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
use Elementive\Includes\Elementive_Helpers;

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
class Elementive_Widget_Icon_Box extends Widget_Base {

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
		return 'elementive-icon-box';
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
		return __( 'Icon Box', 'elementive' );
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
		return [ 'elementive-starter' ];
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
		return [ 'elementive' ];
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
			[
				'label' => __( 'Content', 'elementive' ),
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label'   => __( 'Icon position', 'elementive' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Center', 'elementive' ),
						'icon'  => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'elementive' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'top',
				'toggle'  => true,
			]
		);

		$this->add_control(
			'text_align',
			[
				'label'      => __( 'Alignment', 'elementive' ),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => [
					'left' => [
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementive' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementive' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'    => 'center',
				'toggle'     => true,
				'conditions' => [
					'terms' => [
						[
							'name'     => 'icon_position',
							'value'    => 'top',
						],
					],
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label'   => __( 'Icon', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'tag',
			[
				'label'   => __( 'Title tag', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'  => __( 'H1', 'elementive' ),
					'h2'  => __( 'H2', 'elementive' ),
					'h3'  => __( 'H3', 'elementive' ),
					'h4'  => __( 'H4', 'elementive' ),
					'h5'  => __( 'H5', 'elementive' ),
					'h6'  => __( 'H6', 'elementive' ),
				],
			]
		);

		$this->add_control(
			'widget_title',
			[
				'label'       => __( 'Title', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Default title', 'elementive' ),
				'placeholder' => __( 'Type your title here', 'elementive' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => __( 'Description', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'default'     => __( 'Default description', 'elementive' ),
				'placeholder' => __( 'Type your description here', 'elementive' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'elementive' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'elementive' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'elementive' ),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .wrapper',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .wrapper',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'elementive' ),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border_hover',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .wrapper:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background_hover',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .wrapper:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .wrapper:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Icon', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'elementive' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .wrapper' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'elementive' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .wrapper' => 'color: {{VALUE}}',
				],
			]
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

		echo '<div class="elementive-icon-box">';
		echo $settings['title'];
		echo '</div>';
	}
}
