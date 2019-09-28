<?php
global $post;
if(!isset($animation)) $animation = tech888f_get_opt('shop_thumb_animation');
if(empty($size_list)) $size_list = array(370,370);
$col_class = 'col-md-12 col-sm-12 col-xs-12';
?>
<div <?php post_class($col_class)?>>
	<div class="item-product item-product-list">
		<div class="row">
			<?php do_action( 'woocommerce_before_shop_loop_item' );?>
			<div class="col-md-4 col-sm-5 col-xs-12">
				<div class="product-thumb">
					<!-- tech888f_woocommerce_thumbnail_loop have $size and $animation -->
					<?php tech888f_woocommerce_thumbnail_loop($size_list,$animation);?>
					<?php tech888f_product_quickview()?>
					<?php tech888f_product_label()?>
					<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
				</div>
			</div>
			<div class="col-md-8 col-sm-7 col-xs-12">
				<div class="product-info">
					<h3 class="title18 product-title">
						<a title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
					</h3>
					<?php do_action( 'woocommerce_shop_loop_item_title' );?>
					<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
					<?php tech888f_get_price_html()?>
					<?php tech888f_get_rating_html()?>
					<div class="desc"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?></div>
					<div class="product-extra-link">
						<?php tech888f_addtocart_link()?>
						<?php echo tech888f_compare_url();?>
						<?php echo tech888f_wishlist_url();?>
					</div>
				</div>
			</div>
			<?php do_action( 'woocommerce_after_shop_loop_item' );?>
		</div>
	</div>
</div>