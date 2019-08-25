<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 4/12/2019
 * Time: 3:00 PM
 */

if(!function_exists('tech888f_vc_mega_list_image'))
{
    function tech888f_vc_mega_list_image($attr)
    {
        $html = '';
        $css_class = '';

        // merge data to responsive page builder

        $data_array = array_merge(array(
            'style'         => '',
            'title'         => '',
            'size'          => '',
            'list_image'         => '',
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
        $data = (array) vc_param_group_parse_atts( $list_image );
        $default_val = array(
            'title'         => '',
            'list'          => '',
            'style'         => '',
            'custom_class'  => '',
            'url'           => '',
        );

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class' => $el_class,
            'data'          => $data,
            'default_val'   => $default_val,
        ));

        // frontend

        switch ($style){
            case "":
                $html .= '<div class="ft1-image-wrap '.esc_attr($el_class).'">';
                if(!empty($title)) $html .= '<h2 class="title28 fontita black333 no-margin">'.esc_html($title).'</h2>';
                if(empty($size)) $size = "125x113";
                if(is_array($data) & count($data) > 0){
                    $html .= '<ul class="list-inline-block list-none ">';
                    foreach ($data as $key => $value){
                        if(empty($value['url'])) $value['url'] = "#";
                        if(empty($value['custom_class'])) $value['custom_class'] = '';
                        $html.= '<li class="'.esc_attr($value['custom_class']).'">
                        <a class="hvr-wobble-skew" href="'.esc_url($value['url']).'">
                        <img src="'.wp_get_attachment_image_url($value['image'],$size).'" alt="mega-list-image"/>
                        </a>
                        </li>';
                    }
                    $html .= '</ul>';
                }
                $html .= '</div>';
                break;
            case "style2":
                $html .= '<div class="image-list-wrap '.esc_attr($el_class).'">';
                if(!empty($title)) $html .= '<h2 class="title28 fontita black333 no-margin">'.esc_html($title).'</h2>';
                if(empty($size)) $size = array(293,293);
                if(is_array($data) & count($data) > 0){
                    $html .= '<ul class="flex-wrap list-none ">';
                    foreach ($data as $key => $value){
                        if(empty($value['url'])) $value['url'] = "#";
                        if(empty($value['custom_class'])) $value['custom_class'] = '';
                        $html.= '<li class="'.esc_attr($value['custom_class']).' banner-advs zoom-image overlay-image">
                        <a class="adv-thumb-link" href="'.esc_url($value['url']).'">
                        <img src="'.wp_get_attachment_image_url($value['image'],$size).'" alt="mega-list-image" />
                        </a>
                        </li>';
                    }
                    $html .= '</ul>';
                }
                $html .= '</div>';
                break;
        }


        return $html;

        // End frontend
    }
}

tech888f_reg_shortcode('tech888f_mega_list_image','tech888f_vc_mega_list_image');

vc_map( array(
    "name"      => esc_html__("Mega List Image", 'mptheme'),
    "base"      => "tech888f_mega_list_image",
    "icon"      => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display list of page', 'mptheme' ),
    "params"    => array(
        array(
            "type" => "textfield",
            "admin_label"   => true,
            "heading" => esc_html__("Title",'mptheme'),
            "param_name" => "title",
        ),
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
            "type" => "textfield",
            "heading" => esc_html__("Custom size",'mptheme'),
            'description'   => esc_html__( 'Enter image custom size.Example: 200x200', 'mptheme' ),
            "param_name" => "size",
            "value"         => '',
        ),
        array(
            "type" => "param_group",
            "heading" => esc_html__("Add List Item",'mptheme'),
            "param_name" => "list_image",
            "params"    => array(
                array(
                    "type"          => "attach_image",
                    "heading"       => esc_html__("Image",'mptheme'),
                    "param_name"    => "image",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Image Link",'mptheme'),
                    "param_name"    => "url",
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Custom class",'mptheme'),
                    "param_name" => "custom_class",
                    'description'   => esc_html__( 'Enter element custom class.', 'mptheme' ),
                ),
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