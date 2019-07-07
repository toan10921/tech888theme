<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/2/2019
 * Time: 7:33 PM
 */
if(!class_exists('Tech888f_ExtraPageController'))
{
    class Tech888f_ExtraPageController{

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
                'name'               => esc_html__('Extra Content','ripara'),
                'singular_name'      => esc_html__('Extra Content','ripara'),
                'menu_name'          => esc_html__('Extra Content','ripara'),
                'name_admin_bar'     => esc_html__('Extra Content','ripara'),
                'add_new'            => esc_html__('Add New','ripara'),
                'add_new_item'       => esc_html__( 'Add New Extra Content','ripara' ),
                'new_item'           => esc_html__( 'New Extra Content', 'ripara' ),
                'edit_item'          => esc_html__( 'Edit Extra Content', 'ripara' ),
                'view_item'          => esc_html__( 'View Extra Content', 'ripara' ),
                'all_items'          => esc_html__( 'All Extra Content', 'ripara' ),
                'search_items'       => esc_html__( 'Search Extra Content', 'ripara' ),
                'parent_item_colon'  => esc_html__( 'Parent Extra Content:', 'ripara' ),
                'not_found'          => esc_html__( 'No Extra Content found.', 'ripara' ),
                'not_found_in_trash' => esc_html__( 'No Extra Content found in Trash.', 'ripara' )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'tech888f_extra' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'menu_icon'          => get_template_directory_uri() . "/assets/admin/image/footer-icon.png",
                'supports'           => array( 'title', 'editor' )
            );

            tech888f_reg_post_type('tech888f_extra',$args);
        }
    }

    Tech888f_ExtraPageController::_init();

}