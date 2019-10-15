(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
	$( document ).on( 'click', '.flexi-wp-ajax-aid-pagination-links a.page-numbers', function( e ) {

		var fwpaa_shortcode_id = $( '.flexi-wp-ajax-aid-posts-pagination' ).attr( 'data-fwpaa-shortcode-id' );

		if ( fwpaa_shortcode_id > 0 ) {

			e.preventDefault();

			var page_regex =
				$( this ).attr( 'href' ).match( /\/page\/(\d+)\// )
				||
				$( this ).attr( 'href' ).match( /\/page\/(\d+)/ )
				||
				$( this ).attr( 'href' ).match( /\/paged\/(\d+)\// )
				||
				$( this ).attr( 'href' ).match( /\/paged\/(\d+)/ )
				||
				$( this ).attr( 'href' ).match( /\?page=(\d+)\// )
				||
				$( this ).attr( 'href' ).match( /\?page=(\d+)/ )
				||
				$( this ).attr( 'href' ).match( /\?paged=(\d+)\// )
				||
				$( this ).attr( 'href' ).match( /\?paged=(\d+)/ )			
				||
				$( this ).attr( 'href' ).match( /&page=(\d+)\// )
				||
				$( this ).attr( 'href' ).match( /&page=(\d+)/ )
				||
				$( this ).attr( 'href' ).match( /&paged=(\d+)\// )
				||
				$( this ).attr( 'href' ).match( /&paged=(\d+)/ );

			var page = 1;

			// could not get pagination from the link
			if ( page_regex == null ) {

				// console.log( 'pagination not available, probably it\'s the first page' );
			}
			else {

				page = ( typeof undefined !== typeof page_regex[ 1 ] && page_regex[ 1 ] !== null ) ? page_regex[ 1 ] : 1;
			}

			$.ajax( {

		        url: ajax_request.ajax_url,
		        type: 'POST',
		        dataType: "JSON",
		        data: {
		            'action': 'get_posts_ajax_handler',
		            'security': ajax_request.nonce,
		            'fwpaa_shortcode_id': fwpaa_shortcode_id,
		            'current_page_url': ajax_request.current_page_url,
		            'page': page,
		        },
		        beforeSend: function() {

		            $( '.ajax-loader-div' ).css( 'visibility', 'visible' );
		            $( '.flexi-wp-ajax-aid-posts-items' ).css( 'visibility', 'hidden' );
		        },
		        success: function( ajax_response ) {

		        	setTimeout( function() {

			            $( '.flexi-wp-ajax-aid-posts-items' ).replaceWith( ajax_response.posts_html );
			            $( '.flexi-wp-ajax-aid-posts-pagination' ).replaceWith( ajax_response.pagination_html );
		        	}, 550 );
		        },
		        complete: function() {

		        	setTimeout( function() {

		        		$( '.ajax-loader-div' ).css( 'visibility', 'hidden' );
		        	}, 500 );
		        }
		    } );
		}

	} );

})( jQuery );
