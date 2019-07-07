<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/1/2019
 * Time: 8:31 PM
 */

/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 */

$page_id = tech888f_get_opt('tech888f_404_page');
if(!empty($page_id)){
	$style = tech888f_get_opt('tech888f_404_page_style');
	if($style == 'full-width') {
		get_header('none');
		echo Tech888f_Template::get_vc_pagecontent($page_id);
		get_footer('none');
	}
	else{
		get_header(); ?>
		<div id="main-content" class="main-page-default">
		    <?php do_action('tech888f_before_content')?>
		    <div class="container">
				<?php echo tech888f_Template::get_vc_pagecontent($page_id);?>
			</div>
			<?php do_action('tech888f_after_content')?>
		</div>
		<?php get_footer();
	}
}
else{
	get_header();
	?>
	<div id="main-content" class="main-page-default">
	    <?php do_action('tech888f_before_content')?>
	    <div class="container">
	    	<div class="content-default-404">
		    	<div class="row">
		    		<div class="col-md-6 col-sm-6 col-xs-12">
		    			<div class="icon-404">
		    				<span class="number"><?php esc_html_e("404","7upframework")?></span>
		    				<span class="text"><?php esc_html_e("Page Not Found","7upframework")?></span>
		    			</div>
		    		</div>
		    		<div class="col-md-6 col-sm-6 col-xs-12">
		    			<div class="info-404">
		    				<h2><?php esc_html_e("Oops!","7upframework")?></h2>
		    				<h3><?php esc_html_e("Page not found on server","7upframework")?></h3>
		    				<p class="desc"><?php esc_html_e("The link you followed is either outdated, inaccurate or the server has been instructed not to let you have it.","7upframework")?></p>
		    				<a href="<?php echo home_url('/')?>" class="shop-button"><?php esc_html_e("Go to Home","7upframework")?></a>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		</div>
		<?php do_action('tech888f_after_content')?>
	</div>
	<?php get_footer();
}?>
