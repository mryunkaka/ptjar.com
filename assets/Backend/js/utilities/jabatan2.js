 $(document).ready(function () {


 	var t = $('#crud_table').DataTable({

 		ajax: "Management_Jabatan/get_jabatan_list",

 		columns: [{
 				data: null
 			}, {
 				data: 'vc_nama_jabatan'
 			}, {

 				render: function (data, type, row) {

 					if (
 						row.is_active ==
 						1) {
 						return '<span class="badge rounded-pill bg-success " dt="' + data + '">Active</span>';
 					} else {

 						return '<span class="badge rounded-pill bg-danger" dt="' + data + '">Nonactive</span>';
 					}
 				}

 			},
 			{
 				data: 'nu_id',
 				render: function (data, type, row) {
 					return '<button value="' + data + '" class="badge bg-info text-dark detail" id="edit" >Edit</button>'
 				}

 			},

 		]
 	});
 	t.on('order.dt search.dt', function () {
 		t.column(0, {
 			search: 'applied',
 			order: 'applied'
 		}).nodes().each(function (cell, i) {
 			cell.innerHTML = i + 1;
 		});
 	}).draw();


 	//  var yourForm = document.querySelector('#from');
 	$("form").validate({

 		rules: {
 			nama: "required",
 			username: "required",
 			password: "required",
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

 	$('#generate').on('click', function (e) {
 		$('#password').val(randomString(10));
 	})


 	$('#save').on('click', function (e) {
 		var cek = $('#from').valid();

 		if (cek == true) {
 			var form = document.getElementById('from');

 			$.ajax({
 				url: "Management_Jabatan/insert_jabatan",
 				method: "POST",
 				async: true,
 				dataType: 'json',
 				data: new FormData(form),
 				processData: false,
 				contentType: false,
 				cache: false,
 				async: false,
 				success: function (response) {
 					console.log(response.message);
 					var htmls = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
 						'<strong>' + response.message + '</strong>' +
 						'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
 						'</button>' +
 						'</div>';

 					$('#messages').html(htmls);
 					t.ajax.reload();



 				}


 			});

 			$('#tambahPegawai').modal('hide');

 		}

 	});

 	$('#crud_table tbody').on('click', 'button', function () {
 		var data = $(this).attr('value');


 		$.ajax({
 			url: "Management_Jabatan/get_jabatan_detail",
 			method: "POST",
 			async: true,
 			dataType: 'json',
 			data: {
 				id: data
 			},

 			success: function (response) {
 				console.log(response);
 				var htmd = "";
 				var html = "";
 				var foot = "";
 				htmd += '<h5 class="modal-title" id="detailModalLabel">Edit User</h5>' +
 					'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';

 				html +=
 					' <form id="from_dt">' +
 					' <div class="row  mb-2">' +
 					'  <div class="col-md-12 position-relative">' +
 					'  <label for="validationTooltip02" class="form-label">Nama Jabatan</label>' +
 					' <input type="hidden" class="form-control" id="id_update" name="id_update" value="' + response.data[0].nu_id + '">' +
 					' <input type="text" class="form-control" id="nama_jab" name="nama_jab" value="' + response.data[0].vc_nama_jabatan + '">' +

 					' </div>' +



 					'</div>' +





 					'<div class="row">' +
 					'<div class="col-md-12 position-relative">' +
 					' <label for="exampleFormControlSelect1">Status</label>' +
 					' <select class="form-control" id="status" name="status">' +
 					'<option value="1">Aktif</option>' +
 					'<option value="0">Nonaktif</option>' +
 					' </select>' +
 					'</div>' +
 					' </div>' +
 					'</form>';



 				foot += '<button class="btn btn-secondary" type="button"  data-bs-dismiss="modal">Cancel</button>' +
 					'<button class="btn btn-primary" id="update_data" type="button">Update</button>';

 				$('#editModal-head').html(htmd);
 				$('#editModal-body').html(html);
 				$('#editModal-foot').html(foot);

 				$('select[name="status"] option:selected').attr("selected", null);
 				$('select[name="status"] option[value="' + response.data[0].is_active + '"]').attr("selected", "selected");
 				$('#editModal').modal('show');


 				$('#generate_updt').on('click', function (e) {
 					$('#password_updt').val(randomString(10));

 				})

 			}


 		});
 	});
 	$(document).on('click', '#update_data', function (e) {



 		var form = document.getElementById("from_dt");


 		$.ajax({
 			url: "Management_Jabatan/update_jabatan",
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

 				var htmls = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
 					'<strong>' + response.message + '</strong>' +
 					'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
 					'</button>' +
 					'</div>';

 				$('#messages').html(htmls);
 				t.ajax.reload();
 			}


 		});



 		$('#editModal').modal('hide');


 	});





 });
