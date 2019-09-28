<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
?>
<label class="navi qty-label"><?php esc_html_e("Qty","7upframework")?></label>
<div class="detail-qty info-qty border inline-block">
	<a href="#" class="qty-down"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
	<input type="text" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( $max_value ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', '7upframework' ) ?>" class="input-text text qty qty-val" size="4" />
	<a href="#" class="qty-up"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>
<?php
}