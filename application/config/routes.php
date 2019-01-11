<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'ControllerLogin';
$route['404_override'] = 'ControllerLogin/not_found';
$route['translate_uri_dashes'] = FALSE;

//dashboard
$route['dashboard'] = 'ControllerDashboard';

//login
$route['login/auth'] = 'ControllerLogin/login';
$route['login/logout'] = 'ControllerLogin/logout';

//pelanggan
$route['pelanggan'] = 'ControllerPelanggan';
$route['pelanggan/data_pelanggan'] = 'ControllerPelanggan/data_pelanggan';
$route['pelanggan/simpan'] = 'ControllerPelanggan/simpan';
$route['pelanggan/ubah'] = 'ControllerPelanggan/ubah';
$route['pelanggan/get_pelanggan'] = 'ControllerPelanggan/get_pelanggan';
$route['pelanggan/hapus'] = 'ControllerPelanggan/hapus';
$route['pelanggan/getKode'] = 'ControllerPelanggan/getKode';

//barang
$route['barang'] = 'ControllerBarang';
$route['barang/copy_barang'] = 'ControllerBarang/copy_barang';
$route['barang/data_barang'] = 'ControllerBarang/data_barang';
$route['barang/simpan'] = 'ControllerBarang/simpan';
$route['barang/ubah'] = 'ControllerBarang/ubah';
$route['barang/get_barang'] = 'ControllerBarang/get_barang';
$route['barang/hapus'] = 'ControllerBarang/hapus';
$route['barang/getKode'] = 'ControllerBarang/getKode';

//pesan
$route['pesan'] = 'ControllerPesan';
$route['pesan/data_pesan'] = 'ControllerPesan/data_pesan';
$route['pesan/tambah_pesan'] = 'ControllerPesan/tambah_pesan';
$route['pesan/simpan'] = 'ControllerPesan/simpan';
$route['pesan/simpan_detail'] = 'ControllerPesan/simpan_detail';
$route['pesan/cetak/(:any)'] = 'ControllerPesan/cetak/$1';
$route['pesan/get_pesan'] = 'ControllerPesan/get_pesan';
$route['pesan/get_detail_pesan'] = 'ControllerPesan/get_detail_pesan';
$route['pesan/proses/(:any)'] = 'ControllerPesan/proses/$1';
$route['pesan/getKode'] = 'ControllerPesan/getKode';
$route['pesan/destroy'] = 'ControllerPesan/destroy';
$route['pesan/get_pelanggan'] = 'ControllerPesan/get_pelanggan';

//retur
$route['retur'] = 'ControllerRetur';
$route['retur/tambah_retur'] = 'ControllerRetur/tambah_retur';
$route['retur/data_retur'] = 'ControllerRetur/data_retur';
$route['retur/simpan'] = 'ControllerRetur/simpan';
$route['retur/simpan_detail'] = 'ControllerRetur/simpan_detail';
$route['retur/cetak/(:any)'] = 'ControllerRetur/cetak/$1';
$route['retur/get_retur'] = 'ControllerRetur/get_retur';
$route['retur/get_detail_retur'] = 'ControllerRetur/get_detail_retur';
$route['retur/get_nota'] = 'ControllerRetur/get_nota';
$route['retur/getKode'] = 'ControllerRetur/getKode';
$route['retur/destroy'] = 'ControllerRetur/destroy';
$route['retur/get_barang'] = 'ControllerRetur/get_barang';

//laporan penjualan
$route['laporan_penjualan'] = 'ControllerPenjualan';
$route['laporan_penjualan/cetak'] = 'ControllerPenjualan/cetak';

//laporan retur
$route['laporan_retur'] = 'ControllerLapRetur';
$route['laporan_retur/cetak'] = 'ControllerLapRetur/cetak';

//laporan pesan
$route['laporan_pesan'] = 'ControllerLapPesan';
$route['laporan_pesan/cetak'] = 'ControllerLapPesan/cetak';