<?php get_header(); ?>

<div class="w-full mx-auto">

	<?php if (have_posts()) : ?>

		<?php
		while (have_posts()) :
			the_post();
		?>

			<?php get_template_part('template-parts/content', 'single'); ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) {
				// comments_template();
			}
			?>

		<?php endwhile; ?>

	<?php endif; ?>

</div>

<?php
get_footer();
