 var base_url = $('#base').val();


 $('#delete_preview').on('click', function (e) {

 	var id_delete = $('#id_deleted').val();
 	console.log(id_delete);


 	$.ajax({
 		url: "../delete_berita_preview",
 		method: "POST",

 		dataType: 'json',
 		data: {
 			id_deleted: id_delete
 		},

 		success: function (response) {

 			// var htmls = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
 			// 	'<strong>' + response.message + '</strong>' +
 			// 	'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
 			// 	'</button>' +
 			// 	'</div>';

 			// $('#messages').html(htmls);
 			window.location = base_url + "Management_Siaran_Pers";
 			$('#basicModal').modal('hide');


 		}


 	});
 })
