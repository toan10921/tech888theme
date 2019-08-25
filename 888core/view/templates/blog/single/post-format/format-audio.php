<?php
$data = '';
if (get_post_meta(get_the_ID(), 'format_media', true)) {
    $media_url = get_post_meta(get_the_ID(), 'format_media', true);
    $data .= '<div class="audio single-post-thumb banner-advs">' . tech888fremove_w3c(wp_oembed_get($media_url, array('height' => '176'))) . '</div>';
}
?>
<div class="content-single-blog <?php echo (is_sticky()) ? 'sticky':''?>">
    <?php if(!empty($data)) echo apply_filters('tech888foutput_content',$data);?>
    <?php if($check_meta == 'on') tech888fdisplay_metabox();?>
    <div class="content-post-default">
        <h2 class="title24 font-bold">
            <?php the_title()?>
            <?php echo (is_sticky()) ? '<i class="fa fa-star"></i>':''?>
        </h2>
        <div class="detail-content-wrap clearfix"><?php the_content(); ?></div>
    </div>
</div>