$ = jQuery;
$(document).ready(function () {
	('use strict');

	var searchBtn = $('header .icons .search-icon');
	searchBtn.click(function () {
		$(this).parent().find('input').val('');
		$(this).parent().find('.search-form').toggleClass('active');
		$(this).hasClass('fa-search')
			? $(this).replaceClass('fa-search', 'fa-close')
			: $(this).replaceClass('fa-close', 'fa-search');
	});
	searchBtn.clickOff(function (_, event) {
		let searchForm = $('.search-form input').get(0);
		if (event.target !== searchForm) {
			$('.search-form').removeClass('active');
			searchBtn.replaceClass('fa-close', 'fa-search');
		}
		return false;
	});

	$('.menu-burger').on('click', function () {
		$(this).toggleClass('open');
		$('body').toggleClass('mobile_menu_active');
		$('.mobile-main-menu').toggleClass('open');
		return false;
	});

	$('.mobile-main-menu').clickOff(function () {
		$('.menu-burger').removeClass('open');
		$('body').removeClass('mobile_menu_active');
		$('.mobile-main-menu').removeClass('open');
		return false;
	});
});
/* end ready*/
$(window).on('load', function () {});
