<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/8/2019
 * Time: 3:52 PM
 */

$sub_section = array(
    'title'      => esc_html__( 'General', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 General Settings', 'mmolee' ),
    'id'         => 'opt_main_general_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_header_content',
            'type'     => 'select',
            'title'    => esc_html__('Choose Main Header', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose a header page according dropdown', 'redux-framework-demo'),
            'desc'     => esc_html__('Go to menu name "Tech888 Header" in admin menu to edit/create your own header. This header appear in all pages of your site, If you have any page/single page need display another content, you can set specific header for it.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
            'post_type' => 'tech888f_header',
            ),
        ),
        array(
            'id'       => 'tech888f_footer_content',
            'type'     => 'select',
            'title'    => esc_html__('Choose Main Footer', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose a footer page according dropdown', 'redux-framework-demo'),
            'desc'     => esc_html__('Go to menu name "Tech888 Footer" in admin menu to edit/create your own header. This footer appear in all pages of your site, If you have any page/single page need display another content, you can set specific footer for it.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_footer',
            ),
        ),
        array(
            'id'       => 'tech888f_before_append',
            'type'     => 'select',
            'title'    => esc_html__('Content Before Default template', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your before extra content', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose an extra content append to before main content of page with template default.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id'       => 'tech888f_after_append',
            'type'     => 'select',
            'title'    => esc_html__('Content After Default template', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your after extra content', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose an extra content append to before main content of page with template default.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id'       => 'tech888f_404_page',
            'type'     => 'select',
            'title'    => esc_html__('Choose 404 page', 'redux-framework-demo'),
            'subtitle' => esc_html__('', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose your own 404 page instead of 404 page template default.', 'redux-framework-demo'),
            'data'     => 'pages',
        ),
    )
);

return $sub_section;