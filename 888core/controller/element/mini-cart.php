<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
    if(!function_exists('tech888f_vc_mini_cart'))
    {
        function tech888f_vc_mini_cart($attr)
        {
            $html = $css_class = '';
            $data_array = array_merge(array(
                'style'         => 'mini-cart1',
                'type'          => 'dropdown-box',
                'icon'          => 'fa fa-shopping-cart',
                'el_class'      => '',
                'custom_css'    => '',
            ),tech888f_get_responsive_default_atts());
            $attr = shortcode_atts($data_array,$attr);
            extract($attr);
            $css_classes = vc_shortcode_custom_css_class( $custom_css );
            $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );

            // Variable process vc_shortcodes_css_class
            if(!empty($css_class)) $el_class .= ' '.$css_class;

            $el_class .= ' '.$style.' '.$type;
            $attr = array_merge($attr,array(
                'el_class' => $el_class,
            ));

            if(!is_admin()){
                $html = tech888f_get_template_element('mini-cart/mini-cart',$style,$attr);
            }
            return apply_filters('tech888f_tempalte_mini_cart',$html);
        }
    }

    tech888f_reg_shortcode('sv_mini_cart','tech888f_vc_mini_cart');
    add_action( 'vc_before_init_base','tech888f_minicart_admin',10,100 );
    if ( ! function_exists( 'tech888f_minicart_admin' ) ) {
        function tech888f_minicart_admin(){
            vc_map( array(
                "name"          => esc_html__("Mini Cart", 'mptheme'),
                "base"          => "sv_mini_cart",
                "icon"          => "icon-st",
                "category"      => esc_html__("Tech888-Elements", 'mptheme'),
                "description"   => esc_html__( 'Display mini cart', 'mptheme' ),
                "params"    => array(
                    array(
                        'heading'       => esc_html__( 'Style', 'mptheme' ),
                        "admin_label"   => true,
                        'type'          => 'dropdown',
                        'param_name'    => 'style',
                        'value'         => array(
                            esc_html__('Default','mptheme') => 'mini-cart1',
                            esc_html__('Icon','mptheme') => 'mini-cart-icon',
                        ),
                        'description'   => esc_html__( 'Choose a style to display.', 'mptheme' )
                    ),
                    array(
                        'heading'       => esc_html__( 'Type', 'mptheme' ),
                        "admin_label"   => true,
                        'type'          => 'dropdown',
                        'param_name'    => 'type',
                        'value'         => array(
                            esc_html__('Default','mptheme') => 'dropdown-box',
                            esc_html__('Side box','mptheme') => 'aside-box',
                        ),
                        'description'   => esc_html__( 'Choose a style to display.', 'mptheme' )
                    ),
                    array(
                        'type'          => 'iconpicker',
                        'heading'       => esc_html__( 'Cart icon', 'mptheme' ),
                        'param_name'    => 'icon',
                        'value'         => '',
                        'settings'      => array(
                            'emptyIcon'     => true,
                            'type'          => 'linearicon',
                            'iconsPerPage'  => 4000,
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
}