<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Flexi_WP_Ajax_Aid
 * @subpackage Flexi_WP_Ajax_Aid/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Flexi_WP_Ajax_Aid
 * @subpackage Flexi_WP_Ajax_Aid/includes
 * @author     Eldorjon Juraev <eldor.thedeveloper@gmail.com>
 */
class Flexi_WP_Ajax_Aid {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Flexi_WP_Ajax_Aid_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'Flexi_WP_Ajax_Aid_VERSION' ) ) {
			$this->version = Flexi_WP_Ajax_Aid_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'flexi-wp-ajax-aid';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Flexi_WP_Ajax_Aid_Loader. Orchestrates the hooks of the plugin.
	 * - Flexi_WP_Ajax_Aid_i18n. Defines internationalization functionality.
	 * - Flexi_WP_Ajax_Aid_Admin. Defines all hooks for the admin area.
	 * - Flexi_WP_Ajax_Aid_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flexi-wp-ajax-aid-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-flexi-wp-ajax-aid-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-flexi-wp-ajax-aid-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-flexi-wp-ajax-aid-public.php';

		$this->loader = new Flexi_WP_Ajax_Aid_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Flexi_WP_Ajax_Aid_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Flexi_WP_Ajax_Aid_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Flexi_WP_Ajax_Aid_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'flexi_wp_ajax_aid_top_level_menu' );
		$this->loader->add_action( 'init', $plugin_admin, 'flexi_wp_ajax_aid_custom_post_type' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'flexi_wp_ajax_aid_custom_post_type_add_new_item_submenu' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'flexi_wp_ajax_aid_remove_post_slug_meta_box' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'flexi_wp_ajax_aid_shortcode_parameters_meta_box' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'flexi_wp_ajax_aid_generated_shortcode_meta_box' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'flexi_wp_ajax_aid_save_post', 10, 3 );
		$this->loader->add_action( 'before_delete_post', $plugin_admin, 'flexi_wp_ajax_aid_before_delete_post', 10, 1 );
		$this->loader->add_action( 'admin_head', $plugin_admin, 'flexi_wp_ajax_aid_css_styles' );
		$this->loader->add_action( 'post_row_actions', $plugin_admin, 'flexi_wp_ajax_aid_disable_unnecessary_post_list_links', 10, 1 );
		$this->loader->add_action( 'manage_edit-fwpaa_shortcode_columns', $plugin_admin, 'flexi_wp_ajax_aid_fwpaa_shortcode_column', 10, 1 );
		$this->loader->add_action( 'manage_fwpaa_shortcode_posts_custom_column', $plugin_admin, 'flexi_wp_ajax_aid_manage_fwpaa_shortcode_column', 10, 2 );
		$this->loader->add_action( 'bulk_actions-edit-fwpaa_shortcode', $plugin_admin, 'flexi_wp_ajax_aid_remove_edit_from_bulk_actions', 10, 1 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Flexi_WP_Ajax_Aid_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'flexi_wp_ajax_aid_shortcodes_init' );
		$this->loader->add_action( 'wp_ajax_nopriv_get_posts_ajax_handler', $plugin_public, 'get_posts_ajax_handler' );
		$this->loader->add_action( 'wp_ajax_get_posts_ajax_handler', $plugin_public, 'get_posts_ajax_handler' );
		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Flexi_WP_Ajax_Aid_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
