<?php


use Illuminate\Support\Facades\Route;

//untuk index menu utama
//Route::get('/', [ManagementUserController::class, 'index']);

//untuk index di sub menu
//Route::resource('user', ManagementUserController::class);

 //route::get("/home", function (){
   // return view("home");
//});
Route::get('/', function (){
return view('welcome');
 });

 Route::get('/home', function (){
  return view('frontend.home');
   });

 