<?php 
namespace Elementive\Modules\Dynamic_Content;

defined( 'ABSPATH' ) || exit;

class Cpt{

    public function __construct() {
        $this->post_type();  
    }

    public function post_type() {
        
        $labels = array(
            'name'                  => _x( 'Elementskit items', 'Post Type General Name', 'elementive' ),
            'singular_name'         => _x( 'Elementskit item', 'Post Type Singular Name', 'elementive' ),
            'menu_name'             => esc_html__( 'Elementskit item', 'elementive' ),
            'name_admin_bar'        => esc_html__( 'Elementskit item', 'elementive' ),
            'archives'              => esc_html__( 'Item Archives', 'elementive' ),
            'attributes'            => esc_html__( 'Item Attributes', 'elementive' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'elementive' ),
            'all_items'             => esc_html__( 'All Items', 'elementive' ),
            'add_new_item'          => esc_html__( 'Add New Item', 'elementive' ),
            'add_new'               => esc_html__( 'Add New', 'elementive' ),
            'new_item'              => esc_html__( 'New Item', 'elementive' ),
            'edit_item'             => esc_html__( 'Edit Item', 'elementive' ),
            'update_item'           => esc_html__( 'Update Item', 'elementive' ),
            'view_item'             => esc_html__( 'View Item', 'elementive' ),
            'view_items'            => esc_html__( 'View Items', 'elementive' ),
            'search_items'          => esc_html__( 'Search Item', 'elementive' ),
            'not_found'             => esc_html__( 'Not found', 'elementive' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'elementive' ),
            'featured_image'        => esc_html__( 'Featured Image', 'elementive' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'elementive' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'elementive' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'elementive' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'elementive' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'elementive' ),
            'items_list'            => esc_html__( 'Items list', 'elementive' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'elementive' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'elementive' ),
        );
        $rewrite = array(
            'slug'                  => 'elementive-content',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__( 'Elementskit item', 'elementive' ),
            'description'           => esc_html__( 'elementive_content', 'elementive' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'elementor', 'permalink' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => false,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'publicly_queryable' => true,
            'rewrite'               => $rewrite,
            'query_var' => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            'rest_base'             => 'elementive-content',
        );
        register_post_type( 'elementive_content', $args );
    }

    public function flush_rewrites() {
        $this->post_type();
        flush_rewrite_rules();
    }
}