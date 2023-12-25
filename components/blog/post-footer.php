<?php
/*
 * Created on Sun Dec 24 2023
 * Author: Connor Doman
 */

$meta = PageMetadataSingleton::getInstance()->getMetadata();

?>
<footer class="flex flex-col gap-8 py-8">
    <?php
    get_template_part('components/blog/share-links');
    echo do_shortcode('[related_posts_by_tags posts_per_page="4"]');
    ?>
</footer>