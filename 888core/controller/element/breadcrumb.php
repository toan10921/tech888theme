<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_breadcrumb')){
    function tech888f_vc_breadcrumb($attr, $content = false){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => '',
            'el_class'      => '',
            'custom_css'    => '',
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $el_class .=  ' '.$style.' breadcrumb-element';
        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class'      => $el_class,
            'breadcrumb'    => 'on'
            ));

        // Call function get template
        $html = tech888f_get_template('breadcrumb',$style,$attr);

        return $html;
    }
}

tech888f_reg_shortcode('tech888f_breadcrumb','tech888f_vc_breadcrumb');

vc_map( array(
    "name"          => esc_html__("Breadcrumb", 'mptheme'),
    "base"          => "tech888f_breadcrumb",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display breadcrumb on your site', 'mptheme' ),
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