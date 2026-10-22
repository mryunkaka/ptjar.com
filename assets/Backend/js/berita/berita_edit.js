	var cnt_img = $('#cnt_img').val();
	var base_url = $('#base').val();
	$('#add_image').click(function () {


		if (cnt_img < 3) {


			var html_code = "<div class='row' id='row_" + cnt_img + "' > " +
				"<div class='col-md-6 mb-2'>" +
				"<input type='file' class='form-control' id='image_" + cnt_img + "' name='image_berita[]'>" +
				"</div>" +
				// " <div class='col-md-2 mb-2'>" +
				// "<div class = 'col-12' >" +
				// " <input class='form-check-input' type='radio' name='tumbnail' id='gridRadios" + cnt_img + "' value='" + cnt_img + "'>" +
				// " </div>" +
				// " </div>" +
				" <div class='col-md-2 mb-2'>" +
				"<div class='col-12'>" +
				"<a href='#' id='delete_image'><span class='badge rounded-pill bg-danger p-3 ms-2'> <i class='ri-delete-bin-6-line'></i></span></a>" +
				" </div>" +
				" </div>" +
				"</div>";

			$('#img-container').append(html_code);
			cnt_img = parseInt(cnt_img) + 1;

			if (cnt_img > 2) {
				$(this).hide();

			}
		}

		console.log(cnt_img);
	});

	$(document).on('click', '#delete_image', (function () {

		var del = $(this).attr('value');
		if (typeof del !== "undefined") {
			var cek = $('#del_img').val();
			if (cek != "") {
				$('#del_img').attr('value', cek + ',' + del);
			} else {
				$('#del_img').attr('value', del);
			}
		}

		$(this).parent().parent().parent().remove();
		cnt_img = cnt_img - 1;
		if (cnt_img < 3) {
			$('#add_image').show();
		}

	}));

	$('#update').on('click', function (e) {
		// var cek = $('#from').valid();

		// if (cek == true) {
		var form = document.getElementById('from');

		$.ajax({
			url: "../update_berita",
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




		// }

	});
