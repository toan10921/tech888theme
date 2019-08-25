<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 05/09/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
    if(!function_exists('tech888f_vc_products')){
        function tech888f_vc_products($attr, $content = false){
            $html = $css_class = '';
            $data_array = array_merge(array(
                'style'         => 'grid',
                'title'         => '',
                'des'           => '',
                'number'        => '8',
                'cats'          => '',
                'order_by'      => 'date',
                'order'         => 'DESC',
                'product_type'  => '',
                'column'        => '2',
                'row_number'    => '1',
                'gap'           => '',
                'pagination'    => '',
                'grid_type'     => '',
                'item_style'    => '',
                'product_layout' => '',
                'category_slide' => '',
                'item'          => '',
                'item_res'      => '',
                'speed'         => '',
                'slider_navi'   => '',
                'slider_pagi'   => '',
                'size'          => '',
                'animation'     => '',
                'el_class'      => '',
                'custom_css'    => '',
                'custom_ids'    => '',
                'filter_show'   => '',
                'filter_cats'   => '',
                'filter_price'  => 'yes',
                'filter_attr'   => '',
                'filter_style'  => '',
                'filter_column' => 'filter-2-col',
                'filter_pos'    => ''
            ),tech888f_get_responsive_default_atts());
            $attr = shortcode_atts($data_array,$attr);
            extract($attr);
            $css_classes = vc_shortcode_custom_css_class( $custom_css );
            $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );

            // Variable process vc_shortcodes_css_class
            if(!empty($css_class)) $el_class .= ' '.$css_class;
            $el_class .= ' product-'.$style.'-view '.$grid_type.' '.$style.' filter-'.$filter_show;
            $paged = (get_query_var('paged') && $style != 'slider') ? get_query_var('paged') : 1;
            $args = array(
                'post_type'         => 'product',
                'posts_per_page'    => $number,
                'orderby'           => $order_by,
                'order'             => $order,
                'paged'             => $paged,
                );
            if($product_type == 'trending'){
                $args['meta_query'][] = array(
                        'key'     => 'trending_product',
                        'value'   => '1',
                        'compare' => '=',
                    );
            }
            if($product_type == 'toprate'){
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby'] = 'meta_value_num';
                $args['meta_query'] = WC()->query->get_meta_query();
                $args['tax_query'][] = WC()->query->get_tax_query();
            }
            if($product_type == 'mostview'){
                $args['meta_key'] = 'post_views';
                $args['orderby'] = 'meta_value_num';
            }
            if($product_type == 'menu_order'){
                $args['meta_key'] = 'menu_order';
                $args['orderby'] = 'meta_value_num';
            }
            if($product_type == 'bestsell'){
                $args['meta_key'] = 'total_sales';
                $args['orderby'] = 'meta_value_num';
            }
            if($product_type=='onsale'){
                $args['meta_query']['relation']= 'OR';
                $args['meta_query'][]=array(
                    'key'   => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type'          => 'numeric'
                );
                $args['meta_query'][]=array(
                    'key'   => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type'          => 'numeric'
                );
            }
            if($product_type == 'featured'){
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
            }
            if(!empty($cats)) {
                $custom_list = explode(",",$cats);
                $args['tax_query'][]=array(
                    'taxonomy'=>'product_cat',
                    'field'=>'slug',
                    'terms'=> $custom_list
                );
            }
            if(!empty($custom_ids)){
                $args['post__in'] = explode(',', $custom_ids);
            }
            $product_query = new WP_Query($args);
            $count = 1;
            $count_query = $product_query->post_count;
            $max_page = $product_query->max_num_pages;
            $size = tech888f_get_size_crop($size);
            if($gap != '') $el_class .= ' '.$gap;

            /* param group product layout style3 */
            if(isset($category_slide)){
                $category_slide = (array) vc_param_group_parse_atts( $category_slide );
            }


            $default_val = array(
                'image'     => '',
                'title'     => '',
                'price'     =>  '',
            );

            $attr = array_merge($attr,array(
                'el_class'      => $el_class,
                'product_query' => $product_query,
                'count'         => $count,
                'count_query'   => $count_query,
                'max_page'      => $max_page,
                'args'          => $args,
                'size'          => $size,
                'category_slide' => $category_slide,
                'default_val'  => $default_val
            ));

            $html = tech888f_get_template_element('products/'.$style,'',$attr);
            wp_reset_postdata();
            return $html;
        }
    }
tech888f_reg_shortcode('tech888f_products','tech888f_vc_products');
$check_add = '';
if(isset($_GET['return'])) $check_add = sanitize_text_field($_GET['return']);
if(empty($check_add)) add_action( 'vc_before_init_base','tech888f_add_list_product',10,100 );
if ( ! function_exists( 'tech888f_add_list_product' ) ) {
    function tech888f_add_list_product(){
        $tab_id = 'tech888f_'.uniqid();
        vc_map( array(
            "name"      => esc_html__("Products", 'mptheme'),
            "base"      => "tech888f_products",
            "icon"      => "icon-st",
            "category"      => esc_html__("Tech888-Elements", 'mptheme'),
            "description"   => esc_html__( 'Display list of product', 'mptheme' ),
            "params"    => array(
                array(
                    'type'        => 'textfield',
                    "admin_label"   => true,
                    'heading'     => esc_html__( 'Title', 'mptheme' ),
                    'param_name'  => 'title',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Description', 'mptheme' ),
                    'param_name'  => 'des',
                ),
                array(
                    'heading'     => esc_html__( 'Style', 'mptheme' ),
                    "admin_label"   => true,
                    'type'        => 'dropdown',
                    'description' => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'  => 'style',
                    'value'       => array(
                        esc_html__('Grid','mptheme')      => 'grid',
                        esc_html__('Slider','mptheme')    => 'slider',
                        ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'     => esc_html__( 'Number', 'mptheme' ),
                    'type'        => 'textfield',
                    'description' => esc_html__( 'Enter number of product. Default is 8.', 'mptheme' ),
                    'param_name'  => 'number',
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Custom IDs', 'mptheme' ),
                    'param_name'  => 'custom_ids',
                    'description' => esc_html__( 'Enter list ID. Separate values by ",". Example is 12,15,20', 'mptheme' ),
                ),
                array(
                    'heading'     => esc_html__( 'Product Type', 'mptheme' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'product_type',
                    'value' => array(
                        esc_html__('Default','mptheme')            => '',
                        esc_html__('Trending','mptheme')          => 'trending',
                        esc_html__('Featured Products','mptheme')  => 'featured',
                        esc_html__('Best Sellers','mptheme')       => 'bestsell',
                        esc_html__('On Sale','mptheme')            => 'onsale',
                        esc_html__('Top rate','mptheme')           => 'toprate',
                        esc_html__('Most view','mptheme')          => 'mostview',
                        esc_html__('Menu order','mptheme')         => 'menu_order',
                    ),
                    'description' => esc_html__( 'Select Product View Type', 'mptheme' ),
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
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Order By', 'mptheme' ),
                    'value' => tech888f_get_order_list(),
                    'param_name' => 'order_by',
                    'description' => esc_html__( 'Select Orderby Type ', 'mptheme' ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'     => esc_html__( 'Order', 'mptheme' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'order',
                    'value' => array(
                        esc_html__('Desc','mptheme')  => 'DESC',
                        esc_html__('Asc','mptheme')  => 'ASC',
                    ),
                    'description' => esc_html__( 'Select Order Type ', 'mptheme' ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'       => esc_html__( 'Product style', 'mptheme' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'    => 'item_style',
                    'value'         => tech888f_get_product_style(),
                ),
                array(
                    'heading'       => esc_html__( 'Product Layout', 'mptheme' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'    => 'product_layout',
                    'value'         => array(
                        esc_html__('Default','mptheme')  => '',
                        esc_html__('Style2','mptheme')  => 'style2',
                        esc_html__('Style 3(Product grid 4)','mptheme')  => 'style3',
                        esc_html__('Style 4(Home Grid Layout)','mptheme')  => 'style4',
                    )
                ),
                array(
                    "type"          => "param_group",
                    "heading"       => esc_html__("Category Slider",'mptheme'),
                    "param_name"    => "category_slide",
                    "dependency"    => array(
                        "element"   => "product_layout",
                        "value"     => "style3"
                    ),
                    "params"        => array(
                        array(
                            "type"          => "attach_image",
                            "heading"       => esc_html__("Image",'mptheme'),
                            "param_name"    => "image",
                        ),
                        array(
                            "type"          => "textfield",
                            "heading"       => esc_html__("Title",'mptheme'),
                            "param_name"    => "title",
                        ),
                        array(
                            "type"          => "textfield",
                            "heading"       => esc_html__("Price",'mptheme'),
                            "param_name"    => "price",
                        ),
                        array(
                            'type'          => 'autocomplete',
                            "admin_label"   => true,
                            'heading'        => esc_html__( 'Product Category', 'mptheme' ),
                            'param_name'    => 'slider_style3_prd_cats',
                            'settings' => array(
                                'multiple' => false,
                                'sortable' => false,
                                'values' => tech888f_get_list_taxonomy(),
                            ),
                            'save_always'   => true,
                            'description'   => esc_html__( 'List of product categories', 'mptheme' ),
                        ),
                    )
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
                    'heading'     => esc_html__( 'Grid style', 'mptheme' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'grid_type',
                    'value' => array(
                        esc_html__('Default','mptheme')  => '',
                        esc_html__('Masonry','mptheme')  => 'list-masonry',
                    ),
                    'description' => esc_html__( 'Select Column display ', 'mptheme' ),
                    "group"         => esc_html__("Grid Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "grid",
                    ),
                ),
                array(
                    'heading'     => esc_html__( 'Column', 'mptheme' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'column',
                    'value' => array(
                        esc_html__('1 columns','mptheme')  => '1',
                        esc_html__('2 columns','mptheme')  => '2',
                        esc_html__('3 columns','mptheme')  => '3',
                        esc_html__('4 columns','mptheme')  => '4',
                        esc_html__('5 columns','mptheme')  => '5',
                        esc_html__('6 columns','mptheme')  => '6',
                        esc_html__('7 columns','mptheme')  => '7',
                        esc_html__('8 columns','mptheme')  => '8',
                        esc_html__('9 columns','mptheme')  => '9',
                        esc_html__('10 columns','mptheme')  => '10',
                    ),
                    'description' => esc_html__( 'Select Column display ', 'mptheme' ),
                    "group"         => esc_html__("Grid Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "grid",
                    ),
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Pagination",'mptheme'),
                    "param_name"    => "pagination",
                    "value"         => array(
                        esc_html__("None",'mptheme')                => '',
                        esc_html__("Pagination",'mptheme')          => 'pagination',
                        esc_html__("Load more button",'mptheme')    => 'load-more',
                        ),
                    'group'         => esc_html__('Grid Settings','mptheme'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "grid",
                    ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Size Thumbnail",'mptheme'),
                    "param_name"    => "size",
                    'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height), for multi size: 200x100|200x200 separate by "|" or ",").', 'mptheme' ),
                ),
                array(
                    'heading'       => esc_html__( 'Thumbnail animation', 'mptheme' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'    => 'animation',
                    'value'         => tech888f_get_product_thumb_animation(),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Item",'mptheme'),
                    "param_name"    => "item",
                    "group"         => esc_html__("Slider Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "slider",
                    ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Item Responsive",'mptheme'),
                    "param_name"    => "item_res",
                    "group"         => esc_html__("Slider Settings",'mptheme'),
                    'description'   => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'mptheme' ),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "slider",
                    ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Speed",'mptheme'),
                    "param_name"    => "speed",
                    "group"         => esc_html__("Slider Settings",'mptheme'),
                    'description'   => esc_html__( 'Enter number speed to auto slider (ms). Example is 5000. Default auto is disable.', 'mptheme' ),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "slider",
                    ),
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Row / item slider",'mptheme'),
                    "param_name"    => "row_number",
                    'value' => array(
                        esc_html__('1 row','mptheme')  => '1',
                        esc_html__('2 rows','mptheme')  => '2',
                        esc_html__('3 rows','mptheme')  => '3',
                        esc_html__('4 rows','mptheme')  => '4',
                        esc_html__('5 rows','mptheme')  => '5',
                        esc_html__('6 rows','mptheme')  => '6',
                        esc_html__('7 rows','mptheme')  => '7',
                        esc_html__('8 rows','mptheme')  => '8',
                        esc_html__('9 rows','mptheme')  => '9',
                        esc_html__('10 rows','mptheme')  => '10',
                    ),
                    'description'   => esc_html__( 'Choose number row to display', 'mptheme' ),
                    "group"         => esc_html__("Slider Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "slider",
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Navigation', 'mptheme' ),
                    'param_name'  => 'slider_navi',
                    'value'       => array(
                        esc_html__( 'Hidden', 'mptheme' )                  => '',
                        esc_html__( 'Default Navigation', 'mptheme' )      => 'navi-nav-style',
                        esc_html__( 'Group Navigation', 'mptheme' )        => 'group-navi',
                        esc_html__( 'Style 2 Navigation', 'mptheme' )      => 'navi-nav-style2',
                        esc_html__( 'Style 3 Navigation', 'mptheme' )      => 'navi-nav-style3',
                        esc_html__( 'Style 4 Navigation', 'mptheme' )      => 'navi-nav-style4',
                    ),
                    "group"         => esc_html__("Slider Settings",'mptheme'),
                        "dependency"    =>  array(
                            "element"       => "style",
                            "value"         => "slider",
                        ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Pagination', 'mptheme' ),
                    'param_name'  => 'slider_pagi',
                    'value'       => array(
                        esc_html__( 'Hidden', 'mptheme' )                  => '',
                        esc_html__( 'Default Pagination', 'mptheme' )      => 'pagi-nav-style',
                    ),
                    "group"         => esc_html__("Slider Settings",'mptheme'),
                        "dependency"    =>  array(
                            "element"       => "style",
                            "value"         => "slider",
                        ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Show filter', 'mptheme' ),
                    'param_name'  => 'filter_show',
                    'value'       => array(
                        esc_html__( 'No', 'mptheme' )          => '',
                        esc_html__( 'Yes', 'mptheme' )         => 'yes',
                    ),
                    "group"         => esc_html__("Filter Settings",'mptheme'),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Filter position', 'mptheme' ),
                    'param_name'  => 'filter_pos',
                    'value'       => array(
                        esc_html__( 'Left', 'mptheme' )          => '',
                        esc_html__( 'Right', 'mptheme' )         => 'pull-right',
                        esc_html__( 'Center', 'mptheme' )        => 'text-center',
                    ),
                    "group"         => esc_html__("Filter Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "filter_show",
                        "value"         => "yes",
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Filter style', 'mptheme' ),
                    'param_name'  => 'filter_style',
                    'value'       => array(
                        esc_html__( 'Style 1( Horizontal )', 'mptheme' )         => '',
                        esc_html__( 'Style 2( Column list inline )', 'mptheme' )          => 'filter-col',
                        esc_html__( 'Style 3( Column list )', 'mptheme' )          => 'filter-col filter-col-list',
                    ),
                    "group"         => esc_html__("Filter Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "filter_show",
                        "value"         => "yes",
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Filter column', 'mptheme' ),
                    'param_name'  => 'filter_column',
                    'value'       => array(
                        esc_html__( '2 Column', 'mptheme' )         => 'filter-2-col',
                        esc_html__( '3 Column', 'mptheme' )         => 'filter-3-col',
                        esc_html__( '4 Column', 'mptheme' )         => 'filter-4-col',
                    ),
                    "group"         => esc_html__("Filter Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "filter_style",
                        "value"         => array("filter-col","filter-col filter-col-list"),
                    ),
                ),
                array(
                    'heading'       => esc_html__( 'Filter Categories', 'mptheme' ),
                    'type'          => 'autocomplete',
                    'param_name'    => 'filter_cats',
                    'settings'      => array(
                        'multiple'      => true,
                        'sortable'      => true,
                        'values'        => tech888f_get_list_taxonomy(),
                    ),
                    'save_always'   => true,
                    'description'   => esc_html__( 'List of product categories', 'mptheme' ),
                    "group"         => esc_html__("Filter Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "filter_show",
                        "value"         => "yes",
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Filter price', 'mptheme' ),
                    'param_name'  => 'filter_price',
                    'value'       => array(
                        esc_html__( 'Yes', 'mptheme' )         => 'yes',
                        esc_html__( 'No', 'mptheme' )          => '',
                    ),
                    "group"         => esc_html__("Filter Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "filter_show",
                        "value"         => "yes",
                    ),
                ),
                array(
                    "type"          => "checkbox",
                    "heading"       => esc_html__( "Filter attribute", 'mptheme' ),
                    "param_name"    => "filter_attr",
                    "value"         => tech888f_get_list_attribute(),
                    "description"   => esc_html__( "Check list attribute to filter", 'mptheme' ),
                    "group"         => esc_html__("Filter Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "filter_show",
                        "value"         => "yes",
                    ),
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
            )
        ));
    }
}
}