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
			<div class="flex flex-row justify-between items-center px-8 mx-auto relative w-full h-header">
				<div class="mx-8 flex flex-col justify-center items-center font-syne">
					<a href="<?php echo $meta->site_url; ?>" class="w-28 flex flex-col justify-center items-center <?php echo $meta->needs_contrast() ? "text-csek-white" : "text-csek-dark"; ?>">
						<img src="<?php echo $meta->logo_url(); ?>" />
						<span class="tracking-[0.4rem] text-xs relative left-[0.2rem]">CREATIVE</span>
					</a>
				</div>
				<span class="header-scroll-down-target basis-0"></span>
				<nav class="mx-8">
					<ul class="flex flex-row gap-8 items-center">
						<li>
							<a href="#contact" class="lets-talk-open py-2 px-8 rounded-full bg-csek-blue h-11 font-semibold font-montserrat inline-flex items-center text-sm">
								LET'S TALK
							</a>
						</li>
						<li>
							<a href="#nav" id="primary-menu-toggle" class="rounded-full h-12 w-12 border flex flex-row items-center justify-center text-xl <?php echo $meta->has_thumbnail ? "border-csek-white text-csek-white" : "border-csek-dark text-csek-dark"; ?>">
								<i class="fa-solid fa-bars"></i>
							</a>
						</li>
					</ul>
					<?php wp_nav_menu(['theme_location' => 'csek-menu', 'container_class' => 'csek-nav-menu hidden-nav',]); ?>
				</nav>
			</div>
			<h3 id="scroll-down" class="fixed bottom-0 font-syne font-semibold text-sm left-[50%] translate-x-[-50%] translate-y-[50%] text-white z-50 scroll-fade-away pointer-events-none">
				&nbsp;SCROLL DOWN &#x2022; SCROLL DOWN &#x2022; SCROLL DOWN &#x2022;&nbsp;
			</h3>
			<?php if (!$meta->is_home) : ?>
				<?php if ($meta->has_thumbnail) : ?>
					<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center text-center w-[100vw] h-[100vh] text-white -z-10">
						<div class="w-1/2">
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