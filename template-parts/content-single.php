<?php
/*
 * Created on Sun Dec 24 2023
 * Author: Connor Doman
 */

$meta = PageMetadataSingleton::getInstance()->getMetadata();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ($meta->is_blog_post() && is_singular()) :
		get_template_part('components/blog/post-title');
	?>
		<div class="blog-content w-11/12 max-w-csek-2/3 mx-auto">
			<?php the_content(); ?>
		</div>
	<?php
	else :
	?>

		<div class="w-full">
			<?php the_content(); ?>

			<?php
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

	<?php
	if ($meta->is_blog_post() && is_singular()) {
		get_template_part('components/blog/post-footer');
	}
	?>
</article>