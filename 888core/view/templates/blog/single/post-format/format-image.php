<?php
$data = $st_link_post= $s_class = '';
global $post;
$s7upf_image_blog = get_post_meta(get_the_ID(), 'format_image', true);
if(!empty($s7upf_image_blog)){
    $data .='<div class="single-post-thumb banner-advs">
                <img alt="'.esc_attr($post->post_name).'" title="'.esc_attr($post->post_name).'" src="' . esc_url($s7upf_image_blog) . '"/>
            </div>';
}
else{
    if (has_post_thumbnail()) {
        $data .= '<div class="single-post-thumb banner-advs">
                    '.get_the_post_thumbnail(get_the_ID(),'full').'                
                </div>';
    }
}
?>
<div class="content-single-blog <?php echo (is_sticky()) ? 'sticky':''?>">
    <?php if(!empty($data)) echo apply_filters('s7upf_output_content',$data);?>
    <?php if($check_meta == 'on') s7upf_display_metabox();?>
    <div class="content-post-default">
        <h2 class="title24 font-bold">
            <?php the_title()?>
            <?php echo (is_sticky()) ? '<i class="fa fa-star"></i>':''?>
        </h2>
        <div class="detail-content-wrap clearfix"><?php the_content(); ?></div>
    </div>
</div>