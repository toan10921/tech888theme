<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */
if(!function_exists('tech888f_vc_payment'))
{
    function tech888f_vc_payment($attr, $content = false)
    {
        $html = $icon_html = '';
        $data_array = array_merge(array(
            'style'         => 'brand-slider',
            'title'         => '',
            'des'           => '',
            'url'           => '',
            'list'          => '',
            'itemres'       => '',
            'speed'         => '',
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
            'des'       => '',
            'link'      => '',
            'pos'       => '',
            );

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class'      => $el_class,
            'data'          => $data,
            'default_val'   => $default_val,
            'size'          => $size,
            ));

        // Call function get template
        $html = tech888f_get_template_element('images-list/list',$style,$attr);

        return  $html;
    }
}

tech888f_reg_shortcode('sv_payment','tech888f_vc_payment');


vc_map( array(
    "name"          => esc_html__("Images list", 'mptheme'),
    "base"          => "sv_payment",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display list images ', 'mptheme' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')    => 'brand-slider',
                esc_html__("Style 2",'mptheme')    => 'style2',
                esc_html__("Clients Happy",'mptheme')    => 'clients-happy',
                esc_html__("Style 3",'mptheme')    => 'style3',
                esc_html__("Style 4 - Service",'mptheme')    => 'style4',
                esc_html__("Style 5 - Instagram Home 2",'mptheme')    => 'style5',
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
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Images List Link",'mptheme'),
            "param_name"    => "url",
            "description"   => esc_html__( 'Enter link of element.', 'mptheme' ),
            "dependency"    => array(
                "element"   => "style",
                "value"     => "style3"
            )
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
            'heading'       => esc_html__( 'Custom Item', 'mptheme' ),
            'type'          => 'textfield',
            'description'   => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'mptheme' ),
            'param_name'    => 'itemres',
            'group'         => esc_html__("Slider Settings","mptheme"),
            'dependency'    => array(
                'element'       => 'style',
                'value'         => array('brand-slider','style2','style3','style4'),
                )
        ),        
        array(
            'heading'       => esc_html__( 'Speed', 'mptheme' ),
            'type'          => 'textfield',
            'group'         => esc_html__("Slider Settings","mptheme"),
            'description'   => esc_html__( 'Enter time slider go to next item. Unit (ms). Example 5000. If empty this field autoPlay is false.', 'mptheme' ),
            'param_name'    => 'speed',
            'dependency'    => array(
                'element'       => 'style',
                'value'         => array('brand-slider','style2','style3','style4'),
                )
        ),
        array(
            "type"          => "param_group",
            "heading"       => esc_html__("Add Image List",'mptheme'),
            "param_name"    => "list",
            "params"        => array(
                array(
                    "heading"       => esc_html__("Style",'mptheme'),
                    "type"          => "dropdown",
                    "param_name"    => "param_style",
                    "value"         => array(
                        esc_html__("Default",'mptheme')    => '',
                        esc_html__("Clients Happy",'mptheme')    => 'clients',
                        esc_html__("Style 4 - Service",'mptheme')    => 'service',
                    )
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => esc_html__("Image",'mptheme'),
                    "param_name"    => "image",
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => esc_html__("Icon Image",'mptheme'),
                    "param_name"    => "image_icon",
                    'dependency'    => array(
                        'element'   => 'param_style',
                        'value' => 'service',
                    )
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Title",'mptheme'),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Position",'mptheme'),
                    "param_name"    => "pos",
                    'description'   => esc_html__( 'Positions', 'mptheme' ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Background text",'mptheme'),
                    "param_name"    => "bg_text",
                    'description'   => esc_html__( 'Background text', 'mptheme' ),
                    'dependency'    => array(
                        'element'   => 'param_style',
                        'value' => 'clients',
                    )
                ),
                array(
                    "type"          => "textarea",
                    "heading"       => esc_html__("Description",'mptheme'),
                    "param_name"    => "des",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Link",'mptheme'),
                    "param_name"    => "link",
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