<?php

/**
 * Provide an admin area view for the metabox
 *
 * This file is used to render the shortcode parameters
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

    $fwpaa_post_type = ( $type = get_post_meta( $post->ID, '_fwpaa_post_type', true ) ) ? $type : 'post';
    $fwpaa_posts_per_page = ( $per_page = get_post_meta( $post->ID, '_fwpaa_posts_per_page', true ) ) ? $per_page : 10;
    
    $args = array(
        'public' => true,
    );

    $post_types = get_post_types( $args, 'objects' );
?>

<p>
    <label class="post-attributes-label" for="fwpaa_post_type">
        <?php _e( 'Select what to show:', 'flexi-wp-ajax-aid' ); ?>
    </label>
    <br>
    <select name="fwpaa_post_type" id="fwpaa_post_type" class="postbox">
        <?php if ( isset( $post_types ) && ! empty( $post_types ) ): ?>
            <?php foreach ( $post_types as $item ): ?>
                <option <?php selected( $fwpaa_post_type, $item->name ); ?> value="<?php echo $item->name; ?>"><?php echo $item->label; ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</p>

<p>
    <label class="post-attributes-label" for="fwpaa_posts_per_page">
        <?php _e( 'Select how many items to show per page <br> (avoid too big amount):', 'flexi-wp-ajax-aid' ); ?>
    </label>
    <br>
    <input type="number" min="1" name="fwpaa_posts_per_page" id="fwpaa_posts_per_page" class="postbox" value="<?php echo $fwpaa_posts_per_page; ?>">
</p>
