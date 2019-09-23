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

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Scheme_Color;

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
class Elementive_Widget_Text extends Widget_Base {

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
		return 'elementive-text';
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
		return __( 'Advanced Text', 'elementive' );
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
		return array( 'jquery-lettering' );
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

		$this->add_control(
			'text',
			array(
				'label'       => __( 'Text', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'placeholder' => __( 'Type your text here', 'elementive' ),
			)
		);

		$this->add_control(
			'tag',
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
				'name'     => 'typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementive-text-content',
			)
		);

		$this->add_control(
			'text_align',
			array(
				'label'   => __( 'Alignment', 'elementive' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
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
				'default' => '',
				'toggle'  => true,
			)
		);

		$this->add_control(
			'text_style',
			array(
				'label'   => __( 'Text Style', 'elementive' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'  => __( 'Default', 'elementive' ),
					'mask'     => __( 'Background mask', 'elementive' ),
					'animated' => __( 'Animated colors', 'elementive' ),
				),
			)
		);

		$this->add_control(
			'color',
			array(
				'label'      => __( 'Color', 'elementive' ),
				'type'       => Controls_Manager::COLOR,
				'scheme'     => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'    => 'inherit',
				'selectors'  => array(
					'{{WRAPPER}} .elementive-text-content' => 'color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'text_style',
							'operator' => 'in',
							'value'    => array(
								'default',
							),
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'       => 'text_background',
				'label'      => __( 'Background mask', 'elementive' ),
				'types'      => array( 'classic', 'gradient' ),
				'selector'   => '{{WRAPPER}} .elementive-text-content',
				'separator'  => 'before',
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'text_style',
							'operator' => 'in',
							'value'    => array(
								'mask',
							),
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'text_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-text-content',
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
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$classes  = array( 'elementive-text-content', 'uk-width-1-1', 'uk-margin-remove' );

		if ( 'mask' === $settings['text_style'] ) {
			$classes[] = 'has_background_mask';

			if ( 'classic' === $settings['text_background_background'] && $settings['text_background_image'] ) {
				$classes[] = 'has_background_image_mask';
			}

			if ( 'gradient' === $settings['text_background_background'] ) {
				$classes[] = 'has_background_gradient_mask';
			}
		}

		if ( 'animated' === $settings['text_style'] ) {
			$classes[] = 'has-text-color-animation';
		}

		$classes[] = $settings['text_align'];

		$classes = array_map( 'esc_attr', $classes );

		$this->add_render_attribute(
			'text_content',
			array(
				'class' => esc_attr( join( ' ', $classes ) ),
			)
		);

		echo '<' . esc_attr( $settings['tag'] ) . ' ' . wp_kses( $this->get_render_attribute_string( 'text_content' ), array( 'class' => array() ) ) . '>';
		echo esc_html( $settings['text'] );
		echo '</' . esc_attr( $settings['tag'] ) . '>';
	}
}
