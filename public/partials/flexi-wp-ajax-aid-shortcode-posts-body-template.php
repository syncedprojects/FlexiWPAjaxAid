<?php
    global $the_post_items_query;
?>

<div class="flexi-wp-ajax-aid-posts-items">
    <?php
        if ( $the_post_items_query->have_posts() ) {

            while ( $the_post_items_query->have_posts() ) {

                $the_post_items_query->the_post();

                ?>
                    <p>
                        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                    </p>
                <?php
            }
        }
    ?>
</div>
