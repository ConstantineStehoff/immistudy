<?php
/*
* Template Name: Immigration Info page
*/

$arrayOfStrings = explode('/', CURRENT_URI);
$country = $arrayOfStrings[3];
$category_class = $country . "_" . $arrayOfStrings[4];
require_once(ROOT_DIR . '/html_templates.php');
$html_template = new HtmlTemplate();


if ($country == "canada"){
	$header = array("Программы Для Иммиграции В Канаду", "выбрать программму иммиграции");
} elseif ($country == "australia"){
	$header = array("Программы Для Иммиграции В Австралию", "выбрать программму иммиграции");
} elseif ($country == "newzealand") {
	$header = array("Программы Для Иммиграции В Новою Зеландию", "выбрать программму иммиграции");
} elseif ($country == "usa") {
	$header = array("Программы Для Иммиграции В Америку", "выбрать программму иммиграции");
} elseif ($country == "france") {
	$header = array("Программы Для Иммиграции Во Францию", "выбрать программму иммиграции");
}
get_header();
?>


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
									$html_template->infoLinksList($canada_info_cats, $canada_info_urls, $canada_info_ids); 
								} elseif($country == 'australia'){
									$html_template->infoLinksList($aus_info_cats, $aus_info_urls, $aus_info_ids);
								} elseif($country == 'newzealand'){
									$html_template->infoLinksList($nz_info_cats, $nz_info_urls, $nz_info_ids);
								} elseif($country == 'usa'){
									$html_template->infoLinksList($usa_info_cats, $usa_info_urls, $usa_info_ids);
								} elseif($country == 'france'){
									$html_template->infoLinksList($france_info_cats, $france_info_urls, $france_info_ids);
								}				
								?>		
							
								<div class="unit">
									<div class="mod"> 
										<b class="top"><b class="tl"></b><b class="tr"></b></b> 
											<div class="inner">
												<div class="hd">
													<a class="green" href="<?php echo site_url(); ?>/immigration_programs/">Вернуться в раздел об иммиграции</a>
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
						<?php
							if ( function_exists( 'icit_spot' ) )
							    icit_spot( $category_class );
							?>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	
	</div>
<!-- End categories content -->
	
<?php get_footer();?>