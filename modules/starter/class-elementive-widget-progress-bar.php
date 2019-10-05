<?php
/**
 * Progressbar Widget
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
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Progressbar Widget
 *
 * Progressbar widget for Elementive.
 *
 * @since 1.0.0
 */
class Elementive_Widget_Progress_Bar extends Widget_Base {

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
		return 'elementive-progress-bar';
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
		return __( 'Progress bar', 'elementive' );
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
		return array( 'uikit', 'circle-progress', 'anime' );
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

		$this->add_control(
			'circle',
			array(
				'label'        => __( 'Circle progress bar', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'line_cap',
			array(
				'label'     => __( 'Arc line cap', 'elementive' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'round',
				'options'   => array(
					'butt'   => __( 'Butt', 'elementive' ),
					'round'  => __( 'Round', 'elementive' ),
					'square' => __( 'Square', 'elementive' ),
				),
				'condition' => array(
					'circle' => 'yes',
				),
			)
		);

		$this->add_control(
			'progress_bar_max_width',
			array(
				'label'      => __( 'Circle progress width', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 400,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 250,
				),
				'condition'  => array(
					'circle' => 'yes',
				),
			)
		);

		$this->add_control(
			'progress_bar_tickness',
			array(
				'label'      => __( 'Circle progress tickness', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'condition'  => array(
					'circle' => 'yes',
				),
			)
		);

		$this->add_control(
			'progress_bar_height',
			array(
				'label'      => __( 'Progress bar height', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 25,
				),
				'condition'  => array(
					'circle!'    => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-progress-bar-background' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'progress_bar_radius',
			array(
				'label'      => __( 'Progress bar border radius', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'condition'  => array(
					'circle!'    => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementive-progress-bar-background' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementive-progress-bar-normal' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'duration',
			array(
				'label'      => __( 'Transition duration', 'elementive' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '' ),
				'range'      => array(
					'px' => array(
						'min'  => 10,
						'max'  => 3000,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1200,
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'elementive' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'My skill', 'elementive' ),
			)
		);

		$this->add_control(
			'inner_text',
			array(
				'label'        => __( 'Enable inner text', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'text',
			array(
				'label'      => __( 'Inner text', 'elementive' ),
				'type'       => Controls_Manager::TEXT,
				'default'    => __( 'Web Design', 'elementive' ),
				'condition'  => array(
					'inner_text' => 'yes',
				),
			)
		);

		$this->add_control(
			'percentage_start',
			array(
				'label'      => __( 'Percentage start', 'elementive' ),
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
					'size' => 10,
				),
			)
		);

		$this->add_control(
			'percentage_end',
			array(
				'label'      => __( 'Percentage end', 'elementive' ),
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
			'display_percentage',
			array(
				'label'        => __( 'Display percentage', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_progress_style',
			array(
				'label' => __( 'Progress bar empty fill', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'empty_fill',
			array(
				'label'     => __( 'Empty fill color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F9F9F9',
				'selectors' => array(
					'{{WRAPPER}} .elementive-progress-bar-background' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-progress-bar-background',
			)
		);

		$this->add_control(
			'note_box_shadow_1',
			array(
				'type' => Controls_Manager::RAW_HTML,
				'raw'  => __( 'Box shadow does not work on circle progress bar.', 'elementive' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_progress_style_fill',
			array(
				'label' => __( 'Progress bar fill', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fill',
				'label'    => __( 'Color', 'elementive' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .elementive-progress-bar-normal',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fill_box_shadow',
				'label'    => __( 'Box Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-progress-bar-normal',
			)
		);

		$this->add_control(
			'note_box_shadow_2',
			array(
				'type' => Controls_Manager::RAW_HTML,
				'raw'  => __( 'Box shadow does not work on circle progress bar.', 'elementive' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Title', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'           => __( 'Title margin', 'elementive' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px' ),
				'devices'         => array( 'desktop', 'tablet', 'mobile' ),
				'range'           => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'desktop_default' => array(
					'size' => 20,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .elementive-progress-bar-circle + .elementive-progress-bar-title' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementive-progress-bar-top .elementive-progress-bar-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementive-progress-bar-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-progress-bar-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-progress-bar-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_inner_style',
			array(
				'label' => __( 'Inner text', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'inner_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementive-progress-bar-inner-text',
			)
		);

		$this->add_control(
			'inner_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-progress-bar-inner-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'inner_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-progress-bar-inner-text',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_percentage_style',
			array(
				'label' => __( 'Percentage', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'percentage_typography',
				'label'    => __( 'Typography', 'elementive' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .elementive-progress-bar-percentage',
			)
		);

		$this->add_control(
			'percentage_color',
			array(
				'label'     => __( 'Color', 'elementive' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementive-progress-bar-percentage' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'percentage_shadow',
				'label'    => __( 'Text Shadow', 'elementive' ),
				'selector' => '{{WRAPPER}} .elementive-progress-bar-percentage',
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
		$classes_wrapper = array( 'elementive-progress-bar' );

		if ( 'yes' === $settings['circle'] ) {
			$classes_wrapper[] = 'uk-text-center';
		}

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class' => esc_attr( join( ' ', $classes_wrapper ) ),
			)
		);

		// Progress Classes.
		$allowed_attr_progress_bar = array(
			'class'          => array(),
			'data-start'     => array(),
			'data-end'       => array(),
			'data-max-width' => array(),
			'data-thickness' => array(),
			'data-duration'  => array(),
			'data-linecap'   => array(),
			'data-emptyfill' => array(),
			'data-fill'      => array(),
		);

		$classes_progress_bar = array( 'run-progress-bar' );

		if ( 'yes' === $settings['circle'] ) {
			$classes_progress_bar[] = 'elementive-progress-bar-circle';
			$classes_progress_bar[] = 'uk-position-relative';
		} else {
			$classes_progress_bar[] = 'elementive-progress-bar-normal';
			$classes_progress_bar[] = 'uk-position-left';
			$classes_progress_bar[] = 'uk-overflow-hidden';

			if ( 'yes' !== $settings['inner_text'] ) {
				$classes_progress_bar[] = 'inner-text-disabled';
			}
		}

		$classes_progress_bar = array_map( 'esc_attr', $classes_progress_bar );

		$fill = '{ "color": "##6ec1e4"}';

		if ( 'classic' === $settings['fill_background'] ) {
			$fill = '{ "color": "' . $settings['fill_color'] . '"}';
		}

		if ( 'gradient' === $settings['fill_background'] ) {
			$fill = '{ "gradient": ["' . $settings['fill_color'] . '", "' . $settings['fill_color_b'] . '"] }';
		}

		$this->add_render_attribute(
			'progress_bar',
			array(
				'class'          => esc_attr( join( ' ', $classes_progress_bar ) ),
				'data-start'     => esc_attr( $settings['percentage_start']['size'] ),
				'data-end'       => esc_attr( $settings['percentage_end']['size'] ),
				'data-max-width' => esc_attr( $settings['progress_bar_max_width']['size'] ),
				'data-thickness' => esc_attr( $settings['progress_bar_tickness']['size'] ),
				'data-duration'  => esc_attr( $settings['duration']['size'] ),
				'data-linecap'   => esc_attr( $settings['line_cap'] ),
				'data-emptyfill' => esc_attr( $settings['empty_fill'] ),
				'data-fill'      => esc_attr( $fill ),
			)
		);
		?>
		<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?>>
			<?php
			if ( 'yes' === $settings['circle'] ) {
				?>
				<div <?php echo wp_kses( $this->get_render_attribute_string( 'progress_bar' ), $allowed_attr_progress_bar ); ?>>
					<div class="uk-position-center">
					<?php
					if ( $settings['text'] && 'yes' === $settings['inner_text'] ) {
						?>
						<span class="elementive-progress-bar-inner-text uk-display-block uk-padding-remove-left"><?php echo esc_html( $settings['text'] ); ?></span>
						<?php
					}

					if ( 'yes' === $settings['display_percentage'] && $settings['percentage_end']['size'] ) {
						?>
						<span class="elementive-progress-bar-percentage uk-padding-remove-right"><?php echo esc_html( $settings['percentage_end']['size'] ); ?></span>
						<?php
					}
					?>
					</div>
				</div>
				<?php
				if ( $settings['title'] ) {
					?>
					<h3 class="elementive-progress-bar-title"><?php echo esc_html( $settings['title'] ); ?></h3>
					<?php
				}
			} else {
				?>
				<div class="elementive-progress-bar-top uk-position-relative">
				<?php
				if ( $settings['title'] ) {
					?>
					<h3 class="elementive-progress-bar-title"><?php echo esc_html( $settings['title'] ); ?></h3>
					<?php
				}

				if ( 'yes' !== $settings['inner_text'] && 'yes' === $settings['display_percentage'] && $settings['percentage_end']['size'] ) {
					?>
					<span class="elementive-progress-bar-percentage uk-position-center-right percentage-top"><?php echo esc_html( $settings['percentage_end']['size'] ); ?></span>
					<?php
				}
				?>
				</div>
				<div class="elementive-progress-bar-background uk-width-1-1 uk-position-relative">
					<div <?php echo wp_kses( $this->get_render_attribute_string( 'progress_bar' ), $allowed_attr_progress_bar ); ?> style="width:0;">
						<?php
						if ( 'yes' === $settings['inner_text'] && ( $settings['text'] || ( 'yes' === $settings['display_percentage'] && $settings['percentage_end']['size'] ) ) ) {
							if ( $settings['text'] && 'yes' === $settings['inner_text'] ) {
								?>
								<span class="elementive-progress-bar-inner-text uk-text-truncate uk-position-center-left"><?php echo esc_html( $settings['text'] ); ?></span>
								<?php
							}

							if ( 'yes' === $settings['display_percentage'] && $settings['percentage_end']['size'] ) {
								?>
								<span class="elementive-progress-bar-percentage uk-position-center-right"><?php echo esc_html( $settings['percentage_end']['size'] ); ?></span>
								<?php
							}
						}
						?>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}
