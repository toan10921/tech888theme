<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package tech888-framework
 */
?>
<!DOCTYPE html>
<html <?php language_attributes('html'); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="<?php echo esc_url("http://gmpg.org/xfn/11") ?>">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php //s7upf_preload();?>
<div class="wrap">
<?php echo tech888f_get_template('header-default');
