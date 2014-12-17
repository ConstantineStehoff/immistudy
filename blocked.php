<?php 
/**
 * The template for displaying all pages.
 *
 * Template name: Blocked page
 */
get_header('empty'); ?>

<div class="grid">
	<div class="unit wide margin_top">
		<div class="mod"> 
			<b class="top"><b class="tl"></b><b class="tr"></b></b> 
				<div class="inner">
					<h2 class="center">Извините но ваш личный кабинет заблокирован. Свяжитесь с нами если это ошибка.</h2>
					<button class="margin_top center"><a class="none white" href="<?php echo SITE_URL;?>">Перейти на главную страницу</a></button>
				</div>
			<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
		</div>
	</div>
</div>
<?php get_footer(); ?>	