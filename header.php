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
		<header class="w-full relative <?php if (!is_front_page() && has_post_thumbnail()) echo 'w-[100vw] h-[100vh]';
										else echo 'w-full h-20'; ?>">
			<div class="flex flex-row justify-between items-center px-8 mx-auto z-10 relative">
				<div class="mx-8 flex flex-col justify-center items-center font-syne tracking-[0.4em] text-xs p-4 box-border">
					<!-- <img src="src/img/CSEK.svg" class="h-8" alt="Csek wordmark" /> -->

					<div class="w-28">
						<?php if (has_custom_logo()) : ?>
							<?php the_custom_logo(); ?>
						<?php endif; ?>
					</div>
					CREATIVE
				</div>
				<nav class="mx-8">
					<ul class="flex flex-row gap-8 items-center">
						<li>
							<a href="#contact" class="lets-talk-open py-2 px-8 rounded-full bg-csek-blue h-11 font-semibold font-montserrat inline-flex items-center text-sm">
								LET'S TALK
							</a>
						</li>
						<li>
							<a href="#nav" class="rounded-full h-12 w-12 border border-zinc-900 flex flex-row items-center justify-center text-xl">
								<i class="fa-solid fa-bars"></i>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<h3 id="scroll-down" class="fixed bottom-0 font-syne font-semibold text-sm left-[50%] translate-x-[-50%] translate-y-[50%] text-white z-50 scroll-fade-away pointer-events-none">
				&nbsp;SCROLL DOWN &#x2022; SCROLL DOWN &#x2022; SCROLL DOWN &#x2022;&nbsp;
			</h3>
			<?php if (!is_front_page()) : ?>
				<?php if (has_post_thumbnail()) : $imageSrc = get_the_post_thumbnail_url() ?>
					<?php
					$titleParts = explode("|", the_title("", "", false));
					$clientName = trim($titleParts[0]);
					if (count($titleParts) > 1) {
						$postTitle = trim($titleParts[1]);
					}
					?>
					<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center text-center w-[100vw] h-[100vh] text-white">
						<div class="w-1/2">

							<h2 class="uppercase font-syne"><?php echo $clientName ?></h2>
							<h2 class="entry-title text-3xl md:text-6xl font-bold leading-tight mb-1 font-syne"><?php echo $postTitle ?></h2>
						</div>
						<img id="featured-image" src="<?php echo $imageSrc; ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover -z-20 absolute top-0 brightness-50" />
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</header>


		<?php if (is_front_page()) : ?>
		<?php endif; ?>

		<!-- <?php do_action('csek_rebrand_content_start'); ?> -->

		<main id="content" class="site-content flex-grow">