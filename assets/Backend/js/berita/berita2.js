	var cnt_img = 0;
	var base_url = $('#base').val();

	$('#add_image').click(function () {

		if (cnt_img < 2) {
			cnt_img = cnt_img + 1;
			console.log(cnt_img);

			var html_code = "<div class='row' id='row_" + cnt_img + "' > " +
				"<div class='col-md-8 mb-2'>" +
				"<input type='file' class='form-control' id='image_" + cnt_img + "' name='image_berita[]'>" +
				"</div>" +
				// " <div class='col-md-4 mb-2'>" +
				// " <input class='form-check-input' type='radio' name='tumbnail' id='gridRadios" + cnt_img + "' value='" + cnt_img + "'>" +
				// " </div>" +
				"</div>";
			$('#img-container').append(html_code);

		}

	});

	$(document).on('click', '#delete_image', (function () {


		if (cnt_img > 0) {
			console.log("#row_" + cnt_img);
			$('#row_' + cnt_img).remove();
			console.log(cnt_img);
			cnt_img = cnt_img - 1;

		}

	}));

	$("form").validate({

		rules: {
			berita_author: "required",
			berita_title: "required",
			dt_publish: "required",
		},
		errorElement: "em",
		errorPlacement: function (error, element) {
			// Add the `help-block` class to the error element
			error.addClass("help-block");
			//  console.log($(element).parents(".position-relative"));


			// Add `has-feedback` class to the parent div.form-group
			// in order to add icons to inputs
			element.parents(".col-sm-5").addClass("has-feedback");

			if (element.prop("type") === "checkbox") {
				error.insertAfter(element.parent("label"));
			} else {
				error.insertAfter(element);
			}

			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if (!element.next("span")[0]) {

				$("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
			}
		},
		success: function (label, element) {

			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if (!$(element).next("span")[0]) {

				$("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
			$(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
			$(element).addClass('is-invalid');




		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
			$(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
			$(element).removeClass('is-invalid');



		}
	});


	$('#save').on('click', function (e) {
		var cek = $('#from').valid();

		if (cek == true) {
			var form = document.getElementById('from');
			console.log(form);
			$.ajax({
				url: "insert_berita",
				method: "POST",
				async: true,
				dataType: 'json',
				data: new FormData(form),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function (response) {
					console.log(response);
					// var htmls = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
					// 	'<strong>' + response.message + '</strong>' +
					// 	'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
					// 	'</button>' +
					// 	'</div>';

					// $('#messages').html(htmls);
					// t.ajax.reload();

					window.location.replace(base_url + "Management_Berita");

				}


			});




		}

	});
	$('#save_preview').on('click', function (e) {
		var cek = $('#from').valid();

		if (cek == true) {
			var form = document.getElementById('from');
			console.log(form);
			$.ajax({
				url: "insert_berita_preview",
				method: "POST",
				async: true,
				dataType: 'json',
				data: new FormData(form),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function (response) {
					console.log(response);
					// // var htmls = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
					// // 	'<strong>' + response.message + '</strong>' +
					// // 	'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
					// // 	'</button>' +
					// // 	'</div>';

					// // $('#messages').html(htmls);
					// // t.ajax.reload();
					// alert(base_url + "Management_Berita/berita_preview/" + response.uuid);
					window.location.replace(base_url + "Management_Berita/berita_preview/" + response.uuid);

				}


			});




		}

	});
