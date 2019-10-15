<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Flexi_WP_Ajax_Aid
 * @subpackage Flexi_WP_Ajax_Aid/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Flexi_WP_Ajax_Aid
 * @subpackage Flexi_WP_Ajax_Aid/public
 * @author     Eldorjon Juraev <eldor.thedeveloper@gmail.com>
 */
class Flexi_WP_Ajax_Aid_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    /**
     * The full template path name for shortcode template header.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $posts_header_template_path    The template path name.
     */
    private $posts_header_template_path;

    /**
     * The full template path name for shortcode template filter.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $posts_filter_template_path    The template path name.
     */
    private $posts_filter_template_path;

    /**
     * The full template path name for shortcode template body.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $posts_body_template_path    The template path name.
     */
    private $posts_body_template_path;

    /**
     * The full template path name for shortcode template pagination.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $posts_pagination_template_path    The template path name.
     */
    private $posts_pagination_template_path;

    /**
     * The full template path name for shortcode template footer.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $posts_footer_template_path    The template path name.
     */
    private $posts_footer_template_path;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->posts_header_template_path = 'flexi-wp-ajax-aid-shortcode-posts-header-template.php';
        $this->posts_filter_template_path = 'flexi-wp-ajax-aid-shortcode-posts-filters-template.php';
        $this->posts_body_template_path = 'flexi-wp-ajax-aid-shortcode-posts-body-template.php';
        $this->posts_pagination_template_path = 'flexi-wp-ajax-aid-shortcode-posts-pagination-template.php';
        $this->posts_footer_template_path = 'flexi-wp-ajax-aid-shortcode-posts-footer-template.php';
        
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flexi_WP_Ajax_Aid_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flexi_WP_Ajax_Aid_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flexi-wp-ajax-aid-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flexi_WP_Ajax_Aid_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flexi_WP_Ajax_Aid_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flexi-wp-ajax-aid-public.js', array( 'jquery' ), $this->version, false );

        wp_localize_script( $this->plugin_name, 'ajax_request', array(
           'ajax_url'         => admin_url( 'admin-ajax.php' ),
           'nonce'            => wp_create_nonce( $this->plugin_name . '-' . $this->version ),
           'current_page_url' => esc_url( get_permalink( get_the_ID() ) ), // link to the current page
        ) );
	}

	/**
     * The plugin shortcode
     *
     * @since  1.0.0
     */
    public function flexi_wp_ajax_aid_shortcodes_init() {
        
	    add_shortcode( 'fwpaa_shortcode_item', array( &$this, 'flexi_wp_ajax_aid_shortcode' ) );
    }

    /**
     * The plugin shortcode implementation
     *
     * @since  1.0.0
     * @return string The post content
     */
    public function flexi_wp_ajax_aid_shortcode( $atts = array(), $content = null, $tag = '' ) {

        // show the shortcode output ONLY on singular post page templates
        if ( ! is_singular() ) {

            return '';
        }

        // allow one shortcode per page
        static $already_run = false;

        if ( $already_run ) {

            return '';
        }

        $already_run = true;

        global $current_page_id;

        $current_page_id = get_the_ID();

    	// normalize attribute keys, lowercase
    	$atts = array_change_key_case( (array)$atts, CASE_LOWER );
        
        global $shortcode_id;

        $shortcode_id = isset( $atts[ 'item_id' ] ) ? sanitize_text_field( $atts[ 'item_id' ] ) : 0;

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $current_page_url = esc_url( get_permalink( $current_page_id ) );

        // let's get the shortcode post to access its properties
        $the_shortcode_query = new WP_Query( array(
	        	'p' => $shortcode_id,
	        	'post_type' => 'fwpaa_shortcode',
	        	'posts_per_page' => 1,
	        )
	    );

        // the shortcode NOT found
        if ( ! $the_shortcode_query->have_posts() ) {

            return '';
        }
		else {

            // start shortcode output
            $output = '';


            while ( $the_shortcode_query->have_posts() ) {

                $the_shortcode_query->the_post();
                
                // determine the post type to query for
                $post_type = ( $fwpaa_post_type = get_post_meta( $shortcode_id, '_fwpaa_post_type', true ) ) ? $fwpaa_post_type : 'post';
                $fwpaa_posts_per_page = ( $fwpaa_posts_per_page = get_post_meta( $shortcode_id, '_fwpaa_posts_per_page', true ) ) ? $fwpaa_posts_per_page : 10;

                $the_posts_query = new WP_Query( array(
                        'post_type' => $post_type,
                        'posts_per_page' => $fwpaa_posts_per_page,
                        'orderby' => 'post_date',
                        'order' => 'desc',
                        'paged' => $paged,
                    )
                );

                global $the_post_items_query;
                $the_post_items_query = $the_posts_query;


                // HEADER
                // get the buffered output and append it to the output
                $output .= flexi_wp_ajax_aid_get_template_html( $this->posts_header_template_path );


                // FILTERS
                // get the buffered output and append it to the output
                $output .= flexi_wp_ajax_aid_get_template_html( $this->posts_filter_template_path );


                // PAGINATION
                // let's build pagination
                $args = array(
                    'total' => $the_posts_query->max_num_pages,
                    'current' => max( 1, $paged ),
                    'type' => 'array',
                    'prev_next' => true,
                    'prev_text' => __( '&larr;' ),
                    'next_text' => __( '&rarr;' ),
                );

                // pretty permalinks are NOT being used
                if ( ! get_option( 'permalink_structure' ) ) {

                    $args[ 'base' ] = $current_page_url . '%_%';
                    $args[ 'format' ] = '&paged=%#%';
                }
                // pretty permalinks ARE being used
                else {

                    $is_slash = ( $current_page_url[ strlen( $current_page_url ) - 1 ] == '/' ) ? '' : '/';
                    $args[ 'base' ] = $current_page_url . '%_%';
                    $args[ 'format' ] = $is_slash . 'page/%#%/';
                }

                global $_page_links;
                $_page_links = paginate_links( $args );

                // get the buffered output and append it to the output
                $output .= $pagination_links = flexi_wp_ajax_aid_get_template_html( $this->posts_pagination_template_path );


                // BODY
                // get the buffered output and append it to the output
                $output .= flexi_wp_ajax_aid_get_template_html( $this->posts_body_template_path );


                // get the buffered output and append it to the output
                $output .= $pagination_links;
                

                // FOOTER
                // get the buffered output and append it to the output
                $output .= flexi_wp_ajax_aid_get_template_html( $this->posts_footer_template_path );
            }

            // end shortcode output
            $output .= '';
		}

        // enclosing tags
        if ( ! is_null( $content ) ) {

            // secure output by executing the_content filter hook on $content
            $output .= apply_filters( 'the_content', $content );
        }

        // always return
        return $output;
    }

    /**
     * AJAX handler function for the plugin
     *
     * @since  1.0.0
     * @return JSON Ajax response for the request
     */
    public function get_posts_ajax_handler() {

        // handle the ajax request
        check_ajax_referer( $this->plugin_name . '-' . $this->version, 'security' );
        
        global $shortcode_id;

        $shortcode_id = $_POST[ 'fwpaa_shortcode_id' ];
        
        $paged = ( $_POST[ 'page' ] ) ? $_POST[ 'page' ] : 1;
        
        $current_page_url = $_POST[ 'current_page_url' ];

        // let's get the shortcode post to access its properties
        $the_shortcode_query = new WP_Query( array(
                'p' => $shortcode_id,
                'post_type' => 'fwpaa_shortcode',
                'posts_per_page' => 1,
            )
        );

        // start output
        $posts_html = '';
        $pagination_html = '';
        
        if ( $the_shortcode_query->have_posts() ) {

            while ( $the_shortcode_query->have_posts() ) {

                $the_shortcode_query->the_post();

                // determine the post type to query for
                $post_type = ( $fwpaa_post_type = get_post_meta( $shortcode_id, '_fwpaa_post_type', true ) ) ? $fwpaa_post_type : 'post';
                $fwpaa_posts_per_page = ( $fwpaa_posts_per_page = get_post_meta( $shortcode_id, '_fwpaa_posts_per_page', true ) ) ? $fwpaa_posts_per_page : 10;

                $the_posts_query = new WP_Query( array(
                        'post_type' => $post_type,
                        'posts_per_page' => $fwpaa_posts_per_page,
                        'orderby' => 'post_date',
                        'order' => 'desc',
                        'paged' => $paged,
                    )
                );

                // BODY
                global $the_post_items_query;
                $the_post_items_query = $the_posts_query;

                // get the buffered output and append it to the output
                $posts_html .= flexi_wp_ajax_aid_get_template_html( $this->posts_body_template_path );
            

                // PAGINATION
                // let's build pagination
                $args = array(
                    'total' => $the_posts_query->max_num_pages,
                    'current' => max( 1, $paged ),
                    'type' => 'array',
                    'prev_next' => true,
                    'prev_text' => __( '&larr;' ),
                    'next_text' => __( '&rarr;' ),
                );

                // pretty permalinks are NOT being used
                if ( ! get_option( 'permalink_structure' ) ) {

                    $args[ 'base' ] = $current_page_url . '%_%';
                    $args[ 'format' ] = '&paged=%#%';
                }
                // pretty permalinks ARE being used
                else {

                    $is_slash = ( $current_page_url[ strlen( $current_page_url ) - 1 ] == '/' ) ? '' : '/';
                    $args[ 'base' ] = $current_page_url . '%_%';
                    $args[ 'format' ] = $is_slash . 'page/%#%/';
                }

                global $_page_links;
                $_page_links = paginate_links( $args );

                // get the buffered output and append it to the output
                $pagination_html = flexi_wp_ajax_aid_get_template_html( $this->posts_pagination_template_path );
            }
        }

        echo json_encode( array(
                'posts_html' => $posts_html,
                'pagination_html' => $pagination_html,
            )
        );

        wp_die();
    }
}
