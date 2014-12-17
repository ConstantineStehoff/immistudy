<?php 
$json_a = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . 
	'/wp-content/themes/immistudy1.2/scripts/allLiksData.json'), true);
//Arrays with the json allLinksData
$site_url = site_url();

foreach($json_a['canada']['links'] as $link){
	$class = $link['className'];
	$url = $link['url'];
	$text = $link['text'];
	if($class == 'immigration_item'){ 
		$canada_info_cats[] = $text;
		$canada_info_ids[] = $link['category_id'];
		$canada_info_urls[] = $site_url . $url;
	}
	if($class == 'school_item'){
		$canada_school_cats[] = $text;
		$canada_school_ids[] = $link['category_id'];
		$canada_school_urls[] = $site_url . $url;
	}
	$canada_classes[] = $class;
	$canada_urls[] = $site_url . $url;
	$canada_texts[] = $text;
}
foreach($json_a['aus']['links'] as $link){
	$class = $link['className'];
	$url = $link['url'];
	$text = $link['text'];
	if($class == 'immigration_item'){ 
		$aus_info_cats[] = $text;
		$aus_info_ids[] = $link['category_id'];
		$aus_info_urls[] = $site_url . $url;
	}
	if($class == 'school_item'){
		$aus_school_cats[] = $text;
		$aus_school_ids[] = $link['category_id'];
		$aus_school_urls[] = $site_url . $url;
	}
	$aus_classes[] = $class;
	$aus_urls[] = $site_url . $url;
	$aus_texts[] = $text;
}
foreach($json_a['nz']['links'] as $link){
	$class = $link['className'];
	$url = $link['url'];
	$text = $link['text'];
	if($class == 'immigration_item'){ 
		$nz_info_cats[] = $text;
		$nz_info_ids[] = $link['category_id'];
		$nz_info_urls[] = $site_url . $url;
	}
	if($class == 'school_item'){
		$nz_school_cats[] = $text;
		$nz_school_ids[] = $link['category_id'];
		$nz_school_urls[] = $site_url . $url;
	}
	$nz_classes[] = $class;
	$nz_urls[] = $site_url . $url;
	$nz_texts[] = $text;
}
foreach($json_a['usa']['links'] as $link){
	$class = $link['className'];
	$url = $link['url'];
	$text = $link['text'];
	if($class == 'immigration_item'){ 
		$usa_info_cats[] = $text;
		$usa_info_ids[] = $link['category_id'];
		$usa_info_urls[] = $site_url . $url;
	}
	if($class == 'school_item'){
		$usa_school_cats[] = $text;
		$usa_school_ids[] = $link['category_id'];
		$usa_school_urls[] = $site_url . $url;
	}
	$usa_classes[] = $class;
	$usa_urls[] = $site_url . $url;
	$usa_texts[] = $text;
}
foreach($json_a['france']['links'] as $link){
	$class = $link['className'];
	$url = $link['url'];
	$text = $link['text'];
	if($class == 'immigration_item'){ 
		$france_info_cats[] = $text;
		$france_info_ids[] = $link['category_id'];
		$france_info_urls[] = $site_url . $url;
	}
	if($class == 'school_item'){
		$france_school_cats[] = $text;
		$france_school_ids[] = $link['category_id'];
		$france_school_urls[] = $site_url . $url;
	}
	$france_classes[] = $class;
	$france_urls[] = $site_url . $url;
	$france_texts[] = $text;
}
foreach($json_a['emirates']['links'] as $link){
	$class = $link['className'];
	$text = $link['text'];
	$url = $link['url'];
	if($class == 'immigration_item'){ 
		$emirates_info_cats[] = $text;
		$emirates_info_ids[] = $link['category_id'];
		$emirates_info_urls[] = $site_url . $link['url'];
	}
	$emirates_classes[] = $class;
	$emirates_urls[] = $site_url . $url;
	$emirates_texts[] = $text;
}

$json_b = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . 
	'/wp-content/themes/immistudy1.2/scripts/schoolLinksData.json'), true);

class HtmlTemplate {
	
	public function linksList($classes, $urls, $texts){
		$c = count($classes);
		$out = "";
		if(isset($classes, $urls, $texts) && count($texts) > 0){
			echo "<ul>\n";
			for ($i = 0; $i < count($texts); $i++) {
				echo "\t<li class=\"inline alignleft\"><a class=" . $classes[$i] . " href=\"" . $urls[$i] . "\">" . $texts[$i] . "</a></li>";
			}
			echo "</ul>\n";
		}
	}

	public function infoLinksList($categories, $urls, $category_ids){
		if (isset($categories, $urls, $category_ids) && count($categories) > 0){
			echo "<ul style=\"border-top: 2px solid #ECECEC\">";
			for ($i = 0; $i < count($categories); $i++) {
				echo "\t<li><a class=\"category-link\" href=\"" . $urls[$i] . "\" id=" . $category_ids[$i] . ">" . $categories[$i] . "</a></li>";
			}
			echo "</ul>\n";
		}
	}

	public function schoolLinksList($texts, $places, $urls, $img_urls, $img_alts){
		if (isset($img_urls, $img_alts, $urls, $texts, $places) && count($texts) > 0){
			echo "<ul>";
			for ($i = 0; $i < count($texts); $i++) {
				echo "\t<li>";
				echo "<div class=\"grid\">";
				//echo "<div class=\"unit blockOneThirds\">";
				//echo "<img src=\"" . $img_urls[$i] . " alt=\"" . $img_alts[$i] . "\"\">"; 
				//echo "</div>";
				echo "<div class=\"unit blockOneHalf\">";
				echo "<p><a class=\"blue center\" href=\"" . site_url() . $urls[$i] . "\">" . $texts[$i] . "</a></p>	"; 
				echo "</div>";
				echo "<div class=\"unit blockOneHalf\">";
				echo "<p class=\"center\">" . $places[$i] . "</p>";
				echo "</div>";
				echo "</div>";
				echo "</li>";
			}
			echo "</ul>\n";
		}
	}
}