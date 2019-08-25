<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
if(!function_exists('tech888f_vc_shop')){
    function tech888f_vc_shop($attr){
        $html = $css_class = '';
        $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        if($order_default == 'menu_order') $order_default = $order_default.' title';
        $data_array = array_merge(array(
            'style'         => 'grid',
            'number'        => '12',
            'cats'          => '',
            'orderby'       => $order_default,
            'column'        => '2',
            'size'          => '',
            'size_list'     => '',
            'item_style'    => '',
            'item_style_list' => '',
            'grid_type'     => '',
            'shop_style'    => '',
            'check_type'    => '1',
            'check_number'  => '1',
            'check_hd_sidebar' => 'off',
            'check_attr_filter' => 'off',
            'el_class'      => '',
            'custom_css'    => '',
            'animation'     => '',
            'gap'           => '',
            'shop_ajax'     => '',
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;

        $el_class .= ' product-'.$style.'-view '.$grid_type.' '.$gap;
        if(isset($_GET['orderby'])) $orderby = sanitize_text_field($_GET['orderby']);
        if(isset($_GET['type'])) $style = sanitize_text_field($_GET['type']);
        if(isset($_GET['number'])) $number = sanitize_text_field($_GET['number']);
        $size = tech888f_get_size_crop($size);
        $size_list = tech888f_get_size_crop($size_list);
        $attr = array_merge($attr,array(
            'style'     => $style,
            'size'      => $size,
            'size_list' => $size_list,
            'number'    => $number,
            ));
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type'         => 'product',
            'order'             => 'ASC',
            'posts_per_page'    => $number,
            'paged'             => $paged,
            );
        $attr_taxquery = array();
        $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
        if(!empty($_chosen_attributes) && is_array($_chosen_attributes)){
            $attr_taxquery = array('relation ' => 'AND');
            foreach ($_chosen_attributes as $key => $value) {
                $attr_taxquery[] =  array(
                                    'taxonomy'      => $key,
                                    'terms'         => $value['terms'],
                                    'field'         => 'slug',
                                    'operator'      => 'IN'
                                );
            }            
        }
        if(isset( $_GET['product_cat'])) $cats = sanitize_text_field($_GET['product_cat']);
        if(!empty($cats)) {
            $cats = explode(",",$cats);
            $attr_taxquery[]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $cats
            );
        }
        if (!empty($attr_taxquery)){
            $attr_taxquery['relation'] = 'AND';
            $args['tax_query'] = $attr_taxquery;
        }
        if( isset( $_GET['min_price']) && isset( $_GET['max_price']) ){
            $min = sanitize_text_field($_GET['min_price']);
            $max = sanitize_text_field($_GET['max_price']);
            $args['post__in'] = tech888f_filter_price($min,$max);
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
                $args['orderby'] = $order_default;
                break;
        }
        $html .= tech888f_get_template('top-filter','',array('style'=>$style,'number'=>$number,'check_number'=>$check_number,'check_type'=>$check_type,'check_hd_sidebar'=>$check_hd_sidebar,'check_attr_filter'=>$check_attr_filter,'check_order'=>true),false);
        $attr_ajax = array(
                'item_style'    => $item_style,
                'item_style_list'=> $item_style_list,
                'column'        => $column,
                'size'          => $size,
                'size_list'     => $size_list,
                'shop_style'    => $shop_style,
                'number'        => $number,
                'animation'     => $animation,
                'cats'          => $cats,
                );
            $data_ajax = array(
                "attr"        => $attr_ajax,
                );
            $data_ajax = json_encode($data_ajax);
        $html .=    '<div class="'.esc_attr($el_class).' has-list-'.esc_attr($column).'-item products-wrap js-content-wrap content-wrap-shop" data-load="'.esc_attr($data_ajax).'">
                        <div class="products row list-product-wrap js-content-main">';
        $product_query = new WP_Query($args);
        $max_page = $product_query->max_num_pages;
        $slug = $item_style;
        if($style == 'list') $slug = $item_style_list;
        if($product_query->have_posts()) {
            while($product_query->have_posts()) {
                $product_query->the_post();
                $html .= tech888f_get_template_woocommerce('loop/'.$style.'/'.$style,$slug,$attr,false);
            }
        }
        $html .=    '</div>';
        if($shop_style == 'load-more' && $max_page > 1){
            $data_load = array(
                "args"        => $args,
                "attr"        => $attr,
                );
            $data_loadjs = json_encode($data_load);
            $html .=    '<div class="btn-loadmore">
                            <a href="#" class="product-loadmore loadmore btn-mptheme" 
                                data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                                data-maxpage="'.esc_attr($max_page).'">
                                '.esc_html__("Load more","mptheme").'
                            </a>
                        </div>';
        }
        else $html .= tech888f_get_template_woocommerce('loop/pagination','',array('wp_query'=>$product_query),false);
        $html .=    '</div>';        
        wp_reset_postdata();
        return $html;
    }
}

tech888f_reg_shortcode('tech888f_shop','tech888f_vc_shop');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','tech888f_admin_shop',10,100 );
if ( ! function_exists( 'tech888f_admin_shop' ) ) {
    function tech888f_admin_shop(){
        $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        if($order_default == 'menu_order') $order_default = $order_default.' title';
        vc_map( array(
            "name"      => esc_html__("Shop", 'mptheme'),
            "base"      => "tech888f_shop",
            "icon"      => "icon-st",
            "category"      => esc_html__("Tech888-Elements", 'mptheme'),
            "description"   => esc_html__( 'Display shop page', 'mptheme' ),
            "params"    => array(
                array(
                    "type"          => "dropdown",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Active Style",'mptheme'),
                    "param_name"    => "style",
                    "value"         => array(
                        esc_html__("Grid",'mptheme')   => 'grid',
                        esc_html__("List",'mptheme')   => 'list',
                        ),
                    ),
                array(
                    "type"          => "dropdown",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Shop ajax",'mptheme'),
                    "param_name"    => "shop_ajax",
                    "value"         => array(
                        esc_html__("Off",'mptheme')   => '',
                        esc_html__("On",'mptheme')   => 'on',
                        ),
                    ),
                array(
                    'heading'     => esc_html__( 'Number', 'mptheme' ),
                    'type'        => 'textfield',
                    'description' => esc_html__( 'Enter number of product. Default is 12.', 'mptheme' ),
                    'param_name'  => 'number',
                    ),                
                array(
                    'heading'     => esc_html__( 'Product Categories', 'mptheme' ),
                    'type'        => 'autocomplete',
                    'param_name'  => 'cats',
                    'settings' => array(
                        'multiple' => true,
                        'sortable' => true,
                        'values' => tech888f_get_list_taxonomy(),
                    ),
                    'save_always' => true,
                    'description' => esc_html__( 'List of product categories', 'mptheme' ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order By",'mptheme'),
                    "param_name" => "orderby",
                    "value"         => array(
                        esc_html__( 'Default sorting', 'mptheme' )          => $order_default,
                        esc_html__( 'Popularity (sales)', 'mptheme' )       => 'popularity',
                        esc_html__( 'Average Rating', 'mptheme' )           => 'rating',
                        esc_html__( 'Sort by most recent', 'mptheme' )      =>'date',
                        esc_html__( 'Sort by price (asc)', 'mptheme' )      => 'price',
                        esc_html__( 'Sort by price (desc)', 'mptheme' )     =>'price-desc',
                        ),
                    ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Size Thumbnail(List)",'mptheme'),
                    "param_name"    => "size_list",
                    'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'mptheme' ),
                    ),
                array(
                    'heading'     => esc_html__( 'Gap products', 'mptheme' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'gap',
                    'value' => array(                   
                        esc_html__('Default','mptheme')  => '',
                        esc_html__('0px','mptheme')   => 'gap-0',
                        esc_html__('5px','mptheme')   => 'gap-5',
                        esc_html__('10px','mptheme')  => 'gap-10',
                        esc_html__('15px','mptheme')  => 'gap-15',
                        esc_html__('20px','mptheme')  => 'gap-20',
                        esc_html__('30px','mptheme')  => 'gap-30',
                        esc_html__('40px','mptheme')  => 'gap-40',
                        esc_html__('50px','mptheme')  => 'gap-50',
                    ),
                    'description' => esc_html__( 'Select space for products.', 'mptheme' ),
                ),
                array(
                    'heading'       => esc_html__( 'Thumbnail animation', 'mptheme' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'    => 'animation',
                    'value'         => tech888f_get_product_thumb_animation(),
                    ),
                array(
                    'heading'       => esc_html__( 'List item style', 'mptheme' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'    => 'item_style_list',
                    'value'         => tech888f_get_product_list_style(),
                    ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Show type filter",'mptheme'),
                    "param_name"    => "check_type",
                    "value"         => array(
                        esc_html__("On",'mptheme')   => '1',
                        esc_html__("Off",'mptheme')   => '0',
                        ),
                    'description'   => esc_html__( 'Show/hide type filter(list/grid) on blog page.', 'mptheme' ),
                    ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Show number filter",'mptheme'),
                    "param_name"    => "check_number",
                    "value"         => array(
                        esc_html__("On",'mptheme')   => '1',
                        esc_html__("Off",'mptheme')   => '0',
                        ),
                    'description'   => esc_html__( 'Show/hide number filter on blog page.', 'mptheme' ),
                    ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Show Hidden sidebar",'mptheme'),
                    "param_name"    => "check_hd_sidebar",
                    "value"         => array(
                        esc_html__("On",'mptheme')   => 'on',
                        esc_html__("Off",'mptheme')   => 'off',
                    ),
                    "std"           => "off",
                    'description'   => esc_html__( 'Show/hide hidden sidebar on shop page.', 'mptheme' ),
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Show Attribute Filter",'mptheme'),
                    "param_name"    => "check_attr_filter",
                    "value"         => array(
                        esc_html__("On",'mptheme')   => 'on',
                        esc_html__("Off",'mptheme')   => 'off',
                    ),
                    "std"           => "off",
                    'description'   => esc_html__( 'Show/hide attribute filter on shop page.', 'mptheme' ),
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Shop Display",'mptheme'),
                    "param_name"    => "shop_style",
                    "value"         => array(
                        esc_html__("Default",'mptheme')             => '',
                        esc_html__("Load more button",'mptheme')    => 'load-more',
                        ),
                    ),        
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Grid Display",'mptheme'),
                    "param_name"    => "grid_type",
                    "value"         => array(
                        esc_html__("Default",'mptheme')   => '',
                        esc_html__("Masonry",'mptheme')   => 'list-masonry',
                        ),
                    'group'         => esc_html__('Grid Settings','mptheme'),
                    ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Size Thumbnail(Grid)",'mptheme'),
                    "param_name"    => "size",
                    'group'         => esc_html__('Grid Settings','mptheme'),
                    'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height), for multi size: 200x100|200x200 separate by "|" or ",").', 'mptheme' ),
                    ),
                array(
                    'heading'       => esc_html__( 'Grid item style', 'mptheme' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'    => 'item_style',
                    'value'         => tech888f_get_product_style(),
                    'group'         => esc_html__('Grid Settings','mptheme'),
                    ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Column",'mptheme'),
                    "param_name" => "column",
                    "value"         => array(
                        esc_html__("2 Column","mptheme")  => '2',
                        esc_html__("3 Column","mptheme")  => '3',
                        esc_html__("4 Column","mptheme")  => '4',
                        esc_html__("5 Column","mptheme")  => '5',
                        esc_html__("6 Column","mptheme")  => '6',
                        esc_html__("7 Column","mptheme")  => '7',
                        esc_html__("8 Column","mptheme")  => '8',
                        esc_html__("9 Column","mptheme")  => '9',
                        esc_html__("10 Column","mptheme") => '10',
                        ),
                    'group'         => esc_html__('Grid Settings','mptheme'),
                    ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name",'mptheme'),
                    "param_name"    => "el_class",
                    'group'         => esc_html__('Design Options','mptheme'),
                    'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'mptheme' )
                    ),
                array(
                    "type"          => "css_editor",
                    "heading"       => esc_html__("CSS box",'mptheme'),
                    "param_name"    => "custom_css",
                    'group'         => esc_html__('Design Options','mptheme')
                    ),
                ),        
        ));
    }
}
}
