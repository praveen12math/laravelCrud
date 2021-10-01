<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customAuth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/login', function () {
//     return view('auth.login');
// });

//Route::view('/login', "auth.login");
//Route::view('/register', "auth.register");


Route::group(['middleware' => "web"], function () {

    Route::get("/register", [customAuth::class, 'register']);
    Route::get("/login", [customAuth::class, 'login']);
    Route::post("/register", [customAuth::class, "registerUser"])->name("register-user");
    Route::post("/login", [customAuth::class, "loginUser"])->name("login-user");

    Route::get("/logout", function () {
        if (Session()->has("userId")) {
            Session()->pull("userId");
        }
        return redirect("/login");
    });

    Route::get('/user', [customAuth::class, "dashboard"]);

    Route::group(['middleware' => 'myProtectedRoute'], function(){

        Route::get('/admin', [customAuth::class, "adminDashboard"]);

        Route::get('/update/{id}', [UserController::class, "showUserData"]);
        Route::post('/update', [UserController::class, "UpdateUser"]);
        Route::get('/showUser/{id}', [UserController::class, "seeUserData"]);
        Route::get('/deleteUser/{userId}', [UserController::class, "deleteUser"]);
        Route::post('/addUser', [UserController::class, "addUser"]);
    
    
        Route::post('/addRole', [RoleController::class, "addRole"]);
        Route::get('/seeRole/{id}', [RoleController::class, "seeRole"]);
        Route::get('/deleteRole/{myId}', [RoleController::class, "deleteRole"]);
        Route::get('/showRole/{myId}', [RoleController::class, "showRole"]);
        Route::post('/updateRole', [RoleController::class, "updateRole"]);
    });
   
});
