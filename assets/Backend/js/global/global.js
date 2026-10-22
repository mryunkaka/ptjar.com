function terbilang(angka) {

	var bilne = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];

	if (angka < 12) {

		return bilne[angka];

	} else if (angka < 20) {

		return terbilang(angka - 10) + " Belas";

	} else if (angka < 100) {

		return terbilang(Math.floor(parseInt(angka) / 10)) + " Puluh " + terbilang(parseInt(angka) % 10);

	} else if (angka < 200) {

		return "Seratus " + terbilang(parseInt(angka) - 100);

	} else if (angka < 1000) {

		return terbilang(Math.floor(parseInt(angka) / 100)) + " Ratus " + terbilang(parseInt(angka) % 100);

	} else if (angka < 2000) {

		return "Seribu " + terbilang(parseInt(angka) - 1000);

	} else if (angka < 1000000) {

		return terbilang(Math.floor(parseInt(angka) / 1000)) + " Ribu " + terbilang(parseInt(angka) % 1000);

	} else if (angka < 1000000000) {

		return terbilang(Math.floor(parseInt(angka) / 1000000)) + " Juta " + terbilang(parseInt(angka) % 1000000);

	} else if (angka < 1000000000000) {

		return terbilang(Math.floor(parseInt(angka) / 1000000000)) + " Milyar " + terbilang(parseInt(angka) % 1000000000);

	} else if (angka < 1000000000000000) {

		return terbilang(Math.floor(parseInt(angka) / 1000000000000)) + " Trilyun " + terbilang(parseInt(angka) % 1000000000000);

	}

}

function randomString(length) {
	var result = '';
	var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	var charactersLength = characters.length;
	for (var i = 0; i < length; i++) {
		result += characters.charAt(Math.floor(Math.random() *
			charactersLength));
	}
	return result;
}

function thousands_separators(num) {
	var num_parts = num.toString().split("@");
	num_parts[0] = num_parts[0].replace(/,/g, "");
	var val1 = num_parts.join("@");
	//tambah comma
	num_parts[0] = val1.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	var val2 = num_parts;
	return val2;
}

function month_name(num) {

	var months = ["January", "February", "Maret", "April", "May", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
	var d = new Date(num);
	var monthName = months[d.getMonth()];
	var year = d.getFullYear();

	var balik = monthName + ' ' + year;
	return balik;
}

function input_bulan(num) {


	var dateObj = new Date(num);
	var month = ("0" + (dateObj.getMonth() + 1)).slice(-2); //months from 1-12
	var year = dateObj.getFullYear();
	if (year < 1980) {
		var result = '';
	} else {
		var result = year + '-' + month;
	}
	return result;
}

function full_month_name(num) {

	var months = ["January", "February", "Maret", "April", "May", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
	var d = new Date(num);
	var monthName = months[d.getMonth()];
	var year = d.getFullYear();
	var date = d.getDate();

	var balik = date + '' + monthName + ' ' + year;
	return balik;
}
