<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 4/12/2019
 * Time: 3:00 PM
 */

if (!function_exists('tech888f_vc_mega_list_url')) {
    function tech888f_vc_mega_list_url($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title' => '',
            'phone_number' => '',
            'list' => '',
            'style' => '',
        ), $attr));

        $html = tech888f_get_template_element('mega-list-url/list',$style,$attr);

        return $html;
    }
}

tech888f_reg_shortcode('tech888f_mega_list_url', 'tech888f_vc_mega_list_url');

vc_map(array(
    "name" => esc_html__("Mega List Url", 'mptheme'),
    "base" => "tech888f_mega_list_url",
    "icon" => "icon-st",
    "category" => esc_html__("Tech888-Elements", 'mptheme'),
    "description" => esc_html__('Display list of page', 'mptheme'),
    "params" => array(
        array(
            "type" => "textfield",
            "admin_label" => true,
            "heading" => esc_html__("Title", 'mptheme'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "admin_label" => true,
            "heading" => esc_html__("Phone number", 'mptheme'),
            "param_name" => "phone_number",
            "dependency"  => array(
                "element" => "style",
                "value"   => "style5"
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style", 'mptheme'),
            "param_name" => "style",
            "value" => array(
                esc_html__("Default", 'mptheme') => '',
                esc_html__("Style 2", 'mptheme') => 'style2',
                esc_html__("Style 3", 'mptheme') => 'style3',
                esc_html__("Style 4", 'mptheme') => 'style4',
                esc_html__("Style 5", 'mptheme') => 'style5',
            ),
        ),
        array(
            "type" => "param_group",
            "heading" => esc_html__("Add List Item", 'mptheme'),
            "param_name" => "list",
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Style", 'mptheme'),
                    "param_name" => "style",
                    "value" => array(
                        esc_html__("Default", 'mptheme') => '',
                        esc_html__("Style 2", 'mptheme') => 'style2',
                    ),
                    "std" => ""
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title", 'mptheme'),
                    "param_name" => "link_title",
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Title 2", 'mptheme'),
                    "param_name" => "link_title2",
                    "dependency" => array(
                        array(
                            "element" => "style",
                            "value" => "style2"
                        ),
                        array(
                            "element" => "style",
                            "value" => "style3"
                        ),
                    )
                ),
                array(
                    "type" => "iconpicker",
                    "heading" => esc_html__("Icon", 'mptheme'),
                    "param_name" => "link_icon",
                    "dependency" => array(
                        array(
                            "element" => "style",
                            "value" => "style2"
                        ),
                        array(
                            "element" => "style",
                            "value" => "style3"
                        ),
                    ),
                    'settings' => array(
                        'emptyIcon' => true,
                        'type' => "linearicon",
                        'iconsPerPage' => 4000,
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Link", 'mptheme'),
                    "param_name" => "link_value",
                    'description' => esc_html__('Enter your link.', 'mptheme'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Custom class", 'mptheme'),
                    "param_name" => "custom_class",
                    'description' => esc_html__('Enter element custom class.', 'mptheme'),
                ),
            ),
        ),
    )
));