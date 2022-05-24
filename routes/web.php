<?php

use Illuminate\Support\Facades\Route;
use App\Models\Factory;

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

Route::get('/', function () {
    $factory = new Factory();
    $page = $factory->getPagesFactory()->createMainPage();
    return view('main', ['page' => $page]);
});

require __DIR__ . '/../src/Common/Laravel/routes.php';
require __DIR__ . '/../src/Modules/JsonObjects/Laravel/routes.php';
