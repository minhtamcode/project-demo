( function ( $ ) {

	"use strict";

	$(window).resize(function(){
		getHeight();
	});

	$(document).ready(function(){
		getHeight();
		getMasonry();
		infinitePortfolio();
		getMasonryGallery();
	});

	var $container = $( '#portfolio-wrapper' ), filter,
	$containerGallery = $( '#portfolio-gallery-wrapper' ),
	count, all, columns,
	perpage = $( '#next-projects' ).data( 'perpage' ),
	loadtext = $( '#next-projects' ).data( 'load' ),
	loadingtext = $( '#next-projects' ).data( 'loading' ),
	offset = perpage;

	if ( offset >= $( '#next-projects' ).attr( 'data-all' ) ) {
		$( '.load-more' ).addClass( 'hide' );
	}

	function getHeight() {
		$('.portfolio-item').each( function() {
			var ratio = $( this ).find( '.thumb' ).attr( 'data-ratio' );
			var img_width = $( this ).width();

			if ( ratio > 1 ) {
				var div_height = img_width / ratio;
			} else {
				var div_height = img_width / ratio;
			}

			//  $( this ).find( '.thumb' ).css( { 'height': Math.floor( div_height ) } );
			$( this ).css( { 'height': Math.floor( div_height ) } );
		});
	}

	function getMasonry() {
		$container.masonry( {
			itemSelector: '.portfolio-item'
		});
	}

	function getMasonryGallery() {
		$containerGallery.masonry( {
			itemSelector: '.portfolio-gallery-item'
		});
	}

	function infinitePortfolio() {

		$('#filter li').click( function( e ) {

			e.preventDefault();

			$( '#ajax-loader' ).fadeIn(100);

			var lastClicked = $(this).data( "lastClicked" ) || 0;
			count = $( this ).attr( 'data-count' );
			offset = 0;
			filter = $( this ).attr( 'data-filter' );
			columns = $( '#next-projects' ).attr( 'data-columns');

			if (new Date() - lastClicked >= 1000) {
				$(this).data( "lastClicked", new Date() );
				$( function() {
					if (e.handled !== true) {
						e.handled = true;
						setTimeout( callAjax, 100 );
					}
				});
			}

			function callAjax() {
				$.ajax( {
					type : 'POST',
					url : infinite_url.ajax_url,
					data : {
						action : 'ajax_infinite',
						perpage : perpage,
						offset : offset,
						filter : filter,
						columns : columns
					},
					success : function( response ) {
						var elem = $( response ).addClass( 'hidden' );
						$container.html( elem );
						getHeight();
						$container.masonry( 'prepended', elem );
						elem.removeClass( 'hidden' );

						offset = perpage + offset;

						if ( perpage >= count ) {
							$( '.load-more' ).addClass( 'hide' );
						} else {
							$( '.load-more' ).removeClass( 'hide' );
						}

						$( '#ajax-loader' ).delay(990).fadeOut("slow");
						//console.log( columns );
					}
				});
			}

			$( '#next-projects' ).attr( 'data-filter', filter );
			$( '#next-projects' ).attr( 'data-all', count );
			$( this ).parent().siblings().find( 'a' ).removeClass( 'active' );
			$( this ).parent().find( 'a' ).addClass( 'active' );

		} );

		$( '#next-projects' ).click( function( e ) {

			e.preventDefault();
			var exclude = '';
			var lastClicked = $(this).data( "lastClicked" ) || 0;
			all = $( this ).attr( 'data-all' );
			filter = $( this ).attr( 'data-filter' );
			columns = $( '#next-projects' ).attr( 'data-columns');
			$( '#portfolio-wrapper' ).find( '.portfolio-item' ).each( function() {
				exclude = exclude + $( this ).attr( 'data-id') + ',';
			});

			$( this ).text( loadingtext ).fadeIn();
			$( '.loadmore-img' ).fadeIn();

			if (new Date() - lastClicked >= 1000) {
			  $(this).data( "lastClicked", new Date() );
				$( function() {
					if (e.handled !== true) {
						e.handled = true;
						setTimeout(callAjax, 100);
					}
				});
			}

			function callAjax() {
				$.ajax( {
					type : 'POST',
					url : infinite_url.ajax_url,
					data : {
						action : 'ajax_infinite',
						perpage : perpage,
						//offset : offset,
						filter : filter,
						columns : columns,
						exclude : exclude
					},
					success : function( response ) {
						var elem = $( response ).addClass( 'hidden' );
						$container.append( elem );
						getHeight();
						$container.masonry( 'appended', elem );
						elem.removeClass( 'hidden' );

						offset = perpage + offset;

						if ( offset >= all ) {
							$( '.load-more' ).addClass( 'hide' );
						}
						$( '.loadmore-img' ).fadeOut();
						$( '#next-projects' ).text( loadtext ).fadeIn();
						//console.log( exclude );
					}
		    });
			}

		});
	}

	$( '.menu-dropdown' ).on( 'click', function() {
		$( '.nav-menu, .menu-dropdown' ).toggleClass( 'toggled-on' );
	} );

	$( '.filters-trigger' ).on( 'click', function() {
		$( '.sb-filters' ).toggleClass( 'sb-filters-open' );
	} );

	var bodyEl = document.body,
	content = document.querySelector( '#wrapper' ),
	openbtn = document.getElementById( 'social-trigger' ),
	openfooterbtn = document.getElementById( 'footer-trigger' ),
	closebtn = document.getElementById( 'close-button' ),
	isOpen = false,
	isOpen2 = false;

	function init() {
		initEvents();
		initEvents2();
	}

	function initEvents() {
		openbtn.addEventListener( 'click', toggleMenu );
		if( closebtn ) {
			closebtn.addEventListener( 'click', toggleMenu );
		}

		// close the menu element if the target it´s not the menu element or one of its descendants..
		content.addEventListener( 'click', function(ev) {
			var target = ev.target;
			if( isOpen && target !== openbtn ) {
				toggleMenu();
			}

		} );
	}

	function initEvents2() {
		openfooterbtn.addEventListener( 'click', toggleMenu2 );
		if( closebtn ) {
			closebtn.addEventListener( 'click', toggleMenu2 );
		}

		// close the menu element if the target it´s not the menu element or one of its descendants..
		content.addEventListener( 'click', function(ev) {
			var target2 = ev.target2;
			if( isOpen2 && target2 !== openfooterbtn ) {
				toggleMenu2();
			}

		} );
	}

	/* $( '#social-trigger' ).on( 'click', function() {
		$( '#social-trigger' ).toggleClass( 'toggled-down' );
	} ); */

	$( '#footer-trigger' ).on( 'click', function() {
		/*$( '#footer-trigger' ).toggleClass( 'toggled-down' );*/
		$('html, body').animate({scrollTop:$(document).height()}, 'slow');
        return false;
	} );

	var isOpenFilter = false;
	$( '.filters-trigger' ).on( 'click', function() {
		if( isOpenFilter ) {
			$('#filters li').css('width', 0);
		}
		else {
			$('#filters li').css('width', $('#filters-container').width()+100);
		}
		isOpenFilter = !isOpenFilter;
	} );

	function toggleMenu() {
		if( isOpen ) {
			$('#social-wrapper').css('height', 2);
		}
		else {
			$('#social-wrapper').css('height', $('.social-height').height());
		}
		isOpen = !isOpen;
	}

	function toggleMenu2() {
		if( isOpen2 ) {
			$('#footer-wrapper').css('height', 2);
		}
		else {
			$('#footer-wrapper').css('height', $('.footer-height').height());
		}
		isOpen2 = !isOpen2;
	}

	init();

} )( jQuery );

// comments form placeholder

	(function() {

		if (!String.prototype.trim) {
			(function() {
				// Make sure we trim BOM and NBSP
				var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
				String.prototype.trim = function() {
					return this.replace(rtrim, '');
				};
			})();
		}

		[].slice.call( document.querySelectorAll( 'input.input__field, textarea.input__field' ) ).forEach( function( inputEl ) {
			// in case the input is already filled..
			if( inputEl.value.trim() !== '' ) {
				classie.add( inputEl.parentNode, 'input--filled' );
			}

			// events:
			inputEl.addEventListener( 'focus', onInputFocus );
			inputEl.addEventListener( 'blur', onInputBlur );
		} );

		function onInputFocus( ev ) {
			classie.add( ev.target.parentNode, 'input--filled' );
		}

		function onInputBlur( ev ) {
			if( ev.target.value.trim() === '' ) {
				classie.remove( ev.target.parentNode, 'input--filled' );
			}
		}
	})();

/* Replace all SVG images with inline SVG */

jQuery(document).ready(function() {
  jQuery('img.svg').each(function(){
    var $img = jQuery(this);
    var imgID = $img.attr('id');
    var imgClass = $img.attr('class');
    var imgURL = $img.attr('src');

    jQuery.get(imgURL, function(data) {
      var $svg = jQuery(data).find('svg');
      if(typeof imgID !== 'undefined') {
        $svg = $svg.attr('id', imgID);
      }
      if(typeof imgClass !== 'undefined') {
        $svg = $svg.attr('class', imgClass+' replaced-svg');
      }
    	$svg = $svg.removeAttr('xmlns:a');
      $img.replaceWith($svg);
    });
  });
});

/* Back to top */

jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 500,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	offset_opacity = 500,
	//duration of the top scrolling animation (in ms)
	scroll_top_duration = 700,
	//grab the "back to top" link
	$back_to_top = $('.to-top');
	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('cd-fade-out');
		}
	});
	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
});
