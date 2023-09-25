</main>

<?php do_action('csek_rebrand_content_end'); ?>

<?php do_action('csek_rebrand_content_after'); ?>

<canvas id="spline-debug" class="fixed z-[999] left-1/2 top-1/2 w-64 h-64 border border-red-500 -translate-x-1/2 -translate-y-1/2 hidden"></canvas>

<footer id="colophon" class="site-footer relative bg-csek-dark py-12 h-[60vh] font-syne" role="contentinfo">
	<!-- <?php do_action('csek_rebrand_footer'); ?> -->
	<div class="grid grid-cols-2 grid-rows-2 text-csek-light justify-between h-full content-around w-11/12 md:max-w-[75rem] mx-auto">
		<div class="col-span-2 flex flex-row items-center justify-start gap-8">
			<h2 class="text-6xl my-12 font-bold">Ready for<br />more?</h2>
			<a class="lets-talk-open" href="#letstalk">
				<div class="w-32 h-32 rounded-full bg-csek-red flex flex-row items-center justify-center text-white uppercase font-extrabold text-xs -rotate-[30deg] font-montserrat relative">
					<span class="absolute">Let&apos;s Talk</span>
				</div>
			</a>
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
	<div id="lets-talk" class="fixed top-0 left-0 w-full h-full bg-black z-[200] flex flex-col justify-center items-center text-white">
		<a id="lets-talk-close" href="#close" class="absolute top-0 right-0 m-8 text-xl font-bold"><i class="fa fa-x"></i></a>
		<h1 class="font-syne my-12 text-7xl font-bold">Ready for more?</h1>
		<form class="flex flex-col justify-center items-center gap-4 text-md">
			<div class="flex flex-row gap-4">
				<input type="text" placeholder="First name" class="border border-white rounded-lg py-2 px-6 bg-transparent" />
				<input type="text" placeholder="Last name" class="border border-white rounded-lg py-2 px-6 bg-transparent" />
			</div>
			<div class="flex flex-row gap-4">
				<input type="text" placeholder="Email" class="border border-white rounded-lg py-2 px-6 bg-transparent" />
				<input type="text" placeholder="Phone" class="border border-white rounded-lg py-2 px-6 bg-transparent" />
			</div>
			<select placeholder="Service of interest" class="border border-white rounded-lg py-2 px-6 bg-transparent w-full">
				<option value="" disabled selected>Service of interest</option>
				<option value="2">Another choice</option>
			</select>
			<textarea placeholder="Message (optional)" class="border border-white rounded-lg py-2 px-6 bg-transparent w-full h-32"></textarea>
			<button class="rounded-full bg-csek-red text-white font-bold py-4 px-8">Send an inquiry</button>
		</form>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

</body>

</html>