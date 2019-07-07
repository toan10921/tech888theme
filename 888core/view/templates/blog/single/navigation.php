<?php
$check_navigation   = tech888f_get_opt('tech888f_post_navi_post_stats');
if($check_navigation == '1'):
	$previous_post = get_previous_post();
	$next_post = get_next_post();
?>
<div class="post-control">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<?php if(!empty( $previous_post )):?>
            <h3 class="title14 text-left"><a href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>" class="prev-post"><i class="fa fa-angle-left"></i> <span><?php echo esc_html($previous_post->post_title)?></span></a></h3>
            <?php endif;?>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<?php if(!empty( $next_post )):?>
            <h3 class="title14 text-right"><a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>" class="next-post"> <span><?php echo esc_html($next_post->post_title)?></span><i class="fa fa-angle-right"></i> </a></h3>
            <?php endif;?>
		</div>
	</div>
</div>
<?php endif;?>