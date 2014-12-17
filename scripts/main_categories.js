function main_categories() {
	var category = $('ul.main_categories').children(),
		img = $('div.img_container');
		
		category.on("mouseenter",
			function () {
				category.addClass('fadeOut'); 
				$(this).removeClass('fadeOut');
			}
		);
		category.on("mouseleave",
			function () {
				category.removeClass('fadeOut');
			}
		);
}		
$(document).ready(function(){
	main_categories();
});