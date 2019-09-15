<?php
/**
 * Type Writer Widget
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
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
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
class Elementive_Widget_Typewriter extends Widget_Base {

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
		return 'elementive-typewriter';
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
		return __( 'Typewriter', 'elementive' );
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
				'label' => __( 'Typewriter', 'elementive' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type_string',
			array(
				'label'        => __( 'Type string', 'elementive' ),
				'desckription' => __( 'Type out a string using the typewriter effect.', 'elementive' ),
				'type'         => Controls_Manager::TEXTAREA,
				'rows'         => 10,
				'default'      => '',
				'placeholder'  => __( 'Type your text here', 'elementive' ),
			)
		);

		$repeater->add_control(
			'pause_for',
			array(
				'label'       => __( 'Pause for', 'elementive' ),
				'description' => __( 'Pause for milliseconds', 'elementive' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 5000,
				'step'        => 10,
				'default'     => '',
				'separator'   => 'before',
			)
		);

		$repeater->add_control(
			'delete_all',
			array(
				'label'        => __( 'Delete all', 'elementive' ),
				'description'  => __( 'Delete everything that is visible inside of the typewriter wrapper element.', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$repeater->add_control(
			'delete_chars',
			array(
				'label'       => __( 'Delete chars', 'elementive' ),
				'description' => __( 'Delete and amount of characters, starting at the end of the visible string.', 'elementive' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 5000,
				'step'        => 1,
				'default'     => '',
				'separator'   => 'before',
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'delete_all',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$repeater->add_control(
			'change_delete_speed',
			array(
				'label'       => __( 'Change delete speed', 'elementive' ),
				'description' => __( 'The speed at which to delete the characters, lower number is faster.', 'elementive' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 5000,
				'step'        => 10,
				'default'     => '',
				'separator'   => 'before',
			)
		);

		$repeater->add_control(
			'change_delay',
			array(
				'label'       => __( 'Change delay', 'elementive' ),
				'description' => __( 'Change the delay when typing out each character.', 'elementive' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 5000,
				'step'        => 1,
				'default'     => '',
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'typewriter',
			array(
				'label'       => __( 'Typewriter', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'type_string'  => __( 'A simple yet powerful typewriter', 'elementive' ),
					),
					array(
						'type_string'  => __( '<strong>Typewriter</strong> widget for a cool typewriter effect and ', 'elementive' ),
						'pause_for'    => 300,
						'delete_all'   => '',
						'delete_chars' => 10,
					),
					array(
						'type_string' => __( '<strong>easy to use!</strong>', 'elementive' ),
						'pause_for'   => 1000,
					),
				),
				'title_field' => '{{{ type_string }}}',
				'separator'   => 'before',
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
				'name'      => 'typography',
				'label'     => __( 'Typography', 'elementive' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .elementive-run-typewriter',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'text_align',
			array(
				'label'   => __( 'Alignment', 'elementive' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'uk-text-right' => array(
						'title' => __( 'Left', 'elementive' ),
						'icon'  => 'fa fa-align-left',
					),
					'uk-text-center' => array(
						'title' => __( 'Center', 'elementive' ),
						'icon'  => 'fa fa-align-center',
					),
					'uk-text-left' => array(
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
					'{{WRAPPER}} .elementive-run-typewriter' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'text_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-run-typewriter',
			)
		);

		$this->add_control(
			'delay',
			array(
				'label'       => __( 'Delay', 'elementive' ),
				'description' => __( 'The delay between each key when typing.', 'elementive' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 1000,
				'step'        => 10,
				'default'     => '100',
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'        => __( 'Loop', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => __( 'Whether to keep looping or not.', 'elementive' ),
				'label_on'     => __( 'True', 'elementive' ),
				'label_off'    => __( 'False', 'elementive' ),
				'return_value' => 'true',
				'default'      => 'true',
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

		$settings      = $this->get_settings_for_display();
		$classes       = array( 'elementive-run-typewriter', 'uk-width-1-1', 'uk-margin-remove' );
		$loop          = 'false';
		$typewriter_id = $this->get_id();
		$allowed_html  = array(
			'a'      => array(
				'href'   => array(),
				'target' => array(),
				'class'  => array(),
			),
			'span'   => array(
				'class'  => array(),
			),
			'strong' => array(),
			'b'      => array(),
			'em'     => array(),
			'i'      => array(),
		);

		if ( 'true' === $settings['loop'] ) {
			$loop = 'true';
		} else {
			$loop = 'false';
		}

		$classes[] = $settings['text_align'];

		$classes = array_map( 'esc_attr', $classes );

		$this->add_render_attribute(
			'typewriter_attr',
			array(
				'id'    => esc_attr( $typewriter_id ),
				'class' => esc_attr( join( ' ', $classes ) ),
			)
		);

		echo '<' . esc_attr( $settings['tag'] ) . ' ' . wp_kses(
			$this->get_render_attribute_string( 'typewriter_attr' ),
			array(
				'id'    => array(),
				'class' => array(),
			)
		) . '></' . esc_attr( $settings['tag'] ) . '>';
		echo '<script>';
		echo 'var typewriter_app_' . esc_attr( $typewriter_id ) . ' = document.getElementById("' . esc_attr( $typewriter_id ) . '");';
		echo 'var typewriter_' . esc_attr( $typewriter_id ) . ' = new Typewriter(typewriter_app_' . esc_attr( $typewriter_id ) . ', {loop: ' . esc_attr( $loop ) . ',delay: ' . esc_attr( $settings['delay'] ) . ',});';
		if ( $settings['typewriter'] ) {
			echo 'typewriter_' . esc_attr( $typewriter_id );
			foreach ( $settings['typewriter'] as $item ) {

				if ( $item['pause_for'] ) {
					echo '.pauseFor(' . esc_attr( $item['pause_for'] ) . ')';
				}

				if ( $item['delete_all'] ) {
					echo '.deleteAll()';
				} elseif ( $item['delete_chars'] ) {
					echo '.deleteChars(' . esc_attr( $item['delete_chars'] ) . ')';
				}

				if ( $item['change_delete_speed'] ) {
					echo '.changeDeleteSpeed(' . esc_attr( $item['change_delete_speed'] ) . ')';
				}

				if ( $item['change_delay'] ) {
					echo '.changeDelay(' . esc_attr( $item['change_delay'] ) . ')';
				}

				echo '.typeString("' . wp_kses( $item['type_string'], $allowed_html ) . '")';
			}
			echo '.start();';
		}
		echo '</script>';
	}
}
