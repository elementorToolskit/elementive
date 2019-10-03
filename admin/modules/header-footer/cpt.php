<?php 
namespace Elementive\Modules\HeaderFooterBuilder;

defined( 'ABSPATH' ) || exit;

class Cpt{

    public function __construct() {
        $this->post_type(); 

        add_action('admin_menu', [$this, 'cpt_menu']);
        add_filter( 'single_template', [ $this, 'load_canvas_template' ] );
    }

    public function post_type() {
        
		$labels = array(
			'name'               => __( 'Templates', 'elementive' ),
			'singular_name'      => __( 'Template', 'elementive' ),
			'menu_name'          => __( 'My Templatesr', 'elementive' ),
			'name_admin_bar'     => __( 'Templates', 'elementive' ),
			'add_new'            => __( 'Add New', 'elementive' ),
			'add_new_item'       => __( 'Add New Template', 'elementive' ),
			'new_item'           => __( 'New Template', 'elementive' ),
			'edit_item'          => __( 'Edit Template', 'elementive' ),
			'view_item'          => __( 'View Template', 'elementive' ),
			'all_items'          => __( 'All Templates', 'elementive' ),
			'search_items'       => __( 'Search Templates', 'elementive' ),
			'parent_item_colon'  => __( 'Parent Templates:', 'elementive' ),
			'not_found'          => __( 'No Templates found.', 'elementive' ),
			'not_found_in_trash' => __( 'No Templates found in Trash.', 'elementive' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'rewrite'             => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'page',
			'hierarchical'        => false,
			'supports'            => array( 'title', 'thumbnail', 'elementor' ),
		);

		register_post_type( 'elementive_template', $args );
    }

    public function cpt_menu(){
        $link_our_new_cpt = 'edit.php?post_type=elementive_template';
        add_submenu_page('elementive', esc_html__('My Templates', 'elementive'), esc_html__('My Templates', 'elementive'), 'manage_options', $link_our_new_cpt);
    }

    function load_canvas_template( $single_template ) {

		global $post;

		if ( 'elementive_template' == $post->post_type ) {

			$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

			if ( file_exists( $elementor_2_0_canvas ) ) {
				return $elementor_2_0_canvas;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}

		return $single_template;
	}
}

new Cpt();