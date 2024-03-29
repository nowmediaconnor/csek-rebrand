<?php

use function PHPSTORM_META\map;

/**
 * Created on Mon Oct 23 2023
 * Author: Connor Doman
 */

class ContactInfo
{
    public $name = "";
    public $street = "";
    public $line2 = "";
    public $city = "";
    public $state = "";
    public $zip = "";
    public $country = "";
    public $phone = "";
    public $email = "";
    public $address_link = "";

    public function __construct($name = "", $street = "", $line2 = "", $city = "", $state = "", $zip = "", $country = "", $phone = "", $email = "", $address_link = "")
    {
        $this->name = $name;
        $this->street = $street;
        $this->line2 = $line2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        $this->phone = $phone;
        $this->email = $email;
        $this->address_link = $address_link;
    }

    public function to_html()
    {
        $html = "";
        if ($this->address_link) {
            $html .= "<a href='" . $this->address_link . "' target='_blank' rel='noopener noreferrer'>";
        }
        if ($this->name) {
            $html .= "<div class='name'>" . $this->name . "</div>";
        }
        if ($this->street) {
            $html .= "<div class='street'>" . $this->street . "</div>";
        }
        if ($this->line2) {
            $html .= "<div class='street'>" . $this->line2 . "</div>";
        }
        if ($this->city || $this->state || $this->zip) {
            $html .= "<div class='city-state-zip'>";
            if ($this->city) {
                $html .= "<span class='city'>" . $this->city . ($this->state ? ", " . $this->state : "") . "</span>";
            } elseif ($this->state) {
                $html .= "<span class='state'>" . $this->state . "</span>";
            }
            if ($this->zip) {
                $this->zip = preg_replace('/\s+/', '&nbsp;', $this->zip);
                $html .= " <span class='zip'>" . $this->zip . "</span>";
            }
            $html .= "</div>";
        }
        if ($this->country) {
            $html .= "<div class='country'>" . $this->country . "</div>";
        }
        if ($this->address_link) {
            $html .= "</a>";
        }
        if ($this->phone) {
            $html .= "<div class='phone'><a href='tel:" . $this->phone . "' target='_blank' rel='noopener noreferrer'>" . $this->phone . "</a></div>";
        }
        if ($this->email) {
            $html .= "<div class='email'><a href='mailto:" . $this->email . "' target='_blank' rel='noopener noreferrer'>" . $this->email . "</a></div>";
        }
        return "<div class='contact-info'>" . $html . "</div>";
    }
}

class SiteMetadata
{
    public static ContactInfo $csek_creative_address;
    public static ContactInfo $kamloops_address;
    public static ContactInfo $vovia_address;
    private static bool $initialized = false;

    public static function init()
    {
        if (self::$initialized) {
            return;
        }

        self::$csek_creative_address = new ContactInfo(
            "Head Office",
            "1631 Dickson Ave",
            "Suite 1600",
            "Kelowna",
            "BC",
            "V1Y 0B5",
            null,
            "(250) 862-8010",
            "info@csekcreative.com",
            "https://www.google.com/maps/place/Csek+Creative/@49.8802815,-119.4638442,17z/data=!3m2!4b1!5s0x5483e662b778f379:0x726b25aeb107c776!4m6!3m5!1s0x537df4a7c486ddcd:0x93c21387e1a90e29!8m2!3d49.8802815!4d-119.4612693!16s%2Fg%2F1thtp87h?entry=ttu"
        );

        self::$kamloops_address = new ContactInfo(
            "Kamloops Office",
            "348 Tranquille Rd",
            null, // line 2
            "Kamloops",
            "BC",
            "V2B 3G6",
            null, // country
            "(250) 862-8010",
            null, // email
            "https://www.google.com/maps/place/348+Tranquille+Rd,+Kamloops,+BC+V2B+3G6/@50.688704,-120.3600728,17z/data=!3m1!4b1!4m6!3m5!1s0x537e2ce3c305eab3:0x1d643653e92c82a!8m2!3d50.688704!4d-120.3574979!16s%2Fg%2F11bw3zlst8?hl=en&entry=ttu"
        );

        self::$vovia_address = new ContactInfo(
            "Vovia",
            "1500 8th St SW",
            "Suite 400",
            "Calgary",
            "AB",
            "T2R 1K1",
            null, // country
            "(403) 265-2036",
            null, // email
            "https://www.google.com/maps/place/Vovia/@51.0385755,-114.0841689,17z/data=!3m1!4b1!4m6!3m5!1s0x53716fdaf1714a99:0x81acd6667c0c82b1!8m2!3d51.0385755!4d-114.081594!16s%2Fg%2F1td0sk77?entry=ttu"
        );

        self::$initialized = true;
    }

    public static function address_html()
    {
        return self::$csek_creative_address->to_html() . self::$kamloops_address->to_html() . self::$vovia_address->to_html();
    }
}

class PageMetadata
{
    public $site_url = "";
    public $is_home = "";
    public $leading_title = "";
    public $has_subtitle = "";
    public $subtitle = "";
    public $has_thumbnail = "";
    public $thumbnail_url = "";
    public $site_logo_url = "";
    public $site_logo_light_url = "";

    public $main_category = "";
    public $tags = [];

    public $read_time = "";

    public function __construct($theme_url = "")
    {
        $this->site_url = get_site_url();
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

        $this->site_logo_url = $theme_url . "/img/csek.svg";
        $this->site_logo_light_url = $theme_url . "/img/csek-light.svg";

        $categories = get_the_category();
        if (!empty($categories)) {
            $this->main_category = $categories[0]->slug;
        } else {
            $this->main_category = "none";
        }

        $tags = get_the_tags();
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $this->tags[$tag->term_id] = ["slug" => $tag->slug, "name" => $tag->name, "url" => get_tag_link($tag->term_id)];
            }
        } else {
            $this->tags = [];
        }

        $this->read_time = $this->calculate_read_time();
    }

    private function calculate_read_time()
    {
        $word_count = str_word_count(strip_tags(get_the_content()));
        $minutes = floor($word_count / 225);
        $seconds = floor($word_count % 225 / (225 / 60));
        if ($minutes > 0) {
            return $minutes . " minute read";
        } else {
            return $seconds . " second read";
        }
    }

    public function needs_contrast()
    {
        return !$this->is_home && $this->has_thumbnail && !$this->is_blog_post();
    }

    public function logo_url($needs_contrast = null)
    {
        if ($needs_contrast === true || $this->needs_contrast()) {
            return $this->site_logo_light_url;
        } else {
            return $this->site_logo_url;
        }
    }

    public function is_blog_post()
    {
        return strtoupper($this->main_category) === "BLOG";
    }

    public function is_projects_post()
    {
        return strtoupper($this->main_category) === "PROJECTS";
    }

    public function post_title()
    {
        echo $this->leading_title;
    }

    public function post_subtitle()
    {
        echo $this->subtitle;
    }

    public function get_facebook_link()
    {
        echo "https://www.facebook.com/sharer/sharer.php?u=" . urlencode(get_permalink());
    }

    public function get_twitter_link()
    {
        echo "https://twitter.com/intent/tweet?url=" . urlencode(get_permalink()) . "&text=" . urlencode(get_the_title());
    }

    public function get_linkedin_link()
    {
        echo "https://www.linkedin.com/sharing/share-offsite/?url=" . urlencode(get_permalink());
    }

    public function get_email_link()
    {
        echo "mailto:?subject=" . urlencode(get_the_title()) . "&body=" . urlencode(get_permalink());
    }

    public function get_reddit_link()
    {
        echo "https://reddit.com/submit?url=" . urlencode(get_permalink()) . "&title=" . urlencode(get_the_title());
    }
}
