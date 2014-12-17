<!DOCTYPE HTML>
<html>

<?php
require_once(IMMISTUDY_DIR . '/classes/geo.php');
$geoObj = new Geo();
$ip = $geoObj->get_ip();
// Посылаем запрос на сервис 
$url = "http://ipgeobase.ru:7020/geo?ip=".$ip;  

$xmlstr = file_get_contents($url);              // xml utf-8 (страна, город, регион, округ)
if($xmlstr){
	$xml = new SimpleXMLElement($xmlstr);           // Объект SimpleXML
	// Получаем из XML объекта
	$district = $xml->ip[0]->district;
	$region = $xml->ip[0]->region;                  // Регион
	if ($district == "Дальневосточный федеральный округ"){
		$display_city = "Хабаровск";
		$phone = "8 4212 31 24 57";
	} elseif ($region == "Ленинградская область"){
		$display_city = "Санкт-Петербург";
		$phone = "8 812 424 78 57";
	} else {
		$display_city = "Москва";
		$phone = "8 498 619 57 98";
	}
} else {
	$display_city = "Москва";
	$phone = "8 498 619 57 98";
}
?>

<head>
	<title>
	    <?php docothemes_titles(); ?>
	</title>
	
	<link rel="icon" 
	      type="image/ico" 
	      href= "<?php echo IMAGES; ?>/logo.ico">
	
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta name="viewport" content="width=device-width">
	
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
	
	<?php custom_color_page();?>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--Main Content goes here-->
	<div class="content" role="main">
	
	<!--Header-->
	<header role="banner">
		<div class="grid">
			<div id="hgroup" class="alignleft">
				<a href="<?php echo get_option('home'); ?>"><h1><strong>immistudy.ru</strong></h1><small>Иммиграция и Обучение</small></a>
			</div>
			<div>		
				<div class="header-login margin_left margin_right">
					<p><a class="black" href="<?php echo SITE_URL;?>/login">Войти</a></p>
					<p><a class="yellow" href="<?php echo SITE_URL;?>/register">Регистрация</a></p>
				</div>
				<div class="header-contacts margin_left">
					<p><a class="blue none" href="mailto:immistudy@mail.ru"><span class="mail margin_right_half"></span><strong>immistudy@mail.ru</strong></a></p>
					<!--<p style="padding-top: 0.9rem; padding-top: 9px;"><a href="http://zingaya.com/widget/66e58b85c420490e8d5e8ab29b1e05ab" onclick="window.open(this.href+'?referrer='+escape(window.location.href)+'', '_blank', 'width=236,height=220,resizable=no,toolbar=no,menubar=no,location=no,status=no'); return false" class="zingaya_button1368685668696 none"><span class="phone-white margin_left_half"></span><span class="margin_left_half margin_right_half" style="padding: 0; margin: 0;">Бесплатный звонок с сайта</a></span></p>-->
					<p class="header-phones"><span class="phone"></span><strong class="margin_left_half blue">8 4212 31 24 57<!--<?php echo $phone; ?>--></strong></p>
				</div>
				
				<div class="header-contacts">
					<p class="blue margin_right header-skype"><span class="skype"></span><strong class="margin_left_half">immistudy</strong></p>
					<p class="header-cities alignright"><a href="#" class="blue"><span class="city"></span><span class="margin_left_half blue">Хабаровск<!--<?php echo $display_city; ?>--></span></a></p>
				</div>
				<div class="header-contacts-skype">
					
				</div>
			</div>	
		</div>
		
		<nav class="menu-header default" style="margin: auto;">			
			<?php wp_nav_menu(array(
				'sort_column' => 'menu_order',
				'theme_location' => 'main_menu',
				'container' => 'div',
				'container_class' => 'menu-nav-container'
			));?>
		</nav>
	</header>	
	<!-- End Header -->
			