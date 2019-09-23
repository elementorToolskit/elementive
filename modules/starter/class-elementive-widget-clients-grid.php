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
class Elementive_Widget_Clients_Grid extends Widget_Base {

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
		return 'elementive-clients-grid';
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
		return __( 'Clients Grid', 'elementive' );
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
				'label' => __( 'Style', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'           => __( 'Columns', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array(),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 6,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'desktop_default' => array(
					'size' => 4,
				),
				'tablet_default'  => array(
					'size' => 3,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 2,
					'unit' => 'px',
				),
			)
		);

		$this->add_control(
			'align_horizontal',
			array(
				'label'   => __( 'Horizontal align', 'elementive' ),
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
				'default' => 'uk-text-center',
				'toggle'  => true,
			)
		);

		$this->add_control(
			'align_vertical',
			array(
				'label'   => __( 'Vertical align', 'elementive' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
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
				'default' => 'uk-flex-middle',
				'toggle'  => true,
			)
		);

		$this->add_control(
			'divider',
			array(
				'label'        => __( 'Divider', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'divider_color',
			array(
				'label'     => __( 'Divider color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'condition' => array(
					'divider' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .uk-grid-divider>:not(.uk-first-column)::before' => 'border-left-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'column_margin',
			array(
				'label'       => __( 'Column margin', 'elementive' ),
				'description' => __( 'Add one of this class to apply a small, medium, large gap to the column.', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'uk-grid-column-default',
				'options'     => array(
					'uk-grid-column-small'    => __( 'Small', 'elementive' ),
					'uk-grid-column-medium'   => __( 'Medium', 'elementive' ),
					'uk-grid-column-large'    => __( 'Large', 'elementive' ),
					'uk-grid-column-collapse' => __( 'Collapse', 'elementive' ),
					'uk-grid-column-default'  => __( 'Default', 'elementive' ),
				),
			)
		);

		$this->add_control(
			'row_margin',
			array(
				'label'       => __( 'Row margin', 'elementive' ),
				'description' => __( 'Add one of this class to apply a small, medium, large gap to the row.', 'elementive' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'uk-grid-row-default',
				'options'     => array(
					'uk-grid-row-small'    => __( 'Small', 'elementive' ),
					'uk-grid-row-medium'   => __( 'Medium', 'elementive' ),
					'uk-grid-row-large'    => __( 'Large', 'elementive' ),
					'uk-grid-row-collapse' => __( 'Collapse', 'elementive' ),
					'uk-grid-row-default'  => __( 'Default', 'elementive' ),
				),
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

		$allowed_html_link = array(
			'target' => array(),
			'rel'    => array(),
		);

		$allowed_html_wrapper = array(
			'class'   => array(),
			'uk-grid' => array(),
		);

		$wrapper_classes = array( 'elementive-clients-grid', 'uk-child-width-1-' . esc_attr( $settings['columns_mobile']['size'] ), 'uk-child-width-1-' . esc_attr( $settings['columns_tablet']['size'] ) . '@s', 'uk-child-width-1-' . esc_attr( $settings['columns']['size'] ) . '@m', 'uk-grid', esc_attr( $settings['align_horizontal'] ), esc_attr( $settings['align_vertical'] ), esc_attr( $settings['column_margin'] ), esc_attr( $settings['row_margin'] ) );
		$wrapper_classes = array_map( 'esc_attr', $wrapper_classes );

		if ( 'yes' === $settings['divider'] ) {
			$wrapper_classes[] = 'uk-grid-divider';
		}

		$this->add_render_attribute(
			'wrapper',
			array(
				'class'           => esc_attr( join( ' ', $wrapper_classes ) ),
				'uk-grid'         => '',
				'uk-height-match' => 'target: > div',
			)
		);

		$logo_classes      = array( 'elementive-client-grid-logo' );
		$allowed_html_logo = array(
			'class'      => array(),
		);

		if ( 'yes' === $settings['grayscale'] ) {
			$logo_classes[] = 'elementive-client-logo-grayscale';
		}

		if ( 'yes' === $settings['grayscale_hover'] ) {
			$logo_classes[] = 'elementive-client-logo-grayscale-hover';
		}

		$logo_classes = array_map( 'esc_attr', $logo_classes );

		$this->add_render_attribute(
			'logo',
			array(
				'class'      => esc_attr( join( ' ', $logo_classes ) ),
			)
		);

		if ( $settings['clients'] ) {
			echo '<div ' . wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_html_wrapper ) . '>';
			foreach ( $settings['clients'] as $client ) {
				// Get Targets.
				$target   = $client['client_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $client['client_link']['nofollow'] ? ' rel="nofollow"' : '';

				echo '<div class="elementive-client-grid-column">';
				echo '<div ' . wp_kses( $this->get_render_attribute_string( 'logo' ), $allowed_html_logo ) . ' uk-tooltip="title: ' . esc_attr( $client['client_name'] ) . '; pos: bottom">';
				if ( $client['client_link']['url'] ) {
					echo '<a href="' . esc_url( $client['client_link']['url'] ) . '"' . wp_kses( $target . $nofollow, $allowed_html_link ) . '>';
					echo wp_get_attachment_image( $client['client_logo']['id'], 'full' );
					echo '</a>';
				} else {
					echo wp_get_attachment_image( $client['client_logo']['id'], 'full' );
				}
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		}
	}
}
