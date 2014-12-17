<?php
	/*
	Template Name: Blog page
	*/
	
	get_header();
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
						//The loop
						$ppp = 5;
						$temp = $wp_query;
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$wp_query= null;
						$wp_query = new WP_Query();
						$wp_query->query('posts_per_page='. $ppp .'&paged='.$paged);
						while ($wp_query->have_posts()) : $wp_query->the_post();?>
							<?php show_blog_excerpt(); ?>
						<?php endwhile; //end the loop?>
						
						<?php wp_reset_postdata(); // reset the query ?>
						<div class="alignright margin_bottom"> <?php  paginate(); ?></div>
						<?php $wp_query = null; $wp_query = $temp;?>
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