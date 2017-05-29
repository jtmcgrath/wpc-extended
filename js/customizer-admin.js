( function( $ ) {
	function addControl( controls, controlType, idSuffix, displayLogic, siblings ) {
		$( controlType ).filter( '[id$="' + idSuffix + '"]' ).each( function() {
			var id, regex, _siblings;

			// Grab the id of the control element.
			id = $( this ).attr( 'id' );

			// Add # to start of id, and remove the suffix from the string.
			regex = new RegExp( idSuffix + '\$' );
			id = '#' + id.replace( regex, '' );

			// Map the siblings array from string to jQuery element.
			_siblings = siblings.slice().map( function( target ) {
				return $( id + target );
			} );

			// Add the elements to the controls array.
			controls.push( {
				'element': this,
				'status': null,
				'displayLogic': displayLogic,
				'siblings': _siblings
			} );
		} );

		return controls;
	}

	function toggleControls( controls ) {
		controls.forEach( function( control ) {
			// Get the current status of the control.
			var showControls = control.displayLogic( control.element );

			// If the control status has changed...
			if ( control.status !== showControls ) {
				// ...toggle all the siblings...
				control.siblings.forEach( function( target ) {
					toggleControl( target, showControls );
				} );

				// ...and then update the status.
				control.status = showControls;
			}
		} );
	}

	function toggleControl( control, showControl ) {
		if ( showControl ) {
			control.slideDown().fadeIn();
		} else {
			control.slideUp().fadeOut();
		}
	}

	function elemHasPlaceholder( elem ) {
		// If the placeholder is visible it means that no image has been selected, so do not show controls.
		return $( elem ).find( '.placeholder' ).length ? false : true;
	}

	function elemHasValue( elem ) {
		// If the input value is greater than zero, show controls.
		return $( elem ).find( 'input[type="text"]' ).val() > 0 ? true : false;
	}

	function elemIsChecked( elem ) {
		// If the element is checked, show controls.
		return $( elem ).find( 'label:last-child' ).find( 'input' ).is( ':checked' ) ? true : false;
	}

	$( document ).ready( function () {
		// Create controls variable.
		var controls = [];

		// Add controls.
		controls = addControl(
			controls,
			'.customize-control-image',
			'_bgimage',
			elemHasPlaceholder,
			[ '_bgrepeat', '_bgposition', '_bgattachment', '_bgsize' ]
		);

		controls = addControl(
			controls,
			'.customize-control-text',
			'_borderwidth',
			elemHasValue,
			[ '_bordercolor', '_borderstyle' ]
		);

		controls = addControl(
			controls,
			'.customize-control',
			'_inherit',
			elemIsChecked,
			[ '' ]
		);

		// Call the toggleControls() function to calculate the initial state.
		toggleControls( controls );

		var toggleControlsTimeout;

		// Shorthand to bind the toggleControls() function to the events listed in the array.
		[ 'change', 'ready' ].forEach( function( e ) {
			wp.customize.bind( e, function() {
				// Use a timeout to ensure the controls aren't toggled while the user is interacting with the controls.
				clearTimeout( toggleControlsTimeout );
				toggleControlsTimeout = setTimeout(function() {
					toggleControls( controls );
				}, 200 );
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
