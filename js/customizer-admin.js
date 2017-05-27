( function( $ ) {
	function toggle_control_siblings( control_type, id_suffix, display_logic, siblings ) {
		$( control_type ).filter( '[id$="' + id_suffix + '"]' ).each( function() {
			// Grab the id of the control element.
			var id = $( this ).attr( 'id' );

			// Check whether the control siblings should be hidden.
			var show_controls = display_logic( this );

			// Add # to start of id, and remove the suffix from the string.
			id = '#' + id.replace( id_suffix, '' );

			// Iterate through siblings array, and show/hide them depending on show_controls variable.
			siblings.forEach( function( target ) {
				target = id + target;
				if ( show_controls ) {
					$( target ).slideDown().fadeIn();
				} else {
					$( target ).slideUp().fadeOut();
				}
			} );
		} );
	}

	function elem_has_placeholder( elem ) {
		// If the placeholder is visible it means that no image has been selected, so do not show controls.
		return $( elem ).find( '.placeholder' ).length ? false : true;
	}

	function elem_has_value( elem ) {
		// If the input value is greater than zero, show controls.
		return $( elem ).find( 'input[type="text"]' ).val() > 0 ? true : false;
	}

	function elem_is_checked( elem ) {
		// If the element is checked, show controls.
		return $( elem ).find( 'label:last-child' ).find( 'input' ).is( ':checked' ) ? true : false;
	}

	function wpcsass_toggle_custom_controls() {
		toggle_control_siblings(
			'.customize-control-image',
			'_bgimage',
			elem_has_placeholder,
			[ '_bgrepeat', '_bgposition', '_bgattachment', '_bgsize' ]
		);

		toggle_control_siblings(
			'.customize-control-text',
			'_borderwidth',
			elem_has_value,
			[ '_bordercolor', '_borderstyle' ]
		);

		toggle_control_siblings(
			'.customize-control',
			'_inherit',
			elem_is_checked,
			[ '' ]
		);
	}

	// Shorthand to bind the wpcsass_toggle_custom_controls function to the events listed in the array.
	[ 'change', 'ready' ].forEach( function( e ) {
		wp.customize.bind( e, function() { setTimeout(function() { wpcsass_toggle_custom_controls(); }, 100 ); } );
	} );

	$( document ).ready( function () {
		// The custom range control includes dual inputs, so we want to tie their values together.
		$( '#customize-theme-controls' ).find( '.wpcsass_range' ).each( function() {
			// When either input is changed...
			$( this ).find( 'input' ).on( 'input change', function() {
				// ...we get its value...
				var val = $( this ).val();
				// ...then update the other input and trigger its keyup event to reload the customizer.
				$( this ).closest( 'label' ).find( 'input' ).not( this ).val( val ).trigger( 'keyup' );
			} );
		} );
	} );
} )( jQuery );
