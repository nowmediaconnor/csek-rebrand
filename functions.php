<?php

require_once "metadata.php";

SiteMetadata::init();

/**
 * Theme setup.
 */
function csek_rebrand_setup()
{
	add_theme_support('title-tag');

	register_nav_menus(
		array(
			'primary' => __('Primary Menu', 'tailpress'),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	add_theme_support('custom-logo');
	add_theme_support('post-thumbnails');

	add_theme_support('align-wide');
	add_theme_support('wp-block-styles');

	add_theme_support('editor-styles');
	add_editor_style('css/editor-style.css');
}

add_action('after_setup_theme', 'csek_rebrand_setup');

/**
 * Enqueue theme assets.
 */
function csek_rebrand_enqueue_scripts()
{


	$theme = wp_get_theme();

	wp_enqueue_style('tailpress', csek_rebrand_asset('css/app.css'), [], $theme->get('Version'));
	wp_enqueue_style('fonts', csek_rebrand_asset('css/fonts.css'), [], $theme->get('Version'));
	wp_enqueue_style('animation', csek_rebrand_asset('css/animation.css'), [], $theme->get('Version'));
	wp_enqueue_style('custom', csek_rebrand_asset('css/style.css'), ['tailpress'], $theme->get('Version'));

	wp_enqueue_script('csekrebrand', csek_rebrand_asset('js/app.js'), [], $theme->get('Version'));
	// $apiSettings = [
	// 	'root' => esc_url_raw(rest_url()),
	// 	'nonce' => wp_create_nonce('wp_rest')
	// ];
	// wp_add_inline_script("csekrebrand", "const CSEK_API_SETTINGS = " . json_encode($apiSettings), "before");

	wp_register_script('CircleType', 'https://cdn.jsdelivr.net/gh/peterhry/CircleType@2.3.1/dist/circletype.min.js', null, null, true);
	wp_enqueue_script('CircleType');
}

add_action('wp_enqueue_scripts', 'csek_rebrand_enqueue_scripts');

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function csek_rebrand_asset($path)
{
	if (wp_get_environment_type() === 'production') {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg('time', time(),  get_stylesheet_directory_uri() . '/' . $path);
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function csek_rebrand_nav_menu_add_li_class($classes, $item, $args, $depth)
{
	if (isset($args->li_class)) {
		$classes[] = $args->li_class;
	}

	if (isset($args->{"li_class_$depth"})) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter('nav_menu_css_class', 'csek_rebrand_nav_menu_add_li_class', 10, 4);

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function csek_rebrand_nav_menu_add_submenu_class($classes, $args, $depth)
{
	if (isset($args->submenu_class)) {
		$classes[] = $args->submenu_class;
	}

	if (isset($args->{"submenu_class_$depth"})) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter('nav_menu_submenu_css_class', 'csek_rebrand_nav_menu_add_submenu_class', 10, 3);

/**
 * Custom Blocks
 */
// require get_template_directory() . '/blocks/blocks.php';
add_theme_support('post-thumbnails');

/* Rgister Custom Nav Menu */
function register_csek_menu()
{
	register_nav_menu('csek-menu', __('Csek Menu'));
}
add_action('init', 'register_csek_menu');
