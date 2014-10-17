function playerReady(thePlayer) {
    //start the player and JS API
    WDN.videoPlayer.createFallback.addJWListeners(document.getElementById(thePlayer.id));
};

WDN.loadJQuery(function(){
	WDN.initializePlugin('modal', [function() {
		WDN.jQuery('span.embed').colorbox({inline: true, href:'#sharing', width:'600px', height:'310px'});
	}]);
	WDN.jQuery('form#addTags').hide();
	WDN.jQuery('#mediaTagsAdd a[href="#"]').click(function(){
		WDN.jQuery(this).hide();
		WDN.jQuery(this).siblings('form').show(function(){
			WDN.jQuery(this).children('input[type="text"]').focus();
		});
		return false;
	});
});