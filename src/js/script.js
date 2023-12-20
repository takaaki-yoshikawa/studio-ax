////////////////////////////////////////
//　SCRIPT
////////////////////////////////////////
jQuery(function(){
	var setFilter = jQuery('#filterBtn'),
	filterBtn = setFilter.find('a'),
	btnAll = jQuery('.allItem'),
	setList = jQuery('#filterList'),
	filterList = setList.find('li'),
	listWidth = filterList.outerWidth();

	filterBtn.click(function(){
		if(!(jQuery(this).hasClass('active'))){
			var filterClass = jQuery(this).attr('class');

			filterList.each(function(){
				if(jQuery(this).hasClass(filterClass)){
					jQuery(this).css({display:'block'}).stop().animate({width:listWidth},1000);
					jQuery(this).find('*').stop().animate({opacity:'1'},000);
				} else {
					jQuery(this).find('*').stop().animate({opacity:'0'},500);
					jQuery(this).stop().animate({width:'0'},500,function(){
						jQuery(this).css({display:'none'});
					});
				}
			});
			filterBtn.removeClass('active');
			jQuery(this).addClass('active');
		}
	});

	btnAll.click(function(){
		filterList.each(function(){
			jQuery(this).css({display:'block'}).stop().animate({width:listWidth},1000);
			jQuery(this).find('*').stop().animate({opacity:'1'},1000);
		});
	});
	btnAll.click();
});
