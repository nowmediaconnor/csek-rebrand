<?php

/**
 * Created on Sat Nov 25 2023
 * Author: Connor Doman
 */

SiteMetadata::init();
?>
<div class="addresses flex flex-col items-start justify-start gap-12">
    <?php echo SiteMetadata::address_html() ?>
</div>