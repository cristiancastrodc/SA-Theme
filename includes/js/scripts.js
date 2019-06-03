jQuery(document).on( 'ready' , function(){

	let $body = document.body;

	let screenWidth 	= jQuery(window).width();

	let body 			= jQuery( 'body' );
	let menu 			= jQuery( 'nav' );
	let siteContainer 	= jQuery( '.site-container' );
	let siteHeader 		= jQuery( '.site-header' );
	let titleArea 		= jQuery( '.title-area' );
	let button			= jQuery( '.menu-toggle' );


	siteHeader.after(titleArea.clone().addClass('hidden-desktop logo'));

	// Swipe Menu
	button.on('click', function(){
	    if ( !jQuery(this).hasClass('menu-active') ) {
	        jQuery(this).addClass('menu-active');
	        menu.addClass('menu-active');
	        siteContainer.addClass('menu-active');
	        siteHeader.addClass('menu-active');
	    } else {
	        jQuery(this).removeClass('menu-active');
	        menu.removeClass('menu-active');
	        siteContainer.removeClass('menu-active');
	        siteHeader.removeClass('menu-active');
	    }
	});

	menu.find('.menu-item-has-children a').after('<i class="fa fa-chevron-down hidden-desktop"></i>');
	menu.find('.menu-item-has-children .fa').on('click', function(){
		if (jQuery(this).closest('.menu-item-has-children').siblings().children('.sub-menu').is(':visible')) {
			jQuery(this).closest('.menu-item-has-children').siblings().children('.sub-menu').hide('slow');
			jQuery(this).closest('.menu-item-has-children').siblings().removeClass('menu-open');
		}

		jQuery(this).closest('.menu-item-has-children').children('.sub-menu').toggle('slow');
		jQuery(this).closest('.menu-item-has-children').toggleClass('menu-open');
	});

	// Search input on menu
	menu.find( '.menu' ).before('<li class="search hidden-desktop"><form role="search" method="get" id="searchform" action="/"><label class="screen-reader-text" for="s">Search for a procedure:</label><input type="text" name="s" id="s" placeholder="Search..." /><input type="submit" id="searchsubmit" value="&#xf002;" /></form><div class="clearfix"></div></li>');


	if ( screenWidth <= 1024) {

		// Add classes for mobile
		body.addClass( 'mobile' );
		menu.addClass( 'swipe-menu' );
		siteContainer.addClass( 'push' );

		// Removed unused classes 
		menu.removeClass( 'nav-primary' );
		menu.find( 'ul.menu' ).removeClass( 'genesis-nav-menu' );

		// Repositioning elements
		siteContainer.after( menu );
		
		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent) ) {
	    
			var swipe = new Hammer ($body);

			swipe.on( 'swipeleft', function(ev){
				button.addClass('menu-active');
				menu.addClass('menu-active');
				siteContainer.addClass('menu-active');
				siteHeader.addClass('menu-active');
			});

			swipe.on( 'swiperight', function(ev) {
				button.removeClass('menu-active');
			    menu.removeClass('menu-active');
			    siteContainer.removeClass('menu-active');
			    siteHeader.removeClass('menu-active');
			});	
		}	
	}

	jQuery(window).scroll(function (event) {
	    let scroll = jQuery(window).scrollTop();
	    if (scroll > 110) { // Distance between the header and the navigation
	    	jQuery('.nav-primary').addClass('sticky'); // The class of the navigation
	    }else{
	    	jQuery('.nav-primary').removeClass('sticky');
	    }
	    event.preventDefault();
	});

});

(function (window, document, undefined) {
  'use strict';
  
  // Initialize the media query
  var mediaQuery = window.matchMedia('(max-width: 1024px)');
  
  // Add a listen event
  mediaQuery.addListener(doSomething);
  
  // Function to do something with the media query
  function doSomething(mediaQuery) {    
    if (mediaQuery.matches) {
		let $body = document.body;

		let body 			= jQuery( 'body' );
		let menu 			= jQuery( 'nav' );
		let siteContainer 	= jQuery( '.site-container' );
		let siteHeader 		= jQuery( '.site-header' );
		let titleArea 		= jQuery( '.title-area' );
		let button			= jQuery( '.menu-toggle' );
      // Add classes for mobile
		body.addClass( 'mobile' );
		menu.addClass( 'swipe-menu' );
		siteContainer.addClass( 'push' );

		// Removed unused classes 
		menu.removeClass( 'nav-primary' );
		menu.find( 'ul.menu' ).removeClass( 'genesis-nav-menu' );

		// Repositioning elements
		siteContainer.after( menu );

		jQuery( '.menu-primary > .menu-item-has-children' ).children( 'a' ).removeAttr('href');
		jQuery( '.menu-primary > .menu-item-has-children' ).children( 'a' ).on('click', function(){
		if (jQuery(this).closest('.menu-item-has-children').siblings().children('.sub-menu').is(':visible')) {
			jQuery(this).closest('.menu-item-has-children').siblings().children('.sub-menu').hide('slow');
			jQuery(this).closest('.menu-item-has-children').siblings().removeClass('menu-open');
		}

			jQuery(this).closest('.menu-item-has-children').children('.sub-menu').toggle('slow');
			jQuery(this).closest('.menu-item-has-children').toggleClass('menu-open');
		});
		
			
    } else {

    	let $body = document.body;

		let body 			= jQuery( 'body' );
		let menu 			= jQuery( 'nav' );
		let siteContainer 	= jQuery( '.site-container' );
		let siteHeader 		= jQuery( '.site-header' );
		let button			= jQuery( '.menu-toggle' );
      // Add classes for desktop
   		menu.addClass( 'nav-primary' );
		menu.find( 'ul.menu' ).addClass( 'genesis-nav-menu' );

		// Removed unused classes on desktop
		body.removeClass( 'mobile' );
		menu.removeClass( 'swipe-menu' );
		siteContainer.removeClass( 'push' );

		// Repositioning elements
		siteHeader.after( menu );
    }
  }
  
  // On load
  doSomething(mediaQuery);
  
})(window, document);