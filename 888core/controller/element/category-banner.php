<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 1/4/2019
 * Time: 9:25 AM
 */
if(!function_exists('tech888f_vc_category_banner'))
{
    function tech888f_vc_category_banner($attr, $content = false)
    {
        $html = $icon_html = '';
        $data_array = array_merge(array(
            'display'       => 'grid',
            'style'         => '',
            'title'         => '',
            'des'           => '',
            'list'          => '',
            'column'        => '3',
            'speed'         => '',
            'row_number'           => '',
            'size'          => '',
            'el_class'      => '',
            'custom_css'    => '',
            'content'       => $content,
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );

        $size = tech888f_get_size_crop($size,'full');

        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $el_class .= ' '.$style;

        $data = (array) vc_param_group_parse_atts( $list );
        $default_val = array(
            'image'     => '',
            'title'     => '',
            'title2'       => '',
            'price'     => '',
            'link'      => '',
            'cats'      => '',
        );

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class'      => $el_class,
            'data'          => $data,
            'default_val'   => $default_val,
            'size'          => $size,
        ));

        // Call function get template

        $html = tech888f_get_template_element('category-banner/category-banner',$style,$attr);

        return  $html;
    }
}

tech888f_reg_shortcode('sv_category_banner','tech888f_vc_category_banner');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','tech888f_add_list_introduce_category',10,100 );
if(! function_exists('tech888f_add_list_introduce_category')){
    function tech888f_add_list_introduce_category(){
        vc_map( array(
            "name"          => esc_html__("Category Banner", 'mptheme'),
            "base"          => "sv_category_banner",
            "icon"          => "icon-st",
            "category"      => esc_html__("Tech888-Elements", 'mptheme'),
            "description"   => esc_html__( 'Display Introduce Category', 'mptheme' ),
            "params"        => array(
                array(
                    "type"          => "dropdown",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Display",'mptheme'),
                    "param_name"    => "display",
                    "value"         => array(
                        esc_html__("Grid",'mptheme')    => 'grid',
                        esc_html__("slider",'mptheme')    => 'slider',
                    ),
                    "description"   => esc_html__( 'Choose a style to display.', 'mptheme' )
                ),
                array(
                    "type"          => "dropdown",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Style",'mptheme'),
                    "param_name"    => "style",
                    "value"         => array(
                        esc_html__("Default",'mptheme')    => '',
                        esc_html__("Style 2",'mptheme')    => 'style2',
                    ),
                    "description"   => esc_html__( 'Choose a style to display.', 'mptheme' )
                ),
                array(
                    "type"          => "textfield",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Title",'mptheme'),
                    "param_name"    => "title",
                    "description"   => esc_html__( 'Enter title of element.', 'mptheme' )
                ),
                array(
                    "admin_label"   => true,
                    "type"          => "textfield",
                    "heading"       => esc_html__("Description",'mptheme'),
                    "param_name"    => "des",
                    "description"   => esc_html__( 'Enter description of element.', 'mptheme' )
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Image custom size",'mptheme'),
                    "param_name"    => "size",
                    'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'mptheme' ),
                ),
                array(
                    'heading'       => esc_html__( 'Speed', 'mptheme' ),
                    'type'          => 'textfield',
                    'group'         => esc_html__("Slider Settings","mptheme"),
                    'description'   => esc_html__( 'Enter time slider go to next item. Unit (ms). Example 5000. If empty this field autoPlay is false.', 'mptheme' ),
                    'param_name'    => 'speed',
                    "dependency"    =>  array(
                        "element"       => "display",
                        "value"         => "slider",
                    ),
                ),
                array(
                    'heading'     => esc_html__( 'Column', 'mptheme' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'column',
                    'value' => array(
                        esc_html__('Default','mptheme')  => '3',
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
                    "type"          => "param_group",
                    "heading"       => esc_html__("Add Category List",'mptheme'),
                    "param_name"    => "list",
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
                            "heading"       => esc_html__("Title 2",'mptheme'),
                            "param_name"    => "title2",
                        ),
                        array(
                            "type"          => "textfield",
                            "heading"       => esc_html__("Price text",'mptheme'),
                            "param_name"    => "price",
                        ),
                        array(
                            "type"          => "textfield",
                            "heading"       => esc_html__("Custom Link",'mptheme'),
                            "param_name"    => "link",
                        ),
                        array(
                            'type'          => 'autocomplete',
                            "admin_label"   => true,
                            'heading'        => esc_html__( 'Product Category', 'mptheme' ),
                            'param_name'    => 'cats',
                            'settings' => array(
                                'multiple' => false,
                                'sortable' => false,
                                'values' => tech888f_get_list_taxonomy(),
                            ),
                            'save_always'   => true,
                            'description'   => esc_html__( 'List of product categories', 'mptheme' ),
                        ),
                    ),
                    'description'   => esc_html__( 'Add more image with link', 'mptheme' ),
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
