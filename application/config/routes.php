<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Frontend/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['robots.txt'] = 'Site_seo/robots';
$route['sitemap.xml'] = 'Site_seo/sitemap';



$route['sitemanager'] = 'auth';
// informasi perusahaan
$route['Profil_Perusahaan'] = 'Frontend/profil_perusahaan';
$route['Dewan_Komisaris'] = 'Frontend/dewan_komisaris';
$route['Direksi'] = 'Frontend/direksi';
$route['Tanggung_Jawab_Dewan_Komisaris'] = 'Frontend/tugas_tanggungjawab_dewan_komisaris';
$route['Tanggung_Jawab_Direksi'] = 'Frontend/tugas_tanggungjawab_direksi';
$route['Komite_Audit'] = 'Frontend/komite_audit';
$route['Sekertaris_Perusahaan'] = 'Frontend/sekertaris_perusahaan';
$route['Struktur_Organisasi'] = 'Frontend/struktur_organisasi';
$route['Struktur_Group'] = 'Frontend/struktur_group';
$route['Pemegang_Saham'] = 'Frontend/pemegang_saham';
$route['Area_Kerja'] = 'Frontend/area_kerja';

// Keberlanjutan
$route['Proses_Kerja'] = 'Frontend/proses_kerja_perusahaan';
$route['Pencapaian_Perusahaan'] = 'Frontend/pencapaian_perusahaan';
$route['Target_Produksi'] = 'Frontend/target_produksi';

// Media
#Berita
$route['Berita'] = 'Frontend_Media/news';
$route['Berita/pages/(:any)'] = 'Frontend_Media/news/$1';
$route['Berita/pages'] = 'Frontend_Media/news';
$route['Berita/(:any)'] = 'Frontend_Media/news_detail/$1';
#siaran Pers
$route['Siaran_Pers'] = 'Frontend_Media/pers';
$route['Siaran_Pers/pages/(:any)'] = 'Frontend_Media/pers/$1';
$route['Siaran_Pers/pages'] = 'Frontend_Media/pers';
$route['Siaran_Pers/(:any)'] = 'Frontend_Media/pers_detail/$1';
#Search
$route['Search'] = 'Frontend_Media/search';
// $route['Search(:any)'] = 'Frontend_Media/pers/$1';
$route['Siaran_Pers/pages'] = 'Frontend_Media/pers';
$route['Siaran_Pers/(:any)'] = 'Frontend_Media/pers_detail/$1';


// hubunngan investor
$route['Informasi_Keuangan'] = 'Frontend_Hubungan_investor/informasi_keuangan';
$route['Informasi_Produksi'] = 'Frontend_Hubungan_investor/informasi_Produksi';
$route['Rilis_Perusahaan'] = 'Frontend_Hubungan_investor/rilis_perusahaan';
$route['Rups-Rupslb'] = 'Frontend_Hubungan_investor/rups';
$route['Tindakan_Korporasi'] = 'Frontend_Hubungan_investor/tindakan_korporasi';
$route['Laporan_Tahunan'] = 'Frontend_Hubungan_investor/laporan_tahunan';
$route['Laporan_Bulanan'] = 'Frontend_Hubungan_investor/laporan_bulanan';






// Tanggung jawab sosial
$route['Kegiatan_Sosial'] = 'Frontend/kegiatan_sosial';
$route['Kebijakan_Kesehatan'] = 'Frontend/kegiatan_k3';
