<?php

/**
 * Created on Sat Nov 25 2023
 * Author: Connor Doman
 */

/** @var PageMetadata $meta */
// $meta = $args['meta'];
$meta = PageMetadataSingleton::getInstance()->getMetadata();

$needs_contrast = $args['needs_contrast'] ?? false;
$close_button = $args['close_button'] ?? false;

$contrast = $needs_contrast || $meta->needs_contrast();
$logo = $meta->logo_url($contrast || null);

?>

<div class="csek-header-elements flex flex-row justify-between items-center md:px-8 mx-auto relative w-full min-h-header h-header basis-header">
    <div class="mx-3 md:mx-8 flex flex-col justify-center items-center font-syne self-center translate-y-[0.1rem]">
        <a href="<?php echo $meta->site_url; ?>" class="w-28 inline-flex flex-col justify-center items-center h-11 <?php echo $contrast ? "text-csek-white" : "text-csek-dark"; ?>">
            <img src="<?php echo $logo ?>" class="h-8" />
            <span class="tracking-[0.4rem] text-xs relative left-[0.2rem] leading-none">CREATIVE</span>
        </a>
    </div>
    <nav class="mx-3 md:mx-8">
        <ul class="flex flex-row gap-4 md:gap-8 items-center">
            <li>
                <a href="#contact" class="lets-talk-open py-2 px-8 rounded-full bg-csek-blue h-11 font-semibold font-montserrat inline-flex items-center text-sm whitespace-nowrap">
                    LET'S TALK
                </a>
            </li>
            <li>
                <?php if ($close_button) : ?>
                    <a href="#close" data-nav-close class="rounded-full h-11 w-11 border flex flex-row items-center justify-center text-xl <?php echo $contrast ? "border-csek-white text-csek-white" : "border-csek-dark text-csek-dark"; ?>">
                        <i class="fa-solid fa-times"></i>
                    </a>
                <?php else : ?>
                    <a href="#open" data-nav-open class="rounded-full h-11 w-11 border flex flex-row items-center justify-center text-xl <?php echo $contrast ? "border-csek-white text-csek-white" : "border-csek-dark text-csek-dark"; ?>">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</div>