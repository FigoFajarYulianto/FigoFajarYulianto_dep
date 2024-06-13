<?php

namespace App\Http\Controllers\Backs;

use App\Models\Program;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {

            $programs    = Program::withCount('posts')->paginate(100);

        $title_bar = 'Kategori Program';

        return view('dashboard.programs', compact('programs', 'title_bar'));

        // return view('dashboard.categories', [
        //     'title_bar'     => 'Kategori',
        //     // 'categories'    => Category::withCount('posts')->latest()->get()

        // ]);
    }

    public function create()
    {
        abort(403);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:programs']
        ]);
        $data['slug'] = SlugService::createSlug(Program::class, 'slug', $request->name);
        Program::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        return response()->json($program);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'name' => $request->name !== $program->name ? ['required', 'min:3', 'max:255', 'unique:programs'] : ['required', 'min:3', 'max:255']
        ]);

        if ($request->name != $program->name) {
            $data['slug'] = SlugService::createSlug(Program::class, 'slug', $request->name);
        }
        Program::where('id', $program->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        if ($program->posts->count()) {
            abort(403);
        }

        Program::destroy($program->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}