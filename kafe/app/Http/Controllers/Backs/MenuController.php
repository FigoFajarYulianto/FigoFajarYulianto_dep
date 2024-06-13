<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Menu;
use Cviebrock\EloquentSluggable\Services\SlugService;

class MenuController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $menus    = Menu::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $menus    = Menu::orderBy('nama', 'ASC')->Paginate(10);
        }

        $title_bar = 'Menu Makanan';



        return view('dashboard.menus', compact('menus', 'title_bar'));

        // return view('dashboard.menus', [
        //     'title_bar' => 'Manajemen Menu',
        //     'menus'     => Menu::orderBy('sort', 'ASC')->get(),
        //     'mainMenus' => Menu::where('child', NULL)->get()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createmenu', [
            'title_bar' => 'Menu Baru',
            'categorys'    => Category::orderBy('nama', 'ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => ['required', 'unique:menus', 'min:4', 'max:100'],
            'photo' => ['image', 'file', 'max:2048'],
            'category_id'      => ['required'],
            'harga'      => ['required'],
            'diskon'      => [''],
            'deskripsi'      => ['required'],
            'aktif'      => ['required'],
        ]);
        $data['slug'] = SlugService::createSlug(Menu::class, 'slug', $request->nama);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->photo->store('uploads');
        }

        Menu::create($data);
        return redirect('/dashboard/menus')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return response()->json($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('dashboard.editmenu', [
            'title_bar' => 'Perbarui Menu',
            'categorys'    => Category::orderBy('nama', 'ASC')->get(),
            'menu'    => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'nama'  => ['required', 'min:4', 'max:100'],
            'photo	' => ['image', 'file', 'max:2048'],
            'category_id'      => ['required'],
            'harga'      => ['required'],
            'diskon'      => [''],
            'deskripsi'      => ['required'],
            'aktif'      => ['required'],
        ]);
        $data['slug'] = SlugService::createSlug(Menu::class, 'slug', $request->nama);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->photo->store('uploads');
        }

        Menu::where('id', $menu->id)->update($data);
        return redirect('/dashboard/menus')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
