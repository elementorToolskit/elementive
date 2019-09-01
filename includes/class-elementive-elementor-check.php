<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dimative.com
 * @since      1.0.0
 *
 * @package    Elementive
 * @subpackage Elementive/admin
 */

namespace Elementive\Includes;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Elementive
 * @subpackage Elementive/admin
 * @author     Dimative <contact@dimative.com>
 */
class Elementive_Elementor_Check {

	/**
	 * If Elementor Does not installed this function will add message to Admin Notice.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'elementive_fail_load' ) );
			return;
		}
		$elementor_version_required = '1.0.6';
		if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'elementive_fail_load_out_of_date' ) );
			return;
		}
	}

	/**
	 * Show in WP Dashboard notice about the plugin is not activated.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function elementive_fail_load() {

		$screen = get_current_screen();

		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}

		$plugin = 'elementor/elementor.php';

		if ( $this->elementive_is_elementor_installed() ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}
			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
			$message        = '<p>' . __( 'Elementive is not working because you need to activate the Elementor plugin.', 'elementive' ) . '</p>';
			$message       .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'elementive' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}
			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
			$message     = '<p>' . __( 'Elementive is not working because you need to install the Elemenor plugin', 'elementive' ) . '</p>';
			$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'elementive' ) ) . '</p>';
		}

		echo '<div class="error"><p>' . $message . '</p></div>';
	}

	/**
	 * Show in WP Dashboard notice about the plugin is not updated.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function elementive_fail_load_out_of_date() {
		if ( ! current_user_can( 'update_plugins' ) ) {
			return;
		}
		$file_path    = 'elementor/elementor.php';
		$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
		$message      = '<p>' . __( 'Elementive is not working because you are using an old version of Elementor.', 'elementive' ) . '</p>';
		$message     .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'elementive' ) ) . '</p>';
		echo '<div class="error">' . $message . '</div>';
	}

	/**
	 * Check Elementor is installed.
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	public function elementive_is_elementor_installed() {
		$file_path         = 'elementor/elementor.php';
		$installed_plugins = get_plugins();
		return isset( $installed_plugins[ $file_path ] );
	}

}
