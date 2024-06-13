<?php

use App\Http\Controllers\Api\CampaignController as ApiCampaignController;
use App\Http\Controllers\Api\DistrictController as ApiDistrictController;
use App\Http\Controllers\Api\ProvinceController as ApiProvinceController;
use App\Http\Controllers\Api\StatistikController;
use App\Http\Controllers\Api\StatistkController;
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
use App\Http\Controllers\Backend\CKEditorController;
use App\Http\Controllers\BackEnd\DistrictController;
use App\Http\Controllers\BackEnd\ProvinceController;
use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\SubdistrictController;
use App\Http\Controllers\BackEnd\PostcategoryController;
use App\Http\Controllers\FrontEnd\PageController as FrontEndPageController;
use App\Http\Controllers\FrontEnd\PostController as FrontEndPostController;
use App\Http\Controllers\Api\SubdistrictController as ApiSubdistrictController;
use App\Http\Controllers\Api\ZakatController as ApiZakatController;
use App\Http\Controllers\BackEnd\CallToActionController;
use App\Http\Controllers\BackEnd\WithdrawalController;
use App\Http\Controllers\BackEnd\CampaignfundController;
use App\Http\Controllers\BackEnd\DanacategoryController;
use App\Http\Controllers\BackEnd\DanaController;
use App\Http\Controllers\BackEnd\DanafundController;
use App\Http\Controllers\BackEnd\DatadanaController;
use App\Http\Controllers\BackEnd\JenisdanaController;
use App\Http\Controllers\BackEnd\LaporanbencanaController;
use App\Http\Controllers\BackEnd\LaporbencanaController as BackEndLaporbencanaController;
use App\Http\Controllers\BackEnd\LinkController;
use App\Http\Controllers\BackEnd\WhatsappControllers;
use App\Http\Controllers\BackEnd\ZakatcollectionunitController;
use App\Http\Controllers\BackEnd\ZakatController;
use App\Http\Controllers\FrontEnd\CalculatorController;
use App\Http\Controllers\FrontEnd\CampaignController as FrontEndCampaignController;
use App\Http\Controllers\FrontEnd\LaporanbencanaController as FrontEndLaporanbencanaController;
use App\Http\Controllers\FrontEnd\ZakatcollectionunitController as FrontEndZakatcollectionunitController;
use App\Http\Controllers\FrontEnd\ZakatsekarangController;
use App\Http\Controllers\FrontEnd\ZakattransactionController;
use App\Http\Controllers\FunditemController;
use App\Http\Controllers\LaporbencanaController;

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
Route::get('/zakatcollectionunits', [FrontEndZakatcollectionunitController::class, 'index']);
Route::get('/zakatcollectionunits/{zakatcollectionunit:slug}', [FrontEndZakatcollectionunitController::class, 'show']);
Route::get('/campaigns/{campaign:slug}', [FrontEndCampaignController::class, 'show']);
Route::post('/campaigns/donation', [FrontEndCampaignController::class, 'store_topup']);
Route::put('/campaigns/donation/{campaignfunditem:id}', [FrontEndCampaignController::class, 'update_topup']);
Route::get('/campaigns', [FrontEndCampaignController::class, 'index']);
Route::get('/posts', [FrontEndPostController::class, 'index']);
Route::get('/posts/{post:slug}', [FrontEndPostController::class, 'show']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/laporanbencana', [FrontEndLaporanbencanaController::class, 'index']);
Route::post('/laporanbencana/create', [FrontEndLaporanbencanaController::class, 'store']);
Route::post('/contact/sendmessage', [ContactController::class, 'sendmessage']);

Route::get('/kalkulator-zakat', [CalculatorController::class, 'index']);
Route::get('/kalkulator-zakat/profesi', [CalculatorController::class, 'profesi']);
Route::get('/kalkulator-zakat/maal', [CalculatorController::class, 'maal']);
Route::get('/kalkulator-zakat/perdagangan', [CalculatorController::class, 'perdagangan']);
Route::get('/kalkulator-zakat/simpanan', [CalculatorController::class, 'simpanan']);
Route::get('/kalkulator-zakat/transaksi/{nominal}/{slug}', [ZakattransactionController::class, 'penghasilan']);
Route::post('/zakat/transaksi', [ZakattransactionController::class, 'store_topup']);
Route::put('/zakat/transaksi/{danafunditem:id}', [ZakattransactionController::class, 'update_topup']);
Route::put('/kalkulator-zakat/transaksi/{danafunditem:id}', [ZakattransactionController::class, 'update_topup']);

Route::get('/zakat-sekarang', [ZakatsekarangController::class, 'index']);
Route::get('/api/danacategory/{danacategory:id}', [ZakatsekarangController::class, 'api_danacategory']);
Route::get('/api/dana/{dana:id}', [ZakatsekarangController::class, 'api_dana']);

// API
Route::get('/api/districts/{idprovince}', [ApiProvinceController::class, 'district']);
Route::get('/api/subdistricts/{iddistrict}', [ApiProvinceController::class, 'subdistrict']);
Route::get('/api/campaigns/{id}/{limit}/{offset}', [ApiCampaignController::class, 'donations']);
Route::get('/api/zakatcollectionunits/{zakatcollectionunit:id}', [ZakatcollectionunitController::class, 'show']);
Route::get('/api/zakats', [StatistikController::class, 'zakat_load']);
Route::get('/api/campaigns', [StatistikController::class, 'campaign_load']);

Route::middleware(['guest'])->group(function () {
    Route::get('/auth', [LoginController::class, 'index']);
    Route::post('/auth', [LoginController::class, 'login']);
    Route::get('/auth/registration', [LoginController::class, 'registration']);
    Route::post('/auth/registration', [LoginController::class, 'register_action']);
    Route::get('/auth/forgot', [LoginController::class, 'forgot']);
    Route::post('/auth/forgot', [LoginController::class, 'reset']);
    Route::get('/auth/confirm', [LoginController::class, 'confirm']);
    Route::get('/auth/newpassword', [LoginController::class, 'newpassword']);
    Route::put('/auth/newpassword/{user:username}', [LoginController::class, 'update']);
    Route::get('/users/username', [UserController::class, 'createUsername']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/auth/logout', [LoginController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/profile', [ProfileController::class, 'index']);
    Route::post('/dashboard/profile/{user:username}', [ProfileController::class, 'update']);

    Route::get('/create/users/username', [UserController::class, 'createUsername']);
    Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('image-upload');

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

        Route::get('/dashboard/provinces', [ProvinceController::class, 'index'])->name('provinces.index');
        Route::post('/dashboard/provinces', [ProvinceController::class, 'store'])->name('provinces.store');
        Route::get('/dashboard/provinces/{province:id}', [ProvinceController::class, 'show'])->name('provinces.show');
        Route::get('/dashboard/provinces/{province:id}/edit', [ProvinceController::class, 'edit'])->name('provinces.edit');
        Route::put('/dashboard/provinces/{province:id}', [ProvinceController::class, 'update'])->name('provinces.update');
        Route::delete('/dashboard/provinces/{province:id}', [ProvinceController::class, 'destroy'])->name('provinces.destroy');

        Route::get('/dashboard/danacategories', [DanacategoryController::class, 'index'])->name('Kategori Dana.index');
        Route::post('/dashboard/danacategories', [DanacategoryController::class, 'store'])->name('Kategori Dana.store');
        Route::get('/dashboard/danacategories/{danacategory:id}', [DanacategoryController::class, 'show'])->name('Kategori Dana.show');
        Route::get('/dashboard/danacategories/{danacategory:id}/edit', [DanacategoryController::class, 'edit'])->name('Kategori Dana.edit');
        Route::put('/dashboard/danacategories/{danacategory:id}', [DanacategoryController::class, 'update'])->name('Kategori Dana.update');
        Route::delete('/dashboard/danacategories/{danacategory:id}', [DanacategoryController::class, 'destroy'])->name('Kategori Dana.destroy');

        Route::get('/dashboard/danas', [DanaController::class, 'index'])->name('Dana.index');
        Route::post('/dashboard/danas', [DanaController::class, 'store'])->name('Dana.store');
        Route::get('/dashboard/danas/{dana:id}', [DanaController::class, 'show'])->name('Dana.show');
        Route::get('/dashboard/danas/{dana:id}/edit', [DanaController::class, 'edit'])->name('Dana.edit');
        Route::put('/dashboard/danas/{dana:id}', [DanaController::class, 'update'])->name('Dana.update');
        Route::delete('/dashboard/danas/{dana:id}', [DanaController::class, 'destroy'])->name('Dana.destroy');

        Route::get('/dashboard/districts', [DistrictController::class, 'index'])->name('districts.index');
        Route::post('/dashboard/districts', [DistrictController::class, 'store'])->name('districts.store');
        Route::get('/dashboard/districts/{district:id}', [DistrictController::class, 'show'])->name('districts.show');
        Route::get('/dashboard/districts/{district:id}/edit', [DistrictController::class, 'edit'])->name('districts.edit');
        Route::put('/dashboard/districts/{district:id}', [DistrictController::class, 'update'])->name('districts.update');
        Route::delete('/dashboard/districts/{district:id}', [DistrictController::class, 'destroy'])->name('districts.destroy');

        Route::get('/dashboard/subdistricts', [SubdistrictController::class, 'index'])->name('subdistricts.index');
        Route::post('/dashboard/subdistricts', [SubdistrictController::class, 'store'])->name('subdistricts.store');
        Route::get('/dashboard/subdistricts/{subdistrict:id}', [SubdistrictController::class, 'show'])->name('subdistricts.show');
        Route::get('/dashboard/subdistricts/{subdistrict:id}/edit', [SubdistrictController::class, 'edit'])->name('subdistricts.edit');
        Route::put('/dashboard/subdistricts/{subdistrict:id}', [SubdistrictController::class, 'update'])->name('subdistricts.update');
        Route::delete('/dashboard/subdistricts/{subdistrict:id}', [SubdistrictController::class, 'destroy'])->name('subdistricts.destroy');

        Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/dashboard/categories/{category:id}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/dashboard/categories/{category:id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/dashboard/categories/{category:id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/dashboard/categories/{category:id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/dashboard/links', [LinkController::class, 'index'])->name('Link Terkait.index');
        Route::get('/dashboard/links/create', [LinkController::class, 'create'])->name('Link Terkait.create');
        Route::post('/dashboard/links/create', [LinkController::class, 'store'])->name('Link Terkait.store');
        Route::get('/dashboard/links/{link:id}/edit', [LinkController::class, 'edit'])->name('Link Terkait.edit');
        Route::put('/dashboard/links/{link:id}', [LinkController::class, 'update'])->name('Link Terkait.update');
        Route::delete('/dashboard/links/{link:id}', [LinkController::class, 'destroy'])->name('Link Terkait.destroy');

        Route::get('/dashboard/statuses', [StatusController::class, 'index'])->name('statuses.index');
        Route::post('/dashboard/statuses', [StatusController::class, 'store'])->name('statuses.store');
        Route::get('/dashboard/statuses/{status:id}', [StatusController::class, 'show'])->name('statuses.show');
        Route::get('/dashboard/statuses/{status:id}/edit', [StatusController::class, 'edit'])->name('statuses.edit');
        Route::put('/dashboard/statuses/{status:id}', [StatusController::class, 'update'])->name('statuses.update');
        Route::delete('/dashboard/statuses/{status:id}', [StatusController::class, 'destroy'])->name('statuses.destroy');

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

        Route::get('/dashboard/banks', [BankController::class, 'index'])->name('banks.index');
        Route::post('/dashboard/banks', [BankController::class, 'store'])->name('banks.store');
        Route::get('/dashboard/banks/{bank:id}', [BankController::class, 'show'])->name('banks.show');
        Route::put('/dashboard/banks/{bank:id}', [BankController::class, 'update'])->name('banks.update');
        Route::delete('/dashboard/banks/{bank:id}', [BankController::class, 'destroy'])->name('banks.destroy');

        Route::get('/dashboard/callToAction', [CallToActionController::class, 'index'])->name('callToAction.index');
        Route::get('/dashboard/callToAction/{callToAction:id}', [CallToActionController::class, 'show'])->name('callToAction.show');
        Route::put('/dashboard/callToAction/{callToAction:id}', [CallToActionController::class, 'update'])->name('callToAction.update');

        Route::get('/dashboard/laporbencana', [BackEndLaporbencanaController::class, 'index'])->name('Lapor Bencana.index');
        Route::get('/dashboard/laporbencana/{laporbencana:id}', [BackEndLaporbencanaController::class, 'show'])->name('Lapor Bencana.show');
        Route::put('/dashboard/laporbencana/{laporbencana:id}', [BackEndLaporbencanaController::class, 'update'])->name('Lapor Bencana.update');

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

        // Unit Pengumpulan Zakat
        Route::get('/dashboard/zakatcollectionunits', [ZakatcollectionunitController::class, 'index'])->name('zakatcollectionunits.index');
        Route::get('/dashboard/zakatcollectionunits/create', [ZakatcollectionunitController::class, 'create'])->name('zakatcollectionunits.create');
        Route::post('/dashboard/zakatcollectionunits', [ZakatcollectionunitController::class, 'store'])->name('zakatcollectionunits.store');
        Route::get('/dashboard/zakatcollectionunits/{zakatcollectionunit:id}', [ZakatcollectionunitController::class, 'show'])->name('zakatcollectionunits.show');
        Route::get('/dashboard/zakatcollectionunits/{zakatcollectionunit:id}/edit', [ZakatcollectionunitController::class, 'edit'])->name('zakatcollectionunits.edit');
        Route::put('/dashboard/zakatcollectionunits/{zakatcollectionunit:id}', [ZakatcollectionunitController::class, 'update'])->name('zakatcollectionunits.update');
        Route::delete('/dashboard/zakatcollectionunits/{zakatcollectionunit:id}', [ZakatcollectionunitController::class, 'destroy'])->name('zakatcollectionunits.destroy');

        Route::get('/dashboard/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/dashboard/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/dashboard/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/dashboard/posts/{post:id}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/dashboard/posts/{post:id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/dashboard/posts/{post:id}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::post('/dashboard/posts/upload', [PostController::class, 'upload'])->name('posts.upload');

        Route::get('/dashboard/postcategories', [PostcategoryController::class, 'index'])->name('postcategories.index');
        Route::get('/dashboard/postcategories/{postcategory:id}', [PostcategoryController::class, 'show'])->name('postcategories.show');
        Route::post('/dashboard/postcategories', [PostcategoryController::class, 'store'])->name('postcategories.store');
        Route::put('/dashboard/postcategories/{postcategory:id}', [PostcategoryController::class, 'update'])->name('postcategories.update');
        Route::delete('/dashboard/postcategories/{postcategory:id}', [PostcategoryController::class, 'destroy'])->name('postcategories.destroy');

        // Menu Utama
        Route::get('/dashboard/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
        Route::get('/dashboard/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
        Route::post('/dashboard/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
        Route::get('/dashboard/campaigns/{campaign:id}', [CampaignController::class, 'show'])->name('campaigns.show');
        Route::get('/dashboard/campaigns/{campaign:id}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
        Route::put('/dashboard/campaigns/{campaign:id}', [CampaignController::class, 'update'])->name('campaigns.update');
        Route::delete('/dashboard/campaigns/{campaign:id}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');

        Route::get('/dashboard/campaigndonations/{campaign:id}', [CampaignfundController::class, 'show_donation'])->name('Kampanye Donasi.index');
        Route::get('/dashboard/campaignwithdrawals/{campaign:id}', [CampaignfundController::class, 'show_withdrawal'])->name('Kampanye Penarikan.show');
        Route::get('/dashboard/campaignwithdrawals/{campaign:id}/create', [CampaignfundController::class, 'create_withdrawal'])->name('Kampanye Penarikan.index');
        Route::post('/dashboard/campaignwithdrawals/{campaign:id}/store', [CampaignfundController::class, 'store_withdrawal'])->name('Kampanye Penarikan.store');
        Route::get('/dashboard/campaignwithdrawals/{campaignfunditem:id}/edit', [CampaignfundController::class, 'edit_withdrawal'])->name('Kampanye Penarikan.edit');
        Route::put('/dashboard/campaignwithdrawals/{campaignfunditem:id}', [CampaignfundController::class, 'update_withdrawal'])->name('Kampanye Penarikan.update');
        Route::delete('/dashboard/campaignwithdrawals/{campaignfunditem:id}', [CampaignfundController::class, 'destroy_withdrawal'])->name('Kampanye Penarikan.destroy');

        Route::get('/dashboard/campaignfundwithdrawals', [CampaignfundController::class, 'show_verifikasipenarikan'])->name('Penarikan Dana Kampanye.index');
        Route::put('/dashboard/campaignfundwithdrawals/{campaignfunditem:id}', [CampaignfundController::class, 'update_verifikasipenarikan'])->name('Penarikan Dana Kampanye.update');
        Route::get('/dashboard/campaignfundwithdrawals/{campaignfunditem:id}', [CampaignfundController::class, 'campaigntransactionwithdrawals'])->name('Penarikan Dana Kampanye.show');

        // Zakat
        Route::get('/dashboard/datadanas', [DanafundController::class, 'index'])->name('Data Dana.index');
        Route::get('/dashboard/datadanas/{jenisdana:id}', [DanafundController::class, 'show'])->name('Data Dana.show');
        Route::put('/dashboard/datadanas/{jenisdana:id}', [DanafundController::class, 'update'])->name('Data Dana.update');

        Route::get('/dashboard/danafunds/{dana:id}', [DanafundController::class, 'pemberi_dana'])->name('Lihat Pemberi Dana.index');
        Route::get('/dashboard/danafundwithdrawals/{dana:id}', [DanafundController::class, 'show_withdrawal'])->name('Penarikan Dana.index');
        Route::get('/dashboard/danafundwithdrawals/{dana:id}/create', [DanafundController::class, 'create_withdrawal'])->name('Penarikan Dana.create');
        Route::post('/dashboard/danafundwithdrawals/{dana:id}/store', [DanafundController::class, 'store_withdrawal'])->name('Penarikan Dana.store');
        Route::get('/dashboard/danafundwithdrawals/{danafunditem:id}/edit', [DanafundController::class, 'edit_withdrawal'])->name('Penarikan Dana.edit');
        Route::put('/dashboard/danafundwithdrawals/{danafunditem:id}', [DanafundController::class, 'update_withdrawal'])->name('Penarikan Dana.update');
        Route::delete('/dashboard/danafundwithdrawals/{danafunditem:id}', [DanafundController::class, 'destroy_withdrawal'])->name('Penarikan Dana.destroy');

        Route::get('/dashboard/verifikasidanawithdrawals', [DanafundController::class, 'show_verifikasipenarikan'])->name('Data Penarikan Dana.index');
        Route::get('/dashboard/verifikasidanawithdrawals/{danafunditem:id}', [DanafundController::class, 'danafunditemwithdrawals'])->name('Data Penarikan Dana.show');
        Route::put('/dashboard/verifikasidanawithdrawals/{danafunditem:id}', [DanafundController::class, 'update_verifikasipenarikan'])->name('Data Penarikan Dana.update');

        // Laporan Bencana
        Route::get('/dashboard/laporanbencanas', [LaporanbencanaController::class, 'index'])->name('Laporan Bencana.index');;
        Route::get('/dashboard/laporanbencanas/{laporanbencana:id}/edit', [LaporanbencanaController::class, 'edit'])->name('Laporan Bencana.edit');
        Route::put('/dashboard/laporanbencanas/{laporanbencana:id}', [LaporanbencanaController::class, 'update'])->name('Laporan Bencana.update');
        Route::get('/dashboard/laporanbencanas/{laporanbencana:id}/detail', [LaporanbencanaController::class, 'detail'])->name('Laporan Bencana.show');
        Route::delete('/dashboard/laporanbencanas/{laporanbencana:id}', [LaporanbencanaController::class, 'destroy'])->name('Laporan Bencana.destroy');
        Route::get('/dashboard/laporanbencanas/download/{laporanbencana:id}', [LaporanbencanaController::class, 'download'])->name('Laporan Bencana.download');
        Route::get('/dashboard/laporanbencanas/downloadsemua', [LaporanbencanaController::class, 'downloadsemua'])->name('Laporan Bencana.downloaddata');
    });
});
