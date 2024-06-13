<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(Request $request)
    {

            $menus    = Menu::orderBy('sort', 'ASC')->paginate(100);

        $title_bar = 'Manajemen Menu';
        $mainMenus =  Menu::where('child', NULL)->get();


        return view('dashboard.menus', compact('menus', 'title_bar', 'mainMenus'));

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
        abort(403);
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
            'name'  => ['required', 'unique:menus', 'min:3', 'max:100']
        ]);
        $data['link'] = $request->link ? $request->link : '#';
        $data['child'] = $request->child ? $request->child : NULL;
        $data['sort'] = $request->sort ? $request->sort : 1;
        Menu::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
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
        abort(403);
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
            'name'  => ($request->name !== $menu->name ? ['required', 'unique:menus', 'min:3', 'max:100'] : ['required', 'min:3', 'max:100'])
        ]);
        $data['link'] = $request->link ? $request->link : '#';
        $data['child'] = $request->child ? $request->child : NULL;
        $data['sort'] = $request->sort ? $request->sort : 1;
        Menu::where('id', $menu->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
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