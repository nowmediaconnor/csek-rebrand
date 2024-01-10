<?php
/*
 * Created on Sun Dec 24 2023
 * Author: Connor Doman
 */

$meta = PageMetadataSingleton::getInstance()->getMetadata();
?>

<div class="w-11/12 max-w-csek-2/3 mx-auto flex flex-col gap-6">
    <strong class="font-medium font-montserrat uppercase text-sm">Share Article</strong>
    <ul class="flex flex-row gap-2">
        <li>
            <a href="<?php $meta->get_facebook_link(); ?>" class="inline-flex text-xl w-10 h-10 items-center justify-center rounded-full bg-csek-dark text-white" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
        </li>
        <li>
            <a href="<?php $meta->get_twitter_link(); ?>" class="inline-flex text-xl w-10 h-10 items-center justify-center rounded-full bg-csek-dark text-white" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
        </li>
        <li>
            <a href="<?php $meta->get_linkedin_link(); ?>" class="inline-flex text-xl w-10 h-10 items-center justify-center rounded-full bg-csek-dark text-white" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-linkedin"></i>
            </a>
        </li>
        <li>
            <a href="<?php $meta->get_reddit_link(); ?>" class="inline-flex text-xl w-10 h-10 items-center justify-center rounded-full bg-csek-dark text-white" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-reddit-alien"></i>
            </a>
        </li>
        <li>
            <a href="<?php $meta->get_email_link(); ?>" class="inline-flex text-xl w-10 h-10 items-center justify-center rounded-full bg-csek-dark text-white" target="_blank" rel="noopener noreferrer">
                <i class="fa-solid fa-envelope"></i>
            </a>
        </li>
    </ul>
</div>