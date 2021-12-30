<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taskController;
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
    return view('welcome');
});
Route::get('/Login', [taskController::class, 'Login']);
Route::post('DoLogin', [taskController::class, 'DoLogin']);
Route::get('/register', function () {
    return view('tasks.register');
});
Route::get('logout', [taskController::class, 'logout'])->middleware('AdminAuth');
Route::post('/doRegister',[taskController::class,'doRegister']);
Route::resource('Tasks', taskController::class)->middleware('AdminAuth')  ;
//->middleware('AdminAuth')
