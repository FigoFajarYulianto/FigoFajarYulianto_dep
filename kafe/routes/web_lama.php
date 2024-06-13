<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backs\LoginController;
use App\Http\Controllers\Backs\DashboardController;
use App\Http\Controllers\Backs\UserController;
use App\Http\Controllers\Backs\LevelController;
use App\Http\Controllers\Backs\CategoryController;
use App\Http\Controllers\Backs\StatusOrderController;
use App\Http\Controllers\Backs\StatusConsultationController;
use App\Http\Controllers\Backs\SettingController;
use App\Http\Controllers\Backs\ProfileController;
use App\Http\Controllers\Backs\CategoryConsultationController;
use App\Http\Controllers\Backs\ConsultationrepliesController;
use App\Http\Controllers\Backs\OrderItemController;
use App\Http\Controllers\Backs\OrderController;
use App\Http\Controllers\Backs\OrderkasirController;

// Home
use App\Http\Controllers\Fronts\HomeController;
// Detail Order
use App\Http\Controllers\Fronts\DetailOrderController;
// Whatsapp
use App\Http\Controllers\Backs\WhatsappControllers as BackendWhatsappController;

// Registrasi Konsultasi
use App\Http\Controllers\Fronts\ConsultationController;

// Layout
use App\Http\Controllers\Backs\SliderController;
use App\Http\Controllers\Backs\MenuController;
use App\Http\Controllers\Backs\MenuNavController;

use App\Http\Controllers\Backs\KonsultasiController;
use App\Http\Controllers\Fronts\ConsultationRepliesController as FrontsConsultationRepliesController;

// Pendapatan
use App\Http\Controllers\Backs\PendapatanController;

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

// Halaman fronts
Route::get('/', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'search'])->name('search');
Route::post('/orders', [HomeController::class, 'store']);
Route::get('/api/orders/createinv', [HomeController::class, 'createinv']);
// Detail Order
Route::get('/detail/orders/{orders:id}/detail', [DetailOrderController::class, 'detail']);

// Registrasi Konsultasi
Route::get('/register/consultation', [ConsultationController::class, 'register']);
Route::post('/register/consultation/order', [ConsultationController::class, 'createconsultation']);
Route::post('/register/consultation/store', [ConsultationController::class, 'store']);
Route::get('/api/consultations/createinv', [ConsultationController::class, 'createinv']);

// Balasan Konsultasi
Route::get('/consultation/replies/{consultations:id}', [FrontsConsultationRepliesController::class, 'show']);
Route::post('/consultation/reply/{consultations:id}', [FrontsConsultationRepliesController::class, 'reply']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard1', [DashboardController::class, 'index']);

    // route untuk dashboard
    Route::middleware([
        'auth', 'roles'
    ])->group(function () {

        // Route::get('/', function () {
        //     return view('welcome');
        // });

        //User
        // user
        Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/dashboard/createuser', [UserController::class, 'create'])->name('users.create');
        Route::post('/dashboard/createuser', [UserController::class, 'store'])->name('users.store');
        Route::get('/dashboard/users/{user:id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/dashboard/users/{user:id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/dashboard/users/{user:id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Level User
        Route::get('/dashboard/levels', [LevelController::class, 'index'])->name('levels.index');
        Route::post('/dashboard/levels', [LevelController::class, 'store'])->name('levels.store');
        Route::get('/dashboard/levels/{level:id}/edit', [LevelController::class, 'edit'])->name('levels.edit');
        Route::put('/dashboard/levels/{level:id}', [LevelController::class, 'update'])->name('levels.update');
        Route::delete('/dashboard/levels/{level:id}', [LevelController::class, 'destroy'])->name('levels.destroy');

        // Hidangan kategori
        Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.index');
        // Route::get('/dashboard/categories', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/dashboard/categories/{category:id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/dashboard/categories/{category:id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/dashboard/categories/{category:id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/dashboard/categories/{category:id}', [CategoryController::class, 'show'])->name('categories.show');


        // Status Order
        Route::get('/dashboard/statusorders', [StatusOrderController::class, 'index'])->name('statusorders.index');
        // Route::get('/dashboard/statusorders', [StatusOrderController::class, 'create'])->name('statusorders.create');
        Route::post('/dashboard/statusorders', [StatusOrderController::class, 'store'])->name('statusorders.store');
        Route::get('/dashboard/statusorders/{statusorder:id}/edit', [StatusOrderController::class, 'edit'])->name('statusorders.edit');
        Route::put('/dashboard/statusorders/{statusorder:id}', [StatusOrderController::class, 'update'])->name('statusorders.update');
        Route::delete('/dashboard/statusorders/{statusorder:id}', [StatusOrderController::class, 'destroy'])->name('statusorders.destroy');
        Route::get('/dashboard/statusorders/{statusorder:id}', [StatusOrderController::class, 'show'])->name('statusorders.show');


        // Status Consultasi
        Route::get('/dashboard/statusconsultations', [StatusConsultationController::class, 'index'])->name('statusconsultations.index');
        // Route::get('/dashboard/statusconsultations', [StatusConsultationController::class, 'create'])->name('statusconsultations.create');
        Route::post('/dashboard/statusconsultations', [StatusConsultationController::class, 'store'])->name('statusconsultations.store');
        Route::get('/dashboard/statusconsultations/{statusconsultation:id}/edit', [StatusConsultationController::class, 'edit'])->name('statusconsultations.edit');
        Route::put('/dashboard/statusconsultations/{statusconsultation:id}', [StatusConsultationController::class, 'update'])->name('statusconsultations.update');
        Route::delete('/dashboard/statusconsultations/{statusconsultation:id}', [StatusConsultationController::class, 'destroy'])->name('statusconsultations.destroy');
        Route::get('/dashboard/statusconsultations/{statusconsultation:id}', [StatusConsultationController::class, 'show'])->name('statusconsultations.show');



        // Categori Consultasi
        Route::get('/dashboard/categoryconsultations', [CategoryConsultationController::class, 'index'])->name('categoryconsultations.index');
        // Route::get('/dashboard/statusconsultations', [StatusConsultationController::class, 'create'])->name('statusconsultations.create');
        Route::post('/dashboard/categoryconsultations', [CategoryConsultationController::class, 'store'])->name('categoryconsultations.store');
        Route::get('/dashboard/categoryconsultations/{categoryconsultation:id}/edit', [CategoryConsultationController::class, 'edit'])->name('categoryconsultations.edit');
        Route::put('/dashboard/categoryconsultations/{categoryconsultation:id}', [CategoryConsultationController::class, 'update'])->name('categoryconsultations.update');
        Route::delete('/dashboard/categoryconsultations/{categoryconsultation:id}', [CategoryConsultationController::class, 'destroy'])->name('categoryconsultations.destroy');
        Route::get('/dashboard/categoryconsultations/{categoryconsultation:id}', [CategoryConsultationController::class, 'show'])->name('categoryconsultations.show');

        // Pengaturan Website admin
        Route::get('/dashboard/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/dashboard/settings/{setting:id}', [SettingController::class, 'update'])->name('settings.update');

        // profile
        Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/dashboard/profile/{user:id}', [ProfileController::class, 'update'])->name('profile.update');

        // Whatsapp
        Route::get('/dashboard/whatsapp/histories', [BackendWhatsappController::class, 'index'])->name('whatsapp.index');
        Route::get('/dashboard/whatsapp/scan', [BackendWhatsappController::class, 'scan'])->name('whatsapp.scan');
        Route::get('/dashboard/whatsapp/auth', [BackendWhatsappController::class, 'getqr'])->name('whatsapp.auth');
        Route::get('/dashboard/whatsapp/reset', [BackendWhatsappController::class, 'reset'])->name('whatsapp.reset');
        Route::post('/dashboard/whatsapp/resend/{walog:id}', [BackendWhatsappController::class, 'resend'])->name('whatsapp.resend');
        Route::delete('/dashboard/whatsapp/destroy/{walog:id}', [BackendWhatsappController::class, 'destroy'])->name('whatsapp.destroy');


        // Layout

        //sliders
        Route::get('/dashboard/sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/dashboard/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/dashboard/sliders/create', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/dashboard/sliders/{slider:id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/dashboard/sliders/{slider:id}', [SliderController::class, 'update'])->name('sliders.update');
        Route::delete('/dashboard/sliders/{slider:id}', [SliderController::class, 'destroy'])->name('sliders.destroy');

        // Menu
        Route::get('/dashboard/menus', [MenuController::class, 'index'])->name('menus.index');
        Route::get('/dashboard/menus/create', [MenuController::class, 'create'])->name('menus.create');
        Route::post('/dashboard/menus/create', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/dashboard/menus/{menu:id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
        Route::put('/dashboard/menus/{menu:id}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/dashboard/menus/{menu:id}', [MenuController::class, 'destroy'])->name('menus.destroy');
        Route::get('/dashboard/menus/{menu:id}', [MenuController::class, 'show'])->name('menus.show');

        // Menu Nav - Bar
        Route::get('/dashboard/menusnav', [MenuNavController::class, 'index'])->name('menusnav.index');
        // Route::get('/dashboard/menusnav/create', [MenuNavController::class, 'create'])->name('menunav.create');
        Route::post('/dashboard/menusnav/create', [MenuNavController::class, 'store'])->name('menusnav.store');
        Route::get('/dashboard/menusnav/{menunav:id}', [MenuNavController::class, 'show'])->name('menusnav.show');
        Route::put('/dashboard/menusnav/{menunav:id}', [MenuNavController::class, 'update'])->name('menusnav.update');
        Route::delete('/dashboard/menusnav/{menunav:id}', [MenuNavController::class, 'destroy'])->name('menusnav.destroy');


        // Order
        Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/dashboard/orders/advancesearchorders', [OrderController::class, 'advance'])->name('advance_search_orders');
        Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/dashboard/orders/create', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/dashboard/orders/{order:id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/dashboard/orders/{order:id}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/dashboard/orders/{order:id}', [OrderController::class, 'destroy'])->name('orders.destroy');



        // Order Kasir
        Route::get('/dashboard/kasir/orders', [OrderkasirController::class, 'index'])->name('orderskasir.index');
        Route::get('/dashboard/kasir/orders/create', [OrderkasirController::class, 'create'])->name('orderskasir.create');
        Route::post('/dashboard/kasir/orders/create', [OrderkasirController::class, 'store'])->name('orderskasir.store');
        Route::get('/dashboard/kasir/orders/{order:id}/edit', [OrderkasirController::class, 'edit'])->name('orderskasir.edit');
        Route::put('/dashboard/kasir/orders/{order:id}', [OrderkasirController::class, 'update'])->name('orderskasir.update');
        Route::delete('/dashboard/kasir/orders/{order:id}', [OrderkasirController::class, 'destroy'])->name('orderskasir.destroy');


        // Pendapatan
        Route::get('/dashboard/pendapatans', [PendapatanController::class, 'index'])->name('pendapatans.index');
        Route::get('/dashboard/pendapatansdetail', [PendapatanController::class, 'detail'])->name('pendapatans.detail');


        // Order Item
        Route::get('/dashboard/orderitems', [OrderItemController::class, 'index'])->name('orderitems.index');
        Route::get('/dashboard/orderitems/create', [OrderItemController::class, 'create'])->name('orderitems.create');
        Route::post('/dashboard/orderitems/create', [OrderItemController::class, 'store'])->name('orderitems.store');
        Route::get('/dashboard/orderitems/{orderitem:id}/edit', [OrderItemController::class, 'edit'])->name('orderitems.edit');
        Route::put('/dashboard/orderitems/{orderitem:id}', [OrderItemController::class, 'update'])->name('orderitems.update');
        Route::delete('/dashboard/orderitems/{orderitem:id}', [OrderItemController::class, 'destroy'])->name('orderitems.destroy');
        Route::get('/dashboard/orderitems/{orderitem:id}', [OrderItemController::class, 'show'])->name('orderitems.show');

        // consultationreplies
        Route::get('/dashboard/consultationreplies', [ConsultationrepliesController::class, 'index'])->name('consultationreplies.index');
        Route::get('/dashboard/consultationreplies/create', [ConsultationrepliesController::class, 'create'])->name('consultationreplies.create');
        Route::post('/dashboard/consultationreplies/create', [ConsultationrepliesController::class, 'store'])->name('consultationreplies.store');
        Route::get('/dashboard/consultationreplies/{consultationreplie:id}/edit', [ConsultationrepliesController::class, 'edit'])->name('consultationreplies.edit');
        Route::put('/dashboard/consultationreplies/{consultationreplie:id}', [ConsultationrepliesController::class, 'update'])->name('consultationreplies.update');
        Route::delete('/dashboard/consultationreplies/{consultationreplie:id}', [ConsultationrepliesController::class, 'destroy'])->name('consultationreplies.destroy');

        // Konsultasi
        Route::get('/dashboard/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
        Route::get('/dashboard/konsultasi/create', [KonsultasiController::class, 'create'])->name('konsultasi.create');
        Route::post('/dashboard/konsultasi/create', [KonsultasiController::class, 'store'])->name('konsultasi.store');
        Route::get('/dashboard/konsultasi/{konsultasi:id}/edit', [KonsultasiController::class, 'edit'])->name('konsultasi.edit');
        Route::put('/dashboard/konsultasi/{konsultasi:id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');
        Route::delete('/dashboard/konsultasi/{konsultasi:id}', [KonsultasiController::class, 'destroy'])->name('konsultasi.destroy');
        Route::delete('/dashboard/konsultasi/reply/{id}', [KonsultasiController::class, 'destroy_reply'])->name('konsultasi.destroy_reply');
    });
});


// login
Route::group(['middleware' => ['guest']], function () {
    Route::get('/auth', [LoginController::class, 'index'])->name('login');
    Route::post('/auth/login', [LoginController::class, 'login']);
    Route::get('/auth/forgot', [LoginController::class, 'forgot']);
    Route::post('/auth/reset', [LoginController::class, 'reset']);
    Route::get('/auth/confirm', [LoginController::class, 'confirm']);
    Route::put('/auth/newpassword', [LoginController::class, 'newpassword']);
});

// logout
Route::group(['middleware' => ['auth']], function () {
    Route::get('/auth/logout', [LoginController::class, 'logout']);
});
