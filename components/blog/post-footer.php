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
    echo do_shortcode('[related_posts_by_tags posts_per_page="4" category="blog"]');
    ?>
    <div class="flex items-center justify-center w-full py-8">
        <a href="/blog" class="rounded-full px-8 py-4 uppercase font-montserrat font-semibold border border-solid border-csek-dark text-xs hover:transform hover:scale-105 transition-all ease-in-out duration-200">More Articles</a>
    </div>
</footer>