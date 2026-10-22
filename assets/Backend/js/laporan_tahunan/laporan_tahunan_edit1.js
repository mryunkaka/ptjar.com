		var base_url = $('#base').val();
		$(document).on('click', '#delete_file', (function () {

			// var del = $(this).attr('value');
			// if (typeof del !== "undefined") {
			// 	var cek = $('#del_img').val();
			// 	if (cek != "") {
			// 		$('#del_img').attr('value', cek + ',' + del);
			// 	} else {
			// 		$('#del_img').attr('value', del);
			// 	}
			// }
			$('#f_file1').remove();
			$('#f_file2').remove();

			var htmls =

				'<label for="floatingEmail">File (PDF max 50 Mb)</label>' +
				'<input type="file" class="form-control" id="image_berita" name="image_berita" placeholder="Your Email">';

			$('#tmp_files').html(htmls);

		}));

		$('#update').on('click', function (e) {
			// var cek = $('#from').valid();

			// if (cek == true) {
			var form = document.getElementById('from');

			$.ajax({
				url: "../update_laporan",
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

					window.location.href = base_url + "Management_Laporan_Tahunan";


				}


			});




			// }

		});
