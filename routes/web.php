<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/coba',function(){
//     return view('penjual.produkadd');
// });
Route::get('/', function () {
    $client = new GuzzleHttp\Client();
    //$request = new \GuzzleHttp\Psr7\Request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=Washington%2C%20DC&destinations=New%20York%20City%2C%20NY&units=imperial&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k');
    //$request = new \GuzzleHttp\Psr7\Request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=42.9814292%2C-70.9477546&destinations=51.5073509%2C-0.1277583&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k');
    $request = new \GuzzleHttp\Psr7\Request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=-8.848198553520579%2C121.6637660808329&destinations=-8.832836631765579%2C121.67777565447375&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k');
    $promise = $client->sendAsync($request)->then(function ($response) {
         echo ($response->getBody());
    });
    $promise->wait();
    //return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'cektoko']], function () {
    //Penjual
    Route::get('/seller/dashboard', 'penjual\PenjualController@dashboard')->name('seller.dashboard');
    //Toko 
    Route::get('/seller/halamanupdatetoko', 'penjual\PenjualController@halamanUpdateToko')->name('seller.halamanupdatetoko');
    //Etalase Produk
    Route::get('/seller/etalase', 'penjual\EtalaseProdukController@index')->name('seller.etalaseindex');
    Route::post('/seller/etalase/store', 'penjual\EtalaseProdukController@store')->name('seller.etalasestore');
    Route::put('/seller/etalase/update/{id}', 'penjual\EtalaseProdukController@update')->name('seller.etalaseupdate');
    Route::delete('/seller/etalase/delete/{id}', 'penjual\EtalaseProdukController@delete')->name('seller.etalasedelete');
    //Produk
    Route::get('/seller/produk', 'penjual\ProdukController@index')->name('seller.produkindex');
    Route::get('/seller/produk/add', 'penjual\ProdukController@add')->name('seller.produkadd');
    Route::get('/seller/produk/edit/{id}', 'penjual\ProdukController@edit')->name('seller.produkedit');
    Route::post('/seller/produk/store', 'penjual\ProdukController@store')->name('seller.produkstore');
    Route::put('/seller/produk/update/{id}', 'penjual\ProdukController@update')->name('seller.produkupdate');
    Route::delete('/seller/produk/delete/{id}', 'penjual\ProdukController@delete')->name('seller.produkdelete');
    Route::delete('/seller/produkimage/delete/{idproduk}/{idgambar}', 'penjual\ProdukController@deleteGambarEdit')->name('seller.gambarprodukdelete');
    //
});
Route::group(['middleware' => ['auth']], function () {
    //Toko
    Route::post('/seller/updatetoko', 'penjual\PenjualController@updateToko')->name('seller.updatetoko');
    Route::post('/seller/storetoko', 'penjual\PenjualController@storeToko')->name('seller.storetoko');
    Route::get('/seller/registoko', 'penjual\PenjualController@regisToko')->name('seller.registoko');

    //Produk Detail
    Route::get('/produkdetail/{id}', 'penjual\ProdukController@detail')->name('user.produkdetail');

    //Keranjang
    Route::get('/keranjang', 'pembeli\KeranjangController@index')->name('user.keranjang');
    Route::get('/keranjang/notif', 'pembeli\KeranjangController@keranjangNotif')->name('user.keranjangnotif');
    Route::post('/keranjang/store', 'pembeli\KeranjangController@store')->name('user.keranjangstore');
    Route::put('/keranjang/update/{id}', 'pembeli\KeranjangController@updateKeranjang')->name('user.keranjangupdte');
    Route::delete('/keranjang/delete/{id}', 'pembeli\KeranjangController@destroy')->name('user.keranjangdestroy');

    //Wishlist
    Route::get('/wishlist', 'pembeli\WishlistController@index')->name('user.wishlist');
    Route::get('/wishlist/store/{id}', 'pembeli\WishlistController@store')->name('user.wishliststore');
    Route::get('/wishlist/storekeranjang/{id}', 'pembeli\WishlistController@addToCart')->name('user.wishlistaddToCart');
    Route::get('/wishlist/destroy/{id}', 'pembeli\WishlistController@destroy')->name('user.wishlistdestroy');

    //Alamat
    Route::get('/alamat', 'pembeli\AlamatController@index')->name('user.alamat');
    Route::post('/alamat/store', 'pembeli\AlamatController@store')->name('user.alamatstore');
    Route::get('/alamat/edit/{id}', 'pembeli\AlamatController@edit')->name('user.alamatedit');
    Route::put('/alamat/update/{id}', 'pembeli\AlamatController@update')->name('user.alamatupdate');
    Route::delete('/alamat/edit/{id}', 'pembeli\AlamatController@destroy')->name('user.alamatdelete');

    // Search
    Route::get('/search', 'pembeli\SearchController@index');
});

Route::get('/midtrans', 'pembeli\TransaksiController@index')->name('coba');
