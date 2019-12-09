jQuery(document).ready(function ($) {
	$(document).on('submit','#addTagForm',function () {
		let form = $(this)[0];
		let formData = new FormData(form);

		$.ajax({
			url:'/admin/tag',
			type:'POST',
			data: formData,
			processData: false,
			success: function () {
				
			}
		});
	})
})