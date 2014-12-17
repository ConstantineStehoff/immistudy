<?php
/*
* Template Name: Testimonies Page
*/
?>

<?php get_header(); ?>


	
	<div class="grid">
		<div class="unit">
			<div id="contact-form" class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Отзывы Наших Клиентов</h2>
							<h3>Счастливые отзывы тех кто воспользовался нашими услугами</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>	
	
	<section>	
		<div class="grid">
			<?php 
			$ppp = -1;
			$args = array('post_type' => 'testimonies', 'posts_per_page' => $ppp);
			$loop = new WP_Query($args);
			while($loop->have_posts()) : $loop->the_post();?>
			
				<?php show_testimony_post(); ?>
			
			<?php endwhile;	
			wp_reset_query();
		    ?>
		</div>
	</section>


<?php get_footer(); ?>