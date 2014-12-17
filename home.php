<?php
/*
* Template Name: Home
*/
ob_start();
?>
<?php get_header(); 
require_once(ROOT_DIR . '/html_templates.php');
$html_template = new HtmlTemplate();
?>
<!--[if IE ]>
	<style>
        .banner{width: 100% !important;}
        </style>
<![endif]-->
			<div class="grid">
				<div class="unit">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<div class="hd">
									<?php
									if ( function_exists( 'icit_spot' ) )
									    icit_spot( 'Main page Anchor text' );
									?>
								</div>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
		    </div>
		  
		    <div class="grid">
		    	<div class="unit margin_left margin_right margin_top margin_bottom">
		    		<!--<ul class="rslides">-->
			    		<li style="list-style-type: none;"><a href="<?php echo SITE_URL; ?>/info/work_programs/usa"><img class="banner" src="<?php echo IMAGES; ?>/ships_banner.jpg"/></a></li>
			    		<!-- <li><a href="<?php echo SITE_URL; ?>/info/about_credit"><img class="banner" src="<?php echo IMAGES; ?>/credit_banner.png"/></a></li> -->
		    		<!--</ul>-->
		    	</div>
		    </div>    		
			
			<div class="grid">
				<div class="unit">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<div class="hd">
									<h2>Основные Категории Услуг</h2>
									<h3 class="colortext">Выберите то что вас больше интересует</h3>
								</div>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
			</div>
				
				
			<div class="grid">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner cat_container">
							<section>
									<ul class="row main_categories">
										<li class="unit mainCategories">
											<a class="school_main_link" href="<?php echo SITE_URL; ?>/info/school_programs">
												<div class="img_container" style="background-image: url(http://immistudy.ru/wp-content/themes/immistudy1.2/images/education.jpg); border-style:none;"></div>
												<div class="main_cat_text_container"><h2>Обучение</h2></div>
											</a>
										</li>
										<li class="unit mainCategories">
											<a class="immigration_main_link" href="<?php echo SITE_URL;; ?>/info/immigration_programs">
												<div class="img_container" style="background-image: url(http://immistudy.ru/wp-content/themes/immistudy1.2/images/immigration.jpg); border-style:none;"></div>
												<div class="main_cat_text_container"><h2>Иммиграция</h2></div>
											</a>	
										</li>
										<li class="unit mainCategories">
											<a class="work_main_link" href="<?php echo SITE_URL; ?>/info/work_programs">
												<div class="img_container" style="background-image: url(http://immistudy.ru/wp-content/themes/immistudy1.2/images/work.jpg); border-style:none;"></div>
												<div class="main_cat_text_container"><h2>Работа</h2></div>
											</a>
										</li>
									</ul>
							</section>	
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>	
			
			<!--Find widget-->
				<?php 
					if( isset($_POST["action"]) && $_POST["action"] == "find" ){
						$country_field = $_POST['find_country'];
						$category_field = $_POST['find_category'];
						switch ($country_field){
							case "Канада":
								$country_link = "/canada/";
								break;
							case "Австралия":
								$country_link = "/australia/";
								break;
							case "Новая Зеландия":
								$country_link = "/newzealand/";
								break;
							case "США":
								$country_link = "/usa/";
								break;
							case "Франция":
								$country_link = "/france/";
								break;
							case "Объединенные Арабские Эмираты":
								$country_link = "/emirates/";
								break;					
						}
						switch ($category_field){
							case "Обучение":
								$category_link = "school_programs";
								$category_ext = "universities/";
								break;
							case "Иммиграция":
								$category_link = "immigration_programs";
								switch ($country_field){
									case "Канада":
										$category_ext = "family";
										break;
									case "Австралия" || "Новая Зеландия":
										$category_ext = "specialist";
										break;
									case "США":
										$category_ext = "business";
										break;
									case "Франция":
										$country_link = "marrige";
										break;
								}
								break;	
							case "Работа":
								$category_link = "work_programs";
								$category_ext = "";
								break;	
						}
						header("Location: " . site_url() . "/info/" . $category_link . $country_link . $category_ext);
					}
				 ?>
				<div class="grid padding_bottom">
					<div class="unit blockFiveSixth center" >
						<div id="find-widget" class="mod"> 
							<b class="top"><b class="tl"></b><b class="tr"></b></b> 
								<div class="inner padding_bottom">
									<form action=""
										method="post"	
										id="find-form">
												
										<div class="grid">					
											<h3 class="colortext center black">Подобрать Подходящую Программу</h3>
										</div>	
												
										<div class="grid">
											<div class="unit find_widget_block">
												<div class="grid margin_top">	
													<label class="alignleft">Страна</label>
													<div class="find_widget_select">
														<select id="find_country" name="find_country">
															<option>Канада</option>
															<option>Австралия</option>
															<option>Новая Зеландия</option>
															<option>США</option>
															<option>Франция</option>
															<option>Объединенные Арабские Эмираты</option>
														</select>
													</div>	
												</div>	
																			
												<div class="grid margin_top">	
													<label class="unit alignleft">Категория</label>
													<div class="find_widget_select">
														<select id="find_category" name="find_category">
															 <option>Обучение</option>
															 <option>Иммиграция</option>
															 <option>Работа</option>
														</select>
													</div>
												</div>
											</div>
											
											<input type="hidden" name="action" value="find" />
														
											<div class="unit margin_top">
												<button class="alignright">Подобрать</button>
											</div>						
										</div>	
									
									</form>
								</div>
							<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
						</div>
					</div>
				</div>
		<!--End Find widget-->
		
		<!--Coupon-->
		<section>
			<div class="mod coupon"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						
						<div class="grid">
							<div class="unit wide">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<div class="hd">
												<h2 class="center">Как Мы Работаем?</h2>
												<h3 class="colortext yellow center">Наша работа состоит из трех этапов</h3>
											</div>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>	
						</div>
						
						<div class="grid">
							
							<div class="unit blockOneThirds">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<div class="hd">
												<a><img class="center main_how_img" src="<?php echo IMAGES; ?>/shanking_hands.png"></a>
												<h3 class="colortext yellow center margin_top"><strong>1. Знакомство</strong></h3>
											</div>
											<div class="bd">
												<div class="steps">
													<?php
													if ( function_exists( 'icit_spot' ) )
													    icit_spot( 'Main page Hello text' );
													?>
												</div>
											</div>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							
							<div class="unit blockOneThirds">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<div class="hd">
												<a><img class="center main_how_img" src="<?php echo IMAGES; ?>/board.png"></a>
												<h3 class="colortext yellow center margin_top"><strong>2. План</strong></h3>
											</div>
											<div class="bd">
												<div class="steps">
													<?php
													if ( function_exists( 'icit_spot' ) )
													    icit_spot( 'Main page Plan text' );
													?>
												</div>
											</div>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							<div class="unit blockOneThirds">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<div class="hd">
												<a><img class="center main_how_img" src="<?php echo IMAGES; ?>/action.png"></a>
												<h3 class="colortext yellow center margin_top"><strong>3. Действие</strong></h3>
											</div>
											<div class="bd">
												<div class="steps">
													<?php
													if ( function_exists( 'icit_spot' ) )
													    icit_spot( 'Main page Action text' );
													?>
												</div>
											</div>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>	
					
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</section>
		<!--End of coupon-->
		
		
		<section>
			<div class="grid padding_top">
				<div class="unit">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<div class="hd">
									<h2>Оценка Шансов</h2>
									<h3 class="colortext">бесплатно оценить свои шансы</h3>
								</div>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
			</div>
			<?php
				$message = "";
				
				if( isset($_POST["action"]) && $_POST["action"] == "eval" ){
					if( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) {
						$message = "Неверное число в капче";
					} else {
						require_once(IMMISTUDY_DIR . '/classes/formHandler.php');
						require_once(IMMISTUDY_DIR . '/classes/chances_application.php');
						$form_handler = new FormHandler();
						$chancesApp_name = $form_handler->validString($_POST['chanceWidget_name']);
						$chancesApp_email = $form_handler->validEmail($_POST['chanceWidget_email']);
						$chancesApp_birthDate =  $_POST['chanceWidget_dayOfBirth'] . "/" . $_POST['chanceWidget_monthOfBirth'] . "/" . $_POST['chanceWidget_yearOfBirth'];
						if ( isset($chancesApp_name, $chancesApp_email, $_POST['chanceWidget_gender']) && !empty($chancesApp_name) && !empty($chancesApp_email) && !empty($_POST['chanceWidget_gender']) ){
							
							$newPerson = ChancesApp::chancesForm(array(
								"goal" => isset($_POST['chanceWidget_goal']) ? $form_handler->validString($_POST['chanceWidget_goal']) : "",
							    "name" => $chancesApp_name,
							    "gender" => isset($_POST['chanceWidget_gender']) ? $form_handler->validString($_POST['chanceWidget_gender']) : "",
							    "birthDate" => $chancesApp_birthDate,
							    "englishLevel" => isset($_POST['chanceWidget_EngLevel']) ? $_POST['chanceWidget_EngLevel'] : "",
							    "email" => $chancesApp_email,
							    "EduLevel" => isset($_POST['chanceWidget_EduLevel']) 
							    					? $form_handler->validString($_POST['chanceWidget_EduLevel']) : "",
							    "birthYear" => isset($_POST['chanceWidget_yearOfBirth']) ? $_POST['chanceWidget_yearOfBirth'] : ""
							));
						
							if($newPerson->put_chancesData()){
								if($newPerson->send_eval_email()){
								       require_once(IMMISTUDY_DIR . '/classes/membership.php');
								       $notification = new Membership();
								       $noteToUs = "Имя: " . $chancesApp_name
											. "\r\n"
											. "Электронный Адрес: " . $chancesApp_email
											. "\r\n"
											. "Дата рождения: " . $chancesApp_birthDate;
								       $notification->utility_email($noteToUs, "immistudy@mail.ru", $chancesApp_name . " заполнил анкету на оценку шансов");	
                                                                       header("location:" . SITE_URL . "/chance_form_mail");
								}	
							}
						
						} else {
							$message = "Поля электронный адрес, имя или пол не заполнены";
						}
					}
				}
			?>
			<form
				method="post"	
				name="chanceWidget-form"
				id="chanceWidget-form">
			<div class="grid">
				<div class="unit blockOneHalf">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<p>
									<label for="chanceWidget_goal"  class="margin_right">Цель обращения</label>
									<select name="chanceWidget_goal">
										<option>иммиграция</option>
										<option>обучение</option>
										<option>работа</option>
									</select>
								</p>
								<p>
									<label for="chanceWidget_name" class="placeholder">
										<span>Имя</span>
										<input type="text" class="required" name="chanceWidget_name" id="chanceWidget_name" maxlength="50"/>
									</label>
								</p>
								
								<p>
									<label for="chanceWidget_gender" class="margin_right">Пол</label>
									<input type="radio" value="Мужской" name="chanceWidget_gender">Мужской
									<input type="radio" value="Женский" name="chanceWidget_gender">Женский
								</p>
							
								<p>
									<label for="chanceWidget_yearOfBirth" class="margin_right">Дата рождения</label>
									 <select name="chanceWidget_yearOfBirth">
									 	<?php
									 	for ($i = 1950; $i <= date("Y"); $i++){
									 	?><option>
									 		<?= $i; ?>
									 		</option>
									 	<?php } ?>	  
									 </select>
									 <select name="chanceWidget_monthOfBirth">
									 	<?php $month = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');
									 	for ($i = 1; $i <= 12; $i++){
									 		?>
									 		<option>
									 		<?= $month[$i]; ?>			
									 		</option>
									 	<?php } ?>	  
									 </select> 
									 <select name="chanceWidget_dayOfBirth">
									 	<?php
									 	for ($i = 1; $i <= 31; $i++){
									 	?><option>
									 		<?= $i; ?>
									 	  </option>
									 	<?php } ?>	  
									 </select>
								</p>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
				
				<div class="unit blockOneHalf">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<p>
									<label for="chanceWidget_EngLevel"  class="margin_right">Уровень знания английского языка</label>
									<select name="chanceWidget_EngLevel">
										<option>Fluent</option>
										<option>Conversational</option>
										<option>Limited</option>
										<option>No</option>
									</select>
								</p>
																
								<p>
									<label for="chanceWidget_email" class="placeholder">
										<span>E-mail</span>
										<input type="text" class="required" name="chanceWidget_email" id="chanceWidget_email" maxlength="50"/>
									</label>
								</p>
							
								<p>
									<label for="chanceWidget_EduLevel" class="unit margin_right">Уровень Образования</label>
									<select name="chanceWidget_EduLevel" class="wide">
										<option>Среднее</option>
										<option>Среднее специальное профессиональное</option>
										<option>Высшее профессиональное</option>
									</select>
								</p>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
			</div>
			<div class="grid padding_bottom">
				<div class="unit">
					<div class="mod" style="margin-top: 0;"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<input type="hidden" name="action" value="eval" />
								<p class="register-message">Вставьте правильное число: <?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?></p>
								<p class="register-message"><?php echo $message; ?></p>
								<button>Оценить</button>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
			</div>
		</form>
		</section>
		
		<section>
			<div class="grid">
				<div class="unit">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<div class="hd">
									<h2>Страны С Которыми Мы Работаем</h2>
									<h3 class="colortext">Информация о странах и услуги</h3>
								</div>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
			</div>
		
			<!--Countries Widget-->
			<div>
				<div class="grid">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<ul id="flagsMainPageUl">
									<li>
										<div id="fl_1" class="unit blockOneSixth flagsMainPageDiv flagsMainPageDivActive">
											<a href="#" >
												<img class="flagsMainPage" src="<?php echo IMAGES; ?>/flags/Canada_small.png" alt="" />
												<span class="center">Канада</span>
											</a>
										</div>
										<div id="accordion_tab_1" class="acc_country_tab hide"></div>
									</li>	
									
									<li>
										<div id="fl_2" class="unit blockOneSixth flagsMainPageDiv">
											<a href="#">
												<img class="flagsMainPage" src="<?php echo IMAGES; ?>/flags/Australia_small.png" alt="" />
												<span class="center">Австралия</span>
											</a>
										</div>
										<div id="accordion_tab_2" class="acc_country_tab hide"></div>
									</li>
									
									<li>
										<div id="fl_3" class="unit blockOneSixth flagsMainPageDiv">
											<a href="#">
												<img class="flagsMainPage" src="<?php echo IMAGES; ?>/flags/nz_small.png" alt="" />
												<span class="center">Новая Зеландия</span>
											</a>
										</div>	
										<div id="accordion_tab_3" class="acc_country_tab hide"></div>
									</li>
									
									<li>
										<div id="fl_4" class="unit blockOneSixth flagsMainPageDiv">
											<a href="#">
												<img class="flagsMainPage" src="<?php echo IMAGES; ?>/flags/USA_small.png" alt="" />
												<span class="center">США</span>
											</a>
										</div>
										<div id="accordion_tab_4" class="acc_country_tab hide"></div>
									</li>
									
									<li>
										<div id="fl_5" class="unit blockOneSixth flagsMainPageDiv">
											<a href="#">
												<img class="flagsMainPage" src="<?php echo IMAGES; ?>/flags/France_small.png" alt="" />
												<span class="center">Франция</span>
											</a>
										</div>	
										<div id="accordion_tab_5" class="acc_country_tab hide"></div>
									</li>
									
									<li>
										<div id="fl_6" class="unit blockOneSixth flagsMainPageDiv">
											<a href="#">
												<img class="flagsMainPage" src="<?php echo IMAGES; ?>/flags/UAE_small.png" alt="" />
												<span class="center">ОАЭ</span>
											</a>
										</div>
										<div id="accordion_tab_6" class="acc_country_tab hide"></div>
									</li>
								</ul>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>	
						
				<!-- Tabs -->
				<div id="tabs">
					<!-- Tab Canada -->
					<div id="tab_1" class="country_tab">
						<div class="grid">
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<ul class="rslides country_img">
												<li><img src="<?php echo IMAGES; ?>/Canada/Canada_1.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/Canada/Canada_2.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/Canada/Canada_3.jpg"/></li>
											</ul>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php
											if ( function_exists( 'icit_spot' ) )
											    icit_spot( 'Main page Canada text' );
											?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
						<div class="grid">
							<h3 class="tab_header margin_top">Категории Услуг:</h3>
						</div>
						<div class="grid padding_bottom">
							<div class="unit">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php $html_template->linksList($canada_classes, $canada_urls, $canada_texts);?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
					</div>
					
										
					<!-- Tab AUS -->
					<div id="tab_2"  class="country_tab" style="display: none;">
						<div class="grid">
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<ul class="rslides country_img">
												<li><img src="<?php echo IMAGES; ?>/Australia/Australia_1.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/Australia/Australia_2.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/Australia/Australia_3.jpg"/></li>
											</ul>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php
												if ( function_exists( 'icit_spot' ) )
												    icit_spot( 'Main page Australia text' );
												?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
						<div class="grid">
							<h3 class="tab_header margin_top">Категории Услуг:</h3>
						</div>
						<div class="grid padding_bottom">
							<div class="unit">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php $html_template->linksList($aus_classes, $aus_urls, $aus_texts);?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
					</div>
					
					<!-- Tab NZ -->
					<div id="tab_3" class="country_tab" style="display: none;">
						<div class="grid">
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<ul class="rslides country_img">
												<li><img src="<?php echo IMAGES; ?>/NewZealand/NZ_1.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/NewZealand/NZ_2.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/NewZealand/NZ_3.jpg"/></li>
											</ul>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php
											if ( function_exists( 'icit_spot' ) )
											    icit_spot( 'Main page New Zealand text' );
											?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						
						</div>
						<div class="grid">
							<h3 class="tab_header margin_top">Категории Услуг:</h3>
						</div>
						<div class="grid padding_bottom">
							<div class="unit">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php $html_template->linksList($nz_classes, $nz_urls, $nz_texts);?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
					</div>
					
					
					<!-- Tab US -->
					<div id="tab_4" class="country_tab" style="display: none;">
						<div class="grid">
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<ul class="rslides country_img">
												<li><img src="<?php echo IMAGES; ?>/USA/USA_1.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/USA/USA_2.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/USA/USA_3.jpg"/></li>
											</ul>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php
											if ( function_exists( 'icit_spot' ) )
											    icit_spot( 'Main page USA text' );
											?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
						<div class="grid">
							<h3 class="tab_header margin_top">Категории Услуг:</h3>
						</div>
						<div class="grid padding_bottom">
							<div class="unit">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php $html_template->linksList($usa_classes, $usa_urls, $usa_texts);?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
					</div>
					
					<!-- Tab Europe -->
					<div id="tab_5" class="country_tab" style="display: none;">
						<div class="grid">
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<ul class="rslides country_img">
												<li><img src="<?php echo IMAGES; ?>/France/france_1.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/France/france_2.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/France/france_3.jpg"/></li>
											</ul>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php
											if ( function_exists( 'icit_spot' ) )
											    icit_spot( 'Main page France text' );
											?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
						<div class="grid">
							<h3 class="tab_header margin_top">Категории Услуг:</h3>
						</div>
						<div class="grid">
							<div class="unit padding_bottom">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php $html_template->linksList($france_classes, $france_urls, $france_texts);?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
					</div>
					
					<!-- Tab Arab -->
					<div id="tab_6" class="country_tab" style="display: none;">
						<div class="grid">
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<ul class="rslides country_img">
												<li><img src="<?php echo IMAGES; ?>/UAE/uae_1.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/UAE/uae_2.jpg"/></li>
												<li><img src="<?php echo IMAGES; ?>/UAE/uae_3.jpg"/></li>
											</ul>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
							
							<div class="unit blockOneHalfCountriesWidget">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php
											if ( function_exists( 'icit_spot' ) )
											    icit_spot( 'Main page Arab Emirates text' );
											?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
						<div class="grid">
							<h3 class="tab_header margin_top">Категории Услуг:</h3>
						</div>
						<div class="grid padding_bottom">
							<div class="unit">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<?php $html_template->linksList($emirates_classes, $emirates_urls, $emirates_texts);?>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>
						</div>
					</div>
					<!-- End Tabs -->
				</div>	
			</div>
			<!--End of the Countries Widget-->
		
		</section>
	
	
	<!--End main categories animation-->
<?php get_footer(); ?>