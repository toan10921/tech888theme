<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tech888-framework
 */

get_header();

/* get value main blog/post settings */
$style = tech888f_get_opt('tech888f_blog_default_style');
$blog_pagi = tech888f_get_opt('tech888f_blog_pagi_style');
/* get value main blog/post settings */

/* Get value blog grid settings */
$item_spec = tech888f_get_opt('tech888f_post_grid_item_specific');
$grid_layout = tech888f_get_opt('tech888f_post_grid_item_layout');
$excerpt = tech888f_get_opt('tech888f_post_grid_excerpt');
$cols_num = tech888f_get_opt('tech888f_post_grid_column');
$size = tech888f_get_opt('tech888f_post_grid_size');
/* Get value blog grid settings */

/* Get value blog list settings */
$item_spec_list = tech888f_get_opt('tech888f_post_list_item_specific');
$excerpt_list = tech888f_get_opt('tech888f_post_list_excerpt');
$size_list = tech888f_get_opt('tech888f_post_list_size');
/* Get value blog list settings */

$number = get_option('posts_per_page');

/* Get menu filter settings */

$check_number = tech888f_get_opt('tech888f_blog_post_per_page_filter');
$check_type = tech888f_get_opt('tech888f_blog_post_style_filter');

/* Get menu filter settings */

if (isset($_GET['number'])) $number = $_GET['number'];
if (isset($_GET['type'])) $style = $_GET['type'];
$size = tech888f_filter_size_crop($size);
$size_list = tech888f_filter_size_crop($size_list);
$slug = $item_spec;
if ($style == 'list') $slug = $item_spec_list;
$attr = array(
    'style' => $style,
    'item_spec' => $item_spec,
    'item_spec_list' => $item_spec_list,
    'excerpt' => $excerpt,
    'cols_num' => $cols_num,
    'size' => $size,
    'size_list' => $size_list,
    'number' => $number,
);
$max_page = $GLOBALS['wp_query']->max_num_pages;
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => $number,
    'order' => 'DESC',
    'paged' => $paged,
);
$curent_query = $GLOBALS['wp_query']->query;
if (is_array($curent_query)) $args = array_merge($args, $curent_query);
tech888f_get_template('menu-filter', '', array('style' => $style, 'number' => $number, 'check_number' => $check_number, 'check_type' => $check_type), true)

?>
<?php do_action('tech888f_before_content') ?>
<div id="main-content" class="main-page-default">
    <div class="container">
        <div class="row">
            <?php tech888f_get_template_sidebar('left') ?>
            <div class="<?php echo esc_attr(tech888f_get_main_class()); ?>">
                <div class="js-content-wrap blog-<?php echo esc_attr($style . '-wrap ' . $grid_layout) ?>"
                     data-column="<?php echo esc_attr($cols_num) ?>">
                    <?php if (have_posts()): ?>
                        <div class="js-content-main list-post-outer row">
                            <?php while (have_posts()) :the_post(); ?>
                                <?php tech888f_get_template_post($style . '/' . $style, $slug, $attr, true); ?>
                            <?php endwhile; ?>

                        </div>

                        <?php
                        if ($blog_pagi == 'load-more' && $max_page > 1) {
                            $data_load = array(
                                "args" => $args,
                                "attr" => $attr,
                            );
                            $data_loadjs = json_encode($data_load);
                            echo '<div class="btn-loadmore">
                                        <a href="#" class="blog-loadmore loadmore" 
                                            data-load="' . esc_attr($data_loadjs) . '" data-paged="1" 
                                            data-maxpage="' . esc_attr($max_page) . '">
                                            ' . esc_html__("Load more", "7upframework") . '
                                        </a>
                                    </div>';
                        } else tech888f_get_page_navi();
                        ?>

                    <?php else : ?>

                        <?php echo tech888f_get_template_post('content', 'none'); ?>

                    <?php endif; ?>

                </div>
            </div>
            <?php tech888f_get_template_sidebar('right') ?>
        </div>
    </div>
</div>
<?php do_action('tech888f_after_content') ?>
<?php
get_footer(); ?>


