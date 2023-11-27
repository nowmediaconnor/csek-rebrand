<?php

/**
 * Created on Mon Nov 27 2023
 * Author: Connor Doman
 */
?>
<div id="lets-talk" class="fixed top-0 left-0 w-screen h-screen bg-black z-[200] flex flex-col justify-start items-center text-white overflow-y-scroll py-8 pointer-events-none opacity-0 transition-opacity duration-500 ease-in-out">
    <a id="lets-talk-close" href="#close" class="absolute top-2 right-0 m-8 text-xl font-bold"><i class="fa fa-x"></i></a>
    <h1 class="font-syne my-12 mx-4 text-7xl font-bold">Ready to chat?</h1>

    <div id="wufoo-me2cd7i0b7ldia"> Fill out my <a href="https://gammatech.wufoo.com/forms/me2cd7i0b7ldia">online form</a>. </div>
    <script type="text/javascript">
        var me2cd7i0b7ldia;
        (function(d, t) {
            var s = d.createElement(t),
                options = {
                    'userName': 'gammatech',
                    'formHash': 'me2cd7i0b7ldia',
                    'autoResize': true,
                    'height': '962',
                    'async': true,
                    'host': 'wufoo.com',
                    'header': 'show',
                    'ssl': true
                };
            s.src = ('https:' == d.location.protocol ? 'https://' : 'http://') + 'secure.wufoo.com/scripts/embed/form.js';
            s.onload = s.onreadystatechange = function() {
                var rs = this.readyState;
                if (rs)
                    if (rs != 'complete')
                        if (rs != 'loaded') return;
                try {
                    me2cd7i0b7ldia = new WufooForm();
                    me2cd7i0b7ldia.initialize(options);
                    me2cd7i0b7ldia.display();
                } catch (e) {}
            };
            var scr = d.getElementsByTagName(t)[0],
                par = scr.parentNode;
            par.insertBefore(s, scr);
        })(document, 'script');
    </script>
</div>