<?php
/*
 * Created on Sun Dec 24 2023
 * Author: Connor Doman
 */

$meta = PageMetadataSingleton::getInstance()->getMetadata();

?>
<header class="entry-header mx-auto text-center pt-12 pb-8 w-11/12 max-w-csek-max">
    <h2 class="text-csek-red uppercase text-lg font-syne font-bold"><?php $meta->post_subtitle(); ?></h2>
    <h1 class="text-3xl md:text-6xl font-syne font-bold py-4"><?php $meta->post_title(); ?></h1>
    <ul class="flex flex-row justify-center gap-2 w-11/12 max-w-csek-2/3 mx-auto flex-wrap">
        <?php foreach ($meta->tags as $tag) : ?>
            <li><a href="<?php echo $tag["url"]; ?>" class="chip"><?php echo $tag["name"]; ?></a></li>
        <?php endforeach; ?>
    </ul>
</header>