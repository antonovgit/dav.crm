<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\Test\MainController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get('/', [MainController::class, 'index']);

Route::post('post', [MainController::class, 'testPost']);

Route::put('/', [MainController::class, 'testPut']);

Route::get('html', [MainController::class, 'html']);

Route::any('test', [MainController::class, 'testAny']);
*/

Route::get('/', [MainController::class, 'index']);

Route::get('create', [RolesController::class, 'create']);
Route::get('index', [RolesController::class, 'index']);


Route::get('roles/{role}', [RolesController::class, 'show']); //!Параметр должен совпадать с названием модели
//Route::get('roles/{role}/{date}', [RolesController::class, 'show']); //http://dav.crm/roles/2/321
//Route::get('roles/{role}/{date?}', [RolesController::class, 'show']); //http://dav.crm/roles/2
/*Route::get('roles/{role}', function ($role) {
    dd($role);
});*/
/*Route::get('roles/1', function () {
    dd(['test']);
});*/