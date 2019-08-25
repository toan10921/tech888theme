<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */
if(!function_exists('tech888f_vc_download_file'))
{
    function tech888f_vc_download_file($attr, $content = false)
    {
        $html = $icon_html = '';
        $data_array = array_merge(array(
            'style'         => 'download-slider',
            'title'         => '',
            'des'           => '',
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
        $html = tech888f_get_template_element('box-download/box-download',$style,$attr);

        return  $html;
    }
}

tech888f_reg_shortcode('sv_download_file','tech888f_vc_download_file');


vc_map( array(
    "name"          => esc_html__("Download Box", 'mptheme'),
    "base"          => "sv_download_file",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display Download Box', 'mptheme' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')    => 'dl-file-slider',
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
            'heading'       => esc_html__( 'Custom Item', 'mptheme' ),
            'type'          => 'textfield',
            'description'   => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'mptheme' ),
            'param_name'    => 'itemres',
            'group'         => esc_html__("Slider Settings","mptheme"),
            'dependency'    => array(
                'element'       => 'style',
                'value'         => array('dl-file-slider'),
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
                'value'         => array('dl-file-slider'),
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
                    "heading"       => esc_html__("Link",'mptheme'),
                    "param_name"    => "link",
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => esc_html__( 'Download Icon', 'mptheme' ),
                    'param_name'    => 'download_icon',
                    'value'         => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linearicon',
                        'iconsPerPage'  => 4000,
                    ),
                    'description'   => esc_html__( 'Select icon from library.', 'mptheme' ),
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