$(document).ready(function() {
	
	// enable fileuploader plugin
	$('input[name="resume"]').fileuploader({
		limit: 1,
		extensions: ['pdf','doc','docx'],
		thumbnails: {
			pdf: {
				viewer: 'assets/pdf.js/web/viewer.html?file=',
				urlPrefix: window.location.pathname
			},
		},
		onSelect: function(item) {
			//item.popup.open();
		}
	});
	
});