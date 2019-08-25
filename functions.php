<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/1/2019
 * Time: 8:27 PM
 */

/**
 * tech888 functions and definitions
 *
 * @version 1.0
 *
 * @date 02.02.2019
 */



load_theme_textdomain( 'tech888', get_template_directory() . '/languages' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

/* call customize theme functions */

require_once( trailingslashit( get_template_directory() ). '/888core/controller/theme-function.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/config/config.php' );

/* End call customize theme functions */


/* DEFINE CLASS RESOURCES */
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-inline-css.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-tgm-plugin-activation.php' );
// require_once( trailingslashit( get_template_directory() ). '/888core/class/importer.php' ); // disable importer
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-menu-extra-page.php' );
//require_once( trailingslashit( get_template_directory() ). '/888core/class/order-comment-field.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/require-plugin.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-template.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-walker-megamenu.php' );

/* END DEFINED */

// Define intergrate redux framework

if(!function_exists('tech888f_intergrate_redux_framework')){
    //declare function
    function tech888f_intergrate_redux_framework(){
        $redux_dir = (ABSPATH . 'wp-content/plugins/redux-framework');

        //add redux theme option
        if( !class_exists( 'ReduxFramewrk' ) ) {
            require_once( $redux_dir . '/ReduxCore/framework.php' );
        }
        if( !isset( $redux_demo ) ) {
            require_once( trailingslashit( get_template_directory() ). '/888core/class/class-theme-option.php');
        }
    }
    // call function
    tech888f_intergrate_redux_framework();
}

// End define intergrate redux framework

/* CALL CONTROLLER */

//load lib class
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-walker-megamenu.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/asset.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-tgm-plugin-activation.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/importer.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-menu-extra-page.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-order-comment-field.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/require-plugin.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/class/class-template.php' );

require_once( trailingslashit( get_template_directory() ). '/888core/controller/Controller.php' );
//nghien cuu 2 controller nay sau khi da co redux framework
//require_once( trailingslashit( get_template_directory() ). '/888core/controller/Customize_Control.php' );
//require_once( trailingslashit( get_template_directory() ). '/888core/controller/Metabox_Control.php' );



//require_once( trailingslashit( get_template_directory() ). '/888core/controller/Option_Control.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/controller/VC-Controller.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/controller/WC-Controller.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/controller/Woocommerce_Variable.php' );
//require_once( trailingslashit( get_template_directory() ). '/888core/controller/Multi_Language_Control.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/controller/tpl-post-type/Header-Controller.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/controller/tpl-post-type/Footer-Controller.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/controller/tpl-post-type/ExtraPage-Controller.php' );
require_once( trailingslashit( get_template_directory() ). '/888core/controller/tpl-post-type/metabox/Metabox-Post-Controller.php' );

/* END Call Controller */

/* Call page builder */
require_once(trailingslashit(get_template_directory()) . '888core/controller/element/index.php');


