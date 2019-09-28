<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_tool_panel'))
{
    function tech888f_vc_tool_panel($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'         => '',
            'sp_link'       => '',
            'doc_link'      => '',
            'buy_link'      => '',
            'image'         => '',
            'demos'         => '',
            'colors'        => '',
            'colors2'        => '',
        ),$attr));
        $data = (array) vc_param_group_parse_atts( $demos );        
        $html .=    '<div class="widget-indexdm" id="widget_indexdm">
                        <a href="" class="dm-open dm-button bg-color" data-title="'.esc_attr__("Close","mptheme").'" data-title-close="'.esc_attr__("Demos","mptheme").'"><i class="fa fa-long-arrow-left"></i><i class="fa fa-long-arrow-right"></i></a>
                        <a href="'.esc_url($sp_link).'" target="_blank" class="dm-button bg-color dm-support" data-title="'.esc_attr__("Support","mptheme").'" data-title-close="'.esc_attr__("Support","mptheme").'"><i class="fa fa-support"></i></a>
                        <a href="'.esc_url($doc_link).'" target="_blank" class="dm-button bg-color dm-guide" data-title="'.esc_attr__("Guide","mptheme").'" data-title-close="'.esc_attr__("Guide","mptheme").'"><i class="fa fa-lightbulb-o"></i></a>
                        <div class="widget-indexdm-inner">
                            <div class="dm-header">
                                <div class="header-event">
                                    <a target="_blank" href="'.esc_url($buy_link).'">'.wp_get_attachment_image($image,array(590,300)).'</a>
                                </div>                                
                                <div class="header-description">
                                    <h2>'.$title.'</h2>
                                    <h4><span class="color2">'.esc_html__("Choose Your Demo","mptheme").'</span></h4>
                                </div>                                
                                <div class="header-button">
                                    <a target="_blank" class="shop-button1 btn-mptheme" href="'.esc_url($buy_link).'" title="'.esc_attr__("Buy Now","mptheme").'">'.esc_html__("Buy Now","mptheme").'</a>                  
                                </div>
                            </div>';
        if($colors || $colors2){
            // Main color
            $main_color = tech888f_get_opt('main_color');
            if(empty($main_color)) $main_color = '#df412f';
            list($rd, $gd, $bd) = sscanf($main_color, "#%02x%02x%02x");
            $rgb_df = $rd.','.$gd.','.$bd;

            // Main color2
            $main_color2 = tech888f_get_opt('main_color2');
            if(empty($main_color2)) $main_color2 = '#000fff';
            list($rd2, $gd2, $bd2) = sscanf($main_color2, "#%02x%02x%02x");
            $rgb2_df = $rd2.','.$gd2.','.$bd2;

            $data_css = S7upf_Template::load_view('custom_css',false,array('main_color'=>$main_color,'main_color2'=>$main_color2));
            $data_css = str_replace('"', "##", $data_css);
            $html .=            '<div class="dm-content-color clearfix">
                                    <h4><span class="color2 text-uppercase title12 font-bold">'.esc_html__("Choose main color","mptheme").'</span></h4>
                                    <div class="get-data-css hidden" 
                                        data-css="'.$data_css.'" 
                                        data-color="'.esc_attr($main_color).'" data-color2="'.esc_attr($main_color2).'" 
                                        data-colordf="'.esc_attr($main_color).'" data-color2df="'.esc_attr($main_color2).'" 
                                        data-rgb="'.esc_attr($rgb_df).'" data-rgb2="'.esc_attr($rgb2_df).'"
                                        data-rgbdf="'.esc_attr($rgb_df).'" data-rgb2df="'.esc_attr($rgb2_df).'">
                                    </div>'; 
            $colors = (array) vc_param_group_parse_atts( $colors );           
            if(isset($colors[0]) && !empty($colors[0])){
                $default_val = array(
                'title'             => '',
                'color'             => '',
                );
                $html .=    '<div class="dm-content-color-inner">
                                <a class="dm-color active" href="#" title="'.esc_attr__("Default","mptheme").'" '.tech888f_add_html_attr('background:'.esc_attr($main_color)).' data-color="'.esc_attr($main_color).'" data-rgb="'.esc_attr($rgb_df).'"></a>';
                foreach ($colors as $key => $value){
                    $value = array_merge($default_val,$value);
                    list($r, $g, $b) = sscanf($value['color'], "#%02x%02x%02x");
                    $rgb = $r.','.$g.','.$b;
                    $html .=    '<a class="dm-color" href="#" title="'.esc_attr($value['title']).'" data-color="'.esc_attr($value['color']).'" data-rgb="'.esc_attr($rgb).'" '.tech888f_add_html_attr('background:'.esc_attr($value['color'])).'></a>';
                }
                $html .=    '</div>';
            }
            $colors2 = (array) vc_param_group_parse_atts( $colors2 );
            if(isset($colors2[0]) && !empty($colors2[0])){
                $default_val = array(
                'title'             => '',
                'color'             => '',
                );

                $html .=    '<div class="dm-content-color-inner">
                                <h4><span class="color2 text-uppercase title12 font-bold">'.esc_html__("Choose main color 2","mptheme").'</span></h4>
                                <a class="dm-color active" href="#" title="'.esc_attr__("Default","mptheme").'" '.tech888f_add_html_attr('background:'.esc_attr($main_color2)).' data-color2="'.esc_attr($main_color2).'" data-rgb2="'.esc_attr($rgb2_df).'"></a>';
                foreach ($colors2 as $key => $value){
                    $value = array_merge($default_val,$value);
                    list($r, $g, $b) = sscanf($value['color'], "#%02x%02x%02x");
                    $rgb = $r.','.$g.','.$b;
                    $html .=    '<a class="dm-color" href="#" title="'.esc_attr($value['title']).'" data-color2="'.esc_attr($value['color']).'" data-rgb2="'.esc_attr($rgb).'" '.tech888f_add_html_attr('background:'.esc_attr($value['color'])).'></a>';
                }
                $html .=    '</div>';
            }
            $html .=            '</div>';
        }
        $html .=            '<div class="dm-content clearfix">';
        if(is_array($data)){
            $default_val = array(
            'image_item'        => '',
            'title'             => '',
            'link'              => '#',
            'image_pre_link'    => '#',
            );
            foreach ($data as $key => $value){
                $value = array_merge($default_val,$value);
                $link_pre = $value['image_pre_link'];
                $html .=    '<div class="item-content pull-left">
                                <a class="indexdm-href" href="'.esc_url($value['link']).'" title="'.esc_attr($value['title']).'">
                                    '.wp_get_attachment_image($value['image_item'],array(170,130),0,array("data-src"=> $link_pre)).'
                                </a>
                                <h5>'.$value['title'].'</h5>
                            </div>';
            }
        }
        $html .=            '</div>
                        </div>          
                    </div>
                    <div id="indexdm_img"><div class="img-demo dm-scroll-img"></div></div>';
        return $html;
    }
}

tech888f_reg_shortcode('tech888f_tool_panel','tech888f_vc_tool_panel');

vc_map( array(
    "name"      => esc_html__("Tool Panel", 'mptheme'),
    "base"      => "tech888f_tool_panel",
    "icon"      => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display a advertisement', 'mptheme' ),
    "params"    => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Title",'mptheme'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Support link",'mptheme'),
            "param_name" => "sp_link",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Documentation",'mptheme'),
            "param_name" => "doc_link",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Buy Link",'mptheme'),
            "param_name" => "buy_link",
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image",'mptheme'),
            "param_name" => "image",
        ),
        array(
            "type" => "param_group",
            "heading" => esc_html__("Demo colors",'mptheme'),
            "param_name" => "colors",
            "params"    => array(
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Title",'mptheme'),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "colorpicker",
                    "heading"       => esc_html__("Color",'mptheme'),
                    "param_name"    => "color",
                ),
            )
        ),
        array(
            "type" => "param_group",
            "heading" => esc_html__("Demo colors 2",'mptheme'),
            "param_name" => "colors2",
            "params"    => array(
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Title",'mptheme'),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "colorpicker",
                    "heading"       => esc_html__("Color",'mptheme'),
                    "param_name"    => "color",
                ),
            )
        ),
        array(
            "type" => "param_group",
            "heading" => esc_html__("Demo List",'mptheme'),
            "param_name" => "demos",
            "params"    => array(
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Title",'mptheme'),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Link",'mptheme'),
                    "param_name"    => "link",
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Image item",'mptheme'),
                    "param_name" => "image_item",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Image preview Link",'mptheme'),
                    "param_name"    => "image_pre_link",
                ),
            )
        ),
    )
));