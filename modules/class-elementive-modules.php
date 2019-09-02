<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dimative.com
 * @since      1.0.0
 *
 * @package    Elementive
 * @subpackage Elementive/public
 */

namespace Elementive\Modules;

use Elementive\Modules\Starter\Elementive_Module_Starter;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Elementive
 * @subpackage Elementive/widgets
 * @author     Dimative <contact@dimative.com>
 */
class Elementive_Modules {

	/**
	 * Widgets Scripts.
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function elementive_is_module_active() {
		// TODO: After admin page, will make it.
	}

	/**
	 * Include Modules
	 */
	public function __construct() {
		new Elementive_Module_Starter();
	}
}
