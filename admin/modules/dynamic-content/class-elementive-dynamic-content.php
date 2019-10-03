<?php
namespace Elementive\Admin\Modules\Dynamic_Content;

defined( 'ABSPATH' ) || exit;

class Elementive_Dynamic_Content {

	public static function get_url() {
		return \Elementive::module_url() . 'dynamic-content/';
	}
	public static function get_dir() {
		return \Elementive::module_dir() . 'dynamic-content/';
	}

	public function __construct() {

		// Includes necessary files
		$this->include_files();
	}

	private function include_files() {
		// Controls_Manager
		include_once self::get_dir() . 'cpt.php';
		include_once self::get_dir() . 'cpt-api.php';

		new Cpt();
	}
}
