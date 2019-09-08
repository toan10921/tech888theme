<?php
global $product;
extract(tech888f_show_single_product_data());
$upsells = $product->get_upsell_ids();
if($show_upsell == '1' && $upsells):?>  
    <div class="related-product">
        <h2 class="title18 font-bold text-uppercase single-title"><?php esc_html_e("You may also like&hellip;","7upframework")?></h2>
        <div class="product-slider">
            <?php echo '<div class="wrap-item group-navi smart-slider owl-carousel owl-theme" data-item="" data-speed="" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';?>
                <?php
                    $meta_query = WC()->query->get_meta_query();
                    $args = array(
                        'post_type'           => 'product',
                        'ignore_sticky_posts' => 1,
                        'no_found_rows'       => 1,
                        'posts_per_page'      => $number,
                        'post__in'            => $upsells,
                        'post__not_in'        => array( $product->get_id() ),
                        'meta_query'          => $meta_query
                    );
                    $products = new WP_Query( $args );
                    if ( $products->have_posts() ) :
                        while ( $products->have_posts() ) : 
                            $products->the_post();                                  
                            tech888f_get_template_woocommerce('loop/grid/grid',$item_style,array('size'=>$size),true);
                        endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
<?php endif;?>