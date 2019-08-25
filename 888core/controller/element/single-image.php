<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 4/12/2019
 * Time: 3:00 PM
 */

if(!function_exists('tech888f_vc_single_image'))
{
    function tech888f_vc_single_image($attr)
    {
        $html = '';
        $css_class = '';

        // merge data to responsive page builder

        $data_array = array_merge(array(
            'style'         => '',
            'title'         => '',
            'title2'        => '',
            'size'          => '',
            'image'         => '',
            'url'           => '',
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

        switch ($style){
            case "":
                if(empty($size)) $size = "full";
                $html .= '<div class="single-image-wrap '.esc_attr($el_class).'">';
                //if(!empty($title)) $html .= '<h2 class="title28 fontita black333 no-margin">'.esc_html($title).'</h2>';
                if(!empty($url)): $html .= '<a href="'.esc_url($url).'">';
                endif;
                if(!empty($image)) $html .= '<img alt="'.$title.'" src="'.esc_url(wp_get_attachment_image_url($image,$size)).'"/>';
                if(!empty($url)): $html .= '</a>';
                endif;
                $html .= '</div>';
                break;
            case "style2":
                if(empty($size)) $size = "full";
                $html .= '<div class="single-image-wrap '.esc_attr($el_class).'">';
                if(!empty($url)) $html .='<a class="text-center" href="'.esc_url($url).'">';
                if(!empty($image)) $html .= '<span class="img-wrap"><img src="'.esc_url(wp_get_attachment_image_url($image,$size)).'" alt="single image style 2" /></span>';
                if(!empty($title)) $html .= '<span class="title12 no-margin">'.esc_html($title).'</span>';
                if(!empty($title2)) $html .= '<strong class="font-bold title18 black30 no-margin">'.esc_html($title2).'</strong>';
                if(!empty($url))  $html .= '</a>';
                $html .= '</div>';
                break;
            case "style3":
                if(empty($size)) $size = "full";
                $html .= '<div class="single-image-wrap pst-relative '.esc_attr($el_class).'">';
                //if(!empty($title)) $html .= '<h2 class="title28 fontita black333 no-margin">'.esc_html($title).'</h2>';
                if(!empty($url)): $html .= '<a href="'.esc_url($url).'">';
                endif;
                $html .= '<span class="insta-wrap bg-overlay pst-absolute text-center white"><i class="title60 fa fa-instagram"></i><span class="text-uppercase title18">'.esc_html__("Shop it","mptheme").'</span></span>';
                if(!empty($image)) $html .= '<img alt="'.$title.'" src="'.esc_url(wp_get_attachment_image_url($image,$size)).'"/>';
                if(!empty($url)): $html .= '</a>';
                endif;
                $html .= '</div>';
                break;
        }


        return $html;

        // End frontend
    }
}

tech888f_reg_shortcode('tech888f_single_image','tech888f_vc_single_image');

vc_map( array(
    "name"      => esc_html__("Single Image", 'mptheme'),
    "base"      => "tech888f_single_image",
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
            "type" => "textfield",
            "admin_label"   => true,
            "heading" => esc_html__("Title 2",'mptheme'),
            "param_name" => "title2",
            "dependency"  => array(
                "element"   => "style",
                "value"     => "style2"
            )
        ),
        array(
            "type" => "attach_image",
            "admin_label"   => true,
            "heading" => esc_html__("Image",'mptheme'),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "admin_label"   => true,
            "heading" => esc_html__("Link",'mptheme'),
            "param_name" => "url",
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'mptheme'),
            "param_name" => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')   => '',
                esc_html__("style2",'mptheme')   => 'style2',
                esc_html__("style3 - Hm1 Image List Istagram",'mptheme')   => 'style3',
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