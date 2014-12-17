<?php 
/*
* Template Name: Chance form Email Page
*/
get_header('empty');
?>		
		
		<div class="grid">
			<div class="unit">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<div class="hd">
								<h2>Проверьте Почту</h2>
								<h3 class="colortext">Проверьте свою Почту</h3>
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
							<form action="<?php echo SITE_URL;?>"
											method="post">
								<div class="bd">
									<p class="register-message">Письмо с оценкой ваших шансов было отправлено на электронный почтовый ящик который вы указали в анкете. Спасибо вам.</p>
									<p class="center margin_bottom"><button>Перейти на главную страницу</button></p>
								</div>
							</form>	
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>		

	<?php get_footer('help'); ?>