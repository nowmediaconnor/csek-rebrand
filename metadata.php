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

    public function __construct($name = "", $street = "", $line2 = "", $city = "", $state = "", $zip = "", $country = "", $phone = "")
    {
        $this->name = $name;
        $this->street = $street;
        $this->line2 = $line2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        $this->phone = $phone;
    }

    public function to_html()
    {
        $html = "";
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
        if ($this->phone) {
            $html .= "<div class='phone'>" . $this->phone . "</div>";
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
        );

        self::$kamloops_address = new ContactInfo(
            "Kamloops Office",
            "348 Tranquille Rd",
            null,
            "Kamloops",
            "BC",
            "V2B 3G6",
            null,
            "(250) 862-8010"
        );

        self::$vovia_address = new ContactInfo(
            "Vovia",
            "1500 8th St SW",
            "Suite 400",
            "Calgary",
            "AB",
            "T2R 1K1",
            null,
            "(403) 265-2036",
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
    }

    public function needs_contrast()
    {
        return !$this->is_home && $this->has_thumbnail;
    }

    public function logo_url($needs_contrast = null)
    {
        if ($needs_contrast === true || $this->needs_contrast()) {
            return $this->site_logo_light_url;
        } else {
            return $this->site_logo_url;
        }
    }
}
