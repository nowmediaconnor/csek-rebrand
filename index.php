<?php get_header(); ?>

<div class="mx-auto">

	<?php if (have_posts()) : ?>
		<?php
		while (have_posts()) :
			the_post();
		?>

			<?php get_template_part('template-parts/content', get_post_format()); ?>

		<?php endwhile; ?>

	<?php endif; ?>

</div>

<?php get_template_part('components/scroll-to-top') ?>

<?php
get_footer();
