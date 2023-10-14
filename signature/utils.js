function save2Image(raw_img_data, author) {
	// Clean base64 header
	var clean_img_data = raw_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
	
	// Save the image
	$.ajax({
		url: 'save_sign.php',
		data: {
			img_data: clean_img_data,
			id: author
		},
		type: 'post',
		success: function (response) {
			console.log(response);
		},
		error: function () {
			console.log('Error in saving the image')
		}
	});	
}