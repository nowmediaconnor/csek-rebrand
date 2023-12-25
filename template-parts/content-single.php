<?php
/*
 * Created on Sun Dec 24 2023
 * Author: Connor Doman
 */

$meta = PageMetadataSingleton::getInstance()->getMetadata();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ($meta->is_blog_post() && is_singular()) {
		// Display the title of the post
		// the_title('<h1 class="entry-title">', '</h1>');
		get_template_part('components/blog/post-title');
	}
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
</article>