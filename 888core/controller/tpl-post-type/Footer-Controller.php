<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/2/2019
 * Time: 7:33 PM
 */
if(!class_exists('Tech888f_FooterController'))
{
    class Tech888f_FooterController{

        static function _init()
        {
            if(function_exists('tech888f_reg_post_type'))
            {
                add_action('init',array(__CLASS__,'_add_post_type'));
            }
        }

        static function _add_post_type()
        {
            $labels = array(
                'name'               => esc_html__('Footer Template','ripara'),
                'singular_name'      => esc_html__('Footer Template','ripara'),
                'menu_name'          => esc_html__('Footer Template','ripara'),
                'name_admin_bar'     => esc_html__('Footer Template','ripara'),
                'add_new'            => esc_html__('Add New','ripara'),
                'add_new_item'       => esc_html__( 'Add New Footer','ripara' ),
                'new_item'           => esc_html__( 'New Footer', 'ripara' ),
                'edit_item'          => esc_html__( 'Edit Footer', 'ripara' ),
                'view_item'          => esc_html__( 'View Footer', 'ripara' ),
                'all_items'          => esc_html__( 'All Footers', 'ripara' ),
                'search_items'       => esc_html__( 'Search Footer', 'ripara' ),
                'parent_item_colon'  => esc_html__( 'Parent Footer:', 'ripara' ),
                'not_found'          => esc_html__( 'No Footer found.', 'ripara' ),
                'not_found_in_trash' => esc_html__( 'No Footer found in Trash.', 'ripara' )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'tech888f_footer' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,                
                'menu_icon'          => get_template_directory_uri() . "/assets/admin/image/footer-icon.png",
                'supports'           => array( 'title', 'editor' )
            );

            tech888f_reg_post_type('tech888f_footer',$args);
        }
    }

    Tech888f_FooterController::_init();

}