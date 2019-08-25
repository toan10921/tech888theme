<?php
/**
 * Created by Sublime text 2.
 * User: ToanNgo92
 * Date: 29/02/16
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_blog')){
    function tech888f_vc_blog($attr){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => 'list',
            'column'        => '2',
            'number'        => '10',
            'excerpt'       => '',
            'cats'          => '',
            'order'         => 'DESC',
            'order_by'      => '',
            'post_formats'  => '',
            'size'          => '',
            'size_list'     => '',
            'item_style'    => 'default',
            'item_2_style_layout2' => 'style2',
            'item_style_list' => '',
            'grid_type'     => '',
            'blog_style'    => '',
            'check_type'    => '1',
            'check_number'  => '1',
            'el_class'      => '',
            'custom_css'    => '',
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        // Variable process vc_shortcodes_css_class
        $el_class .= ' blog-'.$style.'-view blog-item-'.$item_style.' '.$grid_type.' '.$css_class;
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

        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => $paged,
        );        
        if($order_by == 'post_views'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'post_views';
        }
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'category',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        if(!empty($post_formats)) {
            $formats_list = explode(",",$post_formats);
            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][]=array(
                'taxonomy'  => 'post_format',
                'field'     => 'slug',
                'terms'     => $formats_list
            );
        }
        $query = new WP_Query($args);
        $count = 1;
        $count_query = $query->post_count;
        $max_page = $query->max_num_pages;
        $html .=    tech888f_get_template('top-filter','',array('style'=>$style,'number'=>$number,'check_number'=>$check_number,'check_type'=>$check_type,'check_hd_sidebar'=>'off','check_attr_filter'=>'off'));
        $html .=    '<div class="js-content-wrap '.esc_attr($el_class).'" data-column="'.esc_attr($column).'">
                        <div class="js-content-main list-post-wrap row">';
        $slug = $item_style;
        if($style == 'list') $slug = $item_style_list;
        if($query->have_posts()) {
            if($grid_type == 'layout2'){
                $slug_item2 = $item_2_style_layout2;
                while($query->have_posts()) {
                    $query->the_post();
                    $surplus = $count%9;
                    if($surplus == 2 || $surplus == 6 || $surplus == 7){
                        $html .=    tech888f_get_template_post($style.'/'.$style,$slug_item2,$attr);
                    }else{
                        $html .=    tech888f_get_template_post($style.'/'.$style,$slug,$attr);
                    }
                    $count++;
                }
            }else{
                while($query->have_posts()) {
                    $query->the_post();
                    $html .=    tech888f_get_template_post($style.'/'.$style,$slug,$attr);
                    $count++;
                }
            }
        }
        $html .=        '</div>';
        if($blog_style == 'load-more' && $max_page > 1){
            $data_load = array(
                "args"        => $args,
                "attr"        => $attr,
                );
            $data_loadjs = json_encode($data_load);
            $html .=    '<div class="btn-loadmore">
                            <a href="#" class="blog-loadmore loadmore btn-mptheme" 
                                data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                                data-maxpage="'.esc_attr($max_page).'">
                                '.esc_html__("Load more","mptheme").'
                            </a>
                        </div>';
        }
        else $html .= tech888f_paging_nav($query,'',false);
        $html .=    '</div>';
        wp_reset_postdata();

        return $html;
    }
}

tech888f_reg_shortcode('tech888f_blog','tech888f_vc_blog');

vc_map( array(
    "name"          => esc_html__("Blog", 'mptheme'),
    "base"          => "tech888f_blog",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display blog page', 'mptheme' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Default Display",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("List",'mptheme')   => 'list',
                esc_html__("Grid",'mptheme')   => 'grid',
                ),
            ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Number post",'mptheme'),
            "param_name"    => "number",
            'description'   => esc_html__( 'Number of post display in this element. Default is 10.', 'mptheme' ),
            ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Size Thumbnail(List)",'mptheme'),
            "param_name"    => "size_list",
            'group'         => esc_html__('List Settings','mptheme'),
            'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height), for multi size: 200x100|200x200 separate by "|" or ",").', 'mptheme' ),
            ),
        array(
            'heading'       => esc_html__( 'List item style', 'mptheme' ),
            'type'          => 'dropdown',
            'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
            'param_name'    => 'item_style_list',
            'value'         => tech888f_get_post_list_style(),
            'group'         => esc_html__('List Settings','mptheme'),
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
            "heading"       => esc_html__("Blog Display",'mptheme'),
            "param_name"    => "blog_style",
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
                esc_html__("Layout 2",'mptheme')   => 'layout2',
                esc_html__("Masonry",'mptheme')   => 'list-masonry',
                ),
            'group'         => esc_html__('Grid Settings','mptheme'),
            ),        
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Grid Sub string excerpt",'mptheme'),
            "param_name"    => "excerpt",
            'group'         => esc_html__('Grid Settings','mptheme'),
            'description'   => esc_html__( 'Enter number of character want to get from excerpt content. Default is 0(hidden). Example is 80. Note: This value only apply for items style can be show excerpt.', 'mptheme' ),
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
            'value'         => tech888f_get_post_style(),
            'group'         => esc_html__('Grid Settings','mptheme'),
            ),
        array(
            'heading'       => esc_html__( 'Grid item 2 style ', 'mptheme' ),
            'type'          => 'dropdown',
            'description'   => esc_html__( 'Choose style to display.', 'mptheme' ),
            'param_name'    => 'item_2_style_layout2',
            'value'         => tech888f_get_post_style(),
            'group'         => esc_html__('Grid Settings','mptheme'),
            'dependency'    => array(
                'element'   => 'grid_type',
                'value'     => 'layout2',
            )
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Column",'mptheme'),
            "param_name"    => "column",
            "value"         => array(
                esc_html__("2 Column","mptheme")    => '2',
                esc_html__("3 Column","mptheme")    => '3',
                esc_html__("4 Column","mptheme")    => '4',
                esc_html__("5 Column","mptheme")    => '5',
                esc_html__("6 Column","mptheme")    => '6',
            ),
            'group'         => esc_html__('Grid Settings','mptheme'),
            ),
        array(
            'heading'       => esc_html__( 'Categories', 'mptheme' ),
            'type'          => 'checkbox',
            'param_name'    => 'cats',
            'value'         => tech888f_list_taxonomy('category',false)
            ),
        array(
            "type"          => "checkbox",
            "heading"       => esc_html__("Post Format",'mptheme'),
            "param_name"    => "post_formats",
            "value"         => array(
                esc_html__("Image","mptheme")          => 'post-format-image',
                esc_html__("Video","mptheme")          => 'post-format-video',
                esc_html__("Gallery","mptheme")        => 'post-format-gallery',
                esc_html__("Audio","mptheme")          => 'post-format-audio',
                esc_html__("Quote","mptheme")          => 'post-format-quote',
                ),
            'description'   => esc_html__( 'Choose post format to display. If empty is show all post.', 'mptheme' )
            ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Order",'mptheme'),
            "param_name"    => "order",
            "value"         => array(
                esc_html__('Desc','mptheme') => 'DESC',
                esc_html__('Asc','mptheme')  => 'ASC',
                ),
            'edit_field_class'=>'vc_col-sm-6 vc_column'
            ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Order By",'mptheme'),
            "param_name"    => "order_by",
            "value"         => tech888f_get_order_list(),
            'edit_field_class'=>'vc_col-sm-6 vc_column'
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
//Load more blog
add_action( 'wp_ajax_load_more_post', 'tech888f_load_more_post' );
add_action( 'wp_ajax_nopriv_load_more_post', 'tech888f_load_more_post' );
if(!function_exists('tech888f_load_more_post')){
    function tech888f_load_more_post() {
        $paged = sanitize_text_field($_POST['paged']);
        $load_data = sanitize_text_field($_POST['load_data']);
        $load_data = str_replace('\"', '"', $load_data);
        $load_data = str_replace('\/', '/', $load_data);
        $load_data = json_decode($load_data,true);
        extract($load_data);
        extract($attr);
        $args['posts_per_page'] = $number;
        $args['paged'] = $paged + 1;
        $query = new WP_Query($args);
        $count = 1;
        $count_query = $query->post_count;
        $slug = $item_style;
        if($style == 'list') $slug = $item_style_list;
        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                tech888f_get_template_post($style.'/'.$style,$slug,$attr,true);
                $count++;
            }
        }
        wp_reset_postdata();
        die();
    }
}