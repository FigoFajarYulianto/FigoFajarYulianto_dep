<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Statusconsultation;
use Illuminate\Http\Request;

class StatusConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $statusconsultations    = Statusconsultation::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $statusconsultations    = Statusconsultation::latest()->Paginate(10);
        }

        return view('dashboard.statusconsultations', compact('statusconsultations'));

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
        Statusconsultation::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Statusconsultation  $statusconsultation
     * @return \Illuminate\Http\Response
     */
    public function show(Statusconsultation $statusconsultation)
    {
        return response()->json($statusconsultation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Statusconsultation  $statusconsultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Statusconsultation $statusconsultation)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Statusconsultation  $statusconsultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $statusconsultation = Statusconsultation::where('id', $id)->first();

        $data = $request->validate([
            'nama' => $request->nama !== $statusconsultation->nama ? ['required', 'min:3', 'max:255',] : ['required', 'min:3', 'max:255']
        ]);

        if ($request->nama != $statusconsultation->nama) {
        }
        Statusconsultation::where('id', $statusconsultation->id)->update($data);
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

        $statusconsultation = Statusconsultation::where('id', $id)->first();

        Statusconsultation::destroy($statusconsultation->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    // public function show($id)
    // {
    //     $getcategory = Categorysahabat::where('id', $id)->first();
    //     return response()->json($getcategory);
    // }
}