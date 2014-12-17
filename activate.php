<?php 
/**
 * Template Name: Activation Page
 */
ob_start();
$message="";
if( isset($_GET['code']) ){
	$activation =  mysql_escape_string($_GET['code']);
	if(!empty($activation)){
		require_once(IMMISTUDY_DIR . '/classes/Mysql.php');
		$mysql = new Mysql();
		if($mysql->user_activation($activation)){
			$message = "Вы успешно активировали свой личный кабинет. Теперь вы можете перейти по ссылке чтобы в него войти. Спасибо.";
		} else {
			$message = "Не верный активационный код.";
		}
		
	} else {	
		$message = "Нет активационного кода.";
	}
}	
get_header('empty');
?>
					
			<div class="grid">
				<div class="unit">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<div class="hd">
									<h2>Активация</h2>
									<h3 class="colortext">Активация Личного Кабинета</h3>
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
							<form action="<?php echo SITE_URL;?>/login"
											method="post">
								<div class="bd">
									<p class="register-message"><?php echo $message; ?></p>
									<p class="center margin_bottom"><button>Войти</button></p>
								</div>
							</form>	
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>

<?php get_footer('help'); ?>
