<?php

/**
 * Created on Mon Dec 04 2023
 * Author: Connor Doman
 */
?>
<div id="lets-talk" class="fixed top-0 left-0 w-screen h-screen bg-black z-[200] flex flex-col justify-start items-center text-white overflow-y-scroll py-8 pointer-events-none opacity-0 transition-opacity duration-500 ease-in-out">
    <a id="lets-talk-close" href="#close" class="absolute top-2 right-0 m-8 text-xl font-bold"><i class="fa fa-x"></i></a>
    <h1 class="font-syne my-12 mx-4 text-7xl font-bold">Ready to chat?</h1>
    <?php echo do_shortcode('[gravityform id="1" title="false" ajax="true"]'); ?>
</div>