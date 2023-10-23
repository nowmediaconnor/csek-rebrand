<?php

/**
 * Created on Mon Oct 23 2023
 * Author: Connor Doman
 */

class PageMetadata
{
    public $is_home = "";
    public $leading_title = "";
    public $has_subtitle = "";
    public $subtitle = "";
    public $has_thumbnail = "";
    public $thumbnail_url = "";

    public function __construct()
    {
        $this->is_home = is_front_page();

        $titleParts = explode("|", the_title("", "", false));
        $this->leading_title = trim($titleParts[0]);
        $this->has_subtitle = count($titleParts) > 1;

        if ($this->has_subtitle) {
            $this->subtitle = trim($titleParts[1]);
        }

        $this->has_thumbnail = has_post_thumbnail();

        if ($this->has_thumbnail) {
            $this->thumbnail_url = get_the_post_thumbnail_url();
        }
    }
}
