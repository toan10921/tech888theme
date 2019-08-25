<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 4/12/2019
 * Time: 3:00 PM
 */

if(!function_exists('tech888f_vc_scroll_top'))
{
    function tech888f_vc_scroll_top($attr)
    {
        $html = '';
        $css_class = '';

        // merge data to responsive page builder

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
        if(!empty($style)) $el_class .= ' '.$style;


        // frontend

        $html .= tech888f_get_template('scroll-top');

        return $html;

        // End frontend
    }
}

tech888f_reg_shortcode('tech888f_scroll_top','tech888f_vc_scroll_top');

vc_map( array(
    "name"      => esc_html__("Scroll Top", 'mptheme'),
    "base"      => "tech888f_scroll_top",
    "icon"      => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display list of page', 'mptheme' ),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'mptheme'),
            "param_name" => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')   => '',
                esc_html__("style2",'mptheme')   => 'style2',
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