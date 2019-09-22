<?php
/**
 * Team Member Widget for Elementive
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
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

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
class Elementive_Widget_Team_Member extends Widget_Base {






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
		return 'elementive-team-member';
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
		return __( 'Elementive Team Member', 'elementive' );
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

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'elementive' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'name',
			array(
				'label' => __( 'Name', 'elementive' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'title',
			array(
				'label' => __( 'Title', 'elementive' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'elementive' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'default'     => '',
				'placeholder' => __( 'Type your description here', 'elementive' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			array(
				'label'   => __( 'Icon', 'elementive' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'social_url',
			array(
				'label'         => __( 'Link', 'elementive' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'elementive' ),
				'show_external' => true,
				'default' => array(
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				),
			)
		);

		$this->add_control(
			'social',
			array(
				'label'       => __( 'Social Icons', 'elementive' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(),
				'title_field' => '{{{ social_url }}}',
				'separator'   => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Image', 'elementive' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'image_content',
			array(
				'label'        => __( 'Content inside', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'image_content_name',
			array(
				'label'        => __( 'Name inside', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'image_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_content_title',
			array(
				'label'        => __( 'Title inside', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'image_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_content_description',
			array(
				'label'        => __( 'Description inside', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'image_content' => 'yes',
				),
			)
		);

		$this->add_control(
			'image_content_social',
			array(
				'label'        => __( 'Social inside', 'elementive' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementive' ),
				'label_off'    => __( 'No', 'elementive' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'image_content' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image_size',
				'default'   => 'medium',
				'separator' => 'none',
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
				'default' => 'uk-text-left',
				'toggle'  => true,
			)
		);

		$this->add_control(
			'image_margin',
			array(
				'label'      => __( 'Margin', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_padding',
			array(
				'label'      => __( 'Padding', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_radius',
			array(
				'label'      => __( 'Border radius', 'elementive' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .team-member-image' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'label'     => __( 'Border', 'elementive' ),
				'selector'  => '{{WRAPPER}} .team-member-image',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'image_background',
				'label'     => __( 'Background', 'elementive' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .team-member-image',
				'separator' => 'before',
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

		// Allowed Tags.
		$allowed_attr_link = array(
			'rel'    => array(),
			'target' => array(),
		);

		// Wrapper Classes.
		$classes_wrapper = array( 'elementive-team-member' );

		$classes_wrapper[] = esc_attr( $settings['alignment'] );

		$classes_wrapper = array_map( 'esc_attr', $classes_wrapper );

		$this->add_render_attribute(
			'wrapper',
			array(
				'class' => esc_attr( join( ' ', $classes_wrapper ) ),
			)
		);

		// Member Image Classes.
		$classes_image = array( 'elementive-member-image' );

		$classes_image = array_map( 'esc_attr', $classes_image );

		$this->add_render_attribute(
			'image',
			array(
				'class' => esc_attr( join( ' ', $classes_image ) ),
			)
		);

		// Member Content Classes.
		$classes_content = array( 'elementive-member-content' );

		$classes_content = array_map( 'esc_attr', $classes_content );

		$this->add_render_attribute(
			'content',
			array(
				'class' => esc_attr( join( ' ', $classes_content ) ),
			)
		);

		?>
		<div <?php echo wp_kses( $this->get_render_attribute_string( 'wrapper' ), $allowed_attr_class ); ?>>
			<div <?php echo wp_kses( $this->get_render_attribute_string( 'image' ), $allowed_attr_class ); ?>>
				<?php echo wp_get_attachment_image( $settings['image']['id'], $settings['image_size_size'], '', array( 'class' => 'team-member-image' ) ); ?>

				<?php
				if ( 'yes' === $settings['image_content'] && ( 'yes' === $settings['image_content_name'] || 'yes' === $settings['image_content_title'] || 'yes' === $settings['image_content_description'] || 'yes' === $settings['image_content_social'] ) ) {
					?>
					<div class="member-image-content uk-position-cover">
					<?php
					if ( 'yes' === $settings['image_content_name'] ) {
						?>
						<h3><?php echo esc_attr( $settings['name'] ); ?></h3>
						<?php
					}
					if ( 'yes' === $settings['image_content_title'] ) {
						?>
						<span><?php echo esc_attr( $settings['title'] ); ?></span>
						<?php
					}
					if ( 'yes' === $settings['image_content_description'] ) {
						?>
						<p><?php echo esc_attr( $settings['description'] ); ?></p>
						<?php
					}
					if ( 'yes' === $settings['image_content_social'] && $settings['social'] ) {
						?>
						<ul class="team-member-social">
						<?php
						foreach ( $settings['social'] as $social ) {
							$target   = $social['social_url']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $social['social_url']['nofollow'] ? ' rel="nofollow"' : '';
							?>
							<li>
								<a href="<?php echo esc_url( $social['social_url']['url'] ); ?>" <?php echo wp_kses( $target . $nofollow, $allowed_attr_link ); ?>>
									<?php Icons_Manager::render_icon( $social['social_icon'], array( 'aria-hidden' => 'true' ) ); ?>
								</a>
							</li>
							<?php
						}
						?>
						</ul>
						<?php
					}
					?>
					</div>
					<?php
				}
				?>
			</div>
			<div <?php echo wp_kses( $this->get_render_attribute_string( 'content' ), $allowed_attr_class ); ?>>
				<h3><?php echo esc_attr( $settings['name'] ); ?></h3>
				<span><?php echo esc_attr( $settings['title'] ); ?></span>
				<p><?php echo esc_attr( $settings['description'] ); ?></p>
				<?php
				if ( $settings['social'] ) {
					?>
					<ul class="team-member-social">
					<?php
					foreach ( $settings['social'] as $social ) {
						$target   = $social['social_url']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $social['social_url']['nofollow'] ? ' rel="nofollow"' : '';
						?>
						<li>
							<a href="<?php echo esc_url( $social['social_url']['url'] ); ?>" <?php echo wp_kses( $target . $nofollow, $allowed_attr_link ); ?>>
								<?php Icons_Manager::render_icon( $social['social_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</a>
						</li>
						<?php
					}
					?>
					</ul>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}

