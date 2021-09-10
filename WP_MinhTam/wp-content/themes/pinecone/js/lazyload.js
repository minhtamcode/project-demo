( function( $ ) {

	"use strict";

	$( window ).load( function() {
		//$( '#loader' ).delay( 250 ).fadeOut( 500 );
		//$( '#spinner' ).fadeOut();

		$( '#loader' ).delay( 250 ).fadeOut( 500 );
		//$( '#spinner' ).animate({'opacity':1}, 500);
		$( '#spinner, .loader-img' ).fadeOut();

		/*$( 'a:not([target="_blank"]):not([href*="#"]):not([href^=mailto]):not(a[href$="jpg"]):not([href$="jpeg"]):not(a[href$="gif"]):not(a[href$="png"])' ).click( function() {
			var href = $( this ).attr( 'href' );
			$( '#loader, #spinner' ).fadeIn( 200 );
			setTimeout( function() {
				window.location = href;
			}, 250 );
			return false;
		} );*/

		window.onpageshow = function( event ) {
			if ( event.persisted ) {
				$( '#loader' ).delay( 250 ).fadeOut( 500 );
				$( '#spinner' ).fadeOut();
			}
		};
	} );

} )( jQuery );
