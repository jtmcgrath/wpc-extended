( function( $ ) {
    function wpcsass_toggle_custom_controls() {
        $( '.customize-control-image' ).filter( '[id$="_bgimage"]' ).each( function() {
            // Grab the element id of the image control.
            var id = $( this ).attr( 'id' );

            // Check whether the image control contains a placeholder image.
            var show_controls = true;
            if ( $( this ).find( '.placeholder' ).length ) {
                // If placeholder exists, hide the controls.
                show_controls = false;
            }

            // Add # to start of id, and remove _image from the string.
            id = '#' + id.replace( '_bgimage', '' );

            // Iterate through array of potential sub-controls (one for each background css attribute), and fadeIn or fadeOut depending on the show_controls variable.
            [ id + '_repeat', id + '_position', id + '_attachment', id + '_size' ].forEach( function( current_value ) {
                if ( show_controls ) {
                    $( current_value ).fadeIn();
                } else {
                    $( current_value ).fadeOut();
                }
            } );
        } );

        $( '.customize-control-radio' ).filter( '[id$="_inherit"]' ).each( function() {
			var show_control = $( this ).find( 'input[value="inherit"]' ).is( ':checked' );

			if ( show_control ) {
				$( this ).next().fadeIn();
			} else {
				$( this ).next().fadeOut();
			}
        } );
    }

    // Shorthand to bind the wpcsass_toggle_custom_controls function to the events listed in the array.
    [ 'change', 'ready' ].forEach( function( e ) {
        wp.customize.bind( e, function() { setTimeout(function() { wpcsass_toggle_custom_controls(); }, 100 ); } );
    } );

    $( document ).ready( function () {
        $( '#customize-theme-controls' ).find( '.wpcsass_range' ).each( function() {
            $( this ).find( 'input' ).on( 'input change', function() {
                var val = $( this ).val();
                $( this ).closest( 'label' ).find( 'input' ).not( this ).val( val ).trigger( 'keyup' );
            } );
        } );
    } );
} )( jQuery );
