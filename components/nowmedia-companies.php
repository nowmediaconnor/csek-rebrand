<?php

/**
 * Created on Wed Dec 06 2023
 * Author: Connor Doman
 */

$links = ["https://nowcities.ca", "https://www.16flightspublishing.com/", "https://events.nowmediagroup.ca/", "https://ivaproductions.com/"];
$images = ["nowcities.svg", "16flights.svg", "levelup.svg", "iva.png"];
$alts = ["NowCities monochrome logo", "16 Flights monochrome logo", "Level Up monochrome logo", "IVA monochrome logo"];

$image_data = array_map(function ($image, $alt) {
    return [
        "src" => get_template_directory_uri() . "/img/nowmedia/" . $image,
        "alt" => $alt
    ];
}, $images, $alts);

$list_items = generate_list_items(wrap_in_links(generate_img_items($image_data, $classes = ['h-8 max-w-auto']), $links, true));

?>
<ul class="flex flex-row gap-8 items-center justify-between">
    <?php echo $list_items; ?>
</ul>