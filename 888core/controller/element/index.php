<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 7/29/2019
 * Time: 10:33 PM
 */

if(!defined('ABSPATH')) return;


if(function_exists('tech888f_load_lib')){
    if(class_exists('Vc_Manager')){
        tech888f_load_lib('element');
    }
}