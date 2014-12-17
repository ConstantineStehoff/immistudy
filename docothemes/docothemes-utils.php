<?php
define('ROOT_DIR', get_stylesheet_directory());
define('ROOT_URL', get_template_directory_uri());
define('CURRENT_URI', $_SERVER['REQUEST_URI']);
define('SITE_URL', site_url());
define('IMMISTUDY_DIR', ROOT_DIR . '/docothemes/immistudy');
define('IMAGES', ROOT_URL . "/images");

	//This function creates titles for the theme
	function docothemes_titles(){
		if (function_exists('is_tag') && is_tag()) {
		      single_tag_title('Все с тегом &quot;'); echo '&quot; - ';
		} elseif (is_archive()) {
		      echo ' Тема '; wp_title(''); echo ' - ';
		} elseif (is_search()) {
		      echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
		} elseif (!(is_404()) && (is_single()) || (is_page())) {
		      wp_title(''); 
		} elseif (is_404()) {
		      echo 'Страница не найдена - ';
		}
		if (is_home()) {
		      bloginfo('name'); 
		} 		
	}
	
	//changes the length of an excerpt for the post (default 20 characters)
	function docothemes_excerpt($len=20, $trim="&hellip;"){
		$limit = $len+1;
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		$num_words = count($excerpt);
		if ($num_words >= $len){
			$last_item = array_pop($excerpt);
		} else {
			$trim = "";
		}
		$excerpt = implode(" ", $excerpt) . "$trim";
		echo $excerpt;
	}
	
	// Function to get the client ip address
	function get_client_ip() {
	    if(isset($_SERVER["REMOTE_ADDR"]) ) {
	    	$ip = $_SERVER["REMOTE_ADDR"];
	    } elseif(isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ) {
	        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	    } elseif(isset($_SERVER["HTTP_CLIENT_IP"]) ) {
	        $ip = $_SERVER["HTTP_CLIENT_IP"];
	    } else {
	    	$ip = "10.0.0.1";
	    }
	    return $ip;
	}