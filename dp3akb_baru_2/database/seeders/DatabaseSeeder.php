<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bank;
use App\Models\Menu;
use App\Models\User;
use App\Models\About;
use App\Models\Level;
use App\Models\Slider;
use App\Models\Status;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'              => 'Administrator',
            'username'          => 'admin',
            'email'             => 'febript@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin'),
            'level_id'          => 1,
            'status'            => true
        ]);

        $routes =  Level::routes()->all();
        Level::create([
            'name'      => 'Administrator',
            'access'    => implode(',', $routes),
        ]);

        Setting::create([
            'name'          => 'DP3AKB'
        ]);

        Menu::create([
            'name'          => 'Beranda',
            'link'          => '/',
            'sort'          => '1'
        ]);

        Section::create([
            'name'      => 'Slider',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'Sliders'),
            'status'    => false
        ]);
        Section::create([
            'name'      => 'Tentang Kami',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'About'),
            'status'    => false
        ]);
        Section::create([
            'name'      => 'Berita Terbaru',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'Posts'),
            'status'    => false
        ]);

        About::create([
            'name' => 'Tentang Kami'
        ]);
    }
}
