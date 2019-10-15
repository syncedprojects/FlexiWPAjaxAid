<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Flexi_WP_Ajax_Aid
 * @subpackage Flexi_WP_Ajax_Aid/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Flexi_WP_Ajax_Aid
 * @subpackage Flexi_WP_Ajax_Aid/admin
 * @author     Eldorjon Juraev <eldor.thedeveloper@gmail.com>
 */
class Flexi_WP_Ajax_Aid_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flexi-wp-ajax-aid-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flexi-wp-ajax-aid-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the plugin menu item in the admin area
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_top_level_menu() {

		// plugin main top level menu
	    add_menu_page(
	        __( 'Flexi WP Stuff', 'flexi-wp-ajax-aid' ),
	        __( 'Flexi WP Stuff', 'flexi-wp-ajax-aid' ),
	        'manage_options',
	        'flexi-wp-ajax-aid-settings',
	        array( &$this, 'flexi_wp_ajax_aid_top_level_menu_page_html' ), // function() { require_once plugin_dir_path( __FILE__ ) . 'partials/flexi-wp-ajax-aid-admin-display.php'; },
	        'dashicons-screenoptions', // plugin_dir_url( __FILE__ ) . 'images/icon_wporg.png',
	        200
	    );

	}

	/**
	 * Load the actual plugin page template
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_top_level_menu_page_html() {

		require_once plugin_dir_path( __FILE__ ) . 'partials/flexi-wp-ajax-aid-admin-display.php';
	}

	/**
	 * Register a 'flexi wp ajax aid shortcode' post type
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_custom_post_type() {

		register_post_type( 'fwpaa_shortcode',
            array(
                'labels' 			   => array(
			        'name'                  => _x( 'FWPAA shortcodes', 'Post type general name', 'flexi-wp-ajax-aid' ),
			        'singular_name'         => _x( 'FWPAA shortcode', 'Post type singular name', 'flexi-wp-ajax-aid' ),
			        'menu_name'             => _x( 'FWPAA shortcodes', 'Admin Menu text', 'flexi-wp-ajax-aid' ),
			        'name_admin_bar'        => _x( 'FWPAA shortcode', 'Add New on Toolbar', 'flexi-wp-ajax-aid' ),
			        'add_new'               => __( 'Add New', 'flexi-wp-ajax-aid' ),
			        'add_new_item'          => __( 'Add New FWPAA shortcode', 'flexi-wp-ajax-aid' ),
			        'new_item'              => __( 'New FWPAA shortcode', 'flexi-wp-ajax-aid' ),
			        'edit_item'             => __( 'Edit FWPAA shortcode', 'flexi-wp-ajax-aid' ),
			        'view_item'             => __( 'View FWPAA shortcode', 'flexi-wp-ajax-aid' ),
			        'all_items'             => __( 'FWPAA shortcodes', 'flexi-wp-ajax-aid' ),
			        'search_items'          => __( 'Search FWPAA shortcodes', 'flexi-wp-ajax-aid' ),
			        'parent_item_colon'     => __( 'Parent FWPAA shortcodes:', 'flexi-wp-ajax-aid' ),
			        'not_found'             => __( 'No FWPAA shortcodes found.', 'flexi-wp-ajax-aid' ),
			        'not_found_in_trash'    => __( 'No FWPAA shortcodes found in Trash.', 'flexi-wp-ajax-aid' ),
			        'filter_items_list'     => _x( 'Filter FWPAA shortcodes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'flexi-wp-ajax-aid' ),
			        'items_list_navigation' => _x( 'FWPAA shortcodes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'flexi-wp-ajax-aid' ),
			        'items_list'            => _x( 'FWPAA shortcodes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'flexi-wp-ajax-aid' ),
			    ),
                'description'          => __( 'A helper post type for Flexi WP Ajax Aid Plugin' ),
	            'public'               => false,
	            'hierarchical'         => false,
	            'exclude_from_search'  => true,
	            'publicly_queryable'   => true,
	            'show_ui'              => true,
	            // show all 'fwpaa shortcodes' in Flexi WP Ajax Aid top-level menu
	            'show_in_menu'         => 'flexi-wp-ajax-aid-settings',
	            'show_in_nav_menus'    => false,
	            'show_in_admin_bar'    => false,
	            'show_in_rest'         => false,
	            'menu_position'        => 1,
	            'menu_icon' 		   => 'none',
	            'supports' 			   => array( 'title' ),
	            'register_meta_box_cb' => null,
	            'taxonomies'		   => array(),
	            'has_archive'		   => false,
	            'rewrite'			   => false,
            )
	    );

	}

	/**
	 * Add a 'Add new shortcode' submenu item to plugin's top level menu
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_custom_post_type_add_new_item_submenu() {

		// add new 'fwpaa shortcode' submenu
	    add_submenu_page(
	        'flexi-wp-ajax-aid-settings',
	        __( 'Add new FWPAA shortcode', 'flexi-wp-ajax-aid' ),
	        __( 'Add new shortcode', 'flexi-wp-ajax-aid' ),
	        'manage_options',
	        'post-new.php?post_type=fwpaa_shortcode'
	    );
	}

	/**
	 * Remove post slug metabox, as it's not necessary
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_remove_post_slug_meta_box() {
		
        remove_meta_box( 'slugdiv', 'fwpaa_shortcode', 'normal' );
	}

	/**
	 * Add shortcode parameters metabox on fwpaa_shortcode edit page
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_shortcode_parameters_meta_box() {

		add_meta_box(
            'flexi_wp_ajax_aid_shortcode_parameters_meta_box_id',
            __( 'Shortcode Parameters', 'flexi-wp-ajax-aid' ),
            array( &$this, 'flexi_wp_ajax_aid_shortcode_parameters_meta_box_html' ),
            'fwpaa_shortcode'
        );

	}

	/**
	 * Load the actual shortcode parameters metabox html
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_shortcode_parameters_meta_box_html() {

	    require_once plugin_dir_path( __FILE__ ) . 'partials/flexi-wp-ajax-aid-shortcode-parameters-meta-box-html.php';
	}

	/**
	 * Add generated shortcode metabox on fwpaa_shortcode edit page
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_generated_shortcode_meta_box() {

		global $post;

		if ( ! isset( $post ) ) {

			return;
		}

	    $fwpaa_post_type = get_post_meta( $post->ID, '_fwpaa_post_type', true );

	    if ( isset( $fwpaa_post_type ) && ! empty( $fwpaa_post_type ) ) {

			add_meta_box(
	            'flexi_wp_ajax_aid_generated_shortcode_meta_box_id',
	            __( 'Generated Shortcode', 'flexi-wp-ajax-aid' ),
	            array( &$this, 'flexi_wp_ajax_aid_generated_shortcode_meta_box_html' ),
	            'fwpaa_shortcode'
	        );
	    }

	}

	/**
	 * Load the actual generated shortcode metabox html
	 * 
	 * @since 1.0.0
	 */
	public function flexi_wp_ajax_aid_generated_shortcode_meta_box_html() {

	    require_once plugin_dir_path( __FILE__ ) . 'partials/flexi-wp-ajax-aid-generated-shortcode-meta-box-html.php';
	}

	/**
	 * Update fwpaa_shortcode metadata
	 * 
	 * @since  1.0.0
	 * @param  int     $post_id Post ID.
	 * @param  WP_Post $post    Post object.
	 * @param  bool    $update  Whether this is an existing post being updated or not.
	 * @return void
	 */
	public function flexi_wp_ajax_aid_save_post( $post_id, $post, $update ) {

		// If this is just a revision, return
		if ( wp_is_post_revision( $post_id ) ) {

			return;
		}

		// If this isn't a 'fwpaa_shortcode' post type, return
		if ( 'fwpaa_shortcode' != $post->post_type ) {

			return;
		}

		// let's continue to saving postmeta data
		if ( isset( $_POST[ 'fwpaa_post_type' ] ) && ! empty( $_POST[ 'fwpaa_post_type' ] ) ) {

			if ( $update ) {

				update_post_meta( $post_id, '_fwpaa_post_type', sanitize_text_field( $_POST[ 'fwpaa_post_type' ] ) );
				update_post_meta( $post_id, '_fwpaa_posts_per_page', sanitize_text_field( $_POST[ 'fwpaa_posts_per_page' ] ) );
			}
			else {

				add_post_meta( $post_id, '_fwpaa_post_type', sanitize_text_field( $_POST[ 'fwpaa_post_type' ] ), true );
				add_post_meta( $post_id, '_fwpaa_posts_per_page', sanitize_text_field( $_POST[ 'fwpaa_posts_per_page' ] ), true );
			}
		}
	}

	/**
	 * Delete fwpaa_shortcode
	 *
	 * @since  1.0.0
	 * @param  int   $post_id Post ID.
	 * @return void
	 */
	public function flexi_wp_ajax_aid_before_delete_post( $post_id ) {

	    global $post_type;

		// If this isn't a 'fwpaa_shortcode' post type, return
	    if ( $post_type != 'fwpaa_shortcode' ) {

	    	return;
	    }

	    delete_post_meta( $post_id, '_fwpaa_post_type' );
	    delete_post_meta( $post_id, '_fwpaa_posts_per_page' );
	}

	/**
	 * Hides with CSS the publishing options for the types page and cpt_portfolio
	 *
	 * @since  1.0.0
	 */
	public function flexi_wp_ajax_aid_css_styles() {
	 
	    $screen = get_current_screen();
	 
	    if ( in_array( $screen->id, array( 'fwpaa_shortcode' ) ) ) {
	 
	        echo '<style>#minor-publishing, .wrap #message.notice a { display: none; }</style>';
	    }
	}

	/**
	 * Remove unnecessary post list hover links for this post type
	 *
	 * @since  1.0.0
	 * @param  array $actions Post action links on hover
	 * @return array Post action links on hover (without specified links)
	 */
	public function flexi_wp_ajax_aid_disable_unnecessary_post_list_links( $actions = array() ) {

	    // Abort if the post type is not "fwpaa_shortcode"
	    global $pagenow, $typenow;

	    if ( 'fwpaa_shortcode' === $typenow && 'edit.php' === $pagenow ) {

		    // Remove the Quick Edit and View links
		    if ( isset( $actions[ 'inline hide-if-no-js' ] ) ) {

		        unset( $actions[ 'inline hide-if-no-js' ] );
		    }
		    if ( isset( $actions[ 'view' ] ) ) {
		    	
		        unset( $actions[ 'view' ] );
		    }
	    }

	    // Return the set of links
	    return $actions;
	}


	/**
	 * Add custom "shortcode" column title to the custom post type archive page in admin
	 *
	 * @since  1.0.0
	 * @param  mixed $columns Post type table columns
	 * @return mixed Post type table customized columns
	 */
	function flexi_wp_ajax_aid_fwpaa_shortcode_column( $columns ) {

		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Shortcode title', 'flexi-wp-ajax-aid' ),
			'shortcode_item' => __( 'Shortcode', 'flexi-wp-ajax-aid' ),
			'date' => __( 'Date', 'flexi-wp-ajax-aid' ),
		);

		return $columns;
	}

	/**
	 * Add custom "shortcode" column values to the custom post type archive page in admin
	 * 
	 * @since  1.0.0
	 * @param  string $column  Table column slug
	 * @param  int    $post_id Post ID
	 * @return void
	 */
	public function flexi_wp_ajax_aid_manage_fwpaa_shortcode_column( $column, $post_id ) {

		global $post;

		switch( $column ) {

			// if displaying the 'shortcode_item' column
			case 'shortcode_item':

				// display the shortcode
				_e( '<input type="text" class="post-attributes-fwpaa_generated_shortcode" value=\'[fwpaa_shortcode_item item_id="'.$post_id.'"]\' onclick="this.select();" readonly="readonly">' );

				break;

			// just break out of the switch statement for everything else
			default:
				break;
		}
	}

	/**
	 * Remove 'edit' option from bulk actions on the custom post type archive page in admin
	 *
	 * @since  1.0.0
	 * @param  mixed $actions Bulk actions
	 * @return mixed Bulk actions without edit option
	 */
    public function flexi_wp_ajax_aid_remove_edit_from_bulk_actions( $actions ) {
        
        if ( isset( $actions[ 'edit' ] ) ) {

	        unset( $actions[ 'edit' ] );
        }

        return $actions;
    }

}
