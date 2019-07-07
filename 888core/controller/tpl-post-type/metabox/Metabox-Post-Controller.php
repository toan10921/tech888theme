<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/11/2019
 * Time: 2:39 PM
 */

if (!class_exists('Tech888f_Metabox_Post_Controller')) {
    class Tech888f_Metabox_Post_Controller
    {

        static function _init()
        {
            if (function_exists('tech888f_reg_metabox')) {
                add_action( 'admin_menu' , 'remove_post_metabox_fields' );
                add_filter( 'rwmb_meta_boxes', 'tech888f_register_post_meta_boxes' );
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

    Tech888f_Metabox_Post_Controller::_init();

}

/* End Define save metabox function */

function remove_post_metabox_fields() {
    remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' ); //removes comments status div
    remove_meta_box( 'commentsdiv' , 'post' , 'normal' ); //removes comments div
    remove_meta_box( 'authordiv' , 'post' , 'normal' ); //removes author div
    remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' ); //removes trackbacks div
    remove_meta_box( 'postcustom' , 'post' , 'normal' ); //removes custom fields div
    remove_meta_box( 'slugdiv' , 'post' , 'normal' ); //removes custom fields div
}

if(!function_exists('tech888f_register_post_meta_boxes')){
    function tech888f_register_post_meta_boxes( $meta_boxes ) {
        $meta_boxes[] = array (
            'title' => 'Post Customize Option',
            'id' => 'meta-box-post',
            'post_types' => array(
                0 => 'post',
            ),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array (
                    'id' => 'mtb_post_top_image',
                    'type' => 'single_image',
                    'name' => 'Post Detail Top Image',
                    'desc' => 'Upload your specific top head image.If not, the feature image will be set instead of this values',
                    'tab' => 'mtb_tab_post_format',
                ),
                array (
                    'id' => 'mtb_post_gallery_images',
                    'type' => 'image_upload',
                    'name' => 'Post Detail Gallery Images',
                    'max_status' => false,
                    'force_delete' => 1,
                    'max_file_uploads' => 10,
                    'image_size' => 'large',
                    'desc' => 'Upload your gallery images.If not, the gallery will not display. Maximum is 10 images',
                    'tab' => 'mtb_tab_post_format',
                ),
                array (
                    'id' => 'mtb_post_header',
                    'type' => 'post',
                    'name' => 'Post Header Template',
                    'desc' => 'Choose your specific Header Template for your post',
                    'post_type' => array(
                        0 => 'tech888f_header',
                    ),
                    'field_type' => 'select_advanced',
                    'tab' => 'mtb_tab_post_display',
                ),
                array (
                    'id' => 'mtb_post_footer',
                    'type' => 'post',
                    'name' => 'Post Footer Template',
                    'desc' => 'Choose your specific Footer Template for your post',
                    'post_type' => array(
                        0 => 'tech888f_footer',
                    ),
                    'field_type' => 'select_advanced',
                    'tab' => 'mtb_tab_post_display',
                ),
                array (
                    'id' => 'mtb_post_sidebar_positon',
                    'name' => 'Post Sidebar Position',
                    'type' => 'select',
                    'desc' => 'Choose your Sidebar positon for your post',
                    'placeholder' => 'Select an Item',
                    'options' => array(
                        'No Sidebar' => 'No Sidebar',
                        'Right Sidebar' => 'Right Sidebar',
                        'Left Sidebar' => 'Left Sidebar',
                    ),
                    'tab' => 'mtb_tab_post_display',
                ),
                array (
                    'id' => 'mtb_post_sidebar_specs',
                    'type' => 'sidebar',
                    'name' => 'Post Sidebar',
                    'desc' => 'Choose your Post Sidebar',
                    'field_type' => 'select_advanced',
                    'tab' => 'mtb_tab_post_display',
                ),
                array (
                    'id' => 'mtb_extra_content_before_post',
                    'type' => 'post',
                    'name' => 'Extra Content Before Post',
                    'desc' => 'Choose an extra content append before post.',
                    'post_type' => array(
                        0 => 'tech888f_extra',
                    ),
                    'field_type' => 'select_advanced',
                    'tab' => 'mtb_tab_post_display',
                ),
                array (
                    'id' => 'mtb_extra_content_after_post',
                    'type' => 'post',
                    'name' => 'Extra Content After Post',
                    'desc' => 'Choose an extra content append after post.',
                    'post_type' => array(
                        0 => 'tech888f_extra',
                    ),
                    'field_type' => 'select_advanced',
                    'tab' => 'mtb_tab_post_display',
                ),
                array (
                    'id' => 'mtb_post_title_stats',
                    'name' => 'Stats title of post.',
                    'type' => 'radio',
                    'desc' => 'Show/hide title of this post.',
                    'options' => array(
                        'on' => 'on',
                        'off' => 'off',
                    ),
                    'tab' => 'mtb_tab_post_display',
                ),
                array (
                    'id' => 'mtb_post_sharebox_stats',
                    'name' => 'Stats Post Share Box',
                    'type' => 'radio',
                    'desc' => 'You can show/hide share box on this post.',
                    'options' => array(
                        'on' => 'on',
                        'off' => 'off',
                    ),
                    'tab' => 'mtb_tab_post_display',
                ),
                array (
                    'id' => 'mtb_post_bg_color',
                    'name' => 'Body Background Color',
                    'type' => 'color',
                    'desc' => 'Change body background Color of post.',
                    'size' => 7,
                    'tab' => 'mtb_post_custom_color_settings',
                ),
            ),
            'tab_style' => 'default',
            'tab_wrapper' => true,
            'tabs' => array(
                'mtb_tab_post_format' => array(
                    'label' => 'Post Media Format',
                    'icon' => 'dashicons-admin-media',
                ),
                'mtb_tab_post_display' => array(
                    'label' => 'Post Layout Settings',
                    'icon' => 'dashicons-admin-generic',
                ),
                'mtb_post_custom_color_settings' => array(
                    'label' => 'Post Custom Color Settings',
                    'icon' => 'dashicons-art',
                ),
            ),
        );
        return $meta_boxes;
    }
}