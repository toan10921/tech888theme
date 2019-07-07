<?php
$check_author   = tech888f_get_opt('tech888f_post_author_box_stats');
$des 			= get_the_author_meta('description');
if(!empty($des) && $check_author == '1'):
    $user_info = get_userdata(get_the_author_meta( 'ID' ));
?>
<div class="single-info-author table-custom">
	<div class="author-thumb">
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
            <?php echo get_avatar(get_the_author_meta('email'),'100'); ?>
        </a>
	</div>
	<div class="author-info">
		<span class="silver"><?php esc_html_e("Written By","7upframework")?></span>
		<h3 class="title14 font-bold text-uppercase">
			<a class="black" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a>
		</h3>
		<p class="desc"><?php echo get_the_author_meta('description'); ?></p>
		<div class="author-social">
			<?php
                global $post;
                $sl=array(
                    'googleplus'    =>  "fa fa-googleplus",
                    'facebook'      =>  "fa fa-facebook",
                    'twitter'       =>  "fa fa-twitter",
                    'linkedin'      =>  "fa fa-linkedin",
                    'pinterest'     =>  "fa fa-pinterest",
                    'github'        =>  'fa fa-github',
                    'tumblr'        =>  'fa fa-tumblr',
                    'youtube'       =>  'fa fa-youtube',
                    'instagram'     =>  'fa fa-instagram',
                    'vimeo'         =>  'fa fa-vimeo'
                );
                if(isset($post->post_author)){
                    foreach($sl as $type=>$class){
                        $url  = get_user_option( $type, $post->post_author );
                        if($url==true){?>
                            <a href="<?php echo esc_url($url);?>" class="silver"><i class="<?php echo esc_attr($class);?>"></i></a>
                        <?php }
                    }
                }
            ?>
		</div>
	</div>
</div>
<?php endif;?>