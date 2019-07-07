<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/2/2019
 * Time: 7:33 PM
 */

if(!class_exists('tech888f_RequiredPlugins'))
{
    class tech888f_RequiredPlugins
    {
        static function _init()
        {
            add_action('tgmpa_register',array(__CLASS__,'register_required_plugins'));
        }

        static function register_required_plugins()
        {

            global $global_config;
            if( function_exists('tech888f_check_verify') && tech888f_check_verify() ) $plugins= $global_config['require-plugin'];
            else $plugins= $global_config['require-plugin-begin'];


            if(!is_array($plugins) or empty($plugins)) return;

            /**
             * Array of configuration settings. Amend each line as needed.
             * If you want the default strings to be available under your own theme domain,
             * leave the strings uncommented.
             * Some of the strings are added into a sprintf, so see the comments at the
             * end of each line for what each argument will be.
             */
            $default_config = array(
                'default_path' => '',                      // Default absolute path to pre-packaged plugins.
                'menu'         => 'tgmpa-install-plugins', // Menu slug.
                'has_notices'  => true,                    // Show admin notices or not.
                'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
                'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
                'is_automatic' => true,                   // Automatically activate plugins after installation or not.
                'message'      => '',                      // Message to output right before the plugins table.
                'strings'      => array(
                    'page_title'                      => esc_html__( 'Install Required Plugins', 'ripara' ),
                    'menu_title'                      => esc_html__( 'Install Plugins', 'ripara' ),
                    'installing'                      => esc_html__( 'Installing Plugin: %s', 'ripara' ), // %s = plugin name.
                    'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'ripara' ),
                    'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'ripara' ), // %1$s = plugin name(s).
                    'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'ripara' ), // %1$s = plugin name(s).
                    'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'ripara' ), // %1$s = plugin name(s).
                    'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'ripara' ), // %1$s = plugin name(s).
                    'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'ripara' ), // %1$s = plugin name(s).
                    'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'ripara' ), // %1$s = plugin name(s).
                    'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'ripara' ), // %1$s = plugin name(s).
                    'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'ripara' ), // %1$s = plugin name(s).
                    'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'ripara' ),
                    'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'ripara' ),
                    'return'                          => esc_html__( 'Return to Required Plugins Installer', 'ripara' ),
                    'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'ripara' ),
                    'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'ripara' ), // %s = dashboard link.
                    'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
                )
            );
            tgmpa( $plugins, $default_config );
        }
    }

    tech888f_RequiredPlugins::_init();
}
