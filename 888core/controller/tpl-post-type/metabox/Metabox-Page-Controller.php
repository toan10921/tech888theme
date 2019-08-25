<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/11/2019
 * Time: 2:39 PM
 */

if (!class_exists('Tech888f_Metabox_Page_Controller')) {
    class Tech888f_Metabox_Page_Controller
    {

        static function _init()
        {
            if (function_exists('tech888f_reg_metabox')) {
                //add_action( 'admin_menu' , 'remove_post_metabox_fields' );
                add_filter( 'rwmb_meta_boxes', 'tech888f_register_page_meta_boxes' );
            }
        }

        static function _add_meta_box()
        {
            $id = 'tech888f_post_metabox';
            $title = esc_html__('Tech888 Post Customize Settings', 'tech888');
            $screen = 'post';
            $context = 'normal';
            $callback_args = null;
            tech888f_reg_metabox($id, $title, 'output_metabox_post_backend', $screen, $context, null, $callback_args);
        }

    }

    Tech888f_Metabox_Page_Controller::_init();

}


if(!function_exists('tech888f_register_page_meta_boxes')){
    function tech888f_register_page_meta_boxes( $meta_boxes ) {
        $meta_boxes[] = array (
            'title' => 'Page Settings',
            'id' => 'page-settings',
            'post_types' => array(
                0 => 'page',
            ),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array (
                    'id' => 'tech888f_header_page',
                    'name' => 'Post Header Template',
                    'label'       => esc_html__( 'Header Page', 't888fw' ),
                    'type' => 'select',
                    'desc' => 'Choose your specific Header Template for your post',
                    'placeholder' => 'Select an Item',
                    'options'  => tech888f_get_list_post_type('tech888f_header'),
//                    'value'       => array( esc_html__( 'Header Controller', 't888fw' ), ),
                ),
                array (
                    'id' => 'tech888f_footer_page',
                    'name' => 'Post Footer Template',
                    'label'       => esc_html__( 'Footer Page', 't888fw' ),
                    'type' => 'select',
                    'desc' => 'Choose your specific Footer Template for your post',
                    'placeholder' => 'Select an Item',
                    'options'  => tech888f_get_list_post_type('tech888f_footer'),
                ),
                array (
                    'id' => 'page_sidebar_pos',
                    'name' => 'Sidebar Position',
                    'type' => 'select',
                    'desc' => 'Choose your Sidebar positon for your Page',
                    'placeholder' => 'Select an Item',
                    'options' => array(
                        'no'  => 'No Sidebar',
                        'left' => 'Left Sidebar',
                        'right' => 'Right Sidebar'
                    )
                ),
                array (
                    'id' => 'page_sidebar_spec',
                    'name' => 'Page Sidebar Item',
                    'type' => 'sidebar',
                    'field_type'  => 'select_advanced',
                    'placeholder' => 'Select a sidebar',
                    'desc' => 'Choose your Post Sidebar',
                    'placeholder' => 'Select an Item',
                    'hidden' => array( 'page_sidebar_pos', '=', 'no' )
                ),
                array (
                    'id' => 'stats_title_page',
                    'type' => 'switch',
                    'name' => 'Enable title of page',
                    'desc' => 'Show/hide title of this post.',
                    'style' => 'rounded',
                    'on_label' => 'ON',
                    'off_label' => 'OFF',
                ),
            ),
        );
        return $meta_boxes;
    }
}