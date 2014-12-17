<?php
/*
* Template Name: Education Info page
*/

$arrayOfStrings = explode('/', CURRENT_URI);
$country = $arrayOfStrings[3];
$school_type = $arrayOfStrings[4];
$school_category = $country . "_" . $school_type;
$school_country_text = $arrayOfStrings[2] . "_" . $country;
require_once(ROOT_DIR . '/html_templates.php');
$html_template = new HtmlTemplate();


if ($country == "canada"){
	$header = array("Программы Для Обучения В Канаде", "выбрать учебное заведение");
} elseif ($country == "australia"){
	$header = array("Программы Для Обучения В Австралии", "выбрать учебное заведение");
} elseif ($country == "newzealand") {
	$header = array("Программы Для Обучения В Новой Зеландии", "выбрать учебное заведение");
} elseif ($country == "usa") {
	$header = array("Программы Для Обучения В Америке", "выбрать учебное заведение");
} elseif ($country == "france") {
	$header = array("Программы Для Обучения Во Франции", "выбрать учебное заведение");
}
get_header();
?>

<div id="content" role="main">
	<div class="grid">
		<div class="unit">
			<div id="contact-form" class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2><?php echo $header[0]; ?></h2>
							<h3 class="green"><?php echo $header[1]; ?></h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>
	
	<!--Categories content-->
	<div class="grid">
		<div class="unit blockOneThirds">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="grid">
							<div id="immigration-categories">
								<?php 
								if($country == 'canada'){	
									$html_template->infoLinksList($canada_school_cats, $canada_school_urls, $canada_school_ids); 
								} elseif($country == 'australia'){
									$html_template->infoLinksList($aus_school_cats, $aus_school_urls, $aus_school_ids);
								} elseif($country == 'newzealand'){
									$html_template->infoLinksList($nz_school_cats, $nz_school_urls, $nz_school_ids);
								} elseif($country == 'usa'){
									$html_template->infoLinksList($usa_school_cats, $usa_school_urls, $usa_school_ids);
								} elseif($country == 'france'){
									$html_template->infoLinksList($france_school_cats, $france_school_urls, $france_school_ids);
								}			
								?>		
								<div class="unit">
									<div class="mod"> 
										<b class="top"><b class="tl"></b><b class="tr"></b></b> 
											<div class="inner">
												<div class="hd">
													<a class="blue" href="<?php echo site_url(); ?>/school_programs/">Вернуться в раздел об учебе</a>
												</div>
											</div>
										<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
									</div>
								</div>
							
							</div>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	
		<div class="unit blockTwoThirds">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div id="tabs" class="inner">
						<div class="grid">
							<div class="unit blockOneHalf">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<p class="center"><strong> 
											<?php 
												if($school_type == "universities"){
													echo "Университеты";
												} elseif ($school_type == "colleges") {
													echo "Колледжи";
												} elseif ($school_type == "language_schools") {
													echo "Языковые Школы";
												} elseif ($school_type == "schools") {
													echo "Школы";
												}			
											?>
											</strong></p>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							
							<div class="unit blockOneHalf">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<p class="center school_place"><strong>Место</strong></p>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
						<?php 
						if($school_category == "canada_universities"){
							$html_template->schoolLinksList($json_b['canada']['universities']['texts'], $json_b['canada']['universities']['places'], $json_b['canada']['universities']['urls'], $json_b['canada']['universities']['img_urls'], $json_b['canada']['universities']['img_alts']); 
						} elseif($school_category == "canada_colleges"){
							$html_template->schoolLinksList($json_b['canada']['colleges']['texts'], $json_b['canada']['colleges']['places'], $json_b['canada']['colleges']['urls'], $json_b['canada']['colleges']['img_urls'], $json_b['canada']['colleges']['img_alts']); 
						} elseif($school_category == "canada_language_schools"){
							$html_template->schoolLinksList($json_b['canada']['language_schools']['texts'], $json_b['canada']['language_schools']['places'], $json_b['canada']['language_schools']['urls'], $json_b['canada']['language_schools']['img_urls'], $json_b['canada']['language_schools']['img_alts']);
						} elseif($school_category == "newzealand_universities"){
							$html_template->schoolLinksList($json_b['nz']['universities']['texts'], $json_b['nz']['universities']['places'], $json_b['nz']['universities']['urls'], $json_b['nz']['universities']['img_urls'], $json_b['nz']['universities']['img_alts']);
						} elseif($school_category == "newzealand_colleges"){
							$html_template->schoolLinksList($json_b['nz']['colleges']['texts'], $json_b['nz']['colleges']['places'], $json_b['nz']['colleges']['urls'], $json_b['nz']['colleges']['img_urls'], $json_b['nz']['colleges']['img_alts']);
						} elseif($school_category == "newzealand_schools"){ 
							$html_template->schoolLinksList($json_b['nz']['schools']['texts'], $json_b['nz']['schools']['places'], $json_b['nz']['schools']['urls'], $json_b['nz']['schools']['img_urls'], $json_b['nz']['schools']['img_alts']);
						} elseif($school_category == "australia_universities"){
							$html_template->schoolLinksList($json_b['aus']['universities']['texts'], $json_b['aus']['universities']['places'], $json_b['aus']['universities']['urls'], $json_b['aus']['universities']['img_urls'], $json_b['aus']['universities']['img_alts']);
						} elseif($school_category == "australia_colleges"){
							$html_template->schoolLinksList($json_b['aus']['colleges']['texts'], $json_b['aus']['colleges']['places'], $json_b['aus']['colleges']['urls'], $json_b['aus']['colleges']['img_urls'], $json_b['aus']['colleges']['img_alts']);
						} elseif($school_category == "usa_universities"){
							$html_template->schoolLinksList($json_b['usa']['universities']['texts'], $json_b['usa']['universities']['places'], $json_b['usa']['universities']['urls'], $json_b['usa']['universities']['img_urls'], $json_b['usa']['universities']['img_alts']);
						} elseif($school_category == "usa_colleges"){
							$html_template->schoolLinksList($json_b['usa']['colleges']['texts'], $json_b['usa']['colleges']['places'], $json_b['usa']['colleges']['urls'], $json_b['usa']['colleges']['img_urls'], $json_b['usa']['colleges']['img_alts']);
						} elseif($school_category == "france_universities"){
							$html_template->schoolLinksList($json_b['france']['universities']['texts'], $json_b['france']['universities']['places'], $json_b['france']['universities']['urls'], $json_b['france']['universities']['img_urls'], $json_b['france']['universities']['img_alts']);
						}	
							?>
						<div class="grid">
							<div class="unit">
								<h3 class="margin_bottom margin_top"><strong>Общая Информация</strong></h3>
							</div>
						</div>
						
						<?php
							if ( function_exists( 'icit_spot' ) )
							    icit_spot( $school_country_text );
							?>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	
	</div>
<!-- End categories content -->

<?php get_footer();?>