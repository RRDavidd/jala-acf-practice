<article class="list-item col-lg-4 col-6">
    <a class="list-item-body" href="<?php the_permalink(); ?>">

        <figure class="list-item-img">
            <div class="grow">
                <?php
                if ( jdf_get_featured_image() ) {
                    jdf_the_featured_image();
                } else {
                    jdf_the_placeholder_image();
                }
                ?>
            </div>
        </figure>

        <div class="list-item-content bg-color3 p-3">
            <h4 class="font-color-white"><?php the_title(); ?></h4>
            <?php get_template_part( 'inc/partials/meta' ); ?>
            <?php
            if ( $excerpt = get_the_excerpt() ) printf(
                '<p>%s</p>',
                $excerpt
            );
            ?>
        </div>

    </a>
</article>