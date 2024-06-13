<?php

namespace App\Http\Controllers\Backs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Support\Str;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);
        return view('dashboard.levels', [
            'title_bar' => 'Level User',
            'levels' => Level::withCount('users')->latest()->get(),
            'roles'     => $roles
        ]);
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
            'nama' => ['required', 'unique:levels', 'min:4', 'max:255'],
        ]);
        $data['access'] = auth()->user()->id;
        Level::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        return response()->json($level);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        $userAccess = Level::find($level->id)->access;
        $access = explode(',', $userAccess);

        $roles = Level::routes()->toArray();

        foreach ($roles as $role) {
            $roleEx = explode('.', $role);
            $actionName = Level::actionName($roleEx[1])['name'];
            $roleArr[] = [
                'name'  => $actionName,
                'group' => Str::replace('_', ' ', $roleEx[0]),
                'route' => $role
            ];
        }

        $grouped = collect($roleArr)->groupBy('group')->toArray();
        // dd($dataRoles);

        return view('dashboard.editlevel', [
            'title_bar'     => 'Perbarui Level',
            'level'         => $level,
            'access'        => $access,
            'roles'         => $grouped
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        $data = $request->validate([
            'nama' => $request->nama !== $level->nama ? ['required', 'unique:levels', 'min:4', 'max:255'] : ['required', 'min:4', 'max:255']
        ]);
        if ($request->roles) {
            $data['access'] = implode(',', $request->roles);
        }

        Level::where('id', $level->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Level $level)
    {
        // if ($level->id !== 1 && $level->users->count() === 0) {
        Level::destroy($level->id);
        return back()->with('success', 'Data Berhasil Dihapus');
        // } else {
        //     abort(403);
        // }
    }
}