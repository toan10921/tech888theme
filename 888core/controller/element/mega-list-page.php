<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_mega_list_page'))
{
    function tech888f_vc_mega_list_page($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'         => '',
            'list_ids'      => '',
            'list'          => '',
        ),$attr));
        if(!empty($list_ids)){
            if(!empty($list)) $list .= ','.$list_ids;
            else $list .= $list_ids;
        }
        $html .=    '<div class="mega-list-cat">';
        if(!empty($title)) $html .= '<h2 class="title18 font-bold text-uppercase">'.esc_html($title).'</h2>';
        if(!empty($list)){
            $html .=    '<ul class="list-none">';
            $list = str_replace(' ', '', $list);
            $list = explode(",",$list);
            if(is_array($list)){
                foreach ($list as $key => $page) {
                    $html .=    '<li><a href="'.get_the_permalink($page).'">'.get_the_title($page).'</a></li>';
                }
            }
            $html .=    '</ul>';
        }
        $html .=    '</div>';
        return $html;
    }
}

tech888f_reg_shortcode('tech888f_mega_list_page','tech888f_vc_mega_list_page');

vc_map( array(
    "name"      => esc_html__("Mega List Pages", 'mptheme'),
    "base"      => "tech888f_mega_list_page",
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
            'heading'     => esc_html__( 'List page', 'mptheme' ),
            'type'        => 'autocomplete',
            'param_name'  => 'list',
            'settings' => array(
                'multiple' => true,
                'sortable' => true,
                'values' => tech888f_list_all_page(true),
            ),
            'save_always' => true,
            'description' => esc_html__( 'List of pages', 'mptheme' ),
        ),        
        array(
            "type" => "textfield",
            "heading" => esc_html__("Append Custom links with ID",'mptheme'),
            "param_name" => "list_ids",
            'description' => esc_html__( 'Enter list ID page,post or product and separate values by ",". Example is 3,7,11', 'mptheme' ),
        ),
    )
));