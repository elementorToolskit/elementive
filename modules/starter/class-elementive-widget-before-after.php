<?php
/**
 * Before After Widget
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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Elementive Before After Widget
 *
 * Elementor widget for elementive.
 *
 * @since 1.0.0
 */
class Elementive_Widget_Before_After extends Widget_Base {

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
		return 'elementive-before-after';
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
		return __( 'Before After', 'elementive' );
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
		return array( 'uikit', 'BeerSlider' );
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
		return array( 'uikit', 'BeerSlider' );
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
			'start',
			array(
				'label'      => __( 'Start', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 50,
				),
			)
		);

		$this->add_control(
			'before_title',
			array(
				'label'   => __( 'Before label', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Before', 'elementive' ),
			)
		);

		$this->add_control(
			'before_text',
			array(
				'label'   => __( 'Before text', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'before_image',
			array(
				'label'   => __( 'Before image', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'after_title',
			array(
				'label'     => __( 'After label', 'elementive' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'After', 'elementive' ),
			)
		);

		$this->add_control(
			'after_text',
			array(
				'label'     => __( 'After text', 'elementive' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'After', 'elementive' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'after_image',
			array(
				'label'   => __( 'After image', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
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
			'border_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-before-after' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_before_label',
			array(
				'label' => __( 'Before label', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'before_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .beer-slider[data-beer-label]:after',
			)
		);

		$this->add_control(
			'before_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .beer-slider[data-beer-label]:after' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'before_margin',
			array(
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .beer-slider[data-beer-label]:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'before_padding',
			array(
				'label'      => __( 'padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .beer-slider[data-beer-label]:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'before_background',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .beer-slider[data-beer-label]:after',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'before_box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .beer-slider[data-beer-label]:after',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_after_label',
			array(
				'label' => __( 'After label', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'after_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .beer-reveal[data-beer-label]:after',
			)
		);

		$this->add_control(
			'after_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .beer-reveal[data-beer-label]:after' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'after_margin',
			array(
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .beer-reveal[data-beer-label]:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'after_padding',
			array(
				'label'      => __( 'padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .beer-reveal[data-beer-label]:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'after_background',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .beer-reveal[data-beer-label]:after',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'after_box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .beer-reveal[data-beer-label]:after',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			array(
				'label' => __( 'Text', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .beer-reveal[data-text]:before, {{WRAPPER}} .beer-slider[data-text]:before',
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .beer-reveal[data-text]:before, {{WRAPPER}} .beer-slider[data-text]:before' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'text_margin',
			array(
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .beer-reveal[data-text]:before, {{WRAPPER}} .beer-slider[data-text]:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_padding',
			array(
				'label'      => __( 'padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .beer-reveal[data-text]:before, {{WRAPPER}} .beer-slider[data-text]:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'text_background',
				'label'    => __( 'Background', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .beer-reveal[data-text]:before, {{WRAPPER}} .beer-slider[data-text]:before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'text_box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .beer-reveal[data-text]:before, {{WRAPPER}} .beer-slider[data-text]:before',
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

		// Wrapper Classes.
		$classes_wrapper = array( 'elementive-before-after', 'uk-overflow-hidden' );

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class' => esc_attr( join( ' ', $classes_wrapper ) ),
			)
		);

		// Allowed Tags Beerslider.
		$allowed_attr_beerslider = array(
			'class'            => array(),
			'data-beer-label'  => array(),
			'data-beer-start'  => array(),
			'data-text'        => array(),
		);

		// Beer Slider Before Classes.
		$classes_before = array( 'run-beer-slider', 'beer-slider', 'uk-display-block' );

		if ( $settings['before_text'] ) {
			$classes_before[] = 'with-text';
		}

		$classes_before = array_map( 'esc_attr', $classes_before );

		$this->add_render_attribute(
			'beerslider_before',
			array(
				'class'            => esc_attr( join( ' ', $classes_before ) ),
				'data-beer-label'  => esc_attr( $settings['before_title'] ),
				'data-text'        => esc_attr( $settings['before_text'] ),
				'data-beer-start'  => esc_attr( $settings['start']['size'] ),
			)
		);

		// Beer Slider After Classes.
		$classes_after = array( 'beer-reveal' );

		if ( $settings['after_text'] ) {
			$classes_after[] = 'with-text';
		}

		$classes_after = array_map( 'esc_attr', $classes_after );

		$this->add_render_attribute(
			'beerslider_after',
			array(
				'class'           => esc_attr( join( ' ', $classes_after ) ),
				'data-beer-label' => esc_attr( $settings['after_title'] ),
				'data-text'       => esc_attr( $settings['after_text'] ),
			)
		);

		?>
		<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?>>
			<div <?php echo wp_kses( $this->get_render_attribute_string( 'beerslider_before' ), $allowed_attr_beerslider ); ?>>
			<?php echo wp_get_attachment_image( $settings['before_image']['id'], $settings['image_size_size'], '', array( 'class' => 'uk-width-1-1' ) ); ?>
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'beerslider_after' ), $allowed_attr_beerslider ); ?>>
				<?php echo wp_get_attachment_image( $settings['after_image']['id'], $settings['image_size_size'], '', array( 'class' => 'uk-width-1-1' ) ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}
