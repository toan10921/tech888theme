<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_team')){
    function tech888f_vc_team($attr, $content = false){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => '',
            'title'         => '',
            'des'           => '',
            'link'          => '',
            'social'        => '',
            'image'         => '',
            'el_class'      => '',
            'custom_css'    => '',
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        if(!empty($style)) $el_class .= ' '.$style;
        $data = (array) vc_param_group_parse_atts( $social );
        $default_val = array(
            'icon'      => '',
            'link'      => '',
            );
        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class' => $el_class,
            'data'          => $data,
            'default_val'   => $default_val,
            ));

        // Call function get template
        $html = tech888f_get_template_element('team/team',$style,$attr);

        return $html;
    }
}

tech888f_reg_shortcode('tech888f_team','tech888f_vc_team');

vc_map( array(
    "name"          => esc_html__("Team", 'mptheme'),
    "base"          => "tech888f_team",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display one person info', 'mptheme' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')     => '',
            ),
            "description"   => esc_html__( 'Choose style to display.', 'mptheme' )
        ),
        array(
            "type"          => "attach_image",
            "admin_label"   => true,
            "heading"       => esc_html__("Image",'mptheme'),
            "param_name"    => "image",
            "description"   => esc_html__( 'Choose a image to display as logo site.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Title",'mptheme'),
            "param_name"    => "title",
            "description"   => esc_html__( 'Enter content logo text to display.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Link",'mptheme'),
            "param_name"    => "link",
            "description"   => esc_html__( 'Enter url to view detail.', 'mptheme' )
        ),
        array(
            "type"          => "textarea",
            "admin_label"   => true,
            "heading"       => esc_html__("Description",'mptheme'),
            "param_name"    => "des",
            "description"   => esc_html__( 'Enter content logo text to display.', 'mptheme' )
        ),
        array(
            "type"          => "param_group",
            "heading"       => esc_html__("Social List",'mptheme'),
            "param_name"    => "social",
            "params"        => array(
                array(
                    'type'          => 'iconpicker',
                    'heading'       => esc_html__( 'Icon', 'mptheme' ),
                    'param_name'    => 'icon',
                    'value'         => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 4000,
                    ),
                    'description'   => esc_html__( 'Select icon from library.', 'mptheme' ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Link",'mptheme'),
                    "param_name"    => "link",
                    "description"   => esc_html__( 'Enter URL redirect when click to icon.', 'mptheme' )
                ),
            )
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