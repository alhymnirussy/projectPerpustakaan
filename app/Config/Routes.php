<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');
$routes->get('/buku', 'Buku::index');
// $routes->get('/buku/dataBuku', 'Buku::dataBuku');
// $routes->get('/buku/generate', 'Buku::generate');
// $routes->get('/buku/tambah', 'Buku::tambah');
// $routes->get('/buku/edit', 'Buku::edit');
// $routes->get('/buku/simpan', 'Buku::simpan');
// $routes->get('/buku/update', 'Buku::update');


// $routes->get('/buku/update/(:number)', 'Buku::update/$1');
// $routes->delete('/buku/(:any)', 'Buku::delete/$1');
// $routes->get('/buku/(:any)', 'Buku::detail/$1');

// Anggota

$routes->get('/anggota', 'Anggota::index');
// $routes->get('/anggota/tambah', 'Anggota::tambah');

// pinjam pilih anggota

// $routes->get('/pinjam/pilihAnggota/(:any)', 'Pinjam::pilihAnggota/$1');

// pilih buku
// $routes->get('/pinjam/daftarBuku/(:any)', 'Pinjam::daftarBuku/$1');
// $routes->get('/pinjam/pilihBuku/(:any)/(:any)', 'Pinjam::pilihBuku/$1/$2');
// $routes->get('pinjam/inputTanggal(:any)', 'Pinjam::inputTanggal/$1');

// Denda

// $routes->get('/denda/nonAktif/(:num)', 'Denda::nonAktif/$1');
// $routes->get('/denda/Aktif/(:num)', 'Denda::Aktif/$1');

// Peminjaman Detail
// $routes->get('pinjam/getPeminjamanDetail/(:any)', 'Pinjam::getPeminjamanDetail/$1');








/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
