<?php
/*
 * Template Name: Product action
 *
 *
 * */

get_header();

if (!function_exists('s7upf_update_product')) {
    function s7upf_update_product($update = 'thumbnail', $value, $post_type = 'product', $cats = '')
    {
        echo "hello";
        if (isset($_GET['update_product'])) {
            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => -1,
            );
            if (!empty($cats)) {
                $custom_list = explode(",", $cats);
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $custom_list
                );
            }
            $product_query = new WP_Query($args);
            $count = 0;
            if ($product_query->have_posts()) {
                while ($product_query->have_posts()) {
                    $product_query->the_post();
                    switch ($update) {
                        case 'thumb_hover':
                            if (is_array($value)) {
                                $count++;
                                update_post_meta(get_the_ID(), 'product_thumb_hover', wp_get_attachment_image_url($value[$count], 'full'));
                                if ($count == count($value)) $count = -1;
                            } else update_post_meta(get_the_ID(), 'product_thumb_hover', wp_get_attachment_image_url($value, 'full'));
                            break;
                        case 'sub_title':
                            update_post_meta(get_the_ID(), 'product_sub_title', $value);
                            break;
                        case 'feature':
                            $check = rand(1, 3);
                            if ($check % 2 == 0) update_post_meta(get_the_ID(), '_featured', 1);
                            break;

                        case 'cats':
                            wp_set_object_terms(get_the_ID(), $value, 'product_cat');
                            break;

                        case 'tags':
                            if (is_array($value)) {
                                $tags_key = array_rand($value, 3);
                                $tags = array_intersect_key($value, array_flip($tags_key));
                            } else $tags = $value;

                            if($post_type == 'product'){
                                wp_set_object_terms( get_the_ID() , $tags , 'product_tag' );
                            }elseif ($post_type == 'post'){
                                wp_set_object_terms( get_the_ID() , $tags , 'post_tag' );
                            }
                            break;
                        case 'excerpt':
                            $my_post = array(
                                'ID' => get_the_ID(),
                                'post_excerpt' => $value,
                            );
                            wp_update_post($my_post);
                            break;

                        case 'content':
                            $my_post = array(
                                'ID' => get_the_ID(),
                                'post_content' => $value,
                            );
                            wp_update_post($my_post);
                            break;

                        case 'title':

                            break;

                        case 'gallery':
                            $gallery = array_rand($value, 3);
                            $gallery = array_intersect_key($value, array_flip($gallery));
                            $gallery = implode(',', $gallery);
                            update_post_meta(get_the_ID(), '_product_image_gallery', $gallery);
                            break;

                        case 'thumbnail':
                            if (is_array($value)) {
                                update_post_meta(get_the_ID(), '_thumbnail_id', $value[$count]);
                                $count++;
                                if ($count == count($value)) $count = 0;
                            } else update_post_meta(get_the_ID(), '_thumbnail_id', $value);
                            break;
                        case 'price':
                            if ($post_type == 'product') {
                                echo "<pre>";
                                var_dump(get_the_ID());
                                echo "</pre>";
                                $price = rand(50, 500);
                                $price_sale = '';
                                $sku = 'No-' . rand(1000, 9999) . '-' . rand(1, 99);
                                if ($price % 2 == 0) {
                                    $price_sale = $price - rand(5, $price - 30) % 100;
                                }
                                update_post_meta(get_the_ID(), '_regular_price', $price);
                                update_post_meta(get_the_ID(), '_sale_price', $price_sale);
                                update_post_meta(get_the_ID(), '_sku', $sku);
                                wp_set_object_terms($post_id, $key_array[$index], 'product_cat');
                            }
                        default:

                            break;
                    }
                }
            }
            wp_reset_postdata();
        }
    }
}

if (!function_exists('s7upf_create_products')) {
    function s7upf_create_products($name = array(), $number = 10, $post_type = 'product', $content = '', $excerpt = '')
    {
        if (isset($_GET['add_product'])) {
            $index = $key_index = 0;
            $products = array();
            if (is_array($name) && !empty($name)) {
                $key_array = array();
                for ($i = 0; $i < $number; $i++) {
                    foreach ($name as $key => $value) {
                        if (isset($value[$key_index])) $products[] = $value[$key_index];
                    }
                    $key_index++;
                    if ($key_index == 5) $key_index = 0;
                }
                foreach ($name as $key => $value) {
                    $key_array[] = $key;
                }
                foreach ($products as $key => $value) {
                    $post = array(
                        'post_content' => $content,
                        'post_excerpt' => $excerpt,
                        'post_status' => "publish",
                        'post_title' => $value,
                        'post_type' => $post_type,
                    );
                    $post_id = wp_insert_post($post);
                    if ($post_type == 'product') {
                        $price = rand(50, 500);
                        $price_sale = '';
                        $sku = 'No-' . rand(1000, 9999) . '-' . rand(1, 99);
                        if ($price % 2 == 0) {
                            $price_sale = $price - rand(5, $price - 30) % 100;
                        }
                        update_post_meta($post_id, '_regular_price', $price);
                        update_post_meta($post_id, '_sale_price', $price_sale);
                        update_post_meta($post_id, '_sku', $sku);
                        wp_set_object_terms($post_id, $key_array[$index], 'product_cat');
                    }elseif($post_type == 'post'){
                        wp_set_object_terms($post_id, $key_array[$index], 'category');
                    }
                    $index++;
                    if ($index == count($key_array)) $index = 0;
                }
            } else {
                for ($i = 0; $i < $number; $i++) {
                    $post = array(
                        'post_content' => $content,
                        'post_excerpt' => $excerpt,
                        'post_status' => "publish",
                        'post_title' => $name,
                        'post_type' => $post_type,
                    );
                    $post_id = wp_insert_post($post);
                    if ($post_type == 'product') {
                        $price = rand(50, 500);
                        $price_sale = '';
                        $sku = 'No-' . rand(1000, 9999) . '-' . rand(1, 99);
                        if ($price % 2 == 0) {
                            $price_sale = $price - rand(5, $price - 30) % 100;
                        }
                        update_post_meta($post_id, '_regular_price', $price);
                        update_post_meta($post_id, '_sale_price', $price_sale);
                    }
                }
            }
        }
    }
}

if (!function_exists('tech888f_delele_media')){
    function tech888f_delele_media(){
        if (isset($_GET['del_media'])){
            $attachments = get_posts( array(
                'post_type' => 'attachment',
                'numberposts' => -1,
                'fields' => 'ids',
                'post_parent' => 0,
            ));
            if ($attachments) {
                foreach ($attachments as $attachmentID){
                    $attachment_path = get_attached_file( $attachmentID);
                    //Delete attachment from database only, not file
                    $delete_attachment = wp_delete_attachment($attachmentID, true);
                    //Delete attachment file from disk
                    //$delete_file = unlink($attachment_path);
                }
            }
        }
    }
}

if(!function_exists('tech88f_delete_products')){
    function tech88f_delete_products(){
        if (isset($_GET['del_product'])){
            for($i = 1000 ; $i <= 23350; $i++){
                wh_deleteProduct($i, TRUE);
                echo "delete successful";
            }
        }
    }
}
if(!function_exists('tech88f_delete_media_attachment')){
    function tech88f_delete_media_attachment(){
        if (isset($_GET['del_media_post_type'])){
            $attachments = get_posts( array(
                'post_type' => 'attachment',
                'numberposts' =>-1,
            ));
            if ($attachments) {
                foreach ($attachments as $attachment){
                    $parent_id = $attachment->post_parent;
                    if ( 'portfolio' == get_post_type($parent_id) ) {
                        $attachmentID = $attachment->ID;
                        $attachment_path = get_attached_file( $attachmentID);
                        //Delete attachment from database only, not file
                        $delete_attachment = wp_delete_attachment($attachmentID, true);
                        //Delete attachment file from disk
                        $delete_file = unlink($attachment_path);
                    }
                }
            }
        }
    }
}

//id image post mptheme

$ids = array(24176);
//$ids_prd = array(24030,24029,24028,24027);
//$ids_portfolio = array(1639,1640,1641,1642,1643);
//$ids_prd_gallery = array(959,960,961,962,963,964,965,966,967,968,969,970,971,972,973,974,975,976,977,978,979,980,981,982,983,984,985);
//$tags = array("headphone", "audio device", "music accessories", "Prestige Series", "In-Ear Series", "Wireless");
// $ids_foods = array(595,596,597,598,599,600,601,602);
// s7upf_update_product('thumbnail',$ids,'product','foods');
// s7upf_update_product('gallery',$ids,'product','foods');
// s7upf_update_product('thumb_hover',$ids,'product','foods');

// $ids_sweat = array(603,604,605,606,607,608);
// s7upf_update_product('thumbnail',$ids,'product','sweat-cloth');
// s7upf_update_product('gallery',$ids,'product','sweat-cloth');
// s7upf_update_product('thumb_hover',$ids,'product','sweat-cloth');

// $ids_flowers = array(632,633,634,635,636,637,638,639);
// s7upf_update_product('thumbnail',$ids);
// s7upf_update_product('gallery',$ids);
// s7upf_update_product('thumb_hover',$ids);

// s7upf_update_product('excerpt',$excerpt);
// s7upf_update_product('content',$content);
// s7upf_update_product('tags',$tags);
// $gallery = '2568,2569,2570';
// update_post_meta( 2506, '_product_image_gallery', $gallery);
$name = array(
    "Accessories" => array(
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
        "Cáp sạc Earldom 3in1 IMC 017 – PK225",
    ),
);
/*$prd_name = array(
    "Reference Series" => array(
        "Beoplay A1",
        "Beoplay M3",
        "Beoplay E8 Motion",
        "Beoplay A1",
        "Beoplay M3",
        "Beoplay E8 Motion",
        "Beoplay A1",
        "Beoplay M3",
        "Beoplay E8 Motion",
        "Beoplay A1",
        "Beoplay M3",
        "Beoplay E8 Motion",
    ),
);
$portfolio_name = array(
    "Project" => array(
        "E8 Motion",
        "E6 Motion",
        "Urban Nature",
        "Calm, Cool, Collected",
        "A home in harmony",
        "E8 Motion",
        "E6 Motion",
        "Urban Nature",
        "Calm, Cool, Collected",
        "A home in harmony",
        "E8 Motion",
        "E6 Motion",
    ),
);*/
$number = 10; //number product each category
//s7upf_create_products($name,$number);
$content_post = '';


$content_portfolio = 'Lorem ipsum dolor sit amet, conse adipiscing elit. Etiam ante ex, ferme ntum vel libero eget interdum per libero. Curabitur egestas convallis. Donec pede justo fringilla vel aliquet necvulputate eget, arcu. In enm just, rhoncus ut, imperdiet justo. Nullam dictum felis eu pede mollis pretium consectetur adipiscing elit. Vestibulum nec odio ipsum. Suspendisse cursus malesuada facilisis.Lorem ipsum dolor sit amet, consectetur adipiscing.

Lorem ipsum dolor sit amet, conse adipiscing elit. Etiam ante ex, ferme ntum vel libero eget interdum per libero. Curabitur egestas convallis. Donec pede justo frigilla vel aliquet nec vulputate eget, arcu. In enm just, rhoncus ut, imperdiet justo. Nullam dictum felis eu pede mollis pretium consectetur adipiscing elit. Vestibulum nec odio ipsum. Suspen cursus malesuada facilisis.Lorem ipsum dolor sit amet. Aliquam hendrerit a augue in suscipit. Pellentesque id erat quis sapien dignissim sollicitudin. Nulla mattis tortor sit amet dolor sollicitudin aliquam. Integer viverr odio lectus sedisro mattis placerat. Vivamus sed risus erat placerat auctor. Ut cursus massa at urnaaculis estie

Aliquam hendrerit a augue in suscipit. Pellentesque id erat quis sapien dignissim sollicitudin. Nulla mattis tortor sit amet dolor sollicitudin aliquam. Integer viverr odio lectus sedisro mattis placerat. Nullam dictum felis eu pede mollis pretium consectetur adipiscing elit. Vestibulum nec odio ipsum. Suspen cursus vamus sed risus erat placerat auctor. Ut cursus massa at urnaaculis estie.';
$excerpt_portfolio = 'Aliquam hendrerit a augue in suscipit. Pellentesque id erat quis sapien dignissim sollicitudin. Nulla mattis tortor sit amet dolor sollicitudin aliquam. Integer viverr odio lectus sedisro mattis placerat. Nullam dictum felis eu pede mollis pretium consectetur adipiscing elit. Vestibulum nec odio ipsum. Suspen cursus vamus sed risus erat placerat auctor. Ut cursus massa at urnaaculis estie.';

// create post mptheme
//s7upf_create_products($name,$number,'post',$content_post,$excerpt_post);

// update post mptheme
//s7upf_update_product('thumbnail',$ids,'post','');
//s7upf_update_product('tags',$tags,'post','');
//s7upf_update_product('excerpt',$excerpt_post,'post','');
//s7upf_update_product('content',$content_post,'post','');

/*create product mptheme */

//s7upf_create_products($prd_name,$number,'product',$content_post,$excerpt_post);

// update product mptheme

//s7upf_update_product('thumbnail',$ids_prd,'product','');
//s7upf_update_product('thumb_hover',$ids_prd,'product','');
//s7upf_update_product('gallery',$ids_prd_gallery,'product','');
//s7upf_update_product('excerpt',$excerpt_post,'product','');
//s7upf_update_product('tags',$tags,'product','');
//s7upf_update_product('price',null ,'product','');
//s7upf_update_product('sub_title','Speakers, Accessories' ,'product','');
//s7upf_update_product('content',$content_prd,'product','');

//s7upf_update_product('thumbnail',$ids,'product','');

// create portfolio mptheme

//s7upf_create_products($portfolio_name,$number,'portfolio',$content_portfolio,$excerpt_portfolio);
//s7upf_update_product('gallery',$ids_portfolio,'portfolio','');

//tech88f_delete_products();
tech888f_delele_media();
get_footer();