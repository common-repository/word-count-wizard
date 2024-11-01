(function($) {
	
	'use strict';

	jQuery(document).ready(function($) {
		
		$('#wcwizard-tabs').tabs();
		
		$('#wcwizard-tabs a.nav-tab').click(function() {
			
			$('#wcwizard-tabs a.nav-tab').removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
			
		});
		
	});
	
})(jQuery);