<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 15/12/15
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_title'))
{
    function tech888f_vc_title($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'      => '',
            'des'      => '',
            'link'     => '',
            'style'    => '',
        ),$attr));

        switch ($style){
            case "":
                $html .=    '<div class="box-title text-center">';
                if(!empty($title)) $html .=        '<h2 class="title-before no-margin"><span class="font-bold title-text title30 black30">'.esc_html($title).'</span></h2>';
                if(!empty($des)) $html .=        '<p class="desc-title">'.esc_html($des).'</p>';
                $html .=    '</div>';
                return $html;
                break;
            case "style2":
                $html .=    '<div class="box-title style2">';
                if(!empty($title)) $html .=        '<h2 class="title-before no-margin"><span class="font-bold title-text title30 black30">'.esc_html($title).'</span></h2>';
                if(!empty($des)) $html .=        '<span class="post-cat-desc color font-bold title120">'.esc_html($des).'</span>';
                $html .=    '</div>';
                return $html;
                break;
            case "style3":
                $html .=    '<div class="box-title style3 text-center">';
                if(!empty($title)) $html .=        '<h2 class="text-center font-bold title30"><span class="white">'.esc_html($title).'</span></h2>';
                if(!empty($des)) $html .=        '<span class="post-cat-desc text-center font-bold title120 color">'.esc_html($des).'</span>';
                $html .=    '</div>';
                return $html;
                break;
            case "style4":
                $html .=    '<div class="box-title style4 text-center">';
                if(!empty($title)) $html .=        '<h2 class="text-center font-bold title30"><span class="black30  pst-relative">'.esc_html($title).'</span></h2>';

                if(!empty($des) && !empty($link)) $html .= '<a href="'.esc_url($link).'" class="post-cat-desc text-center">'.esc_html($des).'</a>';
                $html .=    '</div>';
                return $html;
                break;
        }
    }
}

tech888f_reg_shortcode('tech888f_title','tech888f_vc_title');

vc_map( array(
    "name"      => esc_html__("Title Box", 'mptheme'),
    "base"      => "tech888f_title",
    "icon"      => "icon-st",
    "category"  => 'Tech888-Elements',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'mptheme'),
            "param_name" => "style",
            "value"   => array(
                esc_html__("Default","mptheme") => "",
                esc_html__("style 2", "mptheme") => "style2",
                esc_html__("style 3", "mptheme") => "style3",
                esc_html__("style 4", "mptheme") => "style4"
            )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Title",'mptheme'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Description",'mptheme'),
            "param_name" => "des",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Link",'mptheme'),
            "param_name" => "link",
            "dependency"  => array(
                "element"   => "style",
                "value"     => "style4"
            )
        )
    )
));