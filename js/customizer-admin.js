( function( $ ) {
	function add_control( controls, control_type, id_suffix, display_logic, siblings ) {
		$( control_type ).filter( '[id$="' + id_suffix + '"]').each( function() {
			// Grab the id of the control element.
			var id = $( this ).attr( 'id' );

			// Add # to start of id, and remove the suffix from the string.
			var regex = new RegExp( id_suffix + '\$' );
			id = '#' + id.replace( regex, '' );

			// Map the siblings array from string to jQuery element.
			var _siblings = siblings.slice().map( function( target ) {
				return $( id + target );
			} );

			// Add the elements to the controls array.
			controls.push( {
				'element': this,
				'status': null,
				'display_logic': display_logic,
				'siblings': _siblings
			} );
		} );

		return controls;
	}

	function toggle_controls( controls ) {
		controls.forEach( function( control ) {
			// Get the current status of the control.
			var show_controls = control.display_logic( control.element );

			// If the control status has changed...
			if ( control.status !== show_controls ) {
				// ...toggle all the siblings...
				control.siblings.forEach( function( target ) {
					toggle_control( target, show_controls );
				} );

				// ...and then update the status.
				control.status = show_controls;
			}
		} );
	}

	function toggle_control( control, show_control ) {
		if ( show_control ) {
			control.slideDown().fadeIn();
		} else {
			control.slideUp().fadeOut();
		}
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

	$( document ).ready( function () {
		// Create controls variable.
		var controls = [];

		// Add controls.
		controls = add_control(
			controls,
			'.customize-control-image',
			'_bgimage',
			elem_has_placeholder,
			[ '_bgrepeat', '_bgposition', '_bgattachment', '_bgsize' ]
		);

		controls = add_control(
			controls,
			'.customize-control-text',
			'_borderwidth',
			elem_has_value,
			[ '_bordercolor', '_borderstyle' ]
		);

		controls = add_control(
			controls,
			'.customize-control',
			'_inherit',
			elem_is_checked,
			[ '' ]
		);

		// Call the toggle_controls() function to calculate the initial state.
		toggle_controls( controls );

		var toggle_controls_timeout;

		// Shorthand to bind the toggle_controls() function to the events listed in the array.
		[ 'change', 'ready' ].forEach( function( e ) {
			wp.customize.bind( e, function() {
				// Use a timeout to ensure the controls aren't toggled while the user is interacting with the controls.
				clearTimeout( toggle_controls_timeout );
				toggle_controls_timeout = setTimeout(function() { toggle_controls( controls ); }, 200 );
			} );
		} );

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
