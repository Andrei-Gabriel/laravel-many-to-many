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


// Area pubblica - FrontOffice
Route::get('/', function () {
    return view('welcome');
});
// Rotte per autenticazione
Auth::routes();


// Area privata - BackOffice
/*
    Dichiariamo delle rotte prefissate con admin: Route::prefix("admin")
    Il namespace di questi controllers (es: PostController.php) saranno all'interno della cartella Admin: namespace("admin")
    Ci evita di aggiungere un costruttore con il codice this->middleware("auth") per tutti i controller che vogliamo 
        proteggere da autenticazione: middleware("auth")
    group(function(){}); perché creiamo un gruppo che ha queste info di base
*/
Route::prefix("admin")->namespace("admin")->middleware("auth")->group(function(){
    // Qui aggiungiamo le rotte di una risorsa a cui devone essere applicate le tre regole (riga 33)
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource("posts", "PostController");
    Route::resource("categories", "CategoryController");
    Route::resource("tags", "TagController");
});

// php artisan route:list
// Route::get('/home', 'HomeController@index')->name('home'); (riga 35)
// Spostiamo il file HomeComtroller dentro la cartella Admin
// php artisan route:list