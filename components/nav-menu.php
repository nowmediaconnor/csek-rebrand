<?php

/**
 * Created on Sat Nov 25 2023
 * Author: Connor Doman
 */

/** @var PageMetadata $meta */
$meta = $args['meta'];
?>
<nav class="csek-nav-menu hidden-nav">
    <?php get_template_part('components/header-elements', null, ['meta' => $meta, 'needs_contrast' => true, 'close_button' => true]); ?>
    <div class="nav-container">
        <?php wp_nav_menu(['theme_location' => 'csek-menu', 'container_class' => 'csek-wp-nav',]); ?>
        <div class="flex flex-col gap-8 md:gap-12">
            <?php get_template_part('components/addresses'); ?>
            <?php get_template_part('components/social-media'); ?>
        </div>
    </div>
</nav>