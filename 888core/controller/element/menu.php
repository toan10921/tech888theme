<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_menu')){
    function tech888f_vc_menu($attr,$content = false){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => 'main-nav1',
            'menu'          => '',
            'menu_sticky'   => '',
            'el_class'      => '',
            'custom_css'    => '',
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;

        // Variable process
        $el_class .= ' '.$style.' '.$menu_sticky;
        $menu_data = array(
                        'container'     => false,
                        'menu_class'    => 'list-none',
                        'walker'        => new Tech888f_Walker_Nav_Menu(),
                    );
        if(!empty($menu)) $menu_data['menu'] = $menu;
        else $menu_data['theme_location'] = 'primary';

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class' => $el_class,
            'menu_data' => $menu_data,
            ));

        // Call function get template
        $html = tech888f_get_template_element('menu/menu',$style,$attr);
        return $html;
    }
}

tech888f_reg_shortcode('tech888f_menu','tech888f_vc_menu');

vc_map( array(
    "name"          => esc_html__("Menu", 'mptheme'),
    "base"          => "tech888f_menu",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display menu navigation', 'mptheme' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')   => 'main-nav1',
                esc_html__("Menu 2",'mptheme')   => 'main-nav2',
            ),
            "description"   => esc_html__( 'Choose menu style to display.', 'mptheme' )
        ),
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Menu Sticky",'mptheme'),
            "param_name"    => "menu_sticky",
            "value"         => array(
                esc_html__("Off",'mptheme')   => '',
                esc_html__("On",'mptheme')   => 'menu-sticky-on',
            ),
            "description"   => esc_html__( 'Choose menu style to display.', 'mptheme' )
        ),
        array(
            'type'          => 'dropdown',
            "admin_label"   => true,
            'heading'       => esc_html__( 'Menu name', 'mptheme' ),
            'param_name'    => 'menu',
            'value'         => tech888f_list_menu_name(),
            'description'   => esc_html__( 'Select Menu name to display.', 'mptheme' )
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