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
                add_action('add_meta_boxes', array(__CLASS__, '_add_meta_box'));
                add_action( 'save_post', 'save_metabox_post_option');
                add_action( 'admin_menu' , 'remove_post_metabox_fields' );
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

/*
* Define output metabox admin
* @var $post // default object post(default method)
*
*/

if (!function_exists('output_metabox_post_backend')) {
    function output_metabox_post_backend($post)
    {
        $link_download = get_post_meta($post->ID, 'link_download', true);
        wp_nonce_field( basename(__FILE__), 'metabox_post_nonce' );
        ?>
        <button class="accordion-metabox text-uppercase font-bold"><?php esc_html_e('Main Settings','tech888') ?></button>
        <div class="panel">
            <p class="input-wrap">
                <label class="font-bold" for="link_download"><?php esc_html_e('Post Detail Top Image:','tech888') ?></label>
                <input type="text" name="link_download" id="link_download" class="link_download" value="<?php echo esc_attr($link_download) ?>"/>
            </p>
            <p class="desc">
                <?php esc_html_e('Upload your specific top head images.If not, the feature image will be set instead of this values','tech888') ?>
            </p>
        </div>

        <button class="accordion-metabox text-uppercase font-bold"><?php esc_html_e('Customize Color Settings','tech888') ?></button>
        <div class="panel">
            <p>Lorem ipsum...</p>
        </div>
        <?php
    }
}

/* End Define output metabox admin  */

/* Define save metabox function */

if(!function_exists('save_metabox_post_option')){
    function save_metabox_post_option($post_id){
        if( !isset( $_POST["link_download"] ) || !wp_verify_nonce( $_POST["metabox_post_nonce"], basename(__FILE__) ) ){
            return $post_id;
        }
        if(!current_user_can( "edit_post", $post_id ) )
        {
            return $post_id;
        }

        if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        {
            return $post_id;
        }

        $allow_object = array( 'post', 'product' );

        $link_download = ( isset( $_POST["link_download"] ) ) ? sanitize_title( $_POST["link_download"] ) : '';
        update_post_meta( $post_id, "link_download", $link_download );
    }
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
