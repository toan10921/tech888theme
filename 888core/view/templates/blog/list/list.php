<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/11/2019
 * Time: 10:49 AM
 */
if(empty($size_list)) $size_list = '840x504';
global $post;
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="item-post item-post-large item-default">
        <div class="row">
            <?php if(has_post_thumbnail()):?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="post-thumb banner-advs zoom-image overlay-image">
                        <a href="<?php echo esc_url(get_the_permalink())?>" class="adv-thumb-link">
                            <?php echo get_the_post_thumbnail(get_the_ID(),$size_list)?>
                        </a>
                    </div>
                </div>
            <?php endif;?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="post-info">
                    <h3 class="title24 post-title">
                        <a href="<?php echo esc_url(get_the_permalink()); ?>">
                            <?php the_title()?>
                            <?php echo (is_sticky()) ? '<i class="fa fa-star"></i>':''?>
                        </a>
                    </h3>
                    <?php if(has_excerpt() || !empty($post->post_content)):?><p class="desc"><?php echo get_the_excerpt();?></p><?php endif;?>
                    <?php tech888f_display_metabox();?>
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="readmore"><?php esc_html_e("Read more","7upframework")?></a>
                </div>
            </div>
        </div>
    </div>
</div>