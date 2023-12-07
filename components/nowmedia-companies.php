<?php

/**
 * Created on Wed Dec 06 2023
 * Author: Connor Doman
 */

$links = ["https://nowcities.ca", "https://www.16flightspublishing.com/", "https://events.nowmediagroup.ca/", "https://ivaproductions.com/"];
$images = ["nowcities.svg", "16flights.svg", "levelup.svg", "iva.svg"];
$alts = ["NowCities monochrome logo", "16 Flights monochrome logo", "Level Up monochrome logo", "IVA monochrome logo"];

$image_data = array_map(function ($image, $alt) {
    return [
        "src" => get_template_directory_uri() . "/img/nowmedia/" . $image,
        "alt" => $alt
    ];
}, $images, $alts);

$list_items = generate_list_items(wrap_in_links(generate_img_items($image_data), $links, true));

?>
<ul class="flex flex-row gap-8 items-center justify-between">
    <!-- <li>
        <img src="/wp-content/themes/csek-rebrand/img/nowmedia/nowcities.svg" alt="NowCities monochrome logo" class="" />
    </li>
    <li>
        <img src="/wp-content/themes/csek-rebrand/img/nowmedia/16flights.svg" alt="NowCities monochrome logo" class="" />
    </li>
    <li>
        <img src="/wp-content/themes/csek-rebrand/img/nowmedia/levelup.svg" alt="NowCities monochrome logo" class="" />
    </li>
    <li>
        <img src="/wp-content/themes/csek-rebrand/img/nowmedia/iva.svg" alt="NowCities monochrome logo" class="" />
    </li> -->
    <?php echo $list_items; ?>
</ul>