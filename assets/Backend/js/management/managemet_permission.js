 $(document).ready(function () {


 	var t = $('#crud_table').DataTable({

 		ajax: "Management_Permission/get_permission_list",

 		columns: [{
 				data: null
 			}, {
 				data: 'vc_role_name'
 			}, {
 				data: 'vc_menu'
 			},
 			{
 				data: 'vc_code_role',
 				render: function (data, type, row) {
 					return '<button value="' + data + '" class="badge bg-info text-dark detail" id="edit" >Permission</button>'
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
 			role_name: "required",

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
 				url: "Management_Permission/insert_role",
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



 			$('#exampleModal1').modal('hide');
 		}

 	});

 	$('#crud_table tbody').on('click', 'button', function () {
 		var data = $(this).attr('value');


 		$.ajax({
 			url: "Management_Permission/get_role_detail",
 			method: "POST",
 			async: true,
 			dataType: 'json',
 			data: {
 				role: data
 			},

 			success: function (response) {
 				console.log(response);
 				var htmd = "";
 				var html = "";
 				var foot = "";
 				htmd += '<h5 class="modal-title" id="detailModalLabel">Edit Permission</h5>' +
 					'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';

 				html +=
 					' <form id="from_dt">' +
 					' <div class="row  mb-2">' +
 					'  <div class="col-md-12 position-relative">' +
 					'  <label for="validationTooltip02" class="form-label">Role</label>' +
 					' <input type="hidden" class="form-control" id="id_update" name="id_update" value="' + response.data[0].nu_id + '">' +
 					' <input type="hidden" class="form-control" id="role_ids" name="role_ids" value="' + response.data[0].vc_code_role + '">' +
 					' <input type="text" class="form-control" id="nama" name="nama" value="' + response.data[0].vc_role_name + '" readonly>' +
 					' </div>' +
 					'</div>' +

 					' <div class="row  mb-2">' +
 					'<div class="col-md-8 position-relative">' +
 					'<label for="exampleFormControlSelect1">Permission</label>' +
 					' <select name="permission" id="permission" class="form-control">';
 				for (i = 0; i < response.menu.length; i++) {
 					html += ' <option value = "' + response.menu[i].nu_id + '" > ' + response.menu[i].vc_menu_name + ' </option>';
 				}
 				html += '</select>' +
 					' </div>' +
 					' <div class="col-md-3 align-self-end">' +
 					' <a class="btn btn-primary" id="add_permission">Tambah</a>' +
 					'</div>' +
 					'</div>' +

 					'<div class="table-responsive ">' +
 					'<table class="table table-striped dt-responsive nowrap" id="permission_table">' +
 					'<thead>' +

 					' <th scope="col">#</th>' +
 					' <th scope="col">Menu</th>' +


 					'<th scope="col"></th>' +
 					'</thead>' +
 					'<tbody id="tdlm" class="tdlm" style="overflow-y:auto;height:200px;overflow-y:auto;width: 100%;">';
 				for (i = 0; i < response.permission.length; i++) {
 					cnt = i + 1;
 					html += '<tr>';

 					html += '<td>' + cnt + '</td>' +
 						'<td>' + response.permission[i].vc_menu_name + '</td>' +
 						' <td> <a id="delete_permission" value="' + response.permission[i].nu_id + '" class="badge bg-danger deleteunit">Delete</a></td>' +
 						'</tr>';

 				}
 				html += '</tbody>' +

 					' <tfoot>' +
 					'<tr>' +
 					'<th colspan="4"></th>' +
 					' </tr>' +
 					'</tfoot>' +

 					' </table>' +


 					'</div>' +
 					'</form>';



 				foot += '<button class="btn btn-secondary" type="button"  data-bs-dismiss="modal">Close</button>';



 				$('#editModal-head').html(htmd);
 				$('#editModal-body').html(html);
 				$('#editModal-foot').html(foot);

 				$('#editModal').modal('show');


 				$('#generate_updt').on('click', function (e) {
 					$('#password_updt').val(randomString(10));

 				})

 			}


 		});
 	});

 	$(document).on('click', '#add_permission', function () {

 		var permission = $('#permission').val();
 		var id_role = $('#role_ids').val();


 		$.ajax({
 			url: "Management_Permission/add_permission",
 			method: "POST",
 			async: true,
 			dataType: 'json',
 			data: {

 				id: id_role,
 				id_permission: permission,



 			},
 			success: function (response) {

 				var html = "";
 				var cnt = 1;



 				for (i = 0; i < +response.permission.length; i++) {

 					html += '<tr>';

 					html += '<td>' + cnt + '</td>' +
 						' <td>' + response.permission[i].vc_menu_name + '</td>' +
 						' <td> <a id="delete_permission" value="' + response.permission[i].nu_id + '" class="badge bg-danger deleteunit">Delete</button></a>' +
 						'</tr>';
 					cnt++;
 				}


 				$("#tdlm").hide().html(html).fadeIn('fast');
 				t.ajax.reload();
 			}

 		});





 	});
 	$(document).on('click', '#delete_permission', function () {

 		var id = $(this).attr("value");
 		var id_role = $('#role_ids').val();


 		$.ajax({
 			url: "Management_Permission/delete_permission",
 			method: "POST",
 			async: true,
 			dataType: 'json',
 			data: {
 				id_role: id_role,
 				id: id,

 			},
 			success: function (response) {

 				var html = "";
 				var cnt = 1;


 				for (i = 0; i < +response.permission.length; i++) {

 					html += '<tr>';

 					html += '<td>' + cnt + '</td>' +
 						' <td>' + response.permission[i].vc_menu_name + '</td>' +
 						' <td> <a id="delete_permission" value="' + response.permission[i].nu_id + '" class="badge bg-danger deleteunit">Delete</button></a>' +
 						'</tr>';
 					cnt++;
 				}


 				$("#tdlm").hide().html(html).fadeIn('fast');
 				t.ajax.reload();


 			}

 		});




 	});


 });
