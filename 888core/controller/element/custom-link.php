<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 1/11/2019
 * Time: 9:56 AM
 */

if(!function_exists('tech888f_vc_custom_link')){
    function tech888f_vc_custom_link($attr, $content = false){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => 'default',
            'list'          => '',
            'textlink'      => '',
            'link'          => '',
            'icon'          => '',
            'el_class'      => '',
            'custom_css'    => '',
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );

        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $el_class .= ' '.$style;
        $data = (array) vc_param_group_parse_atts( $list );
        $default_val = array(
        );

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class'      => $el_class,
            'data'          => $data,
            'default_val'   => $default_val,
        ));

        // Call function get template
        $html = tech888f_get_template_element('custom-link/custom-link',$style,$attr);

        return  $html;
    }
}

tech888f_reg_shortcode('tech888f_custom_link','tech888f_vc_custom_link');

add_action( 'vc_before_init_base','tech888f_custom_link_admin',10,100 );
if ( ! function_exists( 'tech888f_custom_link_admin' ) ) {
    function tech888f_custom_link_admin(){
        vc_map( array(
            "name"          => esc_html__("Custom Link", 'mptheme'),
            "base"          => "tech888f_custom_link",
            "icon"          => "icon-st",
            "category"      => esc_html__("Tech888-Elements", 'mptheme'),
            "description"   => esc_html__( 'Display Custom link on your site', 'mptheme' ),
            "params"        => array(
                array(
                    'type'           => 'dropdown',
                    "admin_label"    => true,
                    'param_name'     => 'style',
                    'heading'        => esc_html__( 'Style', 'mptheme' ),
                    'value'          => array(
                        esc_html__( 'Default', 'mptheme' )     => 'default',
                        esc_html__( 'Icon', 'mptheme' )     => 'icon',
                        esc_html__( 'Wishlist', 'mptheme' )     => 'wishlist',
                    ),
                    "description"   => esc_html__( 'Choose a style to display.', 'mptheme' )
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Link",'mptheme'),
                    "param_name"    => "textlink",
                    "description"   => esc_html__( 'Enter text of custom link display.', 'mptheme' ),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "default",
                    ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Link",'mptheme'),
                    "param_name"    => "link",
                    "description"   => esc_html__( 'Enter URL redirect when click to icon.', 'mptheme' )
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => esc_html__( 'Icon', 'mptheme' ),
                    'param_name'    => 'icon',
                    'value'         => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linearicon',
                        'iconsPerPage'  => 4000,
                    ),
                    "dependency"    =>  array(
                        array(
                            "element"       => "style",
                            "value"         => "icon",
                        ),
                        array(
                            "element"       => "style",
                            "value"         => "wishlist",
                        ),
                    ),
                    'description'   => esc_html__( 'Select icon from library.', 'mptheme' ),
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