<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Menu;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.menus', [
            'title_bar' => 'Manajemen Menu',
            'menus'     => Menu::orderBy('sort', 'ASC')->get(),
            'mainMenus' => Menu::where('child', NULL)->get(),
            'roles'     => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required', 'unique:menus', 'min:3', 'max:100']
        ]);
        $data['link'] = $request->link ? $request->link : '#';
        $data['child'] = $request->child ? $request->child : NULL;
        $data['sort'] = $request->sort ? $request->sort : 1;
        Menu::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show(Menu $menu)
    {
        return response()->json($menu);
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name'  => ($request->name !== $menu->name ? ['required', 'unique:menus', 'min:3', 'max:100'] : ['required', 'min:3', 'max:100'])
        ]);
        $data['link'] = $request->link ? $request->link : '#';
        $data['child'] = $request->child ? $request->child : NULL;
        $data['sort'] = $request->sort ? $request->sort : 1;
        Menu::where('id', $menu->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
