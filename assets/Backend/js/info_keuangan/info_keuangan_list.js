var base_url = $('#base').val();
$(document).ready(function () {
	$(this).on('click', '#id_del', function (e) {

		var id = $(this).attr('uuid');


		$.ajax({
			url: "Management_Informasi_Keuangan/get_laporan",
			method: "POST",

			dataType: 'json',
			data: {
				id: id
			},


			success: function (response) {
				console.log(response);
				var htmd = "";
				var html = "";
				var foot = "";
				htmd += '<h5 class="modal-title" id="detailModalLabel">Delete Informasi Keuangan</h5>' +
					'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';

				html +=
					' <form id="from_dt">' +

					' <input type="hidden" class="form-control" id="id_deleted" name="id_deleted" value="' + response.data[0].vc_group_seq + '">' +
					'</div>' +


					'<div class="row mb-3 h4">' +
					'<div class="col-md-3">' +
					'Tahun' +
					'</div>' +
					' <div class="col-md-1 d-flex justify-content-center">' +
					':' +
					'</div>' +
					'<div class="col-md-2">' +
					'' + response.data[0].vc_tahun + '' +
					'</div>' + '</div>' +


					'<div class="row mb-3 h4">' +
					'<div class="col-md-3">' +
					'Judul' +
					'</div>' +
					' <div class="col-md-1 d-flex justify-content-center">' +
					':' +
					'</div>' +
					'<div class="col-md-8">' +
					'Informasi Keuangan ' + response.data[0].vc_tahun + '' +
					'</div>' +
					'</div>' +



					'</form>';



				foot += '<button class="btn btn-secondary" type="button"  data-bs-dismiss="modal">Cancel</button>' +
					'<button class="btn btn-danger" id="delete_data" type="button">Delete</button>';
				$('#status').val(response.data[0].vc_sts);
				$('#role').val(response.data[0].vc_role_id);

				$('#deleteModal-head').html(htmd);
				$('#deleteModal-body').html(html);
				$('#deleteModal-foot').html(foot);

				$('#deleteModal').modal('show');

			}


		});



		$('#exampleModal1').modal('hide');


	});

	$(document).on('click', '#delete_data', function (e) {


		var form = document.getElementById('from_dt');

		$.ajax({
			url: "Management_Informasi_Keuangan/delete_laporan",
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
				location.reload();



			}


		});



		$('#exampleModal1').modal('hide');

	});









})
