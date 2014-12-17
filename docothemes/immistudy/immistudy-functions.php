<?php
require_once(IMMISTUDY_DIR . '/immistudy-posts.php');

$testimony_post = new Docothemes_Post_Type('Testimonies');
$testimony_post -> add_meta_box('Client Info', array(
	'name' => 'text',
	'picture' => 'file'
	)
);

$questions_post = new Docothemes_Post_Type('Questions');
$questions_post -> add_meta_box('Question Info', array(
	'question' => 'text',
	'answer' => 'textarea'
	)
);	

function show_testimony_post(){
	$meta = get_post_meta(get_the_id(), '');
	if( !empty($meta['client_info_picture'][0]) ){
		echo '
		<div class="grid">
			<div class="unit blockTwoThirds">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							
							<div class="bd">';
								the_content(); 
							echo '<strong>' . $meta['client_info_name'][0] . '</strong>';
					echo '</div>
							
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
			<div class="unit blockOneThirds">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							
							<div class="bd">
								<img class="center testimonial-img" src="' . $meta['client_info_picture'][0] . '" alt="' . $meta['client_info_name'][0] . '"/>' ;
					echo '</div>
							
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>';
	} else {
		echo '
		<div class="grid">
			<div class="unit">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							
							<div class="bd">';
								the_content(); 
							echo '<strong>' . $meta['client_info_name'][0] . '</strong>';
					echo '</div>
							
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>';	
	}			
}

function show_question_post(){
	echo '
		<div class="grid">
			<div class="unit">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							
							<div class="hd">';
								$meta = get_post_meta(get_the_id(), '');
						   echo '<strong>' . $meta['question_info_question'][0] . '</strong>';
					  echo '</div>
							<div class="bd">';
								echo '<p class="margin_top">' . $meta['question_info_answer'][0] . '</p>';		
					  echo '</div>
								
							
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>';	
}

function show_blog_excerpt(){
	$category = get_the_category(); 
	$category_name = $category[0]->cat_name;
		
	if($category_name == 'Новости'){
		$category_link = SITE_URL . '/blog/category/novosti';
	} elseif ($category_name == 'Страны') {
		$category_link = SITE_URL . '/blog/category/countries';
	} elseif ($category_name == 'Иммиграция') {
		$category_link = SITE_URL . '/blog/category/immigrate';
	} elseif ($category_name == 'Образование') {
		$category_link = SITE_URL . '/blog/category/education';
	} elseif ($category_name == 'Работа') {
		$category_link = SITE_URL . '/blog/category/work';
	} else {
		$category_link="#";
	}	
	echo '
		<div class="grid">
			<div class="lastUnit">
				<div class="mod post"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">';?> 
							<a class="blog-header" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
								<div>
									<p class="post-info"><?php echo the_time('j.m.Y'); ?></p> 
									<p class="post-info"><?php echo ' | ' . get_the_author() . ' | ';?></p> 
									<p class="post-info"><a class="none" href="<?php echo $category_link; ?>"><?php echo $category_name;?></a></p>
								</div>
				
				<?php echo the_excerpt();
						 the_tags('<span class="tags">', ', ', '</span>');
				echo '</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>';
}

function new_excerpt_more( $more ) {
	return ' <a class="read-more margin_left_half" href="'. get_permalink( get_the_ID() ) . '">Читать далее</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function show_blog_post(){
	$category = get_the_category(); 
	$category_name = $category[0]->cat_name;
		
	if($category_name == 'Новости'){
		$category_link = SITE_URL . '/blog/category/novosti';
	} elseif ($category_name == 'Страны') {
		$category_link = SITE_URL . '/blog/category/countries';
	} elseif ($category_name == 'Иммиграция') {
		$category_link = SITE_URL . '/blog/category/immigrate';
	} elseif ($category_name == 'Образование') {
		$category_link = SITE_URL . '/blog/category/education';
	} elseif ($category_name == 'Работа') {
		$category_link = SITE_URL . '/blog/category/work';
	} else {
		$category_link="#";
	}	
	echo '
		<div class="grid">
			<div class="lastUnit">
				<div class="mod post"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">';?> 
							<h3 class="blog-header"><?php the_title(); ?></h3>
								<div>
									<p class="post-info"><?php echo the_time('j.m.Y'); ?></p> 
									<p class="post-info"><?php echo ' | ' . get_the_author() . ' | ';?></p> 
									<p class="post-info"><a class="none" href="<?php echo $category_link; ?>"><?php echo $category_name;?></a></p>
								</div>
				
				<?php echo the_content();
						 the_tags('<span class="tags">', ', ', '</span>');
				echo '</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>';
}

function paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'list',
		'next_text' => 'Вперед',
		'prev_text' => 'Назад'
	);
	
	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	
	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	
	echo paginate_links( $pagination );
}

function immistudy_theme_enqueue_scripts(){

	//Enqueue styles

	//Immistudy base styling
	wp_enqueue_style( 'immistudy-style', get_bloginfo('stylesheet_url'), array(), wp_get_theme()->display('Version'));
		
	//Enqueue scripts
	
	if (!is_admin()) {
		//jquery
		wp_deregister_script('jquery'); 
		wp_register_script('jquery', 'http://cdn.jsdelivr.net/jquery/2.0.0/jquery-2.0.0.min.js', false, '2.0.0'); 
		wp_enqueue_script('jquery');
		
		//retina.js
		/*wp_enqueue_script(
				'retina',
				'http://cdn.jsdelivr.net/retinajs/0.0.2/retina.js',
				array( 'jquery' )
			);*/
		//Menu script 
		wp_enqueue_script(
				'menu',
				ROOT_URL . '/scripts/menu.js',
				array( 'jquery' ), true
			);
                wp_enqueue_script(
				'placehoder_fix',
				'//cdn.jsdelivr.net/placeholder-shiv/0.2/placeholder-shiv.jquery.js',
				array( 'jquery'), true
			);
		wp_enqueue_script(
				'yepnope',
				'http://cdn.jsdelivr.net/yepnope.js/1.5.4/yepnope.min.js',
				array( 'jquery' ), false
			);
		wp_enqueue_script(
				'modernizr',
				'http://cdn.jsdelivr.net/modernizr/2.6.2/modernizr.js',
				array( 'jquery', 'yepnope' ), false
			);	
		wp_enqueue_script(
				'modernizr',
				ROOT_URL . '/scripts/script.js',
				array( 'jquery', 'yepnope', 'modernizr' ), false
			);	
	}
	
	//Load scripts for the front page
	if( is_front_page() ){
		//Responsive slides stylesheet
		wp_enqueue_style( 'immistudy-style',  ROOT_URL . '/css/responsiveslides.css', array( 'immistudy-style' ), true);
		
		//Responsive slides script
		wp_enqueue_script(
				'responsiveSlides',
				'http://cdn.jsdelivr.net/jquery.responsiveslides/1.5.3/responsiveslides.js',
				array( 'jquery' ), true
			);			
		wp_enqueue_script(
				'formValidation',
				ROOT_URL . '/scripts/formValidation.js',
				array( 'jquery' ), true
			);
		wp_enqueue_script(
				'main_categories',
				ROOT_URL . '/scripts/main_categories.js',
				array( 'jquery' ), true
			);
		wp_enqueue_script(
				'front_page',
				ROOT_URL . '/scripts/front_page.js',
				array( 'jquery', 'menu', 'formValidation' ), true
			);
	} elseif ( is_page(12) ) { //information page
		wp_enqueue_script(
				'main_categories',
				ROOT_URL . '/scripts/main_categories.js',
				array( 'jquery' ), true
			);
	} elseif ( is_page(16) ) { //questions page
		wp_enqueue_script(
				'formValidation',
				ROOT_URL . '/scripts/formValidation.js',
				array( 'jquery' ), true
			);
	} elseif ( is_page(18) ) { //contacts page
		wp_enqueue_script(
				'formValidation',
				ROOT_URL . '/scripts/formValidation.js',
				array( 'jquery' ), true
			);
		wp_enqueue_script(
				'yandex_map_api',
				'http://api-maps.yandex.ru/2.0/?coordorder=longlat&load=package.full&wizard=constructor&lang=ru-RU&onload=fid_134550975148785924026', 
				false
			);
	} elseif ( is_page(38) ) { //cabinet main page
		wp_enqueue_script(
				'formValidation',
				ROOT_URL . '/scripts/formValidation.js',
				array( 'jquery' ), true
			);
               wp_enqueue_script(
				'main_categories',
				ROOT_URL . '/scripts/main_categories.js',
				array( 'jquery' ), true
			);
	} elseif ( is_page(404) ) { //school application page
		wp_enqueue_script(
				'formValidation',
				ROOT_URL . '/scripts/formValidation.js',
				array( 'jquery' ), true
			);
			
		wp_enqueue_script(
				'sheepItplugin',
				ROOT_URL . '/scripts/sheepItPlugin.js',
				array( 'jquery' ), true
			);
	} elseif ( is_page(408) ) { //immigration application page
		wp_enqueue_script(
				'formValidation',
				ROOT_URL . '/scripts/formValidation.js',
				array( 'jquery' ), true
			);
			
		wp_enqueue_script(
				'sheepItplugin',
				ROOT_URL . '/scripts/sheepItPlugin.js',
				array( 'jquery' ), true
			);
	} elseif ( is_page(410) ) { //work application page
		wp_enqueue_script(
				'formValidation',
				ROOT_URL . '/scripts/formValidation.js',
				array( 'jquery' ), true
			);
			
		wp_enqueue_script(
				'sheepItplugin',
				ROOT_URL . '/scripts/sheepItPlugin.js',
				array( 'jquery' ), true
			);
	} elseif ( is_page(944) ) {
		wp_enqueue_script(
				'formValidation',
				ROOT_URL . '/scripts/formValidation.js',
				array( 'jquery' ), true
			);
	}
}
add_action('wp_enqueue_scripts', 'immistudy_theme_enqueue_scripts');

function old_browsers_fix() {
   echo ' <!--[if gte IE 9]>
   <style type="text/css">
   		.gradient {
   		filter: none
   		}
   </style>
<![endif]-->
<!--[if IE 9]><p class="margin_left register-message">Ваш браузер <strong>устарел</strong>. Пожалуйста <a href="http://browsehappy.com/">скачайте новую версию</a> для того чтобы сайт полноценно отображался.</p> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

<!--[if lt IE 9]><p class="margin_left register-message">Ваш браузер <strong>устарел</strong>. Пожалуйста <a href="http://browsehappy.com/">скачайте новую версию</a> для того чтобы сайт полноценно отображался.</p><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
   
   <!--[if lte IE 8]><p class="margin_left register-message">Ваш браузер <strong>устарел</strong>. Пожалуйста <a href="http://browsehappy.com/">скачайте новую версию</a> для того чтобы сайт полноценно отображался.</p><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><script src="/static/js/libs/json3.min.js"></script><![endif]-->';
}

add_action( 'wp_head', 'old_browsers_fix' );

function immistudy_register_custom_menus(){
	if(function_exists('register_nav_menus')){
		register_nav_menus(
			array(
				'main_menu' => __('Main Menu', 'theme'),
				'cabinet_menu' => __('Cabinet Main Menu', 'theme') 
			)
		);
	}
}
add_action('init', 'immistudy_register_custom_menus');

function google_analytics()
{
	echo "<script type=\"text/javascript\">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35772782-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>";
}

add_action( 'wp_head', 'google_analytics' );

add_theme_support('nav-menus');


/*--- CUSTOM FUNCTIONS ---*/

function custom_color_page(){
	$arrayOfStrings = explode('/', CURRENT_URI);
	if(!empty($arrayOfStrings[3]) && !empty($arrayOfStrings[4])){
		$category_class = $arrayOfStrings[3] . "_" . $arrayOfStrings[4];
	} else {
		$category_class = "";
	}	
	
	$current = array('#hgroup', '.colortext', 'menu-item-26', 'flag-links', 'contact-form h3');
	$color = '#235FA8'; //blue
	$color1 = '#A40000';//red
	$color2 = '#108A3B'; //green
	$color3 = '#EB9605';//yellow
	
	if (is_page(77)) { 
		echo '<style type="text/css">
			#' . $current[2] . ' a{background-color:' . $color .'; color: white;}
		</style>';
	}elseif(!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'immigration_programs') !== false){
		echo '<style type="text/css">
			     ' . $current[0] .' h1{color: '.$color2.' !important;}
				 ' . $current[1] . ' {color: '.$color2.' !important;}
			 	#' . $current[2] . ' a {background-color: '.$color2.'; color: white;}
				#' . $current[3] . ' h3{color: '.$color2.' !important;}
				#' . $current[3] . ' a:hover{color: '.$color2.' !important;}
				#' . $current[4] . ' {color: '.$color2.' !important;}
				.header-cities a, .header-cities span, .header-contacts-skype strong, .header-contacts strong {color: '.$color2.';}
				a.zingaya_button1368685668696 {background-color: '.$color2.' !important;}
				.facebook,
				.twitter,
				.vkontakte,
				.odnoklasniki,
				.skype,
				.mail,
				.city,
				.phone,
				.phone-white{
					display: inline-block;
					background-repeat: no-repeat;
					background-image: url(\'' . IMAGES . '/icons_green.png\') !important;	
				}
				</style>';
				/*@media
				only screen and (-webkit-min-device-pixel-ratio: 2),
				only screen and (   min--moz-device-pixel-ratio: 2),
				only screen and (	-moz-min-device-pixel-ratio: 2),
				only screen and (     -o-min-device-pixel-ratio: 2/1),
				only screen and (        min-device-pixel-ratio: 2),
				only screen and (                min-resolution: 192dpi),
				only screen and (                min-resolution: 2dppx) { 
				  
				 .facebook,
				 .twitter,
				 .vkontakte,
				 .odnoklasniki,
				 .skype,
				 .mail,
				 .city,
				 .phone,
				 .phone-white{
				 	display: inline-block;
				 	background-repeat: no-repeat;
				 	background-image: url(\'' . IMAGES . 'icons_green@2x.png\'!important);
				 }
				 .facebook
				 {
				 	background-position:0px 0px;
				 	width:100px;
				 	height:100px;
				 }
				 .twitter
				 {
				 	background-position:-100px 0px;
				 	width:100px;
				 	height:100px;
				 }
				 .vkontakte
				 {
				 	background-position:-200px 0px;
				 	width:100px;
				 	height:100px;
				 }
				 .odnoklasniki
				 {
				 	background-position:-300px 0px;
				 	width:100px;
				 	height:100px;
				 }
				 .skype
				 {
				 	background-position:-400px 0px;
				 	width:36px;
				 	height:36px;
				 }
				 .mail
				 {
				 	background-position:-436px 0px;
				 	width:35px;
				 	height:24px;
				 }
				 .city@2x
				 {
				 	background-position:0px -100px;
				 	width:36px;
				 	height:36px;
				 }
				 .phone@2x
				 {
				 	background-position:-36px -100px;
				 	width:36px;
				 	height:36px;
				 }
				 .phone-white@2x
				 {
				 	background-position:-72px -100px;
				 	width:21px;
				 	height:28px;
				 }
				 
				}  	*/
		
		
	} elseif(!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'work_programs') !== false){
		echo '<style type="text/css">
			     ' . $current[0] .' h1{color: '.$color1.' !important;}
				 ' . $current[1] . ' {color: '.$color1.' !important;}
			 	#' . $current[2] . ' a {background-color: '.$color1.'; color: white;}
			 	#' . $current[3] . ' h3{color: '.$color1.' !important;}
				#' . $current[3] . ' a:hover{color: '.$color1.' !important;}
				#' . $current[4] . ' {color: '.$color1.' !important;}
				.header-cities a, .header-cities span, .header-contacts-skype strong, .header-contacts strong {color: '.$color1.';}
				a.zingaya_button1368685668696 {background-color: '.$color1.' !important;}
				.facebook,
				.twitter,
				.vkontakte,
				.odnoklasniki,
				.skype,
				.mail,
				.city,
				.phone,
				.phone-white{
					display: inline-block;
					background-repeat: no-repeat;
					background-image: url(\'' . IMAGES . '/icons_red.png\') !important;
				}
				</style>';
				/*@media
				only screen and (-webkit-min-device-pixel-ratio: 2),
				only screen and (   min--moz-device-pixel-ratio: 2),
				only screen and (	-moz-min-device-pixel-ratio: 2),
				only screen and (     -o-min-device-pixel-ratio: 2/1),
				only screen and (        min-device-pixel-ratio: 2),
				only screen and (                min-resolution: 192dpi),
				only screen and (                min-resolution: 2dppx) { 
				  
				 .facebook,
				 .twitter,
				 .vkontakte,
				 .odnoklasniki,
				 .skype,
				 .mail,
				 .city,
				 .phone,
				 .phone-white{
				 	display: inline-block;
				 	background-repeat: no-repeat;
				 	background-image: url(\'' . IMAGES . 'icons_red@2x.png\'!important);
				 }
				 .facebook
				 {
				 	background-position:0px 0px;
				 	width:100px;
				 	height:100px;
				 }
				 .twitter
				 {
				 	background-position:-100px 0px;
				 	width:100px;
				 	height:100px;
				 }
				 .vkontakte
				 {
				 	background-position:-200px 0px;
				 	width:100px;
				 	height:100px;
				 }
				 .odnoklasniki
				 {
				 	background-position:-300px 0px;
				 	width:100px;
				 	height:100px;
				 }
				 .skype
				 {
				 	background-position:-400px 0px;
				 	width:36px;
				 	height:36px;
				 }
				 .mail
				 {
				 	background-position:-436px 0px;
				 	width:35px;
				 	height:24px;
				 }
				 .city@2x
				 {
				 	background-position:0px -100px;
				 	width:36px;
				 	height:36px;
				 }
				 .phone@2x
				 {
				 	background-position:-36px -100px;
				 	width:36px;
				 	height:36px;
				 }
				 .phone-white@2x
				 {
				 	background-position:-72px -100px;
				 	width:21px;
				 	height:28px;
				 }
				 
				}*/
		
	} elseif(!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'school_programs') !== false){
		echo '<style type="text/css">
			#' . $current[2] . ' a {background-color: '.$color.'; color: white;}
		</style>';
	} elseif(!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'about_countries') !== false){ 
		echo '<style type="text/css">
			#' . $current[2] . ' a {background-color: '.$color3.'; color: white;}
		</style>';
	} elseif(!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'questions') !== false){ 
		echo '<style type="text/css">
			#' . $current[2] . ' a {background-color: '.$color3.'; color: white;}
		</style>';
	} elseif(!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'about_credit') !== false){ 
		echo '<style type="text/css">
			#' . $current[2] . ' a {background-color: '.$color3.'; color: white;}
		</style>';
	} elseif(!empty($arrayOfStrings[1]) && strpos($arrayOfStrings[1], 'register') !== false){
		echo '<style type="text/css">
			#menu-item-947 a {background-color: ' . $color3 . '; color: white;}
		</style>';
	} elseif(!empty($arrayOfStrings[1]) && strpos($arrayOfStrings[1], 'newpass_email') !== false ||
		!empty($arrayOfStrings[1]) && strpos($arrayOfStrings[1], 'new_password') !== false){
		echo '<style type="text/css">
			#menu-item-947 a {background-color: ' . $color . '; color: white;}
		</style>';
	} elseif(!empty($arrayOfStrings[1]) && strpos($arrayOfStrings[1], 'login_captcha') !== false ||
		!empty($arrayOfStrings[1]) && strpos($arrayOfStrings[1], 'new_password') !== false){
		echo '<style type="text/css">
			#menu-item-947 a {background-color: ' . $color . '; color: white;}
		</style>';
	} elseif(!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'category') !== false){
		echo '<style type="text/css">
			#menu-item-962 a {background-color: ' . $color . '; color: white;}
		</style>';	
	} elseif(!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'tag') !== false ||
		!empty($arrayOfStrings[2]) && strpos($arrayOfStrings[2], 'post') !== false){
		echo '<style type="text/css">
			#menu-item-962 a {background-color: ' . $color . '; color: white;}
			#all_category a {color: ' . $color . ';}
		</style>';
	} elseif(!empty($arrayOfStrings[1]) && strpos($arrayOfStrings[1], 'blog') !== false){
		echo '<style type="text/css">
			#all_category a {color: ' . $color . ';}
		</style>';	
	}
	
	echo '<style type="text/css">
		   	#' . $category_class . ' {background-color: #F1F0EE;}
		  	#menu-item-418 a {background-color: ' . $color3 . '; color: white;}
		  </style>';
}

function create_membership(){
global $wpdb;
 
//create the name of the table including the wordpress prefix (wp_ etc)
$search_table = $wpdb->prefix . "membership";
 
//check if there are any tables of that name already
if($wpdb->get_var("show tables like '$search_table'") !== $search_table)
{
//create your sql
$sql = "CREATE TABLE ". $search_table . " (
member_id mediumint(12) NOT NULL UNSIGNED AUTO_INCREMENT,
member_name text NOT NULL,
member_lastname text NOT NULL,
member_email text NOT NULL UNIQUE,
member_password text NOT NULL,
member-active int NOT NULL,
member_actcode int NOT NULL,
member_joinDate DATE NOT NULL,
member_lastAceess TIMESTAMP NOT NULL,
type text,
PRIMARY KEY member_id (member_id))Engine=INNODB;";
}
 
//register the new table with the wpdb object
if (!isset($wpdb->membership))
{
$wpdb->membership = $search_table;
//add the shortcut so you can use $wpdb->stats
$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
}
}
 
//add to front and backend inits
add_action('init', 'create_membership');


function create_contactForm(){
global $wpdb;
 
//create the name of the table including the wordpress prefix (wp_ etc)
$search_table = $wpdb->prefix . "contactForm";
 
//check if there are any tables of that name already
if($wpdb->get_var("show tables like '$search_table'") !== $search_table)
{
//create your sql
$sql = "CREATE TABLE ". $search_table . " (
contact_form_id mediumint(12) NOT NULL UNSIGNED AUTO_INCREMENT,
contact_form_name text NOT NULL,
contact_form_email text NOT NULL,
contact_form_message text NOT NULL,
type text,
PRIMARY KEY member_id (member_id));";
}
 
//register the new table with the wpdb object
if (!isset($wpdb->contactForm))
{
$wpdb->contactForm = $search_table;
//add the shortcut so you can use $wpdb->stats
$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
}
}
 
//add to front and backend inits
add_action('init', 'create_contactForm');



function create_schoolAppForm(){
global $wpdb;
 //create the name of the table including the wordpress prefix (wp_ etc)
$search_table = $wpdb->prefix . "schoolApp";
//check if there are any tables of that name already
if($wpdb->get_var("show tables like '$search_table'") !== $search_table)
{
//create your sql
$sql = "CREATE TABLE ". $search_table . " (
form_id mediumint(12) NOT NULL UNSIGNED AUTO_INCREMENT,
member_id mediumint(12) NOT NULL,
member_name text NOT NULL,
member_email text NOT NULL UNIQUE,
member_lastname text NOT NULL,
schoolApp_gender text NOT NULL ENUM( 'Мужской', 'Женский' ),
schoolApp_birthDate text NOT NULL,
schoolApp_phone text NOT NULL,
schoolApp_address text NOT NULL,
schoolApp_familyStatus text NOT NULL ENUM( 'не замужем/не женат', 'разведена/разведен', 'вдова/вдовец', 'замужем/женат', 'гражданский брак' ),
schoolApp_citizenship text NOT NULL,
schoolApp_nativeLanguage text NOT NULL,
schoolApp_eduLevel text NOT NULL ENUM( 'Среднее', 'Среднее специальное профессиональное', 'Высшее профессиональное' ),
schoolApp_eduSpeciality text NOT NULL,
schoolApp_addSkill text NOT NULL,
type text,
PRIMARY KEY form_id (form_id));";
}
//register the new table with the wpdb object
if (!isset($wpdb->schoolApp))
{
$wpdb->schoolApp = $search_table;
//add the shortcut so you can use $wpdb->stats
$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
}
}
 
//add to front and backend inits
add_action('init', 'create_schoolAppForm');

function create_workAppForm(){
global $wpdb;
 //create the name of the table including the wordpress prefix (wp_ etc)
$search_table = $wpdb->prefix . "workApp";
//check if there are any tables of that name already
if($wpdb->get_var("show tables like '$search_table'") !== $search_table)
{
//create your sql
$sql = "CREATE TABLE ". $search_table . " (
form_id mediumint(12) NOT NULL UNSIGNED AUTO_INCREMENT,
member_id mediumint(12) NOT NULL,
member_name text NOT NULL,
member_email text NOT NULL,
member_lastname text NOT NULL,
workApp_gender text NOT NULL,
workApp_birthDate text NOT NULL,
workApp_phone text NOT NULL,
workApp_addPhone text NOT NULL,
workApp_citizenship text NOT NULL,
workApp_propiska text NOT NULL,
workApp_eduLevel text NOT NULL,
workApp_LangLevel text NOT NULL,
workApp_otherLang text NOT NULL,
workApp_relativesAbroad text NOT NULL,
workApp_healthIssues text NOT NULL,
workApp_army text NOT NULL,
workApp_armyOtvod text NOT NULL,
workApp_police text NOT NULL,
workApp_otherCountriesWork text NOT NULL,
workApp_visaDenial text NOT NULL,
workApp_visa text NOT NULL,
type text,
PRIMARY KEY form_id (form_id));";
}
//register the new table with the wpdb object
if (!isset($wpdb->workApp))
{
$wpdb->workApp = $search_table;
//add the shortcut so you can use $wpdb->stats
$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
}
}
 
//add to front and backend inits
add_action('init', 'create_workAppForm');

function create_immigrationAppForm(){
global $wpdb;
 //create the name of the table including the wordpress prefix (wp_ etc)
$search_table = $wpdb->prefix . "immigrationApp";
//check if there are any tables of that name already
if($wpdb->get_var("show tables like '$search_table'") !== $search_table)
{
//create your sql
$sql = "CREATE TABLE ". $search_table . " (
form_id mediumint(12) NOT NULL UNSIGNED AUTO_INCREMENT,
member_id mediumint(12) NOT NULL,
member_name text NOT NULL,
member_email text NOT NULL,
member_lastname text NOT NULL,
immigrationApp_gender text NOT NULL,
immigrationApp_birthDate text NOT NULL,
immigrationApp_phone text NOT NULL,
immigrationApp_address text NOT NULL,
immigrationApp_familyStatus text NOT NULL,
immigrationApp_citizenship text NOT NULL,
immigrationApp_nativeLanguage text NOT NULL,
immigrationApp_EduLevel text NOT NULL,
immigrationApp_EduSpeciality text NOT NULL,
immigrationApp_addSkills text NOT NULL,
immigrationApp_army text NOT NULL,
immigrationApp_armyOtvod text NOT NULL,
immigrationApp_armyZvanie text NOT NULL,
immigrationApp_armyYears text NOT NULL,
immigrationApp_police text NOT NULL,
immigrationApp_policeCause text NOT NULL,
immigrationApp_policeYears text NOT NULL,
type text,
PRIMARY KEY form_id (form_id));";
}
//register the new table with the wpdb object
if (!isset($wpdb->immigrationApp))
{
$wpdb->immigrationApp = $search_table;
//add the shortcut so you can use $wpdb->stats
$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
}
}
//add to front and backend inits
add_action('init', 'create_immigrationAppForm');

function create_schoolApp_children(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "schoolApp_children";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		schoolApp_child_id mediumint(12) NOT NULL,
		schoolApp_form_id mediumint(12) NOT NULL,
		schoolApp_children_name text NOT NULL,
		schoolApp_children_age text NOT NULL,
		schoolApp_children_gender text NOT NULL,
		type text,
		PRIMARY KEY schoolApp_childID (schoolApp_child_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->schoolApp_children)){
		$wpdb->schoolApp_children = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_schoolApp_children');

function create_schoolApp_school(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "schoolApp_school";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		schoolApp_school_id mediumint(12) NOT NULL,
		schoolApp_form_id mediumint(12) NOT NULL,
		schoolApp_school_name text NOT NULL,
		schoolApp_school_place text NOT NULL,
		schoolApp_school_years text NOT NULL,
		schoolApp_school_document text NOT NULL,
		type text,
		PRIMARY KEY schoolApp_school_id (schoolApp_school_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->schoolApp_school)){
		$wpdb->schoolApp_school = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_schoolApp_school');

function create_schoolApp_work(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "schoolApp_work";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		schoolApp_work_id mediumint(12) NOT NULL,
		schoolApp_form_id mediumint(12) NOT NULL,
		schoolApp_work_name text NOT NULL,
		schoolApp_work_status text NOT NULL,
		schoolApp_work_years text NOT NULL,
		schoolApp_responsibilities_document text NOT NULL,
		type text,
		PRIMARY KEY schoolApp_work_id (schoolApp_work_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->schoolApp_work)){
		$wpdb->schoolApp_work = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_schoolApp_work');

function create_immigrationApp_children(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "immigrationApp_children";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		immigrationApp_child_id mediumint(12) NOT NULL,
		immigrationApp_form_id mediumint(12) NOT NULL,
		immigrationApp_children_name text NOT NULL,
		immigrationApp_children_age text NOT NULL,
		immigrationApp_children_gender text NOT NULL,
		type text,
		PRIMARY KEY immigrationApp_child_id (immigrationApp_child_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->immigrationApp_children)){
		$wpdb->immigrationApp_children = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_immigrationApp_children');

function create_immigrationApp_school(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "immigrationApp_school";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		immigrationApp_school_id mediumint(12) NOT NULL,
		immigrationApp_form_id mediumint(12) NOT NULL,
		immigrationApp_school_name text NOT NULL,
		immigrationApp_school_place text NOT NULL,
		immigrationApp_school_years text NOT NULL,
		immigrationApp_school_document text NOT NULL,
		type text,
		PRIMARY KEY immigrationApp_school_id (immigrationApp_school_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->immigrationApp_school)){
		$wpdb->immigrationApp_school = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_immigrationApp_school');

function create_immigrationApp_work(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "immigrationApp_work";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		immigrationApp_work_id mediumint(12) NOT NULL,
		immigrationAppp_form_id mediumint(12) NOT NULL,
		immigrationApp_work_name text NOT NULL,
		immigrationApp_work_status text NOT NULL,
		immigrationApp_work_years text NOT NULL,
		immigrationApp_responsibilities_document text NOT NULL,
		type text,
		PRIMARY KEY immigrationApp_work_id (immigrationApp_work_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->immigrationApp_work)){
		$wpdb->immigrationApp_work = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_immigrationApp_work');

function create_workApp_otherWork(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "workApp_otherWork";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		workApp_otherWork_id mediumint(12) NOT NULL,
		workApp_form_id mediumint(12) NOT NULL,
		workApp_otherWork_country text NOT NULL,
		workApp_otherWork_type text NOT NULL,
		workApp_otherWork_date text NOT NULL,
		type text,
		PRIMARY KEY workApp_otherWork_id (workApp_otherWork_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->workApp_otherWork)){
		$wpdb->workApp_otherWork = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_workApp_otherWork');

function create_workApp_visaDenial(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "workApp_visaDenial";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		workApp_visaDenial_id mediumint(12) NOT NULL,
		workApp_form_id mediumint(12) NOT NULL,
		workApp_visaDenial_country text NOT NULL,
		workApp_visaDenial_type text NOT NULL,
		workApp_visaDenial_date text NOT NULL,
		type text,
		PRIMARY KEY workApp_visaDenial_id (workApp_visaDenial_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->workApp_visaDenial)){
		$wpdb->workApp_visaDenial = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_workApp_visaDenial');

function create_workApp_visa(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "workApp_visa";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		workApp_visa_id mediumint(12) NOT NULL,
		workApp_form_id mediumint(12) NOT NULL,
		workApp_visa_country text NOT NULL,
		workApp_visa_type text NOT NULL,
		workApp_visa_date text NOT NULL,
		type text,
		PRIMARY KEY workApp_visa_id (workApp_visa_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->workApp_visa)){
		$wpdb->workApp_visa = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_workApp_visa');

function create_chancesApp(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "chancesApp";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		chancesApp_id mediumint(12) NOT NULL,
		chancesApp_goal text NOT NULL,
		chancesApp_name text NOT NULL,
		chancesApp_gender text NOT NULL,
		chancesApp_birthDate text NOT NULL,
		chancesApp_english text NOT NULL,
		chancesApp_email text NOT NULL,
		chancesApp_eduLevel text NOT NULL,
		type text,
		PRIMARY KEY chancesApp_id (chancesApp_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->chancesApp)){
		$wpdb->chancesApp = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_chancesApp');

function create_login_attempts(){
	global $wpdb;
	//create the name of the table including the wordpress prefix (wp_ etc)
	$search_table = $wpdb->prefix . "login_attempts";
	
	//check if there are any tables of that name already
	if($wpdb->get_var("show tables like '$search_table'") !== $search_table){
		//create your sql
		$sql = "CREATE TABLE ". $search_table . " (
		id mediumint(12) NOT NULL,
		member_id int(11) NOT NULL,
		login_time varchar(32) NOT NULL,
		login_ip varchar(32) NOT NULL
		type text,
		PRIMARY KEY chancesApp_id (chancesApp_id));";
	}
	
	//register the new table with the wpdb object
	if (!isset($wpdb->login_attempts)){
		$wpdb->login_attempts = $search_table;
		//add the shortcut so you can use $wpdb->stats
		$wpdb->tables[] = str_replace($wpdb->prefix, '', $search_table);
	}
}
//add to front and backend inits
add_action('init', 'create_login_attempts');
/*--- END CUSTOM FUNCTIONS ---*/