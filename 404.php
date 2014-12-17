<?php get_header('empty'); ?>
<div class="grid">
	<div class="unit wide margin_top">
		<div class="mod"> 
			<b class="top"><b class="tl"></b><b class="tr"></b></b> 
				<div class="inner">
					<h2 class="center">404: Страница не найдена!</h2>
					<form action="<?php echo SITE_URL;?>"
											method="post">
						<div class="bd">
							<p class="center margin_top margin_bottom"><button>Перейти на главную страницу</button></p>
						</div>
					</form>	
				</div>
			<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
		</div>
	</div>
</div>
<?php get_footer(); ?>	