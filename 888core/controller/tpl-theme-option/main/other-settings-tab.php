<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/9/2019
 * Time: 1:22 AM
 */

$sub_section = array(
    'title' => esc_html__('Other Settings', 'mmolee'),
    'desc' => esc_html__('Tech888 Other Settings', 'mmolee'),
    'id' => 'opt-main-other-settings',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'tech888f_wishlist_optimize_session_stats',
            'type' => 'switch',
            'title' => __('Session Status', 'redux-framework-demo'),
            'desc' => __('Enable/Disable session, turn on this setting to speed up your website.Default is off', 'redux-framework-demo'),
            'default' => false,
        ),
        array(
            'id' => 'tech888f_scroll_top_stats',
            'type' => 'switch',
            'title' => __('Scroll Top Button Status', 'redux-framework-demo'),
            'desc' => __('Show/Hide Scroll Top Button. Default is on.', 'redux-framework-demo'),
            'default' => true,
        ),
        array(
            'id' => 'tech888f_wishlist_notify_stats',
            'type' => 'switch',
            'title' => __('Wishlist Notification Status', 'redux-framework-demo'),
            'desc' => __('Show/Hide Wishlist Notification after add product to wishlist Default is on.', 'redux-framework-demo'),
            'default' => true,
        ),
        array(
            'id' => 'tech888f_wishlist_notify_stats',
            'type' => 'switch',
            'title' => __('Wishlist Notification Status', 'redux-framework-demo'),
            'desc' => __('Show/Hide Wishlist Notification after add product to wishlist Default is on.', 'redux-framework-demo'),
            'default' => true,
        ),
        array(
            'id' => 'tech888f_icon_libs',
            'type' => 'select',
            'title' => esc_html__('Default Icon Library', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose default Icon.', 'redux-framework-demo'),
            'options' => tech888f_get_list_icons(),
        ),
        array(
            'id' => 'tech888f_share_box_stats',
            'type' => 'checkbox',
            'title' => __('Share Box Satus', 'redux-framework-demo'),
            'desc' => __('Show/hide Share Box', 'redux-framework-demo'),
            //Must provide key => value pairs for multi checkbox options
            'options' => array(
                'post' => 'Post',
                'product' => 'Product',
            ),

            'default' => array(
                'post' => '1',
                'product' => '1',
            )
        ),
        array(
            'id' => 'tech888f_verifiy_notification',
            'type' => 'switch',
            'title' => __('Verify Notification Status', 'redux-framework-demo'),
            'desc' => __('Show/Hide Notification Status. Default is off.', 'redux-framework-demo'),
            'default' => false,
        ),
        array(
            'id' => 'tech888f_add_font',
            'type' => 'text',
            'title' => __('Add New Google Fonts', 'redux-framework-demo'),
            'desc' => __('Add new font via google api using for frontend display or developing.', 'redux-framework-demo'),
        ),
    )
);

return $sub_section;