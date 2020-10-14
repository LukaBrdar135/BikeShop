<?php

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

use App\Http\Controllers\ProizvodController;
use App\Proizvod;
use App\User;


Route::get('/', function () {
    //
    return view('pocetna');
});


// svi proizvodi
Route::get('/proizvodi/svi', 'ProizvodController@index');
Route::get('/proizvodi/svi/{brend}', 'ProizvodController@sviPoBrendu');

// kategorija
Route::get('/proizvodi/{kategorija}', 'ProizvodController@sviPoKategoriji');
Route::get('/proizvodi/{kategorija}/{brend}', 'ProizvodController@kategorijaPoBrendu');

// potkategorija
Route::get('/proizvodi/{kategorija}/{potkategorija}/svi', 'ProizvodController@sviPoPotkategoriji');
Route::get('/proizvodi/{kategorija}/{potkategorija}/{brend}', 'ProizvodController@potkategorijaPoBrendu');

//pretraga
Route::post('/proizvodi/pretraga', 'ProizvodController@rezultatPretrage')->name('pretraga');

//detalji proizvoda
Route::get('/proizvod/{proizvodId}','ProizvodController@detaljiProizvoda');

//korpa
Route::get('/proizvod/dodaj-u-korpu/{id}', 'KorpaController@dodajUKorpu')->name('dodajUKorpu');
Route::get('/korpa', 'KorpaController@korpa');
Route::get('/korpa/smanji/{id}', 'KorpaController@smanjiKolicinu');
Route::get('/korpa/izbaci/{id}','KorpaController@izbaciIzKorpe');
Route::get('korpa/naplata', 'KorpaController@naplata');
Route::post('korpa/naplati','KorpaController@naplataPost');


//reklamacija
Route::get('/reklamacija','ReklamacijaController@index');
Route::post('/reklamacijaPost', 'ReklamacijaController@reklamacijaPost');

//pregled racuna
Route::get('/racuni','RacunController@pregledStarihRacuna');
Route::get('/racuni/{id}','RacunController@detaljiRacuna');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//admin grupa
Route::group(['middleware'=> ['auth'=>'admin']],function(){
    Route::get('/admin','AdminController@index');
    Route::get('/admin/proizvodi','AdminController@sviProizvodi');
    Route::get('/admin/proizvod/{proizvodId}','AdminController@azurirajProizvod');
    Route::post('/admin/proizvod/azuriraj','AdminController@azurirajProizvodPost');
    Route::get('/admin/proizvod/{proizvodId}/spec','AdminController@azurirajProizvodSpec');
    Route::post('/admin/proizvod/azuriraj/spec','AdminController@azurirajProizvodSpecPost');
    Route::get('/admin/proizvodi/dodajProizvod','AdminController@dodajProizvod');
    Route::post('/admin/proizvod/dodajProizvodPost','AdminController@dodajProizvodPost');
    Route::get('/admin/proizvod/obrisiProizvod/{id}','AdminController@obrisiProizvod');

    //admin racuni
    Route::get('/admin/racuni/svi', 'AdminController@sviRacuni');
    Route::get('/admin/racuni/{id}', 'AdminController@racun');

    //admin reklamacije
    Route::get('/admin/reklamacije/sve', 'AdminController@sveReklamacije');
    Route::get('/admin/reklamacije/{id}', 'AdminController@reklamacija');
    Route::post('/admin/reklamacije/posaljiOdgovor', 'AdminController@posaljiOdgovor');

    //ovo 1 da se pozove ako mora
    Route::get('/admin/linkStorage', function () {
        Artisan::call('storage:link');
    });
});