<!-- Footer information -->
		   
                          <footer role="contentinfo" class="margin_top">
				 <a href="<?php echo SITE_URL; ?>/register">
						<div class="footer-register">
							<div class="grid">
								<p class="register-big center">Зарегистрироваться</p>
						                                  
                                                       </div>
						</div>
					</a>
					
					<div class="margin_top margin_bottom wide">
						
							<div id="footer_wrapper" class="grid">
								<div class="unit footer_oneThird">
									<div class="mod"> 
										<b class="top"><b class="tl"></b><b class="tr"></b></b> 
											<div class="inner">
												<a><img class="center footer_image" src="<?php echo IMAGES; ?>/Liudmila_ready.jpg" alt="Liudmila picture"></a>
											</div>
										<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
									</div>
								</div>
								
								<div class="lastUnit footer_twoThirds">
									<div class="mod"> 
										<b class="top"><b class="tl"></b><b class="tr"></b></b> 
											<div class="inner">
												<?php
												if ( function_exists( 'icit_spot' ) )
													 icit_spot( 'About footer' );
												?>
											</div>
										<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
									</div>
								</div>
							</div>
						</div>	
						
						<div class="grid">
							<div class="unit">
								<small class="margin_left alignleft">&copy; <?php bloginfo('name'); ?>, <?=date('Y');?>. Все права защищены</small>
								<ul class="social alignleft margin_left margin_right">
									<li class="margin_right_half"><a class="facebook" href="https://www.facebook.com/Immistudy"></a></li>
									<li class="margin_right_half"><a class="twitter" href="https://twitter.com/immistudy"></a></li>
									<li class="margin_right_half"><a class="vkontakte" href="http://vk.com/immistudy"></a></li>
									<li><a class="odnoklasniki" href="http://www.odnoklassniki.ru/group/51873210958025"></a></li>
								</ul>
							</div>
						</div>
						
						<div class="sticky-button">
							<img class="alignleft sticky-button_span margin_left" src="<?php echo IMAGES; ?>/chat_bubble.png" alt="message_us"/>
							<span class="sticky-button_span white alignright margin_left_half margin_right">Отправьте нам сообщение</span>
						</div>	
						
						<div class="sticky_form_wrap">
							<div class="sticky_close_btn white alignright">Закрыть</div>
							<p class="white" style="padding-top: 0.5rem; padding-top: 5px;">Отправьте нам сообщение на email и мы вам обязательно ответим</p>
							<p>
								<label class="placeholder" style="background-color: white;">
									<textarea class="required" id="sticky_note" name="sticky_note" maxlength="2000" rows="6" placeholder="Сообщение"></textarea>
								</label>
							</p>
							<p>
								<label class="placeholder" style="background-color: white;">
									<input type="text" class="required" name="sticky_email" id="sticky_email"  maxlength="50" placeholder="Адрес почты"/>
								</label>
							</p>
							<p id="sticky_msg" class="white"></p>
							<button id="sticky_submit" class="alignright">Отправить</button>
						</div>
				   
                               </footer>
				<!-- End Footer information -->
				
				<?php wp_footer(); ?>
		</div>
              <!--End of content-->
              </body>
	</html>
	