jQuery(document).ready(function($) {
	$('.install,.uninstall').click(function(){
		button = $(this);
		if($(this).hasClass('disabled')){} else {
			status = $(this).hasClass('install') ? 'install' : '';
			status = $(this).hasClass('uninstall') ? 'uninstall' : status;
			// alert(status);
			jQuery.post(
			   ajaxurl, {
			      'action':'acf_addons',
			      'data':'foobarid',
			      'status':status,
			      'addon':$(this).attr('addon')
			   }, function(response) {
			      alert(response);
			      button.addClass('disabled').siblings().removeClass('disabled');
			   }
			);
		}
	});
});