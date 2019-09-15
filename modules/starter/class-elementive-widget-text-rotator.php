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
use Elementor\Group_Control_Text_Shadow;
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
class Elementive_Widget_Text_Rotator extends Widget_Base {

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
		return 'elementive-text-rotator';
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
		return __( 'Text Rotator', 'elementive' );
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
		return array( 'jquery-lettering', 'anime', 'swiper' );
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
			'text_before',
			array(
				'label'       => __( 'Text before', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'placeholder' => __( 'Type your text here', 'elementive' ),
				'default'     => __( 'My favorite food is', 'elementive' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item',
			array(
				'label'       => __( 'Animated text', 'elementive' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Your text', 'elementive' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'strings',
			array(
				'label'       => __( 'Animated text', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'item'   => __( 'Pizza', 'elementive' ),
					),
					array(
						'item'   => __( 'Burger', 'elementive' ),
					),
				),
				'title_field' => '{{{ item }}}',
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'text_after',
			array(
				'label'       => __( 'Text after', 'elementive' ),
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

		$this->add_control(
			'split',
			array(
				'label'     => __( 'Spilit', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'words',
				'options'   => array(
					'chars' => __( 'Chars', 'elementive' ),
					'words' => __( 'Words', 'elementive' ),
					'lines' => __( 'Lines', 'elementive' ),
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'animation',
			array(
				'label'     => __( 'Animations', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'typed',
				'options'   => array(
					'hello' => __( 'First', 'elementive' ),
					'fade'  => __( 'Fade', 'elementive' ),
					'slide' => __( 'Slide', 'elementive' ),
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'       => __( 'Animation speed', 'elementive' ),
				'description' => __( 'Animation speed in milliseconds', 'elementive' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 1000,
				'step'        => 10,
				'default'     => 30,
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'delay',
			array(
				'label'       => __( 'Start delay', 'elementive' ),
				'description' => __( 'Time before animation starts in milliseconds', 'elementive' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 1000,
				'step'        => 10,
				'default'     => 30,
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'duration',
			array(
				'label'       => __( 'Animation duration', 'elementive' ),
				'description' => __( 'Animation duration in milliseconds', 'elementive' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 100,
				'step'        => 1,
				'default'     => 30,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'        => __( 'Loop', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'loop_count',
			array(
				'label'      => __( 'Loop count', 'elementive' ),
				'type'       => Controls_Manager::NUMBER,
				'min'        => 1,
				'max'        => 100,
				'step'       => 1,
				'default'    => 30,
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'loop',
							'value'    => 'true',
						),
					),
				),
				'separator'  => 'after',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'typography',
				'label'     => __( 'Typography', 'elementive' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .elementive-widget-content',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'alignment',
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
					'{{WRAPPER}} .elementive-widget-content' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'text_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-widget-content',
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

		$settings  = $this->get_settings_for_display();
		$classes   = array( 'elementive-text-rotator', 'swiper-container', 'uk-width-1-1', 'uk-margin-remove' );
		$classes[] = $settings['alignment'];
		$classes[] = $settings['split'];

		$classes = array_map( 'esc_attr', $classes );

		$this->add_render_attribute(
			'text_content',
			array(
				'class' => esc_attr( join( ' ', $classes ) ),
			)
		);

		if ( $settings['strings'] ) {
			echo '<' . esc_attr( $settings['tag'] ) . ' ' . wp_kses( $this->get_render_attribute_string( 'text_content' ), array( 'class' => array() ) ) . '>';
			echo '<div class="swiper-wrapper">';
			foreach ( $settings['strings'] as $item ) {
				echo '<div class="swiper-slide elementive-content-item">' . esc_html( $item['item'] ) . '</div>';
			}
			echo '</div>';
			echo '</' . esc_attr( $settings['tag'] ) . '>';
		}
	}
}
