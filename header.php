<?php

$meta = new PageMetadata(get_template_directory_uri());
$header_class_optional = $meta->needs_contrast() ? "w-[100vw] h-screen" : "w-full h-header";

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-csek-dark antialiased'); ?>>
	<div id="loading"></div>

	<!-- <?php do_action('csek_rebrand_site_before'); ?> -->

	<div id="page" class="min-h-screen flex flex-col">

		<?php do_action('csek_rebrand_header'); ?>
		<header class="w-full relative <?php echo $header_class_optional; ?>">
			<?php get_template_part('components/header-elements', null, ['meta' => $meta, 'needs_contrast' => false]); ?>
			<?php get_template_part('components/nav-menu', null, ['meta' => $meta]); ?>
			<span class="header-scroll-down-target basis-0"></span>
			<h3 id="scroll-down" class="fixed bottom-0 font-syne font-semibold text-sm left-[50%] translate-x-[-50%] translate-y-[50%] text-white z-50 scroll-fade-away pointer-events-none">
				&nbsp;SCROLL DOWN &#x2022; SCROLL DOWN &#x2022; SCROLL DOWN &#x2022;&nbsp;
			</h3>
			<?php if (!$meta->is_home) : ?>
				<?php if ($meta->has_thumbnail) : ?>
					<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center text-center w-[100vw] h-[100vh] text-white -z-10">
						<div class="w-1/3">
							<?php if ($meta->has_subtitle) : ?>
								<h2 class="uppercase font-syne"><?php echo $meta->leading_title ?></h2>
								<h2 class="entry-title text-3xl md:text-6xl font-bold leading-tight mb-1 font-syne"><?php echo $meta->subtitle ?></h2>
							<?php else : ?>
								<h2 class="entry-title text-3xl md:text-6xl font-bold leading-tight mb-1 font-syne"><?php echo $meta->leading_title ?></h2>
							<?php endif; /* has subtitle */ ?>
						</div>
						<img id="featured-image" src="<?php echo $meta->thumbnail_url; ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover -z-20 absolute top-0 brightness-50" />
					</div>
				<?php endif; /* has post thumbnail */ ?>
			<?php endif; /* is not front page */ ?>
		</header>

		<!-- <?php do_action('csek_rebrand_content_start'); ?> -->

		<main id="content" class="site-content flex-grow">