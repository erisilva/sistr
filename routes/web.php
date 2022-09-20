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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin','namespace' => 'Auth'],function(){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::get('/', 'HomeController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('index');

Route::prefix('admin')->namespace('Admin')->group(function () {
    /*  Operadores */
    // nota mental :: as rotas extras devem ser declaradas antes de se declarar as rotas resources
    Route::get('/users/password', 'ChangePasswordController@showPasswordUpdateForm')->name('users.password');
    Route::put('/users/password/update', 'ChangePasswordController@passwordUpdate')->name('users.passwordupdate');
    // relatorios
    Route::get('/users/export/csv', 'UserController@exportcsv')->name('users.export.csv');
    Route::get('/users/export/xls', 'UserController@exportxls')->name('users.export.xls');
    Route::get('/users/export/pdf', 'UserController@exportpdf')->name('users.export.pdf');
    // crud
    Route::resource('/users', 'UserController');

    /* Permissões */
    # relatorios
    Route::get('/permissions/export/csv', 'PermissionController@exportcsv')->name('permissions.export.csv');
    Route::get('/permissions/export/xls', 'PermissionController@exportxls')->name('permissions.export.xls');
    Route::get('/permissions/export/pdf', 'PermissionController@exportpdf')->name('permissions.export.pdf');
    #crud
    Route::resource('/permissions', 'PermissionController');

    /* Perfis */
    # relatorios
    Route::get('/roles/export/csv', 'RoleController@exportcsv')->name('roles.export.csv');
    Route::get('/roles/export/xls', 'RoleController@exportxls')->name('roles.export.xls');
    Route::get('/roles/export/pdf', 'RoleController@exportpdf')->name('roles.export.pdf');
    # crud
    Route::resource('/roles', 'RoleController');
});

Route::get('/situacaos/export/csv', 'SituacaoController@exportcsv')->name('situacaos.export.csv');
Route::get('/situacaos/export/xls', 'SituacaoController@exportxls')->name('situacaos.export.xls');
Route::get('/situacaos/export/pdf', 'SituacaoController@exportpdf')->name('situacaos.export.pdf');
Route::resource('/situacaos', 'SituacaoController');


Route::get('/tipos/export/csv', 'TipoController@exportcsv')->name('tipos.export.csv');
Route::get('/tipos/export/xls', 'TipoController@exportxls')->name('tipos.export.xls');
Route::get('/tipos/export/pdf', 'TipoController@exportpdf')->name('tipos.export.pdf');
Route::resource('/tipos', 'TipoController');

Route::get('/responsavels/export/csv', 'ResponsavelController@exportcsv')->name('responsavels.export.csv');
Route::get('/responsavels/export/xls', 'ResponsavelController@exportxls')->name('responsavels.export.xls');
Route::get('/responsavels/export/pdf', 'ResponsavelController@exportpdf')->name('responsavels.export.pdf');
Route::resource('/responsavels', 'ResponsavelController');

Route::get('/origems/export/csv', 'OrigemController@exportcsv')->name('origems.export.csv');
Route::get('/origems/export/xls', 'OrigemController@exportxls')->name('origems.export.xls');
Route::get('/origems/export/pdf', 'OrigemController@exportpdf')->name('origems.export.pdf');
Route::resource('/origems', 'OrigemController');

Route::get('/deliberacaos/export/csv', 'DeliberacaoController@exportcsv')->name('deliberacaos.export.csv');
Route::get('/deliberacaos/export/xls', 'DeliberacaoController@exportxls')->name('deliberacaos.export.xls');
Route::get('/deliberacaos/export/pdf', 'DeliberacaoController@exportpdf')->name('deliberacaos.export.pdf');
Route::resource('/deliberacaos', 'DeliberacaoController');

Route::get('/modalidades/export/csv', 'ModalidadeController@exportcsv')->name('modalidades.export.csv');
Route::get('/modalidades/export/xls', 'ModalidadeController@exportxls')->name('modalidades.export.xls');
Route::get('/modalidades/export/pdf', 'ModalidadeController@exportpdf')->name('modalidades.export.pdf');
Route::resource('/modalidades', 'ModalidadeController');

Route::get('/pregoeiros/export/csv', 'PregoeiroController@exportcsv')->name('pregoeiros.export.csv');
Route::get('/pregoeiros/export/xls', 'PregoeiroController@exportxls')->name('pregoeiros.export.xls');
Route::get('/pregoeiros/export/pdf', 'PregoeiroController@exportpdf')->name('pregoeiros.export.pdf');
Route::resource('/pregoeiros', 'PregoeiroController');

Route::put('/trs/editnumber/{tr}', 'TrController@editnumber')->name('trs.editnumber');
Route::get('/trs/export/csv', 'TrController@exportcsv')->name('trs.export.csv');
Route::get('/trs/export/xls', 'TrController@exportxls')->name('trs.export.xls');
Route::get('/trs/export/pdf', 'TrController@exportpdf')->name('trs.export.pdf');
Route::get('/trs/export/single/pdf/{tr}', 'TrController@exportsinglepdf')->name('trs.export.single.pdf');
Route::resource('/trs', 'TrController');

Route::get('/trlogs/export/csv', 'TrlogController@exportcsv')->name('trlogs.export.csv');
Route::get('/trlogs/export/xls', 'TrlogController@exportxls')->name('trlogs.export.xls');
Route::get('/trlogs/export/pdf', 'TrlogController@exportpdf')->name('trlogs.export.pdf');
Route::resource('/trlogs', 'TrlogController')->only(['index']);
