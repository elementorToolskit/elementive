<?php
namespace Elementive\Admin\Modules\Library;

use Elementive\Admin\Modules\Library\Manager\Elementive_Manager_API;

defined( 'ABSPATH' ) || exit;

class Elementive_Template_Library {
	private $dir;
	private $url;

	public function __construct() {

		// get current directory path.
		$this->dir = dirname( __FILE__ ) . '/';

		// get current module's url.
		$this->url = ELEMENTIVE_MODULES_ADMIN_PATH . 'library/';

		// enqueue editor js for elementor.
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'editor_scripts' ), 1 );

		// print views and tab variables on footer.
		add_action( 'elementor/editor/footer', array( $this, 'admin_inline_js' ) );
		add_action( 'elementor/editor/footer', array( $this, 'print_views' ) );

		// enqueue editor css.
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_styles' ) );

		// enqueue modal's preview css.
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles' ) );

		// call api manager.
		new Elementive_Manager_API();
	}

	public function editor_scripts() {
		wp_enqueue_script(
			'elementive-library-editor-script',
			$this->url . 'assets/js/editor.js',
			array( 'jquery', 'underscore', 'backbone-marionette' ),
			ELEMENTIVE_VERSION,
			true
		);
	}

	public function editor_styles() {
		wp_enqueue_style( 'elementive-library-editor-style', $this->url . 'assets/css/editor.css', array(), ELEMENTIVE_VERSION );
	}

	public function preview_styles() {
		wp_enqueue_style( 'elementive-library-preview-style', $this->url . 'assets/css/preview.css', array(), ELEMENTIVE_VERSION );
	}

	public function admin_inline_js() { ?>
		<script type="text/javascript" >

		var ElementiveLibreryData = {
			"libraryButton": "Elements Button",
			"modalRegions": {
				"modalHeader": ".dialog-header",
				"modalContent": ".dialog-message"
			},
			"license": {
				"activated": true,
				"link": ""
			},
			"tabs": {
				"elementive_page": {
					"title": "Ready Pages",
					"data": [],
					"sources": ["elementive-theme", "elementive-api"],
					"settings": {
						"show_title": true,
						"show_keywords": true
					}
				},
				"elementive_header": {
					"title": "Headers",
					"data": [],
					"sources": ["elementive-theme", "elementive-api"],
					"settings": {
						"show_title": false,
						"show_keywords": true
					}
				},
				"elementive_footer": {
					"title": "Footers",
					"data": [],
					"sources": ["elementive-theme", "elementive-api"],
					"settings": {
						"show_title": false,
						"show_keywords": true
					}
				},
				"elementive_section": {
					"title": "Sections",
					"data": [],
					"sources": ["elementive-theme", "elementive-api"],
					"settings": {
						"show_title": false,
						"show_keywords": true
					}
				},
				"elementive_widget": {
					"title": "Widget Presets",
					"data": [],
					"sources": ["elementive-theme", "elementive-api"],
					"settings": {
						"show_title": false,
						"show_keywords": true
					}
				},
				// "local": {
				// 	"title": "My Library",
				// 	"data": [],
				// 	"sources": ["elementive-local"],
				// 	"settings": []
				// }
			},
			"defaultTab": "elementive_page"
		};

		</script> 
		<?php
	}

	public function print_views() {
		foreach ( glob( $this->dir . 'views/editor/*.php' ) as $file ) {
			$name = basename( $file, '.php' );
			ob_start();
			include $file;
			printf( '<script type="text/html" id="view-elementive-%1$s">%2$s</script>', $name, ob_get_clean() );
		}
	}
}
