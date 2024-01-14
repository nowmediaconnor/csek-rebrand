<?php

require_once "metadata.php";

SiteMetadata::init();

class PageMetadataSingleton
{
	private static $instance = null;
	private $metadata;

	private function __construct()
	{
		$this->metadata = new PageMetadata(get_template_directory_uri());
	}

	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new PageMetadataSingleton();
		}

		return self::$instance;
	}

	public function getMetadata()
	{
		return $this->metadata;
	}
}

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

	// add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'csek_rebrand_setup');

function csek_rebrand_editor()
{
	wp_enqueue_style('fonts', csek_rebrand_asset('css/fonts.css'), [], csek_file_version('css/fonts.css'));
	wp_enqueue_style('csek-editor-styles', csek_rebrand_asset('css/editor-style.css'), ['fonts'], csek_file_version('css/editor-style.css'));
}
add_action("enqueue_block_editor_assets", "csek_rebrand_editor");


function csek_theme_file_path(string $relative_path)
{
	// Remove leading slash if present
	$relative_path = ltrim($relative_path, '/');

	return plugin_dir_path(__FILE__) . $relative_path;
}

function csek_file_version(string $filepath)
{
	return filemtime(csek_theme_file_path($filepath));
}

/**
 * Enqueue theme assets.
 */
function csek_rebrand_enqueue_scripts()
{
	// $theme = wp_get_theme();

	wp_enqueue_style('tailpress', csek_rebrand_asset('css/app.css'), [], csek_file_version('css/app.css'));
	wp_enqueue_style('fonts', csek_rebrand_asset('css/fonts.css'), [], csek_file_version('css/fonts.css'));
	wp_enqueue_style('animation', csek_rebrand_asset('css/animation.css'), [], csek_file_version('css/animation.css'));
	wp_enqueue_style('custom', csek_rebrand_asset('css/style.css'), ['tailpress'], csek_file_version('css/style.css'));

	wp_enqueue_script('csekrebrand', csek_rebrand_asset('js/app.js'), [], csek_file_version('js/app.js'), true);
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


/* Generate <li>s from array */

function generate_list_items(array $items, array $classes = []): string
{
	$classNames = count($classes) > 0 ? implode(' ', $classes) : "";
	$li = '';
	foreach ($items as $item) {
		$li .= '<li class="' . $classNames . '">' . $item . '</li>';
	}
	return $li;
}

function wrap_in_links(array $items, array $links, bool $external = false, array $classes = []): array
{
	$classNames = count($classes) > 0 ? implode(' ', $classes) : "";

	$target = $external ? 'target="_blank" rel="noopener noreferrer"' : '';
	$wrapped = [];
	foreach ($items as $key => $item) {
		$wrapped[] = '<a href="' . $links[$key] . '"' . $target . ' class="' . $classNames . '">' . $item . '</a>';
	}
	return $wrapped;
}

function generate_img_items(array $items, array $classes = []): array
{
	$classNames = count($classes) > 0 ? implode(' ', $classes) : "";

	$images = [];
	foreach ($items as $item) {
		$src = $item['src'];
		$alt = $item['alt'];
		$images[] = '<img src="' . $src . '" alt="' . $alt . '" class="' . $classNames . '" />';
	}
	return $images;
}


/* Custom Post Tag Fetch */

function calculate_read_time($content)
{
	$word_count = str_word_count(strip_tags($content));
	$words_per_minute = 225; // Average reading words per minute
	$read_time = ceil($word_count / $words_per_minute);
	return $read_time;
}


/**
 * Shortcode function to retrieve related posts based on tags.
 *
 * @param array $atts An array of attributes for the shortcode.
 * @return string The generated HTML for the related posts.
 */
function csek_related_posts_by_tag_shortcode($atts)
{
	// Shortcode attributes
	$atts = shortcode_atts(array(
		'posts_per_page' => 4, // Default number of posts
		'category' => null
	), $atts);

	// Get tags of the current post
	$tags = wp_get_post_tags(get_the_ID(), array('fields' => 'ids'));

	// Return if no tags are found
	if (!$tags) {
		return '';
	}

	// WP_Query arguments
	$args = array(
		'tag__in' => $tags,
		'post_type' => 'post',
		'posts_per_page' => $atts['posts_per_page'],
		'post__not_in' => array(get_the_ID()), // Exclude current post
		'no_found_rows' => true, // Performance boost since pagination is not needed
		'category_name' => $atts['category']
	);

	$current_post_tags = array_map(function ($item) {
		return $item->term_id;
	}, get_the_tags());

	$related_posts = [];

	$query = new WP_Query($args);

	$tag_limit = 2;

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			// Get the tags of the post and extract their IDs
			$post_tags_objects = wp_get_post_tags(get_the_ID());
			$post_tags = array_map(function ($tag) {
				return $tag->term_id;
			}, $post_tags_objects);

			// Count common tags
			$common_tags_count = count(array_intersect($current_post_tags, $post_tags));

			// Add to related posts array if not already present
			$post_id = get_the_ID();
			$is_duplicate = false;
			foreach ($related_posts as $post) {
				if ($post['ID'] === $post_id) {
					$is_duplicate = true;
					break;
				}
			}
			if (!$is_duplicate) {
				$related_posts[] = array(
					'ID' => $post_id,
					'common_tags_count' => $common_tags_count
				);
			}
		}
	}

	// Sort posts by the number of common tags
	usort($related_posts, function ($a, $b) {
		return $b['common_tags_count'] - $a['common_tags_count'];
	});

	// Start HTML string
	$html = '<div class="csek-related-posts">';

	foreach ($related_posts as $post) {
		$post_id = $post['ID'];
		$post_data = get_post($post_id);
		setup_postdata($post_data);
		$read_time = calculate_read_time($post_data->post_content);

		$post_link = get_the_permalink();

		$html .= '<div class="related-post">';
		$html .= '<div class="featured-image">' . get_the_post_thumbnail($post_id) . '</div>';
		$html .= '<div class="text-content">';
		$html .= '<h2 class="title"><a href="' . $post_link . '">' . $post_data->post_title . '</a></h2>';
		$html .= '<div class="read-time">' . $read_time . ' MIN READ</div>';

		$html .= '<div class="tags">';
		$tags = get_the_tags($post_id);

		$tag_count = 0;
		$leftover_tags = [];

		foreach ($tags as $tag) {
			if ($tag_count >= $tag_limit) {
				$leftover_tags[] = $tag->name;
				continue;
			}
			$html .= '<a href="' . get_tag_link($tag->term_id) . '" class="chip">' . $tag->name . '</a>';
			$tag_count++;
		}

		if ($tag_count >= $tag_limit) {
			$html .= '<a href="' . $post_link . '" title="' . implode(", ", $leftover_tags) . '" class="chip">+' . (count($tags) - $tag_limit) . '</a>';
		}

		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
	}

	$html .= '</div>';

	// Reset postdata to ensure no conflicts with other queries
	wp_reset_postdata();

	return $html;
}

// Register the shortcode
add_shortcode('related_posts_by_tags', 'csek_related_posts_by_tag_shortcode');


/* Override Media REST API */

add_filter('rest_authentication_errors', function ($result) {
	// Check if the request is for the /wp-json/wp/v2/media endpoint
	if (strpos($_SERVER['REQUEST_URI'], '/wp-json/wp/v2/media') !== false) {
		// If it is, allow unauthenticated access
		return null;
	}
	return $result;
});


/* Add Guten-Csek Classname */