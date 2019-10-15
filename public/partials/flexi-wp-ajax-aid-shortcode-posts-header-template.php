<?php
    global $the_post_items_query;
?>

<div class="flexi-wp-ajax-aid-shortcode-div">
    <div class="flexi-wp-ajax-aid-orderby-div">
        <div class="availability-count">
            <span class="total-count"><?php echo isset( $the_post_items_query->found_posts ) ? $the_post_items_query->found_posts : '0'; ?></span>
            <span class="available-text"><?php _e( 'available', 'flexi-wp-ajax-aid' ); ?></span>
        </div>
        <select class="flexi-wp-ajax-aid-orderby-select">
            <option value="post_date|desc"><?php esc_html_e( 'Date created descending', 'flexi-wp-ajax-aid' ); ?></option>
            <option value="post_date|asc"><?php esc_html_e( 'Date created ascending', 'flexi-wp-ajax-aid' ); ?></option>
            <option value="post_title|asc"><?php esc_html_e( 'Name ascending', 'flexi-wp-ajax-aid' ); ?></option>
            <option value="post_title|desc"><?php esc_html_e( 'Name descending', 'flexi-wp-ajax-aid' ); ?></option>
        </select>
        <div class="clearboth"></div>
    </div>

    <div class="ajax-loader-div" style="visibility: hidden;">
        <img src="<?php echo flexi_wp_ajax_aid_get_media_url() . '/ajax-loader.gif'; ?>" alt="<?php esc_html_e( 'Loading...', 'flexi-wp-ajax-aid' ); ?>">
    </div>

    <div class="flexi-wp-ajax-aid-posts-div">
