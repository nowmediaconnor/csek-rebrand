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

	<?php do_action('csek_rebrand_site_before'); ?>

	<div id="page" class="min-h-screen flex flex-col">

		<?php do_action('csek_rebrand_header'); ?>
		<header class="w-full h-20">
			<div class="flex flex-row justify-between items-center px-8 mx-auto">
				<div class="mx-8 mt-4 flex flex-col justify-center items-center font-syne tracking-[0.4em] text-xs p-4 box-border">
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
							<a href="#contact" class="py-2 px-8 rounded-full bg-csek-blue h-11 font-semibold font-montserrat inline-flex items-center">
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
			<h3 id="scroll-down" class="fixed bottom-0 font-syne font-semibold text-sm left-[50%] translate-x-[-50%] translate-y-[50%] text-white z-50 scroll-fade-away">
				&nbsp;SCROLL DOWN &#x2022; SCROLL DOWN &#x2022; SCROLL DOWN &#x2022;&nbsp;
			</h3>
		</header>

		<div id="content" class="site-content flex-grow">

			<?php if (is_front_page()) : ?>
			<?php endif; ?>

			<!-- <?php do_action('csek_rebrand_content_start'); ?> -->

			<main>