<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/11/2019
 * Time: 10:38 AM
 */
if(empty($size)) $size = array(400,400);
?>
<?php if(isset($cols_num)):?><div class="grid-col-item grid-<?php echo esc_attr($cols_num)?>-item"><?php endif;?>
    <div class="item-post item-post-default">
        <div class="post-thumb banner-advs zoom-image overlay-image">
            <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link">
                <?php echo get_the_post_thumbnail(get_the_ID(),$size);?>
            </a>
        </div>
        <div class="post-info">
            <h3 class="title18 post-title"><a class="fixlh" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
            <?php if($excerpt) echo '<p class="desc">'.tech888f_substr(get_the_excerpt(),0,(int)$excerpt).'</p>';?>
            <a href="<?php echo esc_url(get_the_permalink()) ?>" class="readmore"><?php esc_html_e("Read more","7upframework")?></a>
        </div>
    </div>
<?php if(isset($cols_num)):?></div><?php
endif;