( function( $ ) {

	"use strict";

	$('.owl-carousel').owlCarousel({
		items:1,
		lazyLoad:true,
		navigation:!0,
		pagination:!0,
		slideSpeed:800,
		dots:true,
		autoHeight:!0,
		singleItem:!0,
		autoWidth:true,
		loop:true
	})

	$('.justified-gallery').justifiedGallery({
		rowHeight : 200,
		maxRowHeight : 600,
		lastRow : 'justify',
		margins : 4,
		captions : false
	});

} )( jQuery );
