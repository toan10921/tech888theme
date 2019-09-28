<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/1/2019
 * Time: 8:30 PM
 */
get_header();?>
    <div id="main-content"  class="main-page-default">
        <?php do_action('tech888f_before_main_content')?>
        <div class="container">
            <div class="row">
                <?php tech888f_get_template_sidebar('left') ?>
                <div class="<?php echo esc_attr(tech888f_get_main_class()); ?>">
                    <?php
                    $size               = tech888f_get_opt('tech888f_post_image_size');
                    $check_meta         = tech888f_get_opt('tech888f_post_meta_data_stats');
                    $check_thumb        = tech888f_get_opt('tech888f_post_media_stats');
                    $size = tech888f_filter_size_crop($size);
                    $data = array(
                        'size'              => $size,
                        'check_thumb'       => $check_thumb,
                        'check_meta'        => $check_meta,
                    );
                    while ( have_posts() ) : the_post();

                        /*
                        * Include the post format-specific template for the content. If you want to
                        * use this in a child theme, then include a file called called content-___.php
                        * (where ___ is the post format) and that will be used instead.
                        */
                        tech888f_get_template_post( 'single/post-format/format',get_post_format(),$data,true );
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', '7upframework' ),
                            'after'  => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) );
                        //tech888fget_template( 'share','',false,true );
                        tech888f_get_template_post( 'single/author','',false,true );
                        tech888f_get_template_post( 'single/navigation','',false,true );
                        tech888f_get_template_post( 'single/related','',false,true );
                        if ( comments_open() || get_comments_number() ) { comments_template(); }

                    endwhile; ?>
                </div>
                <?php tech888f_get_template_sidebar('right')?>
            </div>
        </div>
        <?php do_action('tech888f_after_main_content')?>
    </div>
<?php get_footer();?>