<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Backs\LoginController;
use App\Http\Controllers\Backs\UserController;
use App\Http\Controllers\Backs\DashboardController;
use App\Http\Controllers\Backs\LevelController;
use App\Http\Controllers\Backs\SliderController;
use App\Http\Controllers\Backs\MenuController;
use App\Http\Controllers\Backs\SectionController;
use App\Http\Controllers\Backs\LinkController;
use App\Http\Controllers\Backs\AboutController;
use App\Http\Controllers\Backs\ServiceController;
use App\Http\Controllers\Backs\TestimonialController;
use App\Http\Controllers\Backs\CallToActionController;
use App\Http\Controllers\Backs\SettingController;
use App\Http\Controllers\Backs\CategoryController;
use App\Http\Controllers\Backs\PageController;
use App\Http\Controllers\Backs\PostController;
use App\Http\Controllers\Backs\ProfileController;
use App\Http\Controllers\Backs\KecamatanController;
use App\Http\Controllers\Backs\DesaController;
use App\Http\Controllers\Backs\RegulasiController;
use App\Http\Controllers\Backs\StaffController;
use App\Http\Controllers\Backs\GratifikasiController;
use App\Http\Controllers\Backs\ProgramController;
use App\Http\Controllers\Backs\CategoryPeraturanController;

// katagori Status
use App\Http\Controllers\Backs\CategoryStatusController;

// Whatsapp
use App\Http\Controllers\Backs\WhatsappController;

// Regulasi
use App\Http\Controllers\Fronts\RegulasiController as FrontsRegulasiController;

// Laporan Darurat Back
use App\Http\Controllers\Backs\LaporanDaruratController;





// Api
use App\Http\Controllers\Api\SubdistrictController;
use App\Http\Controllers\Api\DistrictController;

// Tampilan Depan
use App\Http\Controllers\Fronts\HomeController;
use App\Http\Controllers\Fronts\PageController as FrontsPageController;
use App\Http\Controllers\Fronts\PostController as FrontsPostController;
use App\Http\Controllers\Fronts\ContactController;
// CKEditor Controller
use App\Http\Controllers\Backs\CKEditorController;
use App\Http\Controllers\Backs\IrbanController;
use App\Http\Controllers\Backs\IrbanwilayahController;
use App\Http\Controllers\Backs\KopijController as BacksKopijController;
use App\Http\Controllers\Backs\LetterController;
// Laporan Front
use App\Http\Controllers\Fronts\LaporanController;

use App\Http\Controllers\Fronts\TestimonialController as FrontsTestimonialController;

// Pengawasan Front
use App\Http\Controllers\Fronts\PengawasanController;

// Staff
use App\Http\Controllers\Fronts\StaffController as FrontsStaffController;

// Gratifikasi
use App\Http\Controllers\Fronts\GratifikasiController as FrontsGratifikasiController;
use App\Http\Controllers\Fronts\IrbanController as FrontsIrbanController;
use App\Http\Controllers\Fronts\KopijController;

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
// Route::get('/link', function () {
//     $target = '/home/public_html/storage/app/public';
//     $shortcut = '/home/public_html/public/storage';
//     symlink($target, $shortcut);
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/kopij', [KopijController::class, 'index']);
Route::post('/kopij', [KopijController::class, 'store']);
Route::post('/kopij/reply', [KopijController::class, 'reply']);
Route::delete('/kopij/trash/{id}', [KopijController::class, 'trash']);

Route::get('/irban', [FrontsIrbanController::class, 'index']);

// regulasi
Route::get('/regulasis', [FrontsRegulasiController::class, 'index']);
Route::get('/regulasidownload/{regulasi:id}', [FrontsRegulasiController::class, 'download']);
Route::get('/regulasis', [FrontsRegulasiController::class, 'advance'])->name('advance_search_regulasi');


// halaman front
Route::get('/pages/{page:slug}', [FrontsPageController::class, 'show']);
Route::get('/posts', [FrontsPostController::class, 'index']);
Route::get('/posts/{post:slug}', [FrontsPostController::class, 'show']);

// PPID
Route::get('/berita-ppid', [FrontsPostController::class, 'ppid']);
// Detail Berita
Route::get('/detail/berita', [HomeController::class, 'posts']);
// contact
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/sendmessage', [ContactController::class, 'sendmessage']);

// Laporan Front
Route::get('/laporan', [LaporanController::class, 'index']);
Route::post('/laporan/create', [LaporanController::class, 'store']);

Route::get('/api/subdistricts/{idkecamatan}', [SubdistrictController::class, 'index']);
Route::get('/api/districts', [DistrictController::class, 'index']);

//CKEditor
Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('image-upload');

// Testimonial
// Route::get('/statistics', [FrontsPageController::class, 'statistics'])->name('frontend.halaman.statistik');
Route::get('/testimonials', [FrontsTestimonialController::class, 'index'])->name('frontend.testimonial.index');
Route::get('/testimonials/create', [FrontsTestimonialController::class, 'create'])->name('frontend.testimonial.create');
Route::post('/testimonials', [FrontsTestimonialController::class, 'store'])->name('frontend.testimonial.store');

// staff
Route::get('/staff', [FrontsStaffController::class, 'index']);
Route::get('/staffdetail/{staff:id}', [FrontsStaffController::class, 'detail']);

//Program
Route::get('/category/{programslug}', [PengawasanController::class, 'index']);

// Gratifikasi
Route::get('/gratifikasi', [FrontsGratifikasiController::class, 'index']);
Route::post('/gratifikasi/create', [FrontsGratifikasiController::class, 'store']);




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard1', [DashboardController::class, 'index']);
    // route untuk dashboard
    Route::middleware([
        'auth', 'roles'
    ])->group(function () {

        // _Master Data_

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

        // Kategori Berita
        Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/dashboard/categories/{category:id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/dashboard/categories/{category:id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/dashboard/categories/{category:id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/dashboard/categories/{category:id}', [CategoryController::class, 'show'])->name('categories.show');

        // irban
        Route::get('/dashboard/irbans', [IrbanController::class, 'index'])->name('IRBAN.index');
        Route::get('/dashboard/irbans/{irban:id}', [IrbanController::class, 'show'])->name('IRBAN.show');
        Route::post('/dashboard/irbans', [IrbanController::class, 'store'])->name('IRBAN.store');
        Route::put('/dashboard/irbans/{irban:id}', [IrbanController::class, 'update'])->name('IRBAN.update');
        Route::delete('/dashboard/irbans/{irban:id}', [IrbanController::class, 'destroy'])->name('IRBAN.destroy');

        // irban wilayah
        Route::get('/dashboard/irbanwilayahs', [IrbanwilayahController::class, 'index'])->name('wilayah_IRBAN.index');
        Route::get('/dashboard/irbanwilayahs/{irbanwilayah:id}', [IrbanwilayahController::class, 'show'])->name('wilayah_IRBAN.show');
        Route::post('/dashboard/irbanwilayahs', [IrbanwilayahController::class, 'store'])->name('wilayah_IRBAN.store');
        Route::put('/dashboard/irbanwilayahs/{irbanwilayah:id}', [IrbanwilayahController::class, 'update'])->name('wilayah_IRBAN.update');
        Route::delete('/dashboard/irbanwilayahs/{irbanwilayah:id}', [IrbanwilayahController::class, 'destroy'])->name('wilayah_IRBAN.destroy');

        //sliders
        Route::get('/dashboard/sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/dashboard/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/dashboard/sliders/create', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/dashboard/sliders/{slider:id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/dashboard/sliders/{slider:id}', [SliderController::class, 'update'])->name('sliders.update');
        Route::delete('/dashboard/sliders/{slider:id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
        
        Route::get('/dashboard/letters', [LetterController::class, 'index'])->name('front_desk.index');
        Route::get('/dashboard/letters/create', [LetterController::class, 'create'])->name('front_desk.create');
        Route::post('/dashboard/letters', [LetterController::class, 'store'])->name('front_desk.store');
        Route::get('/dashboard/letters/{letter:id}/edit', [LetterController::class, 'edit'])->name('front_desk.edit');
        Route::put('/dashboard/letters/{letter:id}', [LetterController::class, 'update'])->name('front_desk.update');
        Route::delete('/dashboard/letters/{letter:id}', [LetterController::class, 'destroy'])->name('front_desk.destroy');

        // Menu Nav - Bar
        Route::get('/dashboard/menus', [MenuController::class, 'index'])->name('menus.index');
        // Route::get('/dashboard/menusnav/create', [MenuNavController::class, 'create'])->name('menunav.create');
        Route::post('/dashboard/menus/create', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/dashboard/menus/{menu:id}', [MenuController::class, 'show'])->name('menus.show');
        Route::put('/dashboard/menus/{menu:id}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/dashboard/menus/{menu:id}', [MenuController::class, 'destroy'])->name('menus.destroy');


        // Section
        Route::get('/dashboard/sections', [SectionController::class, 'index'])->name('sections.index');
        // Route::get('/dashboard/menusnav/create', [MenuNavController::class, 'create'])->name('menunav.create');
        Route::post('/dashboard/sections/create', [SectionController::class, 'store'])->name('sections.store');
        Route::get('/dashboard/sections/{section:id}', [SectionController::class, 'show'])->name('sections.show');
        Route::put('/dashboard/sections/{section:id}', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/dashboard/sections/{section:id}', [SectionController::class, 'destroy'])->name('sections.destroy');


        //Link
        Route::get('/dashboard/links', [LinkController::class, 'index'])->name('links.index');
        Route::get('/dashboard/links/create', [LinkController::class, 'create'])->name('links.create');
        Route::post('/dashboard/links/create', [LinkController::class, 'store'])->name('links.store');
        Route::get('/dashboard/links/{link:id}/edit', [LinkController::class, 'edit'])->name('links.edit');
        Route::put('/dashboard/links/{link:id}', [LinkController::class, 'update'])->name('links.update');
        Route::delete('/dashboard/links/{link:id}', [LinkController::class, 'destroy'])->name('links.destroy');

        // About
        Route::get('/dashboard/abouts', [AboutController::class, 'index'])->name('abouts.index');
        Route::put('/dashboard/abouts/{about:id}', [AboutController::class, 'update'])->name('abouts.update');

        // Service/layanan
        Route::get('/dashboard/services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/dashboard/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/dashboard/services/create', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/dashboard/services/{service:id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/dashboard/services/{service:id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/dashboard/services/{service:id}', [ServiceController::class, 'destroy'])->name('services.destroy');


        // testimonial
        Route::get('/dashboard/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('/dashboard/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/dashboard/testimonials/create', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('/dashboard/testimonials/{testimonial:id}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::put('/dashboard/testimonials/{testimonial:id}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/dashboard/testimonials/{testimonial:id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

        // cta
        Route::get('/dashboard/callToActions', [CallToActionController::class, 'index'])->name('callToActions.index');
        Route::get('/dashboard/callToActions/create', [CallToActionController::class, 'create'])->name('callToActions.create');
        Route::post('/dashboard/callToActions/create', [CallToActionController::class, 'store'])->name('callToActions.store');
        Route::get('/dashboard/callToActions/{callToAction:id}/edit', [CallToActionController::class, 'edit'])->name('callToActions.edit');
        Route::put('/dashboard/callToActions/{callToAction:id}', [CallToActionController::class, 'update'])->name('callToActions.update');
        Route::delete('/dashboard/callToActions/{callToAction:id}', [CallToActionController::class, 'destroy'])->name('callToActions.destroy');


        // Halaman
        Route::get('/dashboard/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/dashboard/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/dashboard/pages/create', [PageController::class, 'store'])->name('pages.store');
        Route::get('/dashboard/pages/{page:id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/dashboard/pages/{page:id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/dashboard/pages/{page:id}', [PageController::class, 'destroy'])->name('pages.destroy');
        // Route::resource('/dashboard/pages', PageController::class);
        // Route::post('/dashboard/pages/upload', [PageController::class, 'upload']);


        // Berita
        Route::get('/dashboard/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/dashboard/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/dashboard/posts/create', [PostController::class, 'store'])->name('posts.store');
        Route::get('/dashboard/posts/{post:id}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/dashboard/posts/{post:id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/dashboard/posts/{post:id}', [PostController::class, 'destroy'])->name('posts.destroy');
        // Route::resource('/dashboard/posts', PostController::class);
        // Route::post('/dashboard/posts/upload', [PostController::class, 'upload']);


        // Pengaturan Website admin
        Route::get('/dashboard/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/dashboard/settings/{setting:id}', [SettingController::class, 'update'])->name('settings.update');


        // profile
        Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/dashboard/profile/{user:id}', [ProfileController::class, 'update'])->name('profile.update');

        // Kecamatan & desa
        Route::get('/dashboard/kecamatans', [KecamatanController::class, 'index'])->name('kecamatans.index');
        // Route::get('/dashboard/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/dashboard/kecamatans/create', [KecamatanController::class, 'store'])->name('kecamatans.store');
        Route::get('/dashboard/kecamatans/{kecamatan:id}/edit', [KecamatanController::class, 'edit'])->name('kecamatans.edit');
        Route::put('/dashboard/kecamatans/{kecamatan:id}', [KecamatanController::class, 'update'])->name('kecamatans.update');
        Route::delete('/dashboard/kecamatans/{kecamatan:id}', [KecamatanController::class, 'destroy'])->name('kecamatans.destroy');
        Route::get('/dashboard/kecamatans/{kecamatan:id}', [KecamatanController::class, 'show'])->name('kecamatans.show');

        Route::get('/dashboard/desas', [DesaController::class, 'index'])->name('desas.index');
        // Route::get('/dashboard/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/dashboard/desas/create', [DesaController::class, 'store'])->name('desas.store');
        Route::get('/dashboard/desas/{desa:id}/edit', [DesaController::class, 'edit'])->name('desas.edit');
        Route::put('/dashboard/desas/{desa:id}', [DesaController::class, 'update'])->name('desas.update');
        Route::delete('/dashboard/desas/{desa:id}', [DesaController::class, 'destroy'])->name('desas.destroy');
        Route::get('/dashboard/desas/{desa:id}', [DesaController::class, 'show'])->name('desas.show');


        // Whatsapp
        Route::get('/dashboard/whatsapp/histories', [WhatsappController::class, 'index'])->name('whatsapp.index');
        Route::get('/dashboard/whatsapp/scan', [WhatsappController::class, 'scan'])->name('whatsapp.scan');
        Route::get('/dashboard/whatsapp/auth', [WhatsappController::class, 'getqr'])->name('whatsapp.getqr');
        Route::get('/dashboard/whatsapp/reset', [WhatsappController::class, 'reset'])->name('whatsapp.reset');
        Route::post('/dashboard/whatsapp/resend/{walog:id}', [WhatsappController::class, 'resend'])->name('whatsapp.resend');
        Route::delete('/dashboard/whatsapp/destroy/{walog:id}', [WhatsappController::class, 'destroy'])->name('whatsapp.destroy');

        // Laporan Darurat Back
        Route::get('/dashboard/laporandarurats', [LaporanDaruratController::class, 'index'])->name('laporandarurats.index');
        Route::get('/dashboard/laporandarurats/create', [LaporanDaruratController::class, 'create'])->name('laporandarurats.create');
        Route::post('/dashboard/laporandarurats/create', [LaporanDaruratController::class, 'store'])->name('laporandarurats.store');
        Route::get('/dashboard/laporandarurats/{laporandarurat:id}/edit', [LaporanDaruratController::class, 'edit'])->name('laporandarurats.edit');
        Route::put('/dashboard/laporandarurats/{laporandarurat:id}', [LaporanDaruratController::class, 'update'])->name('laporandarurats.update');
        // Route::get('/dashboard/laporandarurats/{laporandarurat:id}/detail', [LaporanDaruratController::class, 'detail']);
        Route::delete('/dashboard/laporandarurats/{laporandarurat:id}', [LaporanDaruratController::class, 'destroy'])->name('laporandarurats.destroy');
        // Route::get('/dashboard/laporandarurats/download/{laporandarurat:id}', [LaporanDaruratController::class, 'download']);
        // Route::get('/dashboard/laporandarurats/download1', [LaporanDaruratController::class, 'download1']);


        //kategori status
        Route::get('/dashboard/kategories', [CategoryStatusController::class, 'index'])->name('kategories.index');
        Route::post('/dashboard/kategories', [CategoryStatusController::class, 'store'])->name('kategories.store');
        Route::get('/dashboard/kategories/{category:id}/edit', [CategoryStatusController::class, 'edit'])->name('kategories.edit');
        Route::put('/dashboard/kategories/{category:id}', [CategoryStatusController::class, 'update'])->name('kategories.update');
        Route::delete('/dashboard/kategories/{category:id}', [CategoryStatusController::class, 'destroy'])->name('kategories.destroy');
        Route::get('/dashboard/kategories/{category:id}', [CategoryStatusController::class, 'show'])->name('kategories.show');


        //regulasi
        Route::get('/dashboard/regulasis', [RegulasiController::class, 'index'])->name('regulasis.index');
        Route::get('/dashboard/regulasis/create', [RegulasiController::class, 'create'])->name('regulasis.create');
        Route::post('/dashboard/regulasis/create', [RegulasiController::class, 'store'])->name('regulasis.store');
        Route::get('/dashboard/regulasis/{regulasi:id}/edit', [RegulasiController::class, 'edit'])->name('regulasis.edit');
        Route::put('/dashboard/regulasis/{regulasi:id}', [RegulasiController::class, 'update'])->name('regulasis.update');
        Route::delete('/dashboard/regulasis/{regulasi:id}', [RegulasiController::class, 'destroy'])->name('regulasis.destroy');
        Route::get('/dashboard/regulasis/{regulasi:id}', [RegulasiController::class, 'show'])->name('regulasis.show');


        //staf
        Route::get('/dashboard/staffs', [StaffController::class, 'index'])->name('staffs.index');
        Route::get('/dashboard/staffs/create', [StaffController::class, 'create'])->name('staffs.create');
        Route::post('/dashboard/staffs/create', [StaffController::class, 'store'])->name('staffs.store');
        Route::get('/dashboard/staffs/{staff:id}/edit', [StaffController::class, 'edit'])->name('staffs.edit');
        Route::put('/dashboard/staffs/{staff:id}', [StaffController::class, 'update'])->name('staffs.update');
        Route::delete('/dashboard/staffs/{staff:id}', [StaffController::class, 'destroy'])->name('staffs.destroy');
        Route::get('/dashboard/staffs/{staff:id}', [StaffController::class, 'show'])->name('staffs.show');

        Route::get('/dashboard/kopijs', [BacksKopijController::class, 'index'])->name('kopi-j.index');
        Route::get('/dashboard/kopijs/create', [BacksKopijController::class, 'create'])->name('kopi-j.create');
        Route::post('/dashboard/kopijs/reply', [BacksKopijController::class, 'reply'])->name('kopi-j.reply');
        Route::post('/dashboard/kopijs', [BacksKopijController::class, 'store'])->name('kopi-j.store');
        Route::get('/dashboard/kopijs/{kopij:id}/edit', [BacksKopijController::class, 'edit'])->name('kopi-j.edit');
        Route::put('/dashboard/kopijs/{kopij:id}', [BacksKopijController::class, 'update'])->name('kopi-j.update');
        Route::delete('/dashboard/kopijs/trash/{id}', [BacksKopijController::class, 'trash'])->name('kopi-j.delete_item');
        Route::delete('/dashboard/kopijs/{kopij:id}', [BacksKopijController::class, 'destroy'])->name('kopi-j.destroy');
        Route::get('/dashboard/kopijs/{kopij:id}', [BacksKopijController::class, 'show'])->name('kopi-j.show');
        Route::get('/dashboard/kopijs/trash/{id}', [BacksKopijController::class, 'show'])->name('kopi-j.show');

        //gratifikasi
        // Route::get('/dashboard/gratifikasis', [GratifikasiController::class, 'index'])->name('gratifikasis.index');
        // Route::get('/dashboard/gratifikasis/create', [GratifikasiController::class, 'create'])->name('gratifikasis.create');
        // Route::post('/dashboard/gratifikasis/create', [GratifikasiController::class, 'store'])->name('gratifikasis.store');
        // Route::get('/dashboard/gratifikasis/{gratifikasi:id}/edit', [GratifikasiController::class, 'edit'])->name('gratifikasis.edit');
        // Route::put('/dashboard/gratifikasis/{gratifikasi:id}', [GratifikasiController::class, 'update'])->name('gratifikasis.update');
        // Route::delete('/dashboard/gratifikasis/{gratifikasi:id}', [GratifikasiController::class, 'destroy'])->name('gratifikasis.destroy');
        // Route::get('/dashboard/gratifikasis/{gratifikasi:id}', [GratifikasiController::class, 'show'])->name('gratifikasis.show');


        //kategori program
        Route::get('/dashboard/programs', [ProgramController::class, 'index'])->name('programs.index');
        Route::post('/dashboard/programs', [ProgramController::class, 'store'])->name('programs.store');
        Route::get('/dashboard/programs/{program:id}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
        Route::put('/dashboard/programs/{program:id}', [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('/dashboard/programs/{program:id}', [ProgramController::class, 'destroy'])->name('programs.destroy');
        Route::get('/dashboard/programs/{program:id}', [ProgramController::class, 'show'])->name('programs.show');

        //kategori Peraturan
        Route::get('/dashboard/categoriperaturans', [CategoryPeraturanController::class, 'index'])->name('categoriperaturans.index');
        Route::post('/dashboard/categoriperaturans', [CategoryPeraturanController::class, 'store'])->name('categoriperaturans.store');
        Route::get('/dashboard/categoriperaturans/{categoriperaturan:id}/edit', [CategoryPeraturanController::class, 'edit'])->name('categoriperaturans.edit');
        Route::put('/dashboard/categoriperaturans/{categoriperaturan:id}', [CategoryPeraturanController::class, 'update'])->name('categoriperaturans.update');
        Route::delete('/dashboard/categoriperaturans/{categoriperaturan:id}', [CategoryPeraturanController::class, 'destroy'])->name('categoriperaturans.destroy');
        Route::get('/dashboard/categoriperaturans/{categoriperaturan:id}', [CategoryPeraturanController::class, 'show'])->name('categoriperaturans.show');
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
