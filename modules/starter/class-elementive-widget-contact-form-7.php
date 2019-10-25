<?php
/**
 * Contact Form 7 Widget
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
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Elementor Conctact Form 7
 *
 * Elementor widget for elementive.
 *
 * @since 1.0.0
 */
class Elementive_Widget_Contact_Form_7 extends Widget_Base {

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
		return 'elementive-contact-form-7';
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
		return __( 'Contact Form 7', 'elementive' );
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
	 * Display selected post template.
	 *
	 * @return array
	 */
	protected function get_contact_form_7_list() {

		$contact_form_7_list = array();

		// WP_Query arguments.
		$args = array(
			'post_type'   => array( 'wpcf7_contact_form' ),
			'post_status' => array( 'publish' ),
			'nopaging'    => true,
			'order'       => 'ASC',
			'orderby'     => 'menu_order',
		);

		// The Query.
		$forms = new \WP_Query( $args );

		// The Loop.
		if ( $forms->have_posts() ) {
			while ( $forms->have_posts() ) {
				$forms->the_post();

				// Getting ID.
				$id = get_the_ID();

				// Getting title.
				$contact_form_7_list[ $id ] = get_the_title();
			}
		} else {
			$contact_form_7_list = array();
		}

		// Restore original Post Data.
		wp_reset_postdata();

		return $contact_form_7_list;
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
			'contact_form_list',
			array(
				'label'    => __( 'Contact form', 'elementive' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => false,
				'options'  => $this->get_contact_form_7_list(),
				'default'  => '',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_input',
			array(
				'label' => __( 'Input', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'input_checkbox',
			array(
				'label'        => __( 'Inline checkbox', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'elementive' ),
				'label_off'    => __( 'Hide', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'input_radio',
			array(
				'label'        => __( 'Inline radio', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'elementive' ),
				'label_off'    => __( 'Hide', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_typography',
				'label'    => __( 'Form typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}}',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'input_typography',
				'label'    => __( 'Control typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .wpcf7-form-control, {{WRAPPER}} .wpcf7-list-item-label',
			)
		);

		$this->add_responsive_control(
			'input_max_width',
			array(
				'label'      => __( 'Max Width', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 100,
				),
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text, {{WRAPPER}} .wpcf7-textarea, {{WRAPPER}} .wpcf7-select, {{WRAPPER}} .wpcf7-date, {{WRAPPER}} .wpcf7-number, {{WRAPPER}} .wpcf7-quiz' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'input_margin',
			array(
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpcf7-text, {{WRAPPER}} .wpcf7-textarea, {{WRAPPER}} .wpcf7-select, {{WRAPPER}} .wpcf7-date, {{WRAPPER}} .wpcf7-number, {{WRAPPER}} .wpcf7-quiz, {{WRAPPER}} .wpcf7-radio, {{WRAPPER}} .wpcf7-checkbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'input_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpcf7-text, {{WRAPPER}} .wpcf7-textarea, {{WRAPPER}} .wpcf7-select, {{WRAPPER}} .wpcf7-date, {{WRAPPER}} .wpcf7-number, {{WRAPPER}} .wpcf7-quiz' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'input_border_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text, {{WRAPPER}} .wpcf7-textarea, {{WRAPPER}} .wpcf7-select, {{WRAPPER}} .wpcf7-date, {{WRAPPER}} .wpcf7-number, {{WRAPPER}} .wpcf7-quiz' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'style_tabs_input'
		);

		$this->start_controls_tab(
			'style_normal_tab_input',
			array(
				'label' => __( 'Normal', 'elementive' ),
			)
		);

		$this->add_control(
			'input_color',
			array(
				'label'     => __( 'Input color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text, {{WRAPPER}} .wpcf7-textarea, {{WRAPPER}} .wpcf7-select, {{WRAPPER}} .wpcf7-date, {{WRAPPER}} .wpcf7-number, {{WRAPPER}} .wpcf7-quiz' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'placeholder_color',
			array(
				'label'     => __( 'Placeholder color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text::placeholder, {{WRAPPER}} .wpcf7-textarea::placeholder, {{WRAPPER}} .wpcf7-select::placeholder, {{WRAPPER}} .wpcf7-date::placeholder, {{WRAPPER}} .wpcf7-number::placeholder, {{WRAPPER}} .wpcf7-quiz::placeholder' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'input_background_color',
			array(
				'label'     => __( 'Background color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text, {{WRAPPER}} .wpcf7-textarea, {{WRAPPER}} .wpcf7-select, {{WRAPPER}} .wpcf7-date, {{WRAPPER}} .wpcf7-number, {{WRAPPER}} .wpcf7-quiz' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'input_border',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .wpcf7-text, {{WRAPPER}} .wpcf7-textarea, {{WRAPPER}} .wpcf7-select, {{WRAPPER}} .wpcf7-date, {{WRAPPER}} .wpcf7-number, {{WRAPPER}} .wpcf7-quiz',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'input_box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .wpcf7-text, {{WRAPPER}} .wpcf7-textarea, {{WRAPPER}} .wpcf7-select, {{WRAPPER}} .wpcf7-date, {{WRAPPER}} .wpcf7-number, {{WRAPPER}} .wpcf7-quiz',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab_input',
			array(
				'label' => __( 'Hover', 'elementive' ),
			)
		);

		$this->add_control(
			'input_color_hover',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text:hover, {{WRAPPER}} .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-select:hover, {{WRAPPER}} .wpcf7-date:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'input_background_color_hover',
			array(
				'label'     => __( 'Background color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text:hover, {{WRAPPER}} .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-select:hover, {{WRAPPER}} .wpcf7-date:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'input_border_hover',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .wpcf7-text:hover, {{WRAPPER}} .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-select:hover, {{WRAPPER}} .wpcf7-date:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'input_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .wpcf7-text:hover, {{WRAPPER}} .wpcf7-textarea:hover, {{WRAPPER}} .wpcf7-select:hover, {{WRAPPER}} .wpcf7-date:hover',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_focus_tab_input',
			array(
				'label' => __( 'Focus', 'elementive' ),
			)
		);

		$this->add_control(
			'input_color_focus',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text:focus, {{WRAPPER}} .wpcf7-textarea:focus, {{WRAPPER}} .wpcf7-select:focus, {{WRAPPER}} .wpcf7-date:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'input_background_color_focus',
			array(
				'label'     => __( 'Background color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpcf7-text:focus, {{WRAPPER}} .wpcf7-textarea:focus, {{WRAPPER}} .wpcf7-select:focus, {{WRAPPER}} .wpcf7-date:focus' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'input_border_focus',
				'label'    => __( 'Border', 'elementive' ),
				'selector' => '{{WRAPPER}} .wpcf7-text:focus, {{WRAPPER}} .wpcf7-textarea:focus, {{WRAPPER}} .wpcf7-select:focus, {{WRAPPER}} .wpcf7-date:focus',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'input_box_shadow_active',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .wpcf7-text:active, {{WRAPPER}} .wpcf7-textarea:active, {{WRAPPER}} .wpcf7-select:active',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			array(
				'label' => __( 'Button', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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

		// Classes.
		$classes_wrapper = array( 'elementive-contact-form-7' );

		if ( 'yes' !== $settings['input_checkbox'] ) {
			$classes_wrapper[] = 'elementive-cf7-checkbox-list';
		}

		if ( 'yes' !== $settings['input_radio'] ) {
			$classes_wrapper[] = 'elementive-cf7-radio-list';
		}

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class'  => esc_attr( join( ' ', $classes_wrapper ) ),
			)
		);
		?>
		<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?>>
			<?php
			echo do_shortcode( '[contact-form-7 id="' . $settings['contact_form_list'] . '"]' );
			?>
		</div>
		<?php
	}
}
