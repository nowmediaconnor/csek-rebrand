</main>

<?php do_action('csek_rebrand_content_end'); ?>

<?php do_action('csek_rebrand_content_after'); ?>

<canvas id="spline-debug" class="fixed z-[999] left-1/2 top-1/2 w-64 h-64 border border-red-500 -translate-x-1/2 -translate-y-1/2 hidden"></canvas>

<footer id="colophon" class="site-footer relative bg-csek-dark py-12 md:pb-12 font-syne" role="contentinfo">
	<!-- <?php do_action('csek_rebrand_footer'); ?> -->
	<div class="flex flex-col md:grid grid-cols-2 grid-rows-2 gap-y-12 text-csek-light justify-between h-full content-around w-11/12 md:max-w-[75rem] mx-auto">
		<div class="col-span-2 flex flex-col md:flex-row items-start md:items-center justify-start gap-8">
			<h3 class="text-5xl md:text-6xl md:my-12 font-bold">Knock on<br />our door<br />anytime.</h3>
			<a class="lets-talk-open" href="#letstalk">
				<div class="w-32 h-32 rounded-full bg-csek-red flex flex-row items-center justify-center text-white uppercase font-extrabold text-xs -rotate-[30deg] font-montserrat relative">
					<span class="absolute">Knock Knock!</span>
				</div>
			</a>
		</div>
		<?php get_template_part('components/social-media'); ?>
		<div class="col-span-2 md:col-span-1 md:self-end md:justify-self-end flex flex-col md:items-end gap-4">
			<img src="/wp-content/themes/csek-rebrand/img/c.svg" alt="Csek Creative letter C monogram" class="w-24 hidden md:block" />
			<div class="flex flex-row md:h-10 items-start md:items-center justify-start md:justify-between gap-x-6 flex-wrap text-xs">
				<span>&copy; <?php echo date_i18n('Y'); ?> <?php echo get_bloginfo('name'); ?></span>
				<span><a href="#privacy">Privacy Policy</a></span>
				<span><a href="#sitemap">Sitemap</a></span>
			</div>
		</div>
	</div>
	<?php get_template_part('components/gravityform', 'form'); ?>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>