( function( $ ) {
	function addControlGroup( controls, controlType, idSuffix, displayLogic, siblings ) {
		$( controlType ).filter( '[id$="' + idSuffix + '"]' ).each( function() {
			// Grab the id of the control element.
			let id = $( this ).attr( 'id' );

			// Add # to start of id, and remove the suffix from the string.
			let regex = new RegExp( idSuffix + '\$' );
			id = '#' + id.replace( regex, '' );

			// Map the siblings array from string to jQuery element.
			let targets = siblings.slice().map( function( target ) {
				return $( id + target );
			} );

			// Add the elements to the controls array.
			controls.push( {
				'status': null,
				'displayLogic': displayLogic,
				'displayParams': { 'elem': this },
				'targets': targets,
			} );
		} );

		return controls;
	}

	function addControl( controls, type, target, setting, comparison, value ) {
		let displayParams = {
			'type': type,
			'setting': setting,
			'comparison': comparison,
			'value': value,
		};

		controls.push( {
			'status': null,
			'displayLogic': conditionalLogic,
			'displayParams': displayParams,
			'targets': [ $( target ) ],
		} );

		return controls;
	}

	function toggleControls( controls ) {
		controls.forEach( function( control ) {
			// Get the current status of the control.
			let showControls = control.displayLogic( control.displayParams );

			// If the control status has changed...
			if ( control.status !== showControls ) {
				// ...toggle all the targets...
				control.targets.forEach( function( target ) {
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

	function elemHasPlaceholder( params ) {
		// If the placeholder is visible it means that no image has been selected, so do not show controls.
		return $( params.elem ).find( '.placeholder' ).length ? false : true;
	}

	function elemHasValue( params ) {
		// If the input value is greater than zero, show controls.
		return $( params.elem ).find( 'input[type="text"]' ).val() > 0 ? true : false;
	}

	function elemIsChecked( params ) {
		// If the element is checked, show controls.
		return $( params.elem ).find( 'label:last-child' ).find( 'input' ).is( ':checked' ) ? true : false;
	}

	function conditionalLogic( params ) {
		const equal = [ '==', '===', '>=', '<=' ];
		const less = [ '!=', '!==', '>', '>=' ];
		const more = [ '!=', '!==', '<', '<=' ];

		let show = false;
		let settingElem = $( params.setting );
		let input = 'input';

		if ( settingElem.hasClass( 'customize-control-radio' ) ) {
			input = 'input:checked';
		}

		let currentValue = settingElem.find( input ).val();

		if ( currentValue === params.value ) {
			show = ( '===' === params.comparison );
		} else if ( currentValue == params.value ) {
			show = equal.includes( params.comparison );
		} else if ( currentValue < params.value ) {
			show = less.includes( params.comparison );
		} else if ( currentValue < params.value ) {
			show = more.includes( params.comparison );
		}

		return 'visible_if' === params.type ? show : ! show;
	}

	$( document ).ready( function () {
		// Create controls variable.
		let controls = [];

		// Add controls.
		controls = addControlGroup(
			controls,
			'.customize-control-image',
			'_bgimage',
			elemHasPlaceholder,
			[ '_bgrepeat', '_bgposition', '_bgattachment', '_bgsize' ],
		);

		controls = addControlGroup(
			controls,
			'.customize-control-text',
			'_borderwidth',
			elemHasValue,
			[ '_bordercolor', '_borderstyle' ],
		);

		controls = addControlGroup(
			controls,
			'.customize-control',
			'_inherit',
			elemIsChecked,
			[ '' ],
		);

		Object.keys( wpcsass_conditional_logic ).forEach( function( type ) {
			wpcsass_conditional_logic[ type ].forEach( function( setting ) {
				controls = addControl(
					controls,
					type,
					setting.target,
					setting.setting,
					setting.comparison,
					setting.value,
				);
			} );
		} );

		// Call the toggleControls() function to calculate the initial state.
		toggleControls( controls );

		let toggleControlsTimeout;

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
				let val = $( this ).val();
				// ...then update the other input and trigger its keyup event to reload the customizer.
				$( this ).closest( 'label' ).find( 'input' ).not( this ).val( val ).trigger( 'keyup' );
			} );
		} );
	} );
} )( jQuery );
