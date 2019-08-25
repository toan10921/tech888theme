<?php
 /* The template for displaying all single posts.
 *
 * @package tech888-framework
 */

get_header();
?>
<?php do_action('tech888f_before_content')?>
    <div id="main-content" class="main-page-default">
        <div class="container">
            <div class="row">
                <?php tech888f_get_template_sidebar('left')?>
                <div class="<?php echo esc_attr(tech888f_get_main_class()); ?>">
                    <?php
                    while ( have_posts() ) : the_post();

                        /*
                        * Include the post format-specific template for the content. If you want to
                        * use this in a child theme, then include a file called called content-___.php
                        * (where ___ is the post format) and that will be used instead.
                        */
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content clearfix">
                                <?php   if(get_post_meta(get_the_ID(),'show_title_page',true) != 'off'):?>
                                    <div class="title-page clearfix">
                                        <h2 class="title24 font-bold text-uppercase"><?php the_title()?></h2>
                                    </div>
                                <?php   endif;?>
                                <?php the_content(); ?>
                                <?php
                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', '7upframework' ),
                                    'after'  => '</div>',
                                ) );
                                tech888f_get_template( 'share','',false,true );
                                ?>

                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->
                        <?php

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number()) :
                            comments_template();
                        endif;

                        // End the loop.
                    endwhile; ?>

                </div>
                <?php tech888f_get_template_sidebar('right')?>
            </div>
        </div>
    </div>
<?php do_action('tech888f_after_main_content')?>
<?php
get_footer();