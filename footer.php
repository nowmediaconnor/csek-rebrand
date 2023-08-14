</main>

<?php do_action('csek_rebrand_content_end'); ?>

</div>

<?php do_action('csek_rebrand_content_after'); ?>
<footer id="colophon" class="site-footer bg-csek-dark py-12 h-[60vh] font-syne" role="contentinfo">
	<!-- <?php do_action('csek_rebrand_footer'); ?> -->
	<div class="grid grid-cols-2 grid-rows-2 text-csek-light justify-between h-full content-around w-11/12 md:max-w-[75rem] mx-auto">
		<div class="col-span-2 flex flex-row items-center justify-start gap-8">
			<h2 class="text-6xl my-12 font-bold">Ready for<br />more?</h2>
			<div class="w-32 h-32 rounded-full bg-csek-red flex flex-row items-center justify-center text-white uppercase font-extrabold text-xs -rotate-[30deg] font-montserrat">Let&apos;s Talk</div>
		</div>
		<div class="self-end">
			<ul class="flex flex-row flex-wrap gap-x-2">
				<li><a href="#facebook" class="w-10 h-10 border-light border rounded-full flex items-center justify-center"><i class="fab fa-facebook-f"></i></a></li>
				<li><a href="#twitter" class="w-10 h-10 border-light border rounded-full flex items-center justify-center"><i class="fab fa-twitter"></i></a></li>
				<li><a href="#youtube" class="w-10 h-10 border-light border rounded-full flex items-center justify-center"><i class="fab fa-youtube"></i></a></li>
				<li><a href="#linkedin" class="w-10 h-10 border-light border rounded-full flex items-center justify-center"><i class="fab fa-linkedin"></i></a></li>
			</ul>
		</div>
		<div class="self-end justify-self-end flex flex-col items-end gap-4">
			<img src="/wp-content/themes/csek-rebrand/img/c.svg" alt="Csek Creative letter C monogram" class="w-24" />
			<div class="flex flex-row h-10 items-center justify-between gap-x-6 flex-wrap text-xs">
				<span>&copy; <?php echo date_i18n('Y'); ?> <?php echo get_bloginfo('name'); ?></span>
				<span><a href="#privacy">Privacy Policy</a></span>
				<span><a href="#sitemap">Sitemap</a></span>
			</div>
		</div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>