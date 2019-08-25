<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_logo')){
    function tech888f_vc_logo($attr, $content = false){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => 'img',
            'site_title'    => 'on',
            'logo_img'      => '',
            'el_class'      => '',
            'custom_css'    => '',
            'content'       => $content,            
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class' => $el_class
            ));

        // Call function get template
        $html = tech888f_get_template_element('logo/logo',$style,$attr);

        return $html;
    }
}

tech888f_reg_shortcode('tech888f_logo','tech888f_vc_logo');

vc_map( array(
    "name"          => esc_html__("Logo", 'mptheme'),
    "base"          => "tech888f_logo",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display logo on your site', 'mptheme' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')     => 'img',
                esc_html__("Logo Text",'mptheme')   => 'text',
            ),
            "description"   => esc_html__( 'Choose logo style to display.', 'mptheme' )
        ),
        array(
            "type"          => "attach_image",
            "admin_label"   => true,
            "heading"       => esc_html__("Logo image",'mptheme'),
            "param_name"    => "logo_img",
            "dependency"    =>  array(
                "element"       => "style",
                "value"         => "img",
            ),
            "description"   => esc_html__( 'Choose a image to display as logo site.', 'mptheme' )
        ),
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Seo site title in logo",'mptheme'),
            "param_name"    => "site_title",
            "value"         => array(
                esc_html__("On",'mptheme')     => 'on',
                esc_html__("Off",'mptheme')   => 'off',
            ),
            "description"   => esc_html__( 'The site title will appear as html with the h1 tag.', 'mptheme' )
        ),
        array(
            "type"          => "textarea_html",
            "admin_label"   => true,
            "heading"       => esc_html__("Text",'mptheme'),
            "param_name"    => "content",
            "dependency"    =>  array(
                "element"       => "style",
                "value"         => "text",
            ),
            "description"   => esc_html__( 'Enter content logo text to display.', 'mptheme' )
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