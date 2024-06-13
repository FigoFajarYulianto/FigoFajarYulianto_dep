<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menunav;

class MenuNavController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $menus    = Menunav::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $menus    = Menunav::orderBy('sort', 'ASC')->Paginate(10);
        }

        $title_bar = 'Manajemen Menu';
        $mainMenus =  Menunav::where('child', NULL)->get();


        return view('dashboard.menusnav', compact('menus', 'title_bar', 'mainMenus'));

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
            'name'  => ['required', 'unique:menunavs', 'min:4', 'max:100']
        ]);
        $data['link'] = $request->link ? $request->link : '#';
        $data['child'] = $request->child ? $request->child : NULL;
        $data['sort'] = $request->sort ? $request->sort : 1;
        Menunav::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menunav  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menunav $menunav)
    {
        return response()->json($menunav);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menunav  $menunav
     * @return \Illuminate\Http\Response
     */
    public function edit(Menunav $menunav)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menunav  $menunav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menunav $menunav)
    {


        $data = $request->validate([
            'name'  => ($request->name !== $menunav->name ? ['required', 'unique:menunavs', 'min:4', 'max:100'] : ['required', 'min:4', 'max:100'])
        ]);
        $data['link'] = $request->link ? $request->link : '#';
        $data['child'] = $request->child ? $request->child : NULL;
        $data['sort'] = $request->sort ? $request->sort : 1;
        Menunav::where('id', $menunav->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menunav $menunav)
    {
        Menunav::destroy($menunav->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
