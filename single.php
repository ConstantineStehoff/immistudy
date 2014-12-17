<?php 
	get_header();
	$arrayOfStrings = explode('/', CURRENT_URI);
	if(!empty($arrayOfStrings[3]) && strpos($arrayOfStrings[3], 'post') !== false ||
		!empty($arrayOfStrings[3]) && strpos($arrayOfStrings[3], 'post') !== false){
		$post_id = $arrayOfStrings[4];
	}
	
?>

	<div class="grid">
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Блог</h2>
							<h3 class="colortext">Здесь вы найдете много всего интересного</h3>
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
						<ul class="category-list">
							<li id="all_category" class="margin_bottom"><a href="<?php echo SITE_URL; ?>/blog">Все темы</a></li>
							<?php wp_list_categories('title_li='); ?>
						</ul>
						
						<?php if ( function_exists('wp_tag_cloud') ) : ?>
						
						<h3 class="margin_top padding_top">Популярные теги</h3>
						<ul>
							<li class="tag-cloud"><?php wp_tag_cloud('smallest=10&largest=22'); ?></li>
						</ul>
						
						<?php endif; ?>
						
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
		
		<div class="lastUnit blockTwoThirds">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<?php
						$ppp = 1;
						global $query_string; 
						while ( have_posts() ) : the_post();
							show_blog_post();
						endwhile;
						?>
						
						<div class="grid">
							<div class="lastUnit">
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<div class="post-link alignright"><?php next_post_link('%link', 'Следующий пост'); ?></div>
											<div class="post-link alignleft"><?php previous_post_link('%link', 'Предыдущий пост'); ?></div>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
							</div>	
						</div>
						<?php wp_reset_query(); ?>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
			
		</div>
	</div>
	
	<div class="grid">
	 	<div class="unit margin_left margin_right">
		 	<p class="post-info">Размещенные на сайте информационные материалы материалы могут содержать информацию предназначенную для пользователей старше 18 лет согласно Федеральному закону номер 436-ФЗ от 29.12.2010 года "О защите детей от информации, причиняющей вред их здоровью и развитию".</p>
		 </div>
	</div>

<?php
	get_footer();
?>