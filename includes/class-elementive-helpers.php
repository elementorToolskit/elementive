<?php
/**
 * Helper functions for Elementive
 *
 * @link       https://dimative.com
 * @since      1.0.0
 *
 * @package    Elementive
 * @subpackage Elementive/includes
 */

namespace Elementive\Includes;

/**
 * Helper functions for Elementive.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Elementive
 * @subpackage Elementive/includes
 * @author     Dimative <contact@dimative.com>
 */
class Elementive_Helpers {

	/**
	 * This function will determine is color light or dark.
	 *
	 * @since    1.0.0
	 * @param string $color Color HEX code.
	 * @return boolean
	 */
	public static function elementive_is_hex_light( $color ) {

		if ( ! isset( $color ) ) {
			return;
		}

		if ( 4 === strlen( $color ) ) {
			$color = preg_replace( '/#([\da-f])([\da-f])([\da-f])/i', '#\1\1\2\2\3\3', $color );
		}

		$hex = str_replace( '#', '', $color );

		$c_r = hexdec( substr( $hex, 0, 2 ) );
		$c_g = hexdec( substr( $hex, 2, 2 ) );
		$c_b = hexdec( substr( $hex, 4, 2 ) );

		$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;

		if ( $brightness > 155 ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Determine whether a color type.
	 *
	 * @param string $color Color.
	 * @return boolean If color is RGBA, return true.
	 */
	public static function elementive_check_rgba( $color ) {
		if ( preg_match( '/^ *rgba\( *\d{1,3} *, *\d{1,3} *, *\d{1,3} *, *[0-1](\.\d{1,2})? *\) *$/i', $color ) ) {
			return true;
		}
	}

	/**
	 * Function for Color.
	 * Convert RGBA color to HEX
	 *
	 * @param string $color Color.
	 * @return string
	 */
	public static function elementive_convert_rgba_to_hex( $color ) {

		$value = explode( ',', str_replace( array( ' ', 'rgba', '(', ')' ), '', $color ) );
		$red   = ( isset( $value[0] ) ) ? intval( $value[0] ) : 255;
		$green = ( isset( $value[1] ) ) ? intval( $value[1] ) : 255;
		$blue  = ( isset( $value[2] ) ) ? intval( $value[2] ) : 255;

		// Limit values in the range of 0 - 255.
		$red   = max( 0, min( 255, $red ) );
		$green = max( 0, min( 255, $green ) );
		$blue  = max( 0, min( 255, $blue ) );

		$hex_red   = self::elementive_convert_dexhex_to_double_digit( $red );
		$hex_green = self::elementive_convert_dexhex_to_double_digit( $green );
		$hex_blue  = self::elementive_convert_dexhex_to_double_digit( $blue );

		return '#' . $hex_red . $hex_green . $hex_blue;
	}

	/**
	 * Function for color.
	 * Convert a decimal value to hex and make sure it's 2 characters.
	 *
	 * @param int|string $value The value to convert.
	 * @return string
	 */
	private static function elementive_convert_dexhex_to_double_digit( $value ) {
		$value = dechex( $value );
		if ( 1 === strlen( $value ) ) {
			$value = '0' . $value;
		}
		return $value;
	}

	/**
	 * Saved Template Selector.
	 * Will use this functio for select2 control.
	 *
	 * @return array
	 */
	public static function elementive_elementor_templates() {
		// WP_Query arguments.
		$options = [];
		$args    = [
			'post_type'   => [ 'elementor_library' ],
			'post_status' => [ 'publish' ],
			'nopaging'    => true,
			'order'       => 'ASC',
			'orderby'     => 'menu_order',
		];

		// The Query.
		$saved_templates = new \WP_Query( $args );

		// The Loop.
		if ( $saved_templates->have_posts() ) {
			while ( $saved_templates->have_posts() ) {
				$saved_templates->the_post();
				$id             = get_the_ID();
				$options[ $id ] = get_the_title();
			}
		} else {
			$options = [];
		}

		// Restore original Post Data.
		wp_reset_postdata();

		return $options;
	}

	/**
	 * Display selected post template.
	 *
	 * @param int $template_id Elementor template id.
	 * @return array
	 */
	public static function elementive_display_elementor_template( $template_id ) {

		if ( ! $template_id ) {
			return;
		}
		// WP_Query arguments.
		$args = [
			'post_type'   => [ 'elementor_library' ],
			'post_status' => [ 'publish' ],
			'p'           => $template_id,
			'nopaging'    => true,
			'order'       => 'ASC',
			'orderby'     => 'menu_order',
		];

		// The Query.
		$saved_templates = new \WP_Query( $args );

		// The Loop.
		if ( $saved_templates->have_posts() ) {
			while ( $saved_templates->have_posts() ) {
				the_content();
			}
		} else {
			esc_html_e( 'Template does not exists', 'elementive' );
		}

		// Restore original Post Data.
		wp_reset_postdata();
	}

}
