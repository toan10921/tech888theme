<?php
$data = '';
global $post;
if(empty($size)) $size = 'full';
$tech888f_img_blog = tech888f_get_meta('mtb_post_top_image');
if($tech888f_img_blog){
    $tech888f_image_blog_url = $tech888f_img_blog['full_url'];
}
if($check_thumb == '1'){
    if(!empty($tech888f_image_blog_url)){
        $data .='<div class="single-post-thumb banner-advs mtb_post_top_image">
                    <img alt="'.esc_attr($post->post_name).'" title="'.esc_attr($post->post_name).'" src="' . esc_url($tech888f_image_blog_url) . '"/>
                </div>';
    }
    else{
        if (has_post_thumbnail()) {
            $data .= '<div class="single-post-thumb banner-advs">
                        '.get_the_post_thumbnail(get_the_ID(),$size).'                
                    </div>';
        }
    }
}
?>
<div class="content-single-blog <?php echo (is_sticky()) ? 'sticky':''?>">
    <?php if(!empty($data)) echo apply_filters('tech888f_output_content',$data);?>
    <?php if($check_meta == '1') tech888f_display_metabox();?>
    <div class="content-post-default">
        <h2 class="title24 font-bold">
            <?php the_title()?>
            <?php echo (is_sticky()) ? '<i class="fa fa-star"></i>':''?>
        </h2>
        <div class="detail-content-wrap clearfix"><?php the_content(); ?></div>
    </div>
</div>