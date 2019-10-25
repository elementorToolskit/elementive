<?php
/**
 * Elementor section expand feature.
 *
 * @link       https://dimative.com
 * @since      1.0.0
 *
 * @package    Elementive
 * @subpackage Elementive/public
 */

namespace Elementive\Modules\Starter;

use Elementive\Modules\Starter;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor section expand feature.
 *
 * @package    Elementive
 * @subpackage Elementive/Modules/Starter
 * @author     Dimative <contact@dimative.com>
 */
class Elementive_Section_Expand {

	/**
	 * Section Expand controls.
	 *
	 * Register new Elementor sections and controls.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param object $element for current element.
	 * @param object $section_id for section ID.
	 * @param array  $args for section args.
	 */
	public function register_controls( $element, $section_id, $args ) {

		if ( ( 'section' === $element->get_name() && 'section_background' === $section_id ) ) {

			$element->start_controls_section(
				'elementive_section_expand_section',
				array(
					'tab'   => Controls_Manager::TAB_ADVANCED,
					'label' => __( 'Elementive Section Expand', 'elementive' ),
				)
			);

			$element->add_control(
				'elementive_section_expand',
				array(
					'label'        => __( 'Enable section expand', 'elementive' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'elementive' ),
					'label_off'    => __( 'Hide', 'elementive' ),
					'return_value' => 'yes',
					'default'      => '',
				)
			);

			$element->add_control(
				'elementive_section_expand_type',
				array(
					'label'     => __( 'Border Style', 'elementive' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'solid',
					'options'   => array(
						'elementive-section-expand-right' => __( 'Right', 'elementive' ),
						'elementive-section-expand-left'  => __( 'Left', 'elementive' ),
					),
					'condition' => array(
						'elementive_section_expand' => 'yes',
					),
				)
			);

			$element->end_controls_section();
		}
	}

	/**
	 * Add Class and atts to sections.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param object $element for current element.
	 */
	public function _before_render( $element ) {

		if ( $element->get_name() !== 'section' ) {
			return;
		}

		$settings  = $element->get_settings();
		$node_id   = $element->get_id();
		$is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();

		if ( 'yes' === $settings['elementive_section_expand'] ) {
			$element->add_render_attribute(
				'_wrapper',
				array(
					'class' => 'elementive-section-expand ' . $settings['elementive_section_expand_type'] . ' aaaaaaaaaa_' . get_option( 'elementor_container_width' ),
				),
			);
		}
	}

	/**
	 * Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		// Register widgets category.
		add_action( 'elementor/element/after_section_end', array( $this, 'register_controls' ), 10, 3 );
		add_action( 'elementor/frontend/section/before_render', array( $this, '_before_render' ), 10, 1 );
	}
}
