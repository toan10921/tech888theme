<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 05/09/15
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_posts')){
    function tech888f_vc_posts($attr, $content = false){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'display'       => 'grid',
            'style'         => 'default',
            'post_list_style' => '',
            'title'         => '',
            'des'           => '',
            'number'        => '8',
            'cats'          => '',
            'order_by'      => 'date',
            'order'         => 'DESC',
            'column'        => '1',
            'row_number'    => '1',
            'pagination'    => '',
            'grid_type'     => '',
            'item_style'    => '',
            'item'          => '',
            'item_res'      => '',
            'speed'         => '',
            'slider_navi'   => '',
            'slider_pagi'   => '',
            'size'          => '',
            'el_class'      => '',
            'custom_css'    => '',
            'excerpt'       => '',
            'custom_ids'    => '',
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $el_class .= ' blog-'.$display.'-view '.$grid_type.' '.$style;
        $paged = (get_query_var('paged') && $display != 'slider') ? get_query_var('paged') : 1;
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => $paged,
            );            
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'category',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        if(!empty($custom_ids)){
            $args['post__in'] = explode(',', $custom_ids);
        }
        $post_query = new WP_Query($args);
        $count = 1;
        $count_query = $post_query->post_count;
        $max_page = $post_query->max_num_pages;
        $size = tech888f_get_size_crop($size);
        $attr = array_merge($attr,array(
            'el_class'      => $el_class,
            'post_query'    => $post_query,
            'count'         => $count,
            'count_query'   => $count_query,
            'max_page'      => $max_page,
            'args'          => $args,
            'size'          => $size,
        ));
        $html = tech888f_get_template_element('posts/'.$display,$style,$attr);
        wp_reset_postdata();
        return $html;
    }
}
tech888f_reg_shortcode('tech888f_posts','tech888f_vc_posts');
$check_add = '';
if(isset($_GET['return'])) $check_add = sanitize_text_field($_GET['return']);
if(empty($check_add)) add_action( 'vc_before_init_base','tech888f_add_list_post',10,100 );
if ( ! function_exists( 'tech888f_add_list_post' ) ) {
    function tech888f_add_list_post(){
        vc_map( array(
            "name"      => esc_html__("Posts", 'mptheme'),
            "base"      => "tech888f_posts",
            "icon"      => "icon-st",
            "category"      => esc_html__("Tech888-Elements", 'mptheme'),
            "description"   => esc_html__( 'Display list of post', 'mptheme' ),
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
                        esc_html__('Default','mptheme')     => 'default',
                        esc_html__('Style 2','mptheme')     => 'layout-style2',
                        ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'     => esc_html__( 'Display', 'mptheme' ),
                    "admin_label"   => true,
                    'type'        => 'dropdown',
                    'description' => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'  => 'display',
                    'value'       => array(                        
                        esc_html__('Grid','mptheme')      => 'grid',
                        esc_html__('Slider','mptheme')    => 'slider',
                        ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'     => esc_html__( 'Post list style', 'mptheme' ),
                    'type'        => 'dropdown',
                    'description' => esc_html__( 'Post list style for style 2 layout.', 'mptheme' ),
                    'param_name'  => 'post_list_style',
                    'value'         => tech888f_get_post_list_style(),
                    'dependency'  => array(
                        "element"  => "style",
                        "value"    => "layout-style2",
                    )
                ),
                array(
                    'heading'     => esc_html__( 'Number', 'mptheme' ),
                    'type'        => 'textfield',
                    'description' => esc_html__( 'Enter number of product. Default is 8.', 'mptheme' ),
                    'param_name'  => 'number',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Custom IDs', 'mptheme' ),
                    'param_name'  => 'custom_ids',
                    'description' => esc_html__( 'Enter list ID. Separate values by ",". Example is 12,15,20', 'mptheme' ),
                ),
                array(
                    'heading'     => esc_html__( 'Post Categories', 'mptheme' ),
                    'type'        => 'autocomplete',
                    'param_name'  => 'cats',
                    'settings' => array(
                        'multiple' => true,
                        'sortable' => true,
                        'values' => tech888f_get_list_taxonomy('category'),
                    ),
                    'save_always' => true,
                    'description' => esc_html__( 'List of post categories', 'mptheme' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Order By', 'mptheme' ),
                    'value' => tech888f_get_order_list(),
                    'param_name' => 'orderby',
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
                    "type"          => "textfield",
                    "heading"       => esc_html__("Grid Sub string excerpt",'mptheme'),
                    "param_name"    => "excerpt",
                    'description'   => esc_html__( 'Enter number of character want to get from excerpt content. Default is 0(hidden). Example is 80. Note: This value only apply for items style can be show excerpt.', 'mptheme' ),
                ),
                array(
                    'heading'       => esc_html__( 'Post style', 'mptheme' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
                    'param_name'    => 'item_style',
                    'value'         => tech888f_get_post_style(),
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
                        "element"       => "display",
                        "value"         => "grid",
                    ),
                ),  
                array(
                    'heading'     => esc_html__( 'Column', 'mptheme' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'column',
                    'value' => array(
                        esc_html__('1 column','mptheme')  => '1',
                        esc_html__('2 columns','mptheme')  => '2',
                        esc_html__('3 columns','mptheme')  => '3',
                        esc_html__('4 columns','mptheme')  => '4',
                        esc_html__('5 columns','mptheme')  => '5',
                        esc_html__('6 columns','mptheme')  => '6',
                    ),
                    'description' => esc_html__( 'Select Column display ', 'mptheme' ),
                    "group"         => esc_html__("Grid Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "display",
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
                        "element"       => "display",
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
                    "type"          => "textfield",
                    "heading"       => esc_html__("Item",'mptheme'),
                    "param_name"    => "item",
                    "group"         => esc_html__("Slider Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "display",
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
                        "element"       => "display",
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
                        "element"       => "display",
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
                        "element"       => "display",
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
                ),
                "group"         => esc_html__("Slider Settings",'mptheme'),
                    "dependency"    =>  array(
                        "element"       => "display",
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
                        "element"       => "display",
                        "value"         => "slider",
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
