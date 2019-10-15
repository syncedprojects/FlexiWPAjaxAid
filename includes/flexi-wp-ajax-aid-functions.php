<?php
/**
 * The core plugin functions. Also contains functions for admin and public.
 *
 * @since      1.0.0
 * @package    Flexi_WP_Ajax_Aid
 * @subpackage Flexi_WP_Ajax_Aid/includes
 * @author     Eldorjon Juraev <eldor.thedeveloper@gmail.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define constants.
 *
 * @since 1.0.0
 * @return  void
 */
function flexi_wp_ajax_aid_define_constants() {

    if ( ! defined( 'FLEXI_WP_AJAX_AID_URL' ) ) {

        define( 'FLEXI_WP_AJAX_AID_URL', plugins_url() . '/flexi-wp-ajax-aid' );
    }
    if ( ! defined( 'FLEXI_WP_AJAX_AID_MEDIA_URL' ) ) {

        define( 'FLEXI_WP_AJAX_AID_MEDIA_URL', plugins_url() . '/flexi-wp-ajax-aid/public/media' );
    }
}
add_action( 'plugins_loaded', 'flexi_wp_ajax_aid_define_constants' );

/**
 * Define constants.
 *
 * @since 1.0.0
 * @return  string  Flexi WP Ajax Aid media url
 */
function flexi_wp_ajax_aid_get_media_url() {

    if ( defined( 'FLEXI_WP_AJAX_AID_MEDIA_URL' ) ) {

        return FLEXI_WP_AJAX_AID_MEDIA_URL;
    }

    return '';
}

/**
 * Load template with the highest priority.
 *
 * Load the called template.
 * Search Order:
 * 1. /themes/theme/flexi-wp-ajax-aid-partials/$template_name
 * 2. /plugins/flexi-wp-ajax-aid/public/partials/$template_name.
 *
 * @since 1.0.0
 * @param   string  $template_name  Template to load.
 * @param   string  $template_path  Path to templates.
 * @param   string  $default_path   Default path to template files.
 * @return  string                  Path to the template file.
 */
function flexi_wp_ajax_aid_get_template( $template_name, $template_path = '', $default_path = '' ) {

    // Set variable to search in the templates folder of theme.
    if ( ! $template_path ) {

        $template_path = get_template_directory() . '/flexi-wp-ajax-aid-partials/';
    }
    
    // Set default plugin templates path.
    if ( ! $default_path ) {

        $default_path = plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/'; // Path to the template folder
    }

    // Search template file in theme folder.
    if ( file_exists( $template_path . $template_name ) ) {

        load_template( $template_path . $template_name );
    }
    else if ( file_exists( $default_path . $template_name ) ) {

        load_template( $default_path . $template_name );
    }
    else {

        printf( __( 'Template "%s" does not exist.', 'flexi-wp-ajax-aid' ), $template_name );
    }
}

/**
 * Return template as a string.
 *
 * @since 1.0.0
 * @param   string  $template_name  Template to load.
 * @return  string                  Template as a string.
 */
function flexi_wp_ajax_aid_get_template_html( $template_name ) {

    ob_start();
    flexi_wp_ajax_aid_get_template( $template_name );
    $output = ob_get_contents();
    ob_get_clean();

    return $output;
}

/**
 * on singular post view, when the URL contains '/page/XX/', the variable WordPress sets is
 * 'page' and not 'paged'. You may think to use 'page' instead of 'paged', but that will not
 * work either, because once the 'page' variable is intended to be used for multi-page
 * singular post (page separation using <!--nextpage-->) and once the post is not multi-page,
 * WordPress will redirect the request to the URL without '/page/XX/'. This is what happens
 * when you name your query variable $wp_query. The solution is to prevent that redirection
 * by removing the function responsible for it, which is 'redirect_canonical' hooked into
 * 'template_redirect':
 * 
 * source: // https://wordpress.stackexchange.com/questions/143812/wp-query-pagination-on-single-custom-php
 *
 * @since 1.0.0
 * @return void
 */
function flexi_wp_ajax_aid_template_redirect() {
    
    if ( is_singular() ) {

        global $wp_query;
        
        $page = (int)$wp_query->get( 'page' );
        
        if ( $page > 1 ) {

            $query->set( 'page', 1 );
            $query->set( 'paged', $page );
        }

        remove_action( 'template_redirect', 'redirect_canonical' );
    }
}
add_action( 'template_redirect', 'flexi_wp_ajax_aid_template_redirect', 0 );
