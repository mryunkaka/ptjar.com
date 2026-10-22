 $(document).ready(function () {


 	var t = $('#crud_table').DataTable({

 		ajax: "Management_Category/get_category_list",

 		columns: [{
 				data: null
 			}, {
 				data: 'vc_category_name'
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
 			cat_name: "required",

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
 				url: "Management_Category/insert_category",
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
 			url: "Management_Category/get_category_id",
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
 				htmd += '<h5 class="modal-title" id="detailModalLabel">Tambah Kategori</h5>' +
 					'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';

 				html +=

 					'<div class="row  mb-2">' +
 					'<div class="col-md-12 position-relative">' +
 					'<label for="validationTooltip02" class="form-label">Nama Kategori</label>' +
 					'<input type="hidden" class="form-control" id="up_cat_id" name="up_cat_id" value="' + response.data[0].nu_id + '">' +
 					'<input type="text" class="form-control" id="up_cat_name" name="up_cat_name" value="' + response.data[0].vc_category_name + '">' +


 					' </div>';



 				foot += '<div class="modal-footer">' +
 					'<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
 					'<a class="btn btn-primary" id="update">Update</a>' +
 					'</div>' +
 					'</div>';









 				$('#editModal-head').html(htmd);
 				$('#editModal-body').html(html);
 				$('#editModal-foot').html(foot);

 				$('#editModal').modal('show');



 			}


 		});
 	});

 	$(document).on('click', '#update', function () {

 		var cat_id = $('#up_cat_id').val();
 		var cat_name = $('#up_cat_name').val();


 		$.ajax({
 			url: "Management_Category/update_category",
 			method: "POST",
 			async: true,
 			dataType: 'json',
 			data: {

 				cat_id: cat_id,
 				cat_name: cat_name,



 			},
 			success: function (response) {

 				var htmls = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
 					'<strong>' + response.message + '</strong>' +
 					'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
 					'</button>' +
 					'</div>';

 				$('#messages').html(htmls);
 				t.ajax.reload();
 				$('#editModal').modal('hide');

 			}

 		});





 	});

 });
