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
		return [ 'uikit', 'jarallax', 'jarallax-video' ];
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
		return [ 'uikit' ];
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
					'icon-left' => [
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'eicon-h-align-left',
					],
					'icon-top' => [
						'title' => __( 'Center', 'elementive' ),
						'icon'  => 'eicon-v-align-top',
					],
					'icon-right' => [
						'title' => __( 'Right', 'elementive' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'icon-top',
				'toggle'  => true,
			]
		);

		$this->add_control(
			'icon_margin_top',
			[
				'label'          => __( 'Icon margin top', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => [ 'px' ],
				'range'          => [
					'px' => [
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					],
				],
				'default'        => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'      => [
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'conditions'     => [
					'terms' => [
						[
							'name'     => 'icon_position',
							'value'    => 'icon-top',
						],
					],
				],
			]
		);

		$this->add_control(
			'icon_margin_left',
			[
				'label'          => __( 'Icon margin left', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => [ 'px' ],
				'range'          => [
					'px' => [
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					],
				],
				'default'        => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'      => [
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions'     => [
					'terms' => [
						[
							'name'     => 'icon_position',
							'value'    => 'icon-right',
						],
					],
				],
			]
		);

		$this->add_control(
			'icon_margin_right',
			[
				'label'          => __( 'Icon margin right', 'elementive' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => [ 'px' ],
				'range'          => [
					'px' => [
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					],
				],
				'default'        => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'      => [
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'conditions'     => [
					'terms' => [
						[
							'name'     => 'icon_position',
							'value'    => 'icon-left',
						],
					],
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label'      => __( 'Alignment', 'elementive' ),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => [
					'uk-text-left' => [
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'fa fa-align-left',
					],
					'uk-text-center' => [
						'title' => __( 'Center', 'elementive' ),
						'icon'  => 'fa fa-align-center',
					],
					'uk-text-right' => [
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
							'value'    => 'icon-top',
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
			'title',
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
				'default'     => __( 'Default description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.​', 'elementive' ),
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

		$this->add_responsive_control(
			'padding',
			[
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .elementive-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'radius',
			[
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .elementive-icon-box' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .elementive-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementive-icon-box .elementive-icon-box-hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementive-icon-box',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => [ 'classic', 'gradient', 'video', 'slideshow' ],
				'selector' => '{{WRAPPER}} .elementive-icon-box',
			]
		);

		$this->add_control(
			'background_overlay',
			[
				'label'      => __( 'Background Overlay', 'elementive' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'none',
				'options'    => [
					'none'               => __( 'None', 'elementive' ),
					'uk-overlay-primary' => __( 'Dark', 'elementive' ),
					'uk-overlay-default' => __( 'Light', 'elementive' ),
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'terms' => [
										[
											'name'  => 'background_background',
											'value' => 'classic',
										],
										[
											'name'     => 'background_image[url]',
											'operator' => '!=',
											'value'    => '',
										],
									],
								],
								[
									'terms' => [
										[
											'name'  => 'background_background',
											'value' => 'video',
										],
										[
											'name'     => 'background_video_link',
											'operator' => '!=',
											'value'    => '',
										],
									],
								],
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-icon-box',
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
				'selector' => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-hover',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background_hover',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elementive-icon-box .elementive-icon-box-hover',
			]
		);

		$this->add_control(
			'background_overlay_hover',
			[
				'label'      => __( 'Background Overlay', 'elementive' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'none',
				'options'    => [
					'none'               => __( 'None', 'elementive' ),
					'uk-overlay-primary' => __( 'Dark', 'elementive' ),
					'uk-overlay-default' => __( 'Light', 'elementive' ),
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'terms' => [
										[
											'name'  => 'background_hover_background',
											'value' => 'classic',
										],
										[
											'name'     => 'background_hover_image[url]',
											'operator' => '!=',
											'value'    => '',
										],
									],
								],
								[
									'terms' => [
										[
											'name'  => 'background_hover_background',
											'value' => 'video',
										],
										[
											'name'     => 'background_hover_video_link',
											'operator' => '!=',
											'value'    => '',
										],
									],
								],
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-icon-box:hover',
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
			'icon_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
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
			'icon_hover_tab',
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

		$classes         = [ 'elementive-icon-box', 'uk-width-1-1', 'uk-position-relative', 'uk-transition-toggle', 'uk-inline-clip' ];
		$classes_icon    = [ 'elementive-icon-box-icon', 'uk-position-relative', 'uk-position-z-index' ];
		$classes_content = [ 'elementive-icon-box-content', 'uk-position-relative', 'uk-position-z-index' ];

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

		$this->add_render_attribute(
			'wrapper',
			[
				'class'    => esc_attr( join( ' ', $classes ) ),
				'tabindex' => '0',
			]
		);

		$this->add_render_attribute(
			'icon',
			[
				'class' => esc_attr( join( ' ', $classes_icon ) ),
			]
		);

		$this->add_render_attribute(
			'content',
			[
				'class' => esc_attr( join( ' ', $classes_content ) ),
			]
		);
		?>
		<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), [ 'class' => [] ] ); ?>>
			<div <?php echo wp_kses( $this->get_render_attribute_string( 'icon' ), [ 'class' => [] ] ); ?>>
				<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
			<div <?php echo wp_kses( $this->get_render_attribute_string( 'content' ), [ 'class' => [] ] ); ?>>
				<<?php echo esc_attr( $settings['tag'] ); ?>><?php echo esc_html( $settings['title'] ); ?></<?php echo esc_attr( $settings['tag'] ); ?>>
				<?php if ( $settings['description'] ) { ?>
				<p><?php echo esc_html( $settings['description'] ); ?></p>	
				<?php } // End Description exists. ?>
			</div>
			<?php

			// Background Video.
			if ( 'video' === $settings['background_background'] && $settings['background_video_link'] ) {
				Elementive_Helpers::elementive_video_background( $settings, 'background', [ 'uk-position-cover', 'uk-height-1-1', 'uk-width-1-1' ] );
			}

			// Overlay.
			if ( ( 'none' !== $settings['background_overlay'] && 'classic' === $settings['background_background'] && '' !== $settings['background_image']['url'] ) || ( 'none' !== $settings['background_overlay'] && 'video' === $settings['background_background'] && '' !== $settings['background_video_link'] ) ) {
				echo '<div class="elementive-icon-box-overlay uk-position-cover uk-overlay ' . esc_attr( $settings['background_overlay'] ) . '"></div>';
			}
			?>
			<div class="elementive-icon-box-hover uk-position-cover uk-transition-fade">
				<?php
			
				// Background Video.
				if ( 'video' === $settings['background_hover_background'] && $settings['background_hover_video_link'] ) {
					Elementive_Helpers::elementive_video_background( $settings, 'background_hover', [ 'uk-position-cover', 'uk-height-1-1', 'uk-width-1-1' ] );
				}

				// Overlay.
				if ( ( 'none' !== $settings['background_overlay_hover'] && 'classic' === $settings['background_hover_background'] && '' !== $settings['background_hover_image']['url'] ) || ( 'none' !== $settings['background_overlay_hover'] && 'video' === $settings['background_hover_background'] && '' !== $settings['background_hover_video_link'] ) ) {
					echo '<div class="elementive-icon-box-hover-overlay uk-position-cover uk-overlay ' . esc_attr( $settings['background_overlay_hover'] ) . '"></div>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
