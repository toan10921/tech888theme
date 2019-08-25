<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/2/2019
 * Time: 7:33 PM
 */
if(class_exists("woocommerce")){
    add_action( 'yith_woocompare_popup_head', 'tech888f_custom_compare_popup' );
    if(!function_exists('tech888f_custom_compare_popup')){
        function tech888f_custom_compare_popup(){
            echo '<link rel="stylesheet" href="'.esc_url(get_template_directory_uri()) . '/assets/css/custom-compare.css" type="text/css">';
        }
    }
    
    /*********************************** BEGIN ADD TO CART AJAX ****************************************/
    
    add_action( 'wp_ajax_add_to_cart', 'tech888f_minicart_ajax' );
    add_action( 'wp_ajax_nopriv_add_to_cart', 'tech888f_minicart_ajax' );
    if(!function_exists('tech888f_minicart_ajax')){
        function tech888f_minicart_ajax() {
            
            $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
            $quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
            $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

            if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) ) {
                do_action( 'woocommerce_ajax_added_to_cart', $product_id );
                WC_AJAX::get_refreshed_fragments();
            } else {
                $this->json_headers();

                // If there was an error adding to the cart, redirect to the product page to show any errors
                $data = array(
                    'error' => true,
                    'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
                    );
                echo json_encode( $data );
            }
            die();
        }
    }
    /*********************************** END ADD TO CART AJAX ****************************************/

    /*********************************** BEGIN UPDATE CART AJAX ****************************************/
    
    add_action( 'wp_ajax_update_mini_cart', 'tech888f_update_mini_cart' );
    add_action( 'wp_ajax_nopriv_update_mini_cart', 'tech888f_update_mini_cart' );
    if(!function_exists('tech888f_update_mini_cart')){
        function tech888f_update_mini_cart() {
            WC_AJAX::get_refreshed_fragments();
            die();
        }
    }
    /*********************************** END UPDATE CART  AJAX ****************************************/

    /********************************** REMOVE ITEM MINICART AJAX ************************************/

    add_action( 'wp_ajax_product_remove', 'tech888f_product_remove' );
    add_action( 'wp_ajax_nopriv_product_remove', 'tech888f_product_remove' );
    if(!function_exists('tech888f_product_remove')){
        function tech888f_product_remove() {
            global $wpdb, $woocommerce;
            $cart_item_key = $_POST['cart_item_key'];
            if ( $woocommerce->cart->get_cart_item( $cart_item_key ) ) {
                $woocommerce->cart->remove_cart_item( $cart_item_key );
            }
            WC_AJAX::get_refreshed_fragments();
            die();
        }
    }

    /********************************** FANCYBOX POPUP CONTENT ************************************/

    add_action( 'wp_ajax_product_popup_content', 'tech888f_product_popup_content' );
    add_action( 'wp_ajax_nopriv_product_popup_content', 'tech888f_product_popup_content' );
    if(!function_exists('tech888f_product_popup_content')){
        function tech888f_product_popup_content() {
            $product_id = $_POST['product_id'];
            $query = new WP_Query( array(
                'post_type' => 'product',
                'post__in' => array($product_id)
                ));
            $style = get_post_meta($product_id,'product_layout',true);
            if(empty($style)) $style = tech888f_get_opt('product_layout');
            if( $query->have_posts() ):
                echo '<div class="woocommerce single-product product-popup-content '.esc_attr($style).'"><div class="product detail-product">';
                while ( $query->have_posts() ) : $query->the_post();    
                    $style = '';
                    tech888f_get_template_woocommerce('single-product/detail',$style,false,true);
                endwhile;
                echo '</div></div>';
            endif;
            wp_reset_postdata();
        }
    }

    /********************************** WOOCOMMERCE HOOK ************************************/

    remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20 );
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count',20 );
    remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering',30 );
    remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination',10 );
    remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

    // Remove action loop product
    remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10 );
    remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10 );
    remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10 );
    remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10 );
    remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5 );
    remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10 );
    remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5 );
    remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10 );
    add_filter( 'ywctm_modify_woocommerce_after_shop_loop_item', 'tech888f_remove_modify_after_shop_loop_item' );
    // End Remove action loop product

    // Remove action single product
    remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10 );
    remove_action( 'woocommerce_before_single_product_summary','woocommerce_show_product_images',20 );
    remove_action( 'woocommerce_product_thumbnails','woocommerce_show_product_thumbnails',20 );
    remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_title',5 );
    remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_sharing',50 );
    remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',10 );    
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    add_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',5 );
    add_action( 'woocommerce_after_single_product_summary', 'tech888f_product_tabs_before', 5 );
    add_action( 'woocommerce_after_single_product_summary', 'tech888f_product_tabs', 10 );
    add_action( 'woocommerce_after_single_product_summary', 'tech888f_product_tabs_after', 15 ); 
    add_action( 'woocommerce_after_single_product_summary', 'tech888f_single_upsell_product', 15 );
    //add_action( 'woocommerce_after_single_product_summary', 'tech888f_single_relate_product', 20 );
    add_action( 'woocommerce_after_single_product_summary', 'tech888f_single_lastest_product', 25 );
    add_filter( 'woocommerce_short_description', 'tech888f_custom_short_description', 10 );
    add_filter( 'woocommerce_product_tabs', 'tech888f_custom_product_tab', 98 );
    // End Remove action single product

    add_action( 'woocommerce_before_main_content','tech888f_woocommerce_wrap_before', 10 );
    add_action( 'woocommerce_after_main_content', 'tech888f_woocommerce_wrap_after', 10 );
    add_action( 'woocommerce_after_main_content', 'tech888f_single_relate_product', 20 );
    add_filter( 'woocommerce_show_page_title', 'tech888f_remove_page_title' );
    add_action( 'woocommerce_before_shop_loop', 'tech888f_woocommerce_top_filter', 25 );    
    add_action( 'woocommerce_before_shop_loop', 'tech888f_shop_wrap_before', 30 ); 
    add_action( 'woocommerce_after_shop_loop','tech888f_woocommerce_pagination',10 );

    add_filter( 'woocommerce_get_price_html', 'tech888f_change_price_html', 100, 2 );
    add_action( 'pre_get_posts', 'tech888f_woo_change_number' );
    add_filter( 'woocommerce_product_get_rating_html', 'tech888f_get_rating_html_default', 10, 2 );

    // Ajax shop
    add_action( 'wp_ajax_load_shop', 'tech888f_load_shop' );
    add_action( 'wp_ajax_nopriv_load_shop', 'tech888f_load_shop' );

    //Load more product
    add_action( 'wp_ajax_load_more_product', 'tech888f_load_more_product' );
    add_action( 'wp_ajax_nopriv_load_more_product', 'tech888f_load_more_product' );

    //Load filter product
    add_action( 'wp_ajax_load_product_filter', 'tech888f_load_product_filter' );
    add_action( 'wp_ajax_nopriv_load_product_filter', 'tech888f_load_product_filter' );


    if(!function_exists('tech888f_remove_modify_after_shop_loop_item')){
        function tech888f_remove_modify_after_shop_loop_item(){
            return false;
        }
    }
    if(!function_exists('tech888f_custom_short_description')){
    function tech888f_custom_short_description( $des ) {
            $show_des = tech888f_get_opt('show_excerpt','on');
            if($show_des == 'on' && $des) return '<div class="product-desc">'.$des.'</div>';
        }
    }
    if(!function_exists('tech888f_custom_product_tab')){
    function tech888f_custom_product_tab( $tabs ) {
            $data_tabs = get_post_meta(get_the_ID(),'tech888f_product_tab_data',true);
            if(!empty($data_tabs) and is_array($data_tabs)){
                foreach ($data_tabs as $key=>$data_tab){
                    $tabs['tech888f_custom_tab_' . $key] = array(
                        'title' => (!empty($data_tab['title']) ? $data_tab['title'] : $key),
                        'priority' => (!empty($data_tab['priority']) ? (int)$data_tab['priority'] : 50),
                        'callback' => 'tech888f_render_tab',
                        'content' => apply_filters('the_content', $data_tab['tab_content']) //this allows shortcodes in custom tabs
                    );
                }
            }
            return $tabs;
        }
    }
    
    if(!function_exists('tech888f_render_tab')){
        function tech888f_render_tab($key, $tab) {
            echo apply_filters('tech888f_product_custom_tab_content', $tab['content'], $tab, $key);
        }
    }

    if(!function_exists('tech888f_woo_change_number')){
        function tech888f_woo_change_number( $query ) {
            if($query->is_main_query() && $query->get( 'wc_query' ) == 'product_query' ){
                $number = tech888f_get_opt('woo_shop_number',12);
                if(isset($_GET['number'])) $number = $_GET['number'];
                $query->set( 'posts_per_page', $number );
            }
        }
    }

    if(!function_exists('tech888f_shop_wrap_before')){
        function tech888f_shop_wrap_before(){
            global $wp_query;
            $cats = '';
            $tags = '';
            if(isset($wp_query->query_vars['product_cat'])) $cats = $wp_query->query_vars['product_cat'];
            if(isset($wp_query->query_vars['product_tag'])) $tags = $wp_query->query_vars['product_tag'];
            $style          = tech888f_get_opt('shop_default_style','grid');
            $grid_type      = tech888f_get_opt('shop_grid_type');
            $gap_product    = tech888f_get_opt('shop_gap_product');
            $number         = tech888f_get_opt('woo_shop_number',12);
            if(isset($_GET['number'])) $number = $_GET['number'];
            if(isset($_GET['type'])) $style = $_GET['type'];
            // data shop ajax
            $attr_ajax = array(
                'item_style'    => tech888f_get_opt('shop_grid_item_style'),
                'item_style_list'=> tech888f_get_opt('shop_list_item_style'),
                'column'        => tech888f_get_opt('shop_grid_column'),
                'size'          => tech888f_get_opt('shop_grid_size'),
                'size_list'     => tech888f_get_opt('shop_list_size'),
                'shop_style'    => tech888f_get_opt('shop_style'),
                'animation'     => tech888f_get_opt('shop_thumb_animation'),
                'number'        => $number,
                'cats'          => $cats,
                'tags'          => $tags,
                );
            $data_ajax = array(
                "attr"        => $attr_ajax,
                );
            $data_ajax = json_encode($data_ajax);
            ?>
            <div class="product-<?php echo esc_attr($style)?>-view <?php echo esc_attr($grid_type.' '.$gap_product)?> products-wrap js-content-wrap" data-load="<?php echo esc_attr($data_ajax)?>">
                <div class="products row list-product-wrap js-content-main">
            <?php 
        }
    }

    if(!function_exists('tech888f_change_price_html')){
        function tech888f_change_price_html($price, $product){
            global $product;
            $price = str_replace('&ndash;', '<span class="slipt">&ndash;</span>', $price);
            $type_class = '';
            if(method_exists($product,'get_type')) $type_class = $product->get_type();
            $price = '<div class="product-price price '.esc_attr($type_class).'">'.$price.'</div>';
            return $price;
        }
    }

    if(!function_exists('tech888f_woocommerce_pagination')){
        function tech888f_woocommerce_pagination(){
            echo '</div>';/*close list-product-wrap*/
            $shop_style     = tech888f_get_opt('shop_style');
            global $wp_query;
            $max_page = $wp_query->max_num_pages;            
            if($shop_style == 'load-more' && $max_page > 1){
                $style          = tech888f_get_opt('shop_default_style','grid');
                $item_style     = tech888f_get_opt('shop_grid_item_style');
                $item_style_list= tech888f_get_opt('shop_list_item_style');
                $column         = tech888f_get_opt('shop_grid_column');
                $size           = tech888f_get_opt('shop_grid_size');
                $size_list      = tech888f_get_opt('shop_list_size');
                $number         = tech888f_get_opt('woo_shop_number',12);
                $animation      = tech888f_get_opt('shop_thumb_animation');
                $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
                if($order_default == 'menu_order') $order_default = $order_default.' title';
                $orderby = $order_default;
                if(isset($_GET['orderby']))$orderby = $_GET['orderby'];
                if(isset($_GET['type'])) $style = $_GET['type'];
                if(isset($_GET['number'])) $number = $_GET['number'];
                $attr = array(
                    'style'         => $style,
                    'item_style'    => $item_style,
                    'item_style_list'=> $item_style_list,
                    'column'        => $column,
                    'size'          => $size,
                    'size_list'     => $size_list,
                    'number'        => $number,
                    'animation'     => $animation,
                    );
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;                
                $args = array(
                    'post_type'         => 'product',
                    'post_status'       => 'publish',
                    'posts_per_page'    => $number,
                    'order'             => 'ASC',
                    'paged'             => $paged,
                );
                $curent_query = $GLOBALS['wp_query']->query;
                $curent_tax_query = $GLOBALS['wp_query']->query_vars['tax_query'];
                $curent_meta_query = $GLOBALS['wp_query']->query_vars['meta_query'];
                if(is_array($curent_query)) $args = array_merge($args,$curent_query);
                if(is_array($curent_tax_query)) $args = array_merge($args,$curent_tax_query);
                if(is_array($curent_meta_query)) $args = array_merge($args,$curent_meta_query);
                switch ($orderby) {
                    case 'price' :
                        $args['orderby']  = "meta_value_num ID";
                        $args['order']    = 'ASC';
                        $args['meta_key'] = '_price';
                    break;

                    case 'price-desc' :
                        $args['orderby']  = "meta_value_num ID";
                        $args['order']    = 'DESC';
                        $args['meta_key'] = '_price';
                    break;

                    case 'popularity' :
                        $args['meta_key'] = 'total_sales';                        
                        $args['order']    = 'DESC';
                        add_filter( 'posts_clauses', array( WC()->query, 'order_by_popularity_post_clauses' ) );
                    break;

                    case 'rating' :
                        $args['meta_key'] = '_wc_average_rating';
                        $args['orderby'] = 'meta_value_num';
                        $args['order']    = 'DESC';
                        $args['meta_query'] = WC()->query->get_meta_query();
                        $args['tax_query'][] = WC()->query->get_tax_query();
                    break;

                    case 'date':
                        $args['orderby'] = 'date';
                        $args['order']    = 'DESC';
                        break;
                    
                    default:
                        $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
                        if($order_default == 'menu_order') $order_default = $order_default.' title';
                        $args['orderby'] = $order_default;
                        break;
                }
                if(isset($_GET['s'])) if($_GET['s'] && $args['orderby'] == 'menu_order title'){
                    unset($args['order']);
                    unset($args['orderby']);
                } 
                $data_load = array(
                    "args"        => $args,
                    "attr"        => $attr,
                    );
                $data_loadjs = json_encode($data_load);
                echo    '<div class="btn-loadmore">
                            <a href="'.esc_url("#").'" class="product-loadmore loadmore" 
                                data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                                data-maxpage="'.esc_attr($max_page).'">
                                '.esc_html__("Load more","ripara").'
                            </a>
                        </div>';
            }
            else tech888f_get_template_woocommerce('loop/pagination','',false,true);
            echo '</div>';/*close div before list-product-wrap*/
        }
    }
    if(!function_exists('tech888f_woocommerce_top_filter')){
        function tech888f_woocommerce_top_filter(){
            $style          = tech888f_get_opt('shop_default_style','grid');
            $number         = tech888f_get_opt('woo_shop_number',12);
            $check_number   = tech888f_get_opt('shop_number_filter','on');
            $check_type     = tech888f_get_opt('shop_type_filter','on');
            $check_attr     = tech888f_get_opt('shop_attr_filter','off');
            $check_hd_sidebar     = tech888f_get_opt('shop_hidden_sidebar','off');
            if(isset($_GET['type'])) $style = $_GET['type'];
            if(isset($_GET['number'])) $number = $_GET['number'];
            tech888f_get_template('top-filter','',array('style'=>$style,'number'=>$number,'check_number'=>$check_number,'check_type'=>$check_type,'check_order'=>true,'check_attr'=>$check_attr,'check_hd_sidebar'=>$check_hd_sidebar),true);
        }
    }
    if(!function_exists('tech888f_woocommerce_wrap_before')){
        function tech888f_woocommerce_wrap_before(){
            ?>
            <?php do_action('tech888f_before_main_content')?>
            <div id="main-content" class="content-page">
                <div class="container">
                    <div class="row">
                        <?php tech888f_get_template_sidebar('left')?>
                        <div class="main-wrap-shop <?php echo esc_attr(tech888f_get_main_class()); ?>">
            <?php
        }
    }
    if(!function_exists('tech888f_woocommerce_wrap_after')){
        function tech888f_woocommerce_wrap_after(){       
            ?>
                        </div><!-- main-wrap-shop -->
                        <?php tech888f_get_template_sidebar('right')?>
                    </div> <!-- close row --> 
                </div> <!-- close container --> 
            </div>  <!-- close content-page -->    
            <?php do_action('tech888f_after_main_content')?>
            <?php
        }
    }
    if(!function_exists('tech888f_remove_page_title')){
        function tech888f_remove_page_title() {
            return false;
        }
    }

    if(!function_exists('tech888f_woocommerce_thumbnail_loop')){
        function tech888f_woocommerce_thumbnail_loop($size,$animation = '',$echo = true) {
            $img_hover_html = '';
            if($animation == 'rotate-thumb' || $animation == 'zoomout-thumb' || $animation == 'translate-thumb' || $animation == "float-thumb") {
                $img_hover = get_post_meta(get_the_ID(),'product_thumb_hover',true);
                if(!empty($img_hover)) $img_hover_html = tech888f_get_image_by_url($img_hover,$size);
                else $img_hover_html = get_the_post_thumbnail(get_the_ID(),$size);
            }
            $html = '<a href="'.esc_url(get_the_permalink()).'" class="product-thumb-link '.esc_attr($animation).'">
                        '.get_the_post_thumbnail(get_the_ID(),$size).'
                        '.$img_hover_html.'
                    </a>';
            if($echo) echo apply_filters( 'woocommerce_product_get_image',$html);
            else return apply_filters( 'woocommerce_product_get_image',$html);
        }
    }
    if(!function_exists('tech888f_product_quickview')){
        function tech888f_product_quickview($icon = '<i class="fa fa-search"></i>',$class = '',$echo = true) {
            $html = '<a title="'.esc_attr__("Quick View","ripara").'" data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link '.esc_attr($class).'">'.$icon.'<span class="ripple"></span></a>';
            if($echo) echo apply_filters( 'tech888f_quickview',$html);
            else return apply_filters( 'tech888f_quickview',$html);
        }
    }
    if(!function_exists('tech888f_product_label')){
        function tech888f_product_label($echo = true) {
            global $product,$post;
            $date_pro = strtotime($post->post_date);
            $date_now = strtotime('now');
            $set_timer = tech888f_get_opt( 'sv_set_time_woo', 30);
            $uppsell = ($date_now - $date_pro - $set_timer*24*60*60);
            $html = '';
            if($product->is_on_sale() || $uppsell < 0) $html .= '<div class="product-label">';
            if($product->is_on_sale()){
                $from = $product->get_regular_price();
                $to = $product->get_price();
                if($from){
                    $percent = round(($from-$to)/$from*100);
                    $html .= apply_filters( 'woocommerce_sale_flash','<span class="sale">'.esc_html__("Sale","ripara").'</span>');
                }
            }
            if($uppsell < 0) $html .=   '<span class="new">'.esc_html__("New","ripara").'</span>';
            if($product->is_on_sale() || $uppsell < 0) $html .= '</div>';
            if($echo) echo apply_filters( 'tech888f_product_label',$html);
            else return apply_filters( 'tech888f_product_label',$html);
        }
    }
    if(!function_exists('tech888f_get_price_html')){
        function tech888f_get_price_html($echo = true){
            global $product;
            $html =    $product->get_price_html();
            if($echo) echo apply_filters( 'tech888f_product_price',$html);
            return apply_filters( 'tech888f_product_price',$html);
        }
    }
    if(!function_exists('tech888f_get_rating_html')){
        function tech888f_get_rating_html($echo = true, $count = true, $style = ''){
            if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) return;
            global $product;
            $html = '';
            $star = $product->get_average_rating();
            $review_count = $product->get_review_count();
            $width = $star / 5 * 100;
            $html .=    '<ul class="wrap-rating list-inline-block">
                            <li>
                                <div class="product-rate">
                                    <div class="product-rating" '.tech888f_add_html_attr('width:'.$width.'%').'></div>
                                </div>
                            </li>';
            if($review_count == 0) $html .=     '<li>
                                        <span class="number-rate silver">( 0'.esc_html__(" Customer Review","ripara").' )</span>
                                    </li>';
            if($count && $review_count) $html .=     '<li>
                                        <span class="number-rate silver">( '.$review_count.esc_html__(" Customer Reviews","ripara").' )</span>
                                    </li>';
            $html .=    '</ul>';
            if($echo) echo apply_filters( 'tech888f_product_get_rating_html',$html);
            else return apply_filters( 'tech888f_product_get_rating_html',$html);
        }
    }
    if(!function_exists('tech888f_get_rating_html_default')){
        function tech888f_get_rating_html_default($html, $rating){
            if(!isset($count)) $count = false;
            if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) return;
            global $product;
            $html = '';
            $width = $rating / 5 * 100;
            $html .=    '<ul class="wrap-rating list-inline-block">
                            <li>
                                <div class="product-rate">
                                    <div class="product-rating" '.tech888f_add_html_attr('width:'.$width.'%').'></div>
                                </div>
                            </li>';
            if($count) $html .=     '<li>
                                        <span class="number-rate silver">('.$count.'s)</span>
                                    </li>';
            $html .=    '</ul>';
            return apply_filters( 'tech888f_product_get_rating_html',$html);
        }
    }
    if ( ! function_exists( 'tech888f_addtocart_link' ) ) {
        function tech888f_addtocart_link($echo = true,$style = '',$el_class = ''){
            global $product;
            if ( $product ) {                
                switch ($style) {
                    case 'cart-icon':
                        $icon = '<i class="fa fa-shopping-cart"></i>';
                        $text = '';
                        $btn_class = 'addcart-link '.$el_class;
                        break;
                    
                    default:
                        $icon = '';
                        $text = '<span>'.$product->add_to_cart_text().'</span>';
                        $btn_class = 'addcart-link '.$el_class;                
                        break;
                }
                $defaults = array(
                    'quantity' => 1,
                    'class'    => implode( ' ', array_filter( array(
                            'button',
                            $btn_class,
                            'product_type_' . $product->get_type(),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $product->supports( 'ajax_add_to_cart' ) ? 'tech888f_ajax_add_to_cart' : '',
                    ) ) ),
                );
                $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( array(), $defaults ), $product );
                if($args) extract($args);
                $button_html =  apply_filters( 'woocommerce_loop_add_to_cart_link',
                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s" data-title="%s">'.$icon.'%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( $product->get_id() ),
                        esc_attr( $product->get_sku() ),
                        esc_attr( $quantity),
                        esc_attr( $class ),
                        esc_attr( $product->get_type() ),
                        esc_attr(get_the_title($product->get_id())),
                        $text
                    ),
                $product );
                if($echo) echo apply_filters( 'tech888f_output_content',$button_html);
                else return $button_html;
            }
        }
    }

    if ( !function_exists( 'tech888f_catalog_ordering' ) ) {
        function tech888f_catalog_ordering($query,$set_orderby = '',$list_item = false,$add_class = '') {        
            
            $orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby','menu_order' ) );
            if(!empty($set_orderby)) $orderby = $set_orderby;
            $show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby','menu_order' ) );
            $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
                'menu_order' => esc_html__( 'Default', 'ripara' ),
                'popularity' => esc_html__( 'Popularity', 'ripara' ),
                'rating'     => esc_html__( 'Average rating', 'ripara' ),
                'date'       => esc_html__( 'Newness', 'ripara' ),
                'price'      => esc_html__( 'Price: low to high', 'ripara' ),
                'price-desc' => esc_html__( 'Price: high to low', 'ripara' )
            ) );

            $default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', $orderby );
            $orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

            if ( wc_get_loop_prop( 'is_search' ) ) {
                $catalog_orderby_options = array_merge( array( 'relevance' => esc_html__( 'Relevance', 'ripara' ) ), $catalog_orderby_options );

                unset( $catalog_orderby_options['menu_order'] );
            }

            if ( ! $show_default_orderby ) {
                unset( $catalog_orderby_options['menu_order'] );
            }

            if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
                unset( $catalog_orderby_options['rating'] );
            }

            if(!$list_item) wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby ) );
            else {
                if( $orderby == 'menu_order' || $orderby == 'menu_order title' ) $order_key = 'menu_order';
                else $order_key = $orderby;
                ?>
                <div class="dropdown-box show-by show-order">
                    <a href="<?php echo esc_url("#") ?>" class="dropdown-link">
                        <span class="silver set-orderby"><?php echo esc_html($catalog_orderby_options[$order_key])?></span>
                    </a>
                    <ul class="dropdown-list list-none">
                        <?php
                        foreach ($catalog_orderby_options as $key => $value) {
                            if($key == $order_key) $active = ' active';
                            else $active = '';
                            echo '<li><a data-orderby="'.esc_attr($key).'" class="'.esc_attr($add_class.$active).'" href="'.esc_url(tech888f_get_key_url('orderby',$key)).'">'.$value.'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            <?php }
        }
    }
    /********************************** Shop ajax ************************************/
    
    if(!function_exists('tech888f_load_shop')){
        function tech888f_load_shop() {
            $data_filter = $_POST['filter_data'];
            extract($data_filter);
            if(!isset($page)) $page = 1;
            $args = array(
                'post_type'         => 'product',
                'order'             => 'ASC',
                'posts_per_page'    => $number,
                'paged'             => $page,
            );
            if(isset($s)) if(!empty($s)){
                $args['s'] = $s;
                $args['order'] = 'DESC';
            }
            $attr_taxquery = array();
            if(!empty($attributes)){
                foreach($attributes as $key => $term){
                    $attr_taxquery[] =  array(
                                            'taxonomy'      => 'pa_'.$key,
                                            'terms'         => $term,
                                            'field'         => 'slug',
                                            'operator'      => 'IN'
                                        );
                }
            }
            if(!empty($cats)) {
                if(is_string($cats)) $cats = explode(",",$cats);
                $attr_taxquery[]=array(
                    'taxonomy'=>'product_cat',
                    'field'=>'slug',
                    'terms'=> $cats
                );
            }
            if(!empty($tags)) {
                if(is_string($tags)) $tags = explode(",",$tags);
                $attr_taxquery[]=array(
                    'taxonomy'=>'product_tag',
                    'field'=>'slug',
                    'terms'=> $tags
                );
            }
            if (!empty($attr_taxquery)){
                $attr_taxquery['relation'] = 'AND';
                $args['tax_query'] = $attr_taxquery;
            }
            if( isset( $price['min']) && isset( $price['max']) ){
                $min = $price['min'];
                $max = $price['max'];
                if($max != $max_price || $min != $min_price) $args['post__in'] = tech888f_filter_price($min,$max);
            }
            switch ($orderby) {
                case 'price' :
                    $args['orderby']  = "meta_value_num ID";
                    $args['order']    = 'ASC';
                    $args['meta_key'] = '_price';
                break;

                case 'price-desc' :
                    $args['orderby']  = "meta_value_num ID";
                    $args['order']    = 'DESC';
                    $args['meta_key'] = '_price';
                break;

                case 'popularity' :
                    $args['meta_key'] = 'total_sales';                        
                    $args['order']    = 'DESC';
                break;

                case 'rating' :
                    $args['meta_key'] = '_wc_average_rating';
                    $args['orderby'] = 'meta_value_num';
                    $args['order']    = 'DESC';
                break;

                case 'date':
                    $args['orderby'] = 'date';
                    $args['order']    = 'DESC';
                    break;
                
                default:
                    $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
                    if($order_default == 'menu_order') $order_default = $order_default.' title';
                    $args['orderby'] = $order_default;
                    break;
            }
            if(isset($s)){
                if(!empty($s) && $args['orderby'] == 'menu_order title'){
                    unset($args['order']);
                    unset($args['orderby']);
                }
            }
            $attr = array(
                'style'         => $style,
                'item_style'    => $item_style,
                'item_style_list'=> $item_style_list,
                'column'        => $column,
                'size'          => $size,
                'size_list'     => $size_list,
                'number'        => $number,
                'animation'     => $animation,
                );
            echo '<div class="products row list-product-wrap js-content-main">';
            $product_query = new WP_Query($args);
            $max_page = $product_query->max_num_pages;
            $slug = $item_style;
            if($style == 'list') $slug = $item_style_list;
            if($product_query->have_posts()) {
                while($product_query->have_posts()) {
                    $product_query->the_post();
                    tech888f_get_template_woocommerce('loop/'.$style.'/'.$style,$slug,$attr,true);
                }
            }
            echo    '</div>';
            if($shop_style == 'load-more' && $max_page > 1){
                $data_load = array(
                    "args"        => $args,
                    "attr"        => $attr,
                    );
                $data_loadjs = json_encode($data_load);
                echo    '<div class="btn-loadmore">
                            <a href="'.esc_url("#").'" class="product-loadmore loadmore" 
                                data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                                data-maxpage="'.esc_attr($max_page).'">
                                '.esc_html__("Load more","ripara").'
                            </a>
                        </div>';
            }
            else tech888f_get_template_woocommerce('loop/pagination','',array('wp_query'=>$product_query,'paged'=>$page),true);
            wp_reset_postdata();
            die();
        }
    }
    //Load more product
    if(!function_exists('tech888f_load_more_product')){
        function tech888f_load_more_product() {
            $paged = $_POST['paged'];
            $load_data = $_POST['load_data'];
            $load_data = str_replace('\"', '"', $load_data);
            $load_data = str_replace('\/', '/', $load_data);
            $load_data = json_decode($load_data,true);
            extract($load_data);
            extract($attr);
            $args['paged'] = $paged + 1;
            $query = new WP_Query($args);
            $count = 1;
            $count_query = $query->post_count;
            $slug = $item_style;
            if($style == 'list') $slug = $item_style_list;
            if($query->have_posts()) {
                while($query->have_posts()) {
                    $query->the_post();
                    tech888f_get_template_woocommerce('loop/'.$style.'/'.$style,$slug,$attr,true);
                    $count++;
                }
            }
            wp_reset_postdata();
            die();
        }
    }

    //Load more product
    if(!function_exists('tech888f_load_product_filter')){
        function tech888f_load_product_filter() {
            $paged = $_POST['paged'];
            $load_data = $_POST['load_data'];
            $load_data = str_replace('\"', '"', $load_data);
            $load_data = str_replace('\/', '/', $load_data);
            $load_data = json_decode($load_data,true);
            extract($load_data);
            extract($attr);            
            $filter_data = $_POST['filter_data'];
            extract($filter_data);
            $args['paged'] = $paged;
            $attr_taxquery = array();
            if(!empty($attributes)){                
                $attr_taxquery['relation'] = 'AND';
                foreach($attributes as $attr_t => $term){
                    $attr_taxquery[] =  array(
                                            'taxonomy'      => 'pa_'.$attr_t,
                                            'terms'         => $term,
                                            'field'         => 'slug',
                                            'operator'      => 'IN'
                                        );
                }
            }
            if(!empty($cats)) {
                $attr_taxquery[]=array(
                    'taxonomy'=>'product_cat',
                    'field'=>'slug',
                    'terms'=> $cats
                );
            }
            if ( !empty($attr_taxquery)){                
                $args['tax_query'] = $attr_taxquery;
            }
            if( isset( $price['min']) && isset( $price['max']) ){
                $min = $price['min'];
                $max = $price['max'];
                if($max != $max_price || $min != $min_price) $args['post__in'] = tech888f_filter_price($min,$max);
            }
            $query = new WP_Query($args);
            $count = 1;
            $count_query = $query->post_count;
            $max_page = $query->max_num_pages;
            $slug = $item_style;
            if($style == 'list') $slug = $item_style_list;
            if(isset($pagination) && !empty($pagination)){?>
                <div class="products row list-product-wrap js-content-main">
                    <?php
                    if($query->have_posts()) {
                        while($query->have_posts()) {
                            $query->the_post();
                            tech888f_get_template_woocommerce('loop/'.$style.'/'.$style,$slug,$attr,true);
                            $count++;
                        }
                    }
                    else echo '<div class="filter-noresult-wrap"><div class="filter-noresult title18 text-center">'.esc_html__("No result found with current filter value.","ripara").'</div></div>';
                    ?>
                </div>
                <?php
                if($pagination == 'load-more' && $max_page > 1){
                    $data_load = array(
                        "args"        => $args,
                        "attr"        => $attr,
                        );
                    $data_loadjs = json_encode($data_load);
                    echo    '<div class="btn-loadmore">
                                <a href="'.esc_url("#").'" class="product-loadmore loadmore" 
                                    data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                                    data-maxpage="'.esc_attr($max_page).'">
                                    '.esc_html__("Load more","ripara").'
                                </a>
                            </div>';
                }
                if($pagination == 'pagination') tech888f_get_template_woocommerce('loop/pagination','',array('wp_query'=>$query,'paged'=>$paged),true);
    
            }
            else{
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        tech888f_get_template_woocommerce('loop/'.$style.'/'.$style,$slug,$attr,true);
                        $count++;
                    }
                }
                else echo '<div class="filter-noresult-wrap"><div class="filter-noresult title18 text-center">'.esc_html__("No result found with current filter value.","ripara").'</div></div>';
            }
            wp_reset_postdata();
            die();
        }
    }

    if(!function_exists('tech888f_single_upsell_product')){
        function tech888f_single_upsell_product($style=''){
            tech888f_get_template_woocommerce('single-product/upsell',$style,false,true);
        }
    }
    if(!function_exists('tech888f_single_lastest_product')){
        function tech888f_single_lastest_product(){
            tech888f_get_template_woocommerce('single-product/latest','',false,true);
        }
    }
    if(!function_exists('tech888f_single_relate_product')){
        function tech888f_single_relate_product($style=''){            
            if(is_product()){
                tech888f_get_template_woocommerce('single-product/related','',false,true);
            }
        }
    }

    if(!function_exists('tech888f_show_single_product_data')){
        function tech888f_show_single_product_data(){
            $show_latest     = tech888f_get_opt('show_latest');
            $show_upsell     = tech888f_get_opt('show_upsell','on');
            $show_related    = tech888f_get_opt('show_related','on');
            $number     = tech888f_get_opt('show_single_number');
            $size       = tech888f_get_opt('show_single_size');
            $item_res   = tech888f_get_opt('show_single_itemres','0:1,480:2,990:3,1200:4');
            $item_style   = tech888f_get_opt('show_single_item_style');
            $size = tech888f_get_size_crop($size);
            $attr = array(
                'show_latest'   => $show_latest,
                'show_upsell'   => $show_upsell,
                'show_related'  => $show_related,
                'number'        => $number,
                'size'          => $size,
                'item_res'      => $item_res,
                'item_style'    => $item_style,
            );
            return $attr;
        }
    }
    if(!function_exists('tech888f_product_tabs')){
        function tech888f_product_tabs(){
            $tab_style = tech888f_get_opt('product_tab_detail');
            tech888f_get_template_woocommerce('single-product/tabs','',false,true);
        }
    }

    if(!function_exists('tech888f_product_tabs_before')){
        function tech888f_product_tabs_before(){            
            $page_id = tech888f_get_opt('before_append_tab');
            if(!empty($page_id)) echo '<div class="content-append-before-tab">'.tech888f_Template::get_vc_pagecontent($page_id).'</div>';
        }
    }    

    if(!function_exists('tech888f_product_tabs_after')){
        function tech888f_product_tabs_after(){            
            $page_id = tech888f_get_opt('after_append_tab');
            if(!empty($page_id)) echo '<div class="content-append-after-tab">'.tech888f_Template::get_vc_pagecontent($page_id).'</div>';
        }
    }
}
