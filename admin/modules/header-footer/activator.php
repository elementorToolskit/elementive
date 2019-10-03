<?php 
namespace Elementive\Modules\Header_Footer;

defined( 'ABSPATH' ) || exit;

class Activator {
    public static $instance = null;

    protected $templates;
    public $header_template;
    public $footer_template;

    protected $current_theme;
    protected $current_template;

    protected $post_type = 'elementive_template';

    public function __construct() {
        add_action( 'wp', array( $this, 'hooks' ) );
    }

    public function hooks(){
        $this->current_template = basename(get_page_template_slug());
        if($this->current_template == 'elementor_canvas'){
            return;
        }

        $this->current_theme = get_template();

        switch($this->current_theme){
            case 'astra':
              new Theme_Hooks\Astra(self::template_ids());
            break;

            case 'generatepress':
              new Theme_Hooks\Generatepress(self::template_ids());
            break;

            case 'oceanwp':
              new Theme_Hooks\Oceanwp(self::template_ids());
            break;

            case 'bb-theme':
              new Theme_Hooks\Bbtheme(self::template_ids());
            break;

            case 'genesis':
              new Theme_Hooks\Genesis(self::template_ids());
            break;

            default:
              new Theme_Hooks\Theme_Support(self::template_ids());
            break;
        }
    }

    public static function template_ids(){
        $cached = wp_cache_get( 'elementive_template_ids' );
		if ( false !== $cached ) {
			return $cached;
        }
        
        $instance = self::instance();
        $instance->the_filter();

        $ids = [
            $instance->header_template,
            $instance->footer_template,
        ];

        wp_cache_set( 'elementive_template_ids', $ids );
        return $ids;
    }


    protected function the_filter(){
        $arg = [
            'posts_per_page'   => -1,
            'orderby'          => 'id',
            'order'            => 'DESC',
            'post_status'      => 'publish',
            'post_type'        => $this->post_type,
            'meta_query' => [
                [
                    'key'     => 'elementive_template_activation',
                    'value'   => 'yes',
                    'compare' => '=',
                ],
            ],
        ];
        $this->templates = get_posts($arg);

        // entire site
        if(!is_admin()){
            $this->get_header_footer();
        }
    }

    protected function get_header_footer(){
        if($this->templates != null){
            foreach($this->templates as $template){
                $template = $this->get_full_data($template);
                $match_found = true;

                if($match_found == true){
                    if($template['type'] == 'header'){
                        $this->header_template = $template['ID'];
                    }
                    if($template['type'] == 'footer'){
                        $this->footer_template = $template['ID'];
                    }
                }
            }
        }
    }

    protected function get_full_data($post){
        if($post != null){
            return array_merge((array)$post, [
                'type' => get_post_meta($post->ID, 'elementive_template_type', true),
            ]);
        }
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}