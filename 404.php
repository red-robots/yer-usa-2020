<?php get_header(); ?>
 
<div id="main-content" class="page-404">
    <?php
        if ( et_builder_is_product_tour_enabled() ):
            // load fullwidth page in Product Tour mode
            while ( have_posts() ): the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                    <?php
                        the_content();
                    ?>
                    </div> <!-- .entry-content -->

                </article> <!-- .et_pb_post -->

        <?php endwhile;
        else:
    ?>
    <div class="hero-wrapper" style="">
        <?php echo do_shortcode( '[et_pb_section global_module="1685"][/et_pb_section]' ); ?>
    </div>

    <div class="container">
        <div id="content-area" class="clearfix">
            <!-- <div id="left-area"> -->
                
                <article id="post-0" <?php post_class( 'et_pb_post not_found' ); ?>>
                    <h1><?php esc_html_e('Page Not Found','Divi'); ?></h1>
                    <p><?php esc_html_e('Whoops. Looks like the page you were looking for doesn\'t exit. Maybe try searching for something else using the search bar above', 'Divi'); ?></p>
                </article> <!-- .et_pb_post -->

            <!-- </div> --> <!-- #left-area -->

        </div> <!-- #content-area -->
    </div> <!-- .container -->
    <?php endif; ?>
</div> <!-- #main-content -->

<?php

get_footer();
