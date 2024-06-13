<?php

use App\Http\Controllers\Api\CampaignController as ApiCampaignController;
use App\Http\Controllers\Api\DistrictController as ApiDistrictController;
use App\Http\Controllers\Api\ProvinceController as ApiProvinceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\BankController;
use App\Http\Controllers\BackEnd\FundController;
use App\Http\Controllers\BackEnd\MenuController;
use App\Http\Controllers\BackEnd\PageController;
use App\Http\Controllers\BackEnd\PostController;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Controllers\BackEnd\AboutController;
use App\Http\Controllers\BackEnd\LevelController;
use App\Http\Controllers\BackEnd\LoginController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\BackEnd\GaleryController;
use App\Http\Controllers\BackEnd\SliderController;
use App\Http\Controllers\BackEnd\StatusController;
use App\Http\Controllers\BackEnd\ProfileController;
use App\Http\Controllers\BackEnd\SectionController;
use App\Http\Controllers\BackEnd\SettingController;
use App\Http\Controllers\BackEnd\CampaignController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\DistrictController;
use App\Http\Controllers\BackEnd\ProvinceController;
use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\SubdistrictController;
use App\Http\Controllers\BackEnd\PostcategoryController;
use App\Http\Controllers\FrontEnd\PageController as FrontEndPageController;
use App\Http\Controllers\FrontEnd\PostController as FrontEndPostController;
use App\Http\Controllers\Api\SubdistrictController as ApiSubdistrictController;
use App\Http\Controllers\BackEnd\WithdrawalController;
use App\Http\Controllers\BackEnd\CampaignfundController;
use App\Http\Controllers\BackEnd\ZakatcollectionunitController;
use App\Http\Controllers\CallToActionController;
use App\Http\Controllers\FrontEnd\CalculatorController;
use App\Http\Controllers\FrontEnd\CampaignController as FrontEndCampaignController;
use App\Http\Controllers\FrontEnd\ZakatcollectionunitController as FrontEndZakatcollectionunitController;
use App\Http\Controllers\FunditemController;

// Controller Link
use App\Http\Controllers\BackEnd\LinkController;

// Controller Service Layanan
use App\Http\Controllers\BackEnd\ServiceController;

// CKEditor Controller
use App\Http\Controllers\BackEnd\CKEditorController;
use App\Http\Controllers\BackEnd\ConsultationController as BackEndConsultationController;
use App\Http\Controllers\BackEnd\ServicecategoryController;
use App\Http\Controllers\BackEnd\TestimonialController;
use App\Http\Controllers\BackEnd\WhatsappControllers;
use App\Http\Controllers\FrontEnd\ConsultationController;
use App\Http\Controllers\FrontEnd\ServicecategoryController as FrontEndServicecategoryController;
use App\Http\Controllers\FrontEnd\ServiceController as FrontEndServiceController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/pages/{page:slug}', [FrontEndPageController::class, 'show']);
Route::get('/services/{service:slug}', [FrontEndServiceController::class, 'show']);
Route::get('/servicecategories/{servicecategory:slug}', [FrontEndServicecategoryController::class, 'show']);
Route::post('/consultation', [ConsultationController::class, 'store']);
Route::get('/consultation/{consultation:id}', [ConsultationController::class, 'show']);
Route::post('/consultation/reply/{consultation:id}', [ConsultationController::class, 'reply']);
Route::delete('/consultation/reply/{consultation:id}', [ConsultationController::class, 'destroy_reply']);
Route::get('/posts', [FrontEndPostController::class, 'index']);
Route::get('/posts/{post:slug}', [FrontEndPostController::class, 'show']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::post('/contact/sendmessage', [ContactController::class, 'sendmessage']);

//CKEditor
Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('image-upload');

Route::middleware(['guest'])->group(function () {
    Route::get('/auth', [LoginController::class, 'index'])->name('login');
    Route::post('/auth', [LoginController::class, 'login'])->name('login.auth');
    // Route::get('/auth/registration', [LoginController::class, 'registration'])->name('registration.form');
    // Route::post('/auth/registration', [LoginController::class, 'register_action'])->name('registration.store');
    Route::get('/auth/forgot', [LoginController::class, 'forgot'])->name('password.request');
    Route::post('/auth/forgot', [LoginController::class, 'forgot_action'])->name('password.email');
    Route::get('/auth/reset/{token}', [LoginController::class, 'reset'])->name('password.reset');
    Route::post('/auth/reset', [LoginController::class, 'reset_action'])->name('password.update');
    Route::get('/users/username', [UserController::class, 'createUsername']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/auth/logout', [LoginController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/profile', [ProfileController::class, 'index']);
    Route::post('/dashboard/profile/{user:username}', [ProfileController::class, 'update']);

    Route::get('/create/users/username', [UserController::class, 'createUsername']);

    Route::middleware(['auth', 'roles'])->group(function () {
        // Master Data
        Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/dashboard/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/dashboard/users/{user:id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/dashboard/users/{user:id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/dashboard/users/{user:id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/dashboard/levels', [LevelController::class, 'index'])->name('levels.index');
        Route::post('/dashboard/levels', [LevelController::class, 'store'])->name('levels.store');
        Route::get('/dashboard/levels/{level:id}/edit', [LevelController::class, 'edit'])->name('levels.edit');
        Route::put('/dashboard/levels/{level:id}', [LevelController::class, 'update'])->name('levels.update');
        Route::delete('/dashboard/levels/{level:id}', [LevelController::class, 'destroy'])->name('levels.destroy');

        Route::get('/dashboard/postcategories', [PostcategoryController::class, 'index'])->name('postcategories.index');
        Route::get('/dashboard/postcategories/{postcategory:id}', [PostcategoryController::class, 'show'])->name('postcategories.show');
        Route::post('/dashboard/postcategories', [PostcategoryController::class, 'store'])->name('postcategories.store');
        Route::put('/dashboard/postcategories/{postcategory:id}', [PostcategoryController::class, 'update'])->name('postcategories.update');
        Route::delete('/dashboard/postcategories/{postcategory:id}', [PostcategoryController::class, 'destroy'])->name('postcategories.destroy');

        Route::get('/dashboard/statuses', [StatusController::class, 'index'])->name('Status Layanan.index');
        Route::post('/dashboard/statuses', [StatusController::class, 'store'])->name('Status Layanan.store');
        Route::get('/dashboard/statuses/{status:id}', [StatusController::class, 'show'])->name('Status Layanan.show');
        Route::get('/dashboard/statuses/{status:id}/edit', [StatusController::class, 'edit'])->name('Status Layanan.edit');
        Route::put('/dashboard/statuses/{status:id}', [StatusController::class, 'update'])->name('Status Layanan.update');
        Route::delete('/dashboard/statuses/{status:id}', [StatusController::class, 'destroy'])->name('Status Layanan.destroy');

        // Whatsapp 
        Route::get('/dashboard/whatsapp', [WhatsappControllers::class, 'index'])->name('Whatsapp.index');
        Route::get('/dashboard/whatsapp/scan', [WhatsappControllers::class, 'scan'])->name('Whatsapp.scan');
        Route::get('/dashboard/whatsapp/auth', [WhatsappControllers::class, 'getqr'])->name('Whatsapp.auth');
        Route::get('/dashboard/whatsapp/reset', [WhatsappControllers::class, 'reset'])->name('Whatsapp.reset');
        Route::post('/dashboard/whatsapp/resend/{walog:id}', [WhatsappControllers::class, 'resend'])->name('Whatsapp.resend');
        Route::delete('/dashboard/whatsapp/destroy/{walog:id}', [WhatsappControllers::class, 'destroy'])->name('Whatsapp.destroy');

        // Layout
        Route::get('/dashboard/sections', [SectionController::class, 'index'])->name('sections.index');
        Route::get('/dashboard/sections/{section:id}', [SectionController::class, 'show'])->name('sections.show');
        Route::put('/dashboard/sections/{section:id}', [SectionController::class, 'update'])->name('sections.update');

        Route::get('/dashboard/menus', [MenuController::class, 'index'])->name('menus.index');
        Route::post('/dashboard/menus', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/dashboard/menus/{menu:id}', [MenuController::class, 'show'])->name('menus.show');
        Route::put('/dashboard/menus/{menu:id}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/dashboard/menus/{menu:id}', [MenuController::class, 'destroy'])->name('menus.destroy');

        Route::get('/dashboard/sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/dashboard/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/dashboard/sliders', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/dashboard/sliders/{slider:id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/dashboard/sliders/{slider:id}', [SliderController::class, 'update'])->name('sliders.update');
        Route::delete('/dashboard/sliders/{slider:id}', [SliderController::class, 'destroy'])->name('sliders.destroy');

        Route::get('/dashboard/abouts', [AboutController::class, 'index'])->name('abouts.index');
        Route::get('/dashboard/abouts/{about:id}', [AboutController::class, 'show'])->name('abouts.show');
        Route::put('/dashboard/abouts/{about:id}', [AboutController::class, 'update'])->name('abouts.update');

        Route::get('/dashboard/calltoactions', [CallToActionController::class, 'index'])->name('calltoactions.index');
        Route::get('/dashboard/calltoactions/{calltoaction:id}', [CallToActionController::class, 'show'])->name('calltoactions.show');
        Route::put('/dashboard/calltoactions/{id}', [CallToActionController::class, 'update'])->name('calltoactions.update');

        // Link
        Route::get('/dashboard/links', [LinkController::class, 'index'])->name('links.index');
        Route::get('/dashboard/links/create', [LinkController::class, 'create'])->name('links.create');
        Route::post('/dashboard/links/create', [LinkController::class, 'store'])->name('links.store');
        Route::get('/dashboard/links/{link:id}/edit', [LinkController::class, 'edit'])->name('links.edit');
        Route::put('/dashboard/links/{link:id}', [LinkController::class, 'update'])->name('links.update');
        Route::delete('/dashboard/links/{link:id}', [LinkController::class, 'destroy'])->name('links.destroy');

        // Testimonials
        Route::get('/dashboard/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('/dashboard/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/dashboard/testimonials/create', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('/dashboard/testimonials/{testimonial:id}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::put('/dashboard/testimonials/{testimonial:id}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/dashboard/testimonials/{testimonial:id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

        // Service layanan
        Route::get('/dashboard/services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/dashboard/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/dashboard/services/create', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/dashboard/services/{service:id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/dashboard/services/{service:id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/dashboard/services/{service:id}', [ServiceController::class, 'destroy'])->name('services.destroy');

        // Kategori Layanan
        Route::get('/dashboard/servicecategories', [ServicecategoryController::class, 'index'])->name('Kategori Layanan.index');
        Route::post('/dashboard/servicecategories', [ServicecategoryController::class, 'store'])->name('Kategori Layanan.store');
        Route::get('/dashboard/servicecategories/{servicecategory:id}', [ServicecategoryController::class, 'show'])->name('Kategori Layanan.show');
        Route::put('/dashboard/servicecategories/{servicecategory:id}', [ServicecategoryController::class, 'update'])->name('Kategori Layanan.update');
        Route::delete('/dashboard/servicecategories/{servicecategory:id}', [ServicecategoryController::class, 'destroy'])->name('Kategori Layanan.destroy');


        // Pengaturan
        Route::get('/dashboard/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/dashboard/settings/{setting:id}', [SettingController::class, 'show'])->name('settings.show');
        Route::put('/dashboard/settings/{setting:id}', [SettingController::class, 'update'])->name('settings.update');

        // Pages
        Route::get('/dashboard/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/dashboard/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/dashboard/pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('/dashboard/pages/{page:id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/dashboard/pages/{page:id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/dashboard/pages/{page:id}', [PageController::class, 'destroy'])->name('pages.destroy');

        // Berita
        Route::get('/dashboard/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/dashboard/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/dashboard/posts/create', [PostController::class, 'store'])->name('posts.store');
        Route::get('/dashboard/posts/{post:id}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/dashboard/posts/{post:id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/dashboard/posts/{post:id}', [PostController::class, 'destroy'])->name('posts.destroy');
        // Route::resource('/dashboard/posts', PostController::class);
        // Route::post('/dashboard/posts/upload', [PostController::class, 'upload'])->name('posts.destroy');

        // Konsultasi
        Route::get('/dashboard/consultations', [BackEndConsultationController::class, 'index'])->name('Data Konsultasi.index');
        Route::post('/dashboard/consultations/create', [BackEndConsultationController::class, 'store'])->name('Data Konsultasi.store');
        Route::get('/dashboard/consultations/{consultation:id}', [BackEndConsultationController::class, 'show'])->name('Data Konsultasi.show');
        Route::get('/dashboard/consultations/{consultation:id}/edit', [BackEndConsultationController::class, 'edit'])->name('Data Konsultasi.edit');
        Route::put('/dashboard/consultations/{consultation:id}', [BackEndConsultationController::class, 'update'])->name('Data Konsultasi.update');
        Route::delete('/dashboard/consultations/{consultation:id}', [BackEndConsultationController::class, 'destroy'])->name('Data Konsultasi.destroy');
        Route::delete('/dashboard/consultations/reply/{id}', [BackEndConsultationController::class, 'destroy_reply'])->name('Data Konsultasi.destroy_reply');
    });
});
