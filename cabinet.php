<?php

/**
 * Template Name: Cabinet Page
 */
ob_start();
require_once(IMMISTUDY_DIR . '/classes/membership.php');
$mysql = new Mysql();
$membership = new Membership();
$membership->sec_session_start();
$id = preg_replace( '/[^0-9]/', '', $membership->confirm_member() ); 
if ( empty($id) || !($mysql->check_member_id($id))){
	header("location:" . SITE_URL . "/login");
	exit();
} 
$user_data = $mysql->get_name_lastname_email_by_id($id);
get_header('cabinet'); ?>

	<div class="grid">
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Личный Кабинет</h2>
							<h3 class="colortext">Это ваш личный кабинет</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>

	<div class="grid">
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h3><strong>Здравствуйте  <?php echo $user_data[0][0]; ?>. Спасибо что зарегистрировались на нашем сайте. Здесь вы можете заполнить анкету по категории в которой вы больше всего заинтересованы и оплатить наши услуги через Интернет.</strong></h3>
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
									<a class="school_main_link" href="<?php echo SITE_URL; ?>/cabinet/school_application">
										<div class="img_container" style="background-image: url(http://immistudy.ru/wp-content/themes/immistudy1.2/images/education.jpg);"></div>
										<div class="main_cat_text_container"><h2>Анкета для Обучения</h2></div>
									</a>
								</li>
								<li class="unit mainCategories">
									<a class="immigration_main_link" href="<?php echo SITE_URL; ?>/cabinet/immigration_application">
										<div class="img_container" style="background-image: url(http://immistudy.ru/wp-content/themes/immistudy1.2/images/immigration.jpg);"></div>
										<div class="main_cat_text_container"><h2>Анкета для Иммиграции</h2></div>
									</a>	
								</li>
								<li class="unit mainCategories">
									<a class="work_main_link" href="<?php echo SITE_URL; ?>/cabinet/work_application">
										<div class="img_container" style="background-image: url(http://immistudy.ru/wp-content/themes/immistudy1.2/images/work.jpg);"></div>
										<div class="main_cat_text_container"><h2>Анкета для Работы</h2></div>
									</a>
								</li>
							</ul>
					</section>	
				</div>
			<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
		</div>
	</div>	
	
	<!--<div class="grid">
		<div class="mod"> 
			<b class="top"><b class="tl"></b><b class="tr"></b></b> 
				<div class="inner">
					<div class="unit">
						<a class="pay_img" href="<?php echo SITE_URL; ?>">
							<img style="max-width: 100%; width: 100%;" src="http://placehold.it/988x250" alt="" />
							<div class="work_text_container"><h2 class="yellow">Оплата Услуг</h2></div>
						</a>
					</div>
				</div>
			<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
		</div>
	</div> -->

<!--Main categories animation-->

<!--<?php get_sidebar(); ?>-->
<?php get_footer('help'); ?>