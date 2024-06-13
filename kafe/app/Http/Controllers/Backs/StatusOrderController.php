<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statusorder;



class StatusOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $statusorders    = Statusorder::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $statusorders    = Statusorder::latest()->Paginate(10);
        }

        return view('dashboard.statusorders', compact('statusorders'));

        // return view('dashboard.categories', [
        //     'title_bar'     => 'Kategori',
        //     // 'categories'    => Category::withCount('posts')->latest()->get()

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
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'min:3', 'max:255']
        ]);
        Statusorder::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Statusorder  $statusorders
     * @return \Illuminate\Http\Response
     */
    public function show(Statusorder $statusorder)
    {
        return response()->json($statusorder);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Statusorder  $statusorder
     * @return \Illuminate\Http\Response
     */
    public function edit(Statusorder $statusorder)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Statusorder  $statusorder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $statusorder = Statusorder::where('id', $id)->first();

        $data = $request->validate([
            'nama' => $request->nama !== $statusorder->nama ? ['required', 'min:3', 'max:255',] : ['required', 'min:3', 'max:255']
        ]);

        if ($request->nama != $statusorder->nama) {
        }
        Statusorder::where('id', $statusorder->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorystatus  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $statusorder = Statusorder::where('id', $id)->first();

        Statusorder::destroy($statusorder->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    // public function show($id)
    // {
    //     $getcategory = Categorysahabat::where('id', $id)->first();
    //     return response()->json($getcategory);
    // }
}