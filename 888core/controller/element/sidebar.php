<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_sidebar'))
{
    function tech888f_vc_sidebar($attr)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'sidebar'       => '',
            'el_class'      => '',
            'custom_css'    => '',
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
        $html = tech888f_get_template_element('sidebar/sidebar','',$attr);
        
        return $html;
    }
}

tech888f_reg_shortcode('tech888f_sidebar','tech888f_vc_sidebar');
add_action( 'vc_build_admin_page','tech888f_admin_sidebar',10,100 );
if ( ! function_exists( 'tech888f_admin_sidebar' ) ) {
    function tech888f_admin_sidebar(){
        vc_map( array(
            "name"          => esc_html__("Sidebar", 'mptheme'),
            "base"          => "tech888f_sidebar",
            "icon"          => "icon-st",
            "category"      => esc_html__("Tech888-Elements", 'mptheme'),
            "description"   => esc_html__( 'Display sidebar on your site', 'mptheme' ),
            "params"        => array(
                array(
                    "type"          => "dropdown",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Sidebar",'mptheme'),
                    "param_name"    => "sidebar",
                    "value"         => tech888f_get_sidebar_list()
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