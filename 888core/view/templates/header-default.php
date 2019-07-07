<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/9/2019
 * Time: 9:54 PM
 */
global $tech888f_option;
if(isset( $tech888f_option['tech888f_header_content'])){
    $page_id = apply_filters('tech888f_header_page_id',$tech888f_option['tech888f_header_content']);
}
if (!empty($page_id)) {
    ?>
    <div id="header" class="header-page">
        <div class="container">
            <?php echo Tech888f_Template::get_vc_pagecontent($page_id); ?>
        </div>
    </div>
    <?php
} else {
    ?>
    <div id="header" class="header header-default">
        <div class="header-top-default">
            <div class="container">
                <div class="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr__("logo", "ripara"); ?>">
                        <?php
                        $tech888f_logo = '';
                        if (!empty($tech888f_option['logo']))
                            $tech888f_logo = $tech888f_option['logo'];
                        ?>
                        <?php if ($tech888f_logo != '') {
                            echo '<h1 class="hidden">' . get_bloginfo('name', 'display') . '</h1><img src="' . esc_url($tech888f_logo) . '" alt="' . esc_attr__("logo", "ripara") . '">';
                        } else {
                            echo '<h1 class="no-margin">' . get_bloginfo('name', 'display') . '</h1>';
                        }
                        ?>
                    </a>
                </div>
            </div>
        </div>
        <?php if (has_nav_menu('primary')) { ?>
            <div class="header-menu-default">
                <div class="container">
                    <nav class="outer-nav">
                        <?php wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'walker' => new Tech888f_Walker_Nav_Menu(),
                            )
                        ); ?>
                        <a href="<?php echo esc_url("#") ?>" class="menu-mobile"><span></span></a>
                    </nav>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
}
?>

