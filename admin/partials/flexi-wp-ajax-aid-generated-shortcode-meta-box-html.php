<?php

/**
 * Provide an admin area view for the metabox
 *
 * This file is used to render the generated shortcode
 * metabox on fwpaa_shortcode edit page of the plugin.
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

<?php
    global $post;
?>

<?php if ( isset( $post->ID ) ): ?>
    <p>
        <label class="post-attributes-label" for="fwpaa_generated_shortcode"><?php _e( 'Place this shortcode in the content editor:', 'flexi-wp-ajax-aid' ); ?></label><br>
        <input type="text" id="fwpaa_generated_shortcode" name="fwpaa_generated_shortcode" value="<?php esc_html_e( '[fwpaa_shortcode_item item_id="'.$post->ID.'"]' ); ?>" onclick="this.select();" readonly="readonly">
    </p>

    <p>
        <label class="post-attributes-label" for="fwpaa_generated_shortcode_php"><?php _e( 'Alternatively, you can place this php code snippet into your page template:', 'flexi-wp-ajax-aid' ); ?></label><br>
        <input type="text" id="fwpaa_generated_shortcode_php" name="fwpaa_generated_shortcode_php" value="<?php esc_html_e( '<?php echo do_shortcode( \'[fwpaa_shortcode_item item_id="'.$post->ID.'"]\' ); ?>' ); ?>" onclick="this.select();" readonly="readonly">
    </p>
<?php endif; ?>
