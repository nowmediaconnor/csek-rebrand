</main>

<?php do_action('csek_rebrand_content_end'); ?>

<?php do_action('csek_rebrand_content_after'); ?>

<canvas id="spline-debug" class="fixed z-[999] left-1/2 top-1/2 w-64 h-64 border border-red-500 -translate-x-1/2 -translate-y-1/2 hidden"></canvas>

<footer id="colophon" class="site-footer relative bg-csek-dark py-12 md:pb-12 font-syne" role="contentinfo">
	<!-- <?php do_action('csek_rebrand_footer'); ?> -->
	<div class="grid grid-cols-2 md:grid-cols-5 grid-rows-footer-mobile md:grid-rows-footer gap-y-8 auto-rows-min text-csek-light justify-between h-full content-around w-11/12 md:max-w-[75rem] mx-auto">
		<div class="col-span-2 md:col-span-3 row-span-2 md:row-span-1 flex flex-col md:flex-row items-start md:items-center justify-start gap-8 my-8">
			<h3 class="text-5xl md:text-6xl font-bold">Knock on our<br />door anytime.</h3>
			<a class="lets-talk-open" href="#letstalk">
				<div class="w-32 h-32 rounded-full bg-csek-red flex flex-row items-center justify-center text-white uppercase font-extrabold text-xs -rotate-[30deg] font-montserrat relative">
					<span class="absolute">Knock Knock!</span>
				</div>
			</a>
		</div>
		<div class="col-start-5 justify-end items-center hidden md:flex">
			<?php get_template_part('components/csek-monogram'); ?>
		</div>
		<div class="flex flex-row row-start-3 md:row-start-2 col-span-1 items-center justify-start">
			<?php get_template_part('components/social-media'); ?>
		</div>
		<div class="flex flex-row row-start-4 col-start-1 md:col-start-2 col-span-3 md:row-start-2 items-start justify-between md:justify-around text-sm md:text-base">
			<?php get_template_part('components/addresses-footer'); ?>
		</div>
		<div class="col-span-3 items-end hidden md:flex">
			<?php get_template_part('components/nowmedia-companies'); ?>
		</div>
		<div class="col-span-2 md:col-start-4 row-start-5 md:row-start-3 md:self-end md:justify-self-end flex flex-col md:items-end gap-4">
			<div class="flex flex-row md:h-10 items-start md:items-center justify-end md:justify-between gap-x-6 gap-y-2 flex-wrap text-xs text-right">
				<span><a href="#privacy">Privacy Policy</a></span>
				<span><a href="#sitemap">Sitemap</a></span>
				<span><a href="https://www.csekcreative.com/product-service-calculator/" target="_blank" rel="noopener noreferrer">Magic Tool</a></span>
				<span>&copy; <?php echo date_i18n('Y'); ?> <?php echo get_bloginfo('name'); ?></span>
			</div>
		</div>
	</div>
	<?php get_template_part('components/gravityform', 'form'); ?>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>