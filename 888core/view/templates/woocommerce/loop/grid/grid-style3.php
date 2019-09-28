<?php
if(!isset($animation)) $animation = tech888f_get_option('shop_thumb_animation');
if(empty($size)) $size = array(270,270);
$size = tech888f_size_random($size);
if(isset($column)) $col_class = "list-col-item list-".esc_attr($column)."-item";
else $col_class = '';
?>	
<div <?php post_class($col_class)?>>
	<div class="item-product item-product-grid">
		<?php do_action( 'woocommerce_before_shop_loop_item' );?>
		<div class="product-thumb">
			<!-- tech888f_woocommerce_thumbnail_loop have $size and $animation -->
			<?php tech888f_woocommerce_thumbnail_loop($size,$animation);?>
			<?php tech888f_product_quickview()?>
			<?php tech888f_product_label()?>
			<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
		</div>
		<div class="product-info">
			<h3 class="title14 product-title">
				<a title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
			</h3>
			<?php do_action( 'woocommerce_shop_loop_item_title' );?>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
			<?php tech888f_get_price_html()?>
			<?php tech888f_get_rating_html()?>
			<div class="product-extra-link">
				<?php tech888f_addtocart_link(true,'cart-icon');?>
				<?php echo tech888f_compare_url();?>
				<?php echo tech888f_wishlist_url();?>
			</div>
		</div>		
		<?php do_action( 'woocommerce_after_shop_loop_item' );?>
	</div>
</div>