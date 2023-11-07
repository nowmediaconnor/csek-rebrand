</main>

<?php do_action('csek_rebrand_content_end'); ?>

<?php do_action('csek_rebrand_content_after'); ?>

<canvas id="spline-debug" class="fixed z-[999] left-1/2 top-1/2 w-64 h-64 border border-red-500 -translate-x-1/2 -translate-y-1/2 hidden"></canvas>

<footer id="colophon" class="site-footer relative bg-csek-dark py-4 md:pb-12 font-syne" role="contentinfo">
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
		<div class="md:self-end flex flex-col gap-8 grid-rows-[10rem]">
			<h3 class="font-syne text-csek-gray font-bold uppercase">Social</h3>
			<ul class="flex flex-row flex-wrap gap-x-2">
				<li><a href="#facebook" class="w-10 h-10 border-light border rounded-full flex items-center justify-center" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>
				<li><a href="#twitter" class="w-10 h-10 border-light border rounded-full flex items-center justify-center" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a></li>
				<li><a href="#linkedin" class="w-10 h-10 border-light border rounded-full flex items-center justify-center" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a></li>
				<li><a href="#youtube" class="w-10 h-10 border-light border rounded-full flex items-center justify-center" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a></li>
			</ul>
		</div>
		<div class="col-span-2 md:col-span-1 md:self-end md:justify-self-end flex flex-col md:items-end gap-4">
			<img src="/wp-content/themes/csek-rebrand/img/c.svg" alt="Csek Creative letter C monogram" class="w-24 hidden md:block" />
			<div class="flex flex-row h-10 items-start md:items-center justify-start md:justify-between gap-x-6 flex-wrap text-xs">
				<span>&copy; <?php echo date_i18n('Y'); ?> <?php echo get_bloginfo('name'); ?></span>
				<span><a href="#privacy">Privacy Policy</a></span>
				<span><a href="#sitemap">Sitemap</a></span>
			</div>
		</div>
	</div>
	<div id="lets-talk" class="fixed top-0 left-0 w-screen h-screen bg-black z-[200] flex flex-col justify-center items-center text-white">
		<a id="lets-talk-close" href="#close" class="absolute top-3 right-0 m-8 text-xl font-bold"><i class="fa fa-x"></i></a>
		<h1 class="font-syne my-12 mx-4 text-7xl font-bold">Ready to chat?</h1>
		<form class="flex flex-col justify-center items-center gap-4 text-md w-full px-4 max-w-csek-max">
			<div class="flex flex-col md:flex-row gap-4 w-full">
				<input type="text" placeholder="First name" class="border border-white rounded-lg py-2 px-6 bg-transparent" />
				<input type="text" placeholder="Last name" class="border border-white rounded-lg py-2 px-6 bg-transparent" />
			</div>
			<div class="flex flex-col md:flex-row gap-4 w-full">
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