<?php
/*
 * Created on Wed Jan 31 2024
 * Author: Connor Doman
 */
?>
<div id="newsletter-form" class="csek-gravity-form fixed top-0 left-0 w-screen h-screen bg-transparent z-[200] flex flex-col justify-start items-center text-white overflow-y-scroll py-8 pointer-events-none opacity-100 transition-opacity duration-500 ease-in-out">
    <!-- <a id="newsletter-close" href="#close" class="absolute top-2 right-0 m-8 text-xl font-bold"><i class="fa fa-x"></i></a> -->
    <!-- <h1 class="font-syne my-12 mx-4 text-7xl font-bold">Join Our Newsletter</h1> -->
    <?php echo do_shortcode('[gravityform id="3" title="false" ajax="true"]'); ?>
</div>