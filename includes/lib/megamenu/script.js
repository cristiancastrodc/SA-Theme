jQuery(document).ready(function() {

	jQuery('.genesis-nav-menu .sub-menu').hide(); //Hide children by default
		
	jQuery('.genesis-nav-menu .menu-item-has-children a').click(function(event){

	    if (jQuery(this).next('ul.sub-menu').children().length !== 0) {   
	       event.preventDefault();

	    }
		jQuery(this).siblings('.sub-menu').slideToggle(0);
		jQuery(this).siblings('.sub-menu').toggleClass('active-sub-menu');

	    if (jQuery(this).parent().siblings('.menu-item-has-children').children().next().slideUp().length !== 0){
	    	return false;
	    }


	});

});

jQuery(document).click(function(event) { 
    if(!jQuery(event.target).closest('.menu-item-has-children').length) {
        if(jQuery('.menu-item-has-children').is(":visible")) {
            jQuery('.menu-item-has-children .sub-menu').hide()
        }
    }        
})
