<?php
$check_related = tech888f_get_opt('tech888f_post_related_post_stats');
if($check_related == '1'):
    $categories = get_the_category(get_the_ID());
    $category_ids = array();
    foreach($categories as $individual_category){
        $category_ids[] = $individual_category->term_id;
    }
    $title 		= tech888f_get_opt('tech888f_post_related_title');
    $number 	= tech888f_get_opt('tech888f_post_related_post_number');
    $size 		= tech888f_get_opt('tech888f_post_related_thumbnail_size');
    $itemres 	= tech888f_get_opt('tech888f_post_related_responsive_format','0:1,480:2,990:3');
    $itemstyle 	= tech888f_get_opt('tech888f_post_related_item_specific');
    $speed      = '';
    $size = tech888f_filter_size_crop($size);
    $attr = array(
        'size'      => $size,
        'excerpt'   => 100,
        );
    $args=array(
        'category__in' 		=> $category_ids,
        'post__not_in' 		=> array(get_the_ID()),
        'posts_per_page'	=> (int)$number,
        'meta_query' 		=> array(array('key' => '_thumbnail_id')) 
        );
    $query = new wp_query($args);
    if($query->post_count > 0):
    ?>
    <div class="single-related-post">
    	<h2 class="title18 font-bold text-uppercase title-single-related-post">
    		<?php echo esc_html($title)?> 
    		<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php esc_html_e("More From Author","7upframework")?></a>
    	</h2>
    	<div class="related-post-slider">
    		<div class="wrap-item smart-slider owl-carousel owl-theme" 
            data-item="" data-speed="<?php echo esc_attr($speed);?>" 
            data-itemres="<?php echo esc_attr($itemres)?>" 
            data-prev="" data-next="" 
            data-pagination="" data-navigation="">
            <?php 
            if($query->have_posts()) {
                while($query->have_posts()) {
                    $query->the_post();
                    tech888f_get_template_post('grid/grid',$itemstyle,$attr,true);
                }
            }
            ?>
    		</div>
    	</div>
    </div>
    <?php 
    endif;
    wp_reset_postdata();
    ?>
<?php endif?>