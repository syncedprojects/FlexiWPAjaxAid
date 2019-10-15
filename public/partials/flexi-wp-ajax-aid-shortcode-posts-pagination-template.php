<?php
    global $_page_links;
    global $shortcode_id;
?>

<div data-fwpaa-shortcode-id="<?php echo $shortcode_id; ?>" class="flexi-wp-ajax-aid-posts-pagination">
    <?php if ( $_page_links ): ?>
        <ul class="flexi-wp-ajax-aid-pagination-links">
            <?php foreach ( $_page_links as $link ): ?>
                <li><?php echo $link; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
