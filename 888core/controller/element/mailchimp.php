<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/12/15
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_mailchimp') && class_exists('MC4WP_MailChimp')){
    function tech888f_vc_mailchimp($attr){
        $html = '';
        $data_array = array_merge(array(
            'style'         => '',
            'title'         => '',
            'des'           => '',
            'image'         => '',
            'placeholder'   => '',
            'submit'        => '',
            'form_id'       => '',
            'el_class'      => '',
            'custom_css'    => '',
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;        

        // Variable process
        $el_class .= ' '.$style;
        $form_html = apply_filters('tech888f_mailchimp_form',do_shortcode('[mc4wp_form id="'.$form_id.'"]'));

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class'  => $el_class,
            'form_html' => $form_html,
            ));

        // Call function get template
        $html = tech888f_get_template_element('mailchimp/mailchimp',$style,$attr);

        return $html;
    }
}

tech888f_reg_shortcode('tech888f_mailchimp','tech888f_vc_mailchimp');

vc_map( array(
    "name"          => esc_html__("MailChimp", 'mptheme'),
    "base"          => "tech888f_mailchimp",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display mailchimp form', 'mptheme' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')         => '',
                esc_html__("Popup",'mptheme')         => 'popup',
            ),
            "description"   => esc_html__( 'Choose a style to display.', 'mptheme' )
        ),
        array(
            "type"          => "attach_image",
            "heading"       => esc_html__("Image",'mptheme'),
            "param_name"    => "image",
            "dependency"    =>  array(
                "element"       => "style",
                "value"         => "popup",
            ),
            "description"   => esc_html__( 'Choose a image from media.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Form ID",'mptheme'),
            "param_name"    => "form_id",
            "description"   => esc_html__( 'Enter mailchimp form ID.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Title",'mptheme'),
            "param_name"    => "title",
            "description"   => esc_html__( 'Enter title of element.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Description",'mptheme'),
            "param_name"    => "des",
            "description"   => esc_html__( 'Enter description of element.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Placeholder Input",'mptheme'),
            "param_name"    => "placeholder",
            "description"   => esc_html__( 'Enter placeholder of input email. Default is value of mailchimp form.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Submit Label",'mptheme'),
            "param_name"    => "submit",
            "description"   => esc_html__( 'Enter label for submit button. Default is value of mailchimp form.', 'mptheme' )
        ),        
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Extra class name",'mptheme'),
            "param_name"    => "el_class",
            'group'         => esc_html__('Design Options','mptheme'),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'mptheme' )
        ),
        array(
            "type"          => "css_editor",
            "heading"       => esc_html__("CSS box",'mptheme'),
            "param_name"    => "custom_css",
            'group'         => esc_html__('Design Options','mptheme')
        ),
    )
));