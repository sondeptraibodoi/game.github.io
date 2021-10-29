( function( api ) {

	// Extends our custom "xmag-pro" section.
	api.sectionConstructor['xmag-pro'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
