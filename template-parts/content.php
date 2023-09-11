<section id="post-<?php the_ID(); ?>" <?php post_class(' w-full'); ?>>
	<!-- <?php if (!is_front_page()) : ?>
		<?php the_title(sprintf('<h2 class="entry-title text-2xl md:text-7xl font-extrabold leading-tight mb-1"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
	<?php endif; ?> -->

	<?php if (is_search() || is_archive()) : ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

	<?php else : ?>

		<div class="w-full">
			<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__('Continue reading %s', 'tailpress'),
					the_title('<span class="screen-reader-text">"', '"</span>', false)
				)
			);

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'tailpress') . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'tailpress') . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
			?>
		</div>

	<?php endif; ?>

</section>