<?php
/**
 * User: ToanNgo92
 * Date: 2018
 */

if (!function_exists('tech888f_vc_banner_video')) {
    function tech888f_vc_banner_video($attr, $content = false)
    {
        $html = $settings = '';
        extract(shortcode_atts(array(
            'style' => '',
            'poster' => '',
            'size' => '',
            'video_link' => '',
            'video_title' => '',
            'video_description' => '',
            'loop' => 'loop',
            'audio' => 'muted',
            'autoplay' => 'autoplay',
            'link' => '',
            'info_animation' => '',
            'info_align' => '',
        ), $attr));

        if (!empty($size)) $size = explode('x', $size);
        else $size = 'full';
//        if(!empty($poster)) $settings .= 'poster="'.wp_get_attachment_image_url($poster,$size).'"';


        if ($loop != 'no') $settings .= ' ' . $loop;
        if ($audio != 'no') $settings .= ' ' . $audio;
        if ($autoplay != 'no') $settings .= ' ' . $autoplay;
        if(empty($video_title)){
            $video_title = "";
        }
        if(empty($video_description)){
            $video_description = "";
        }

        if (!empty($poster)) {
            $bg_img = wp_get_attachment_image_url($poster, "full");
        }
        $data_bg = array(
            'background-color' => '',
            'background-repeat' => '',
            'background-size' => '',
            'background-attachment' => '',
            'background-position' => '',
            'background-image' => $bg_img
        );
        $b_class = tech888f_fill_css_background($data_bg);
        switch ($style) {
            case 'style2':
                $html .= '<div class="banner-video pst-relative '.esc_attr($style).' '.esc_attr($b_class).'">
                                <div class="video-info-wrap text-center">
                                <h4 class="no-margin font-bold banner-video-title title60"><span class="white pst-relative">'.esc_html($video_title).'</span></h4>
                                <p class="banner-video-desc white">'.esc_html($video_description).'</p>
                                <div class="video-btn-wrap">
                                <a href="#video_popup" data-fancybox  class="video-button-style2 title30 white" href="' . esc_url('#') . '" title="' . esc_attr__('Play', 'mptheme') . '">
                                    <i class="li li-camera"></i>
                                </a>
                                </div>
                                </div>
                              
                               <video style="display: none;" id="video_popup" ' . $settings . ' oncontextmenu="return false;">
                                    <source src="' . esc_url($video_link) . '" type="video/mp4">
                                </video>
                            </div>';
                break;
            default:
                $html .= '<div class="banner-video pst-relative '.esc_attr($style).' '.esc_attr($b_class).'">
                                <div class="video-info-wrap text-center">
                                <h4 class="no-margin font-bold banner-video-title title60"><span class="white pst-relative">'.esc_html($video_title).'</span></h4>
                                <p class="banner-video-desc white">'.esc_html($video_description).'</p>
                                <div class="video-btn-wrap">
                                <a class="video-button title30 white" href="' . esc_url('#') . '" title="' . esc_attr__('Play', 'mptheme') . '">
                                    <i class="li li-camera"></i>
                                </a>
                                </div>
                                </div>
                                <div class="video-play pst-absolute bg-overlay">
                                <a class="play-pause-button pst-absolute bg-overlay title30 white" href="' . esc_url('#') . '" title="' . esc_attr__('Play', 'mptheme') . '">
                                    <i class="li li-pause-circle"></i>
                                </a>
                                <video ' . $settings . ' oncontextmenu="return false;">
                                    <source src="' . esc_url($video_link) . '" type="video/mp4">
                                </video>
                                </div>
                            </div>';
                break;
        }
        return $html;
    }
}

tech888f_reg_shortcode('tech888f_banner_video', 'tech888f_vc_banner_video');

vc_map(array(
    "name" => esc_html__("Banner Video", 'mptheme'),
    "base" => "tech888f_banner_video",
    "icon" => "icon-st",
    "description" => esc_html__('Display video background', 'mptheme'),
    "category" => esc_html__("Tech888-Elements", 'mptheme'),
    "params" => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Style', 'mptheme'),
            'param_name' => 'style',
            'value' => array(
                esc_html__('Default', 'mptheme') => '',
                esc_html__('Popup', 'mptheme') => 'style2'
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Video Title", 'mptheme'),
            "param_name" => "video_title",
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__("Video Description", 'mptheme'),
            "param_name" => "video_description",
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image video preview", 'mptheme'),
            "param_name" => "poster",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Image video preview custom size", 'mptheme'),
            "param_name" => "size",
            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'mptheme'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Video source", 'mptheme'),
            "param_name" => "video_link",
            "description" => esc_html__("Enter video source.", 'mptheme'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Redirect Link", 'mptheme'),
            "param_name" => "link",
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Loop', 'mptheme'),
            'param_name' => 'loop',
            'value' => array(
                esc_html__('Yes', 'mptheme') => 'loop',
                esc_html__('No', 'mptheme') => 'no',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Audio', 'mptheme'),
            'param_name' => 'loop',
            'value' => array(
                esc_html__('No', 'mptheme') => 'muted',
                esc_html__('Yes', 'mptheme') => 'no',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Autoplay', 'mptheme'),
            'param_name' => 'autoplay',
            'value' => array(
                esc_html__('Yes', 'mptheme') => 'autoplay',
                esc_html__('No', 'mptheme') => 'no',
            ),
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => esc_html__("Content", 'mptheme'),
            "param_name" => "content",
            "dependency" => array(
                "element" => "style",
                "value" => array("style-content"),
            ),
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__('Info Animation', 'mptheme'),
            'param_name' => 'info_animation',
            'admin_label' => true,
            'value' => '',
            'settings' => array(
                'type' => 'in',
                'custom' => array(
                    array(
                        'label' => esc_html__('Default', 'mptheme'),
                        'values' => array(
                            esc_html__('Top to bottom', 'mptheme') => 'top-to-bottom',
                            esc_html__('Bottom to top', 'mptheme') => 'bottom-to-top',
                            esc_html__('Left to right', 'mptheme') => 'left-to-right',
                            esc_html__('Right to left', 'mptheme') => 'right-to-left',
                            esc_html__('Appear from center', 'mptheme') => 'appear',
                        ),
                    ),
                ),
            ),
            'description' => esc_html__('Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).', 'mptheme'),
            "dependency" => array(
                "element" => "style",
                "value" => array("style-content"),
            ),
        )
    )
));

