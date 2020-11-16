$(document).ready(function() {
	
	// enable fileuploader plugin
	$('input[name="pdf_file"]').fileuploader({
		limit: 1,
		extensions: ['pdf'],
		thumbnails: {
			pdf: {
				viewer: 'assets/pdf.js/web/viewer.html?file=',
				urlPrefix: window.location.pathname
			},
		},
		onSelect: function(item) {
			item.popup.open();
		}
	});
	
});