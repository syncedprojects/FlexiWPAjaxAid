<?php

/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Flexi_WP_Ajax_Aid
 * @subpackage Flexi_WP_Ajax_Aid/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
?>
<div class="wrap">
    <h1><?php esc_html_e( get_admin_page_title() ); ?></h1>
</div>