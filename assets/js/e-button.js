(function() {
	tinymce.PluginManager.add('egenius_mce_button', function( editor, url ) {
		editor.addButton( 'egenius_mce_button', {
			text: 'Carousel',
			
			icon: false,
		
			type: 'menubutton',
			menu: [
				{			
							text: 'E-Carousel ',
							onclick: function() {
							
									editor.windowManager.open( {
									title: 'Carousel ',
									body: [
										{
											type: 'textbox',
											name: 'post_name',
											label: 'Type your post type',
											value: 'e-carousel'
										},
								
									],
								
									onsubmit: function( e ) {  
										editor.insertContent( '[e_carousel post_type="' + e.data.post_name + '"]');
									}
								});
							
							
							}
					
				},	  
			  
			]
		});
	});
})();