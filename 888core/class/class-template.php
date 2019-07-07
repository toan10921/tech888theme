<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/9/2019
 * Time: 9:54 PM
 */

if(!defined('ABSPATH')) return;

if(!class_exists('Tech888f_Template'))
{
    class Tech888f_Template{

        /* declare dir variable */

        static $_template_dir;

        /* constructor */

        static function _init()
        {
            // Init some environment
            self::$_template_dir=apply_filters('tech888f_template_dir','/888core/view/templates');
        }

        /* method */

        static function load_template_view($view_name,$slug=false,$data=array(),$echo=FALSE)
        {
            $template_path = get_template_directory();
            $stylesheet_path = get_stylesheet_directory();
            if($slug){
                $path = $stylesheet_path .self::$_template_dir.'/'.$view_name.'-'.$slug.'.php';
                if( $template_path != $stylesheet_path && is_file($path) ) $template = $path;
                else $template =  get_template_directory().self::$_template_dir.'/'.$view_name.'-'.$slug.'.php';
                if(!is_file($template)){
                    $path = $stylesheet_path .self::$_template_dir.'/'.$view_name.'.php';
                    if( $template_path != $stylesheet_path && is_file($path) ) $template = $path;
                    else $template = get_template_directory().self::$_template_dir.'/'.$view_name.'.php';
                }
            }else{
                $path = $stylesheet_path .self::$_template_dir.'/'.$view_name.'.php';
                if( $template_path != $stylesheet_path && is_file($path) ) $template = $path;
                else $template = get_template_directory().self::$_template_dir.'/'.$view_name.'.php';
            }

            //Allow Template be filter

            $template=apply_filters('tech888f_load_view',$template,$view_name,$slug);
            if($data) extract($data);
            if(file_exists($template)){

                if(!$echo){

                    ob_start();
                    include $template;
                    return @ob_get_clean();

                }else

                include $template;
            }
        }

        static function load_them_option_data($view_name,$echo=false){
            $themeoption_path = get_template_directory().'/888core/controller/tpl-theme-option/'.$view_name.'.php';
            if($echo == false){
                require_once($themeoption_path);
                /**
                 *  @var array $sub_section
                 */
            }
            return $sub_section;
        }

        /* get visual composer template */

        public static function get_vc_pagecontent($page_id=false,$remove_wrap = false)
        {
            if($page_id)
            {
                $page=get_post($page_id);
                if($page)
                {
                    $content = $page->post_content;
                    if($remove_wrap ) $content = str_replace(array('[vc_row]','[vc_column]','[/vc_row]','[/vc_column]'), '' , $content);
                    $content = apply_filters('tech888f_get_page_content',do_shortcode($content));
                    $content = str_replace(']]>', ']]&gt;', $content);
                    $shortcodes_custom_css = get_post_meta( $page_id, '_wpb_shortcodes_custom_css', true );
                    Tech888f_Inline_Style::add_css($shortcodes_custom_css);
                    wp_reset_postdata();
                    return $content;
                }
            }
        }

        /* remove auto p tags in content */

        static function remove_wpautop( $content, $autop = false ) {

            if ( $autop ) {
                $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
            }
            return do_shortcode( shortcode_unautop( $content) );
        }
    }

    Tech888f_Template::_init();
}