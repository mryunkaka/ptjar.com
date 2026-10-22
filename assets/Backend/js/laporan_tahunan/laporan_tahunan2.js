		var base_url = $('#base').val();
		$("form").validate({

			rules: {
				image_berita: "required",
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

				$.ajax({
					url: "insert_laporan",
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




			}

		});
