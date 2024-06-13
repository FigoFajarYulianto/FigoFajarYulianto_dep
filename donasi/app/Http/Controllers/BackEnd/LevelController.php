<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.levels', [
            'title_bar' => 'Data Level',
            'levels'    => Level::withCount('users')->latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:levels'],
        ]);
        Level::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Level $level)
    {
        return response()->json($level);
    }

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

        return view('dashboard.leveledit', [
            'title_bar'     => 'Perbarui Level',
            'level'         => $level,
            'access'        => $access,
            'roles'         => $grouped
        ]);
    }

    public function update(Request $request, Level $level)
    {
        $data = $request->validate([
            'name' => $request->name !== $level->name ? ['required', 'unique:levels'] : ['required']
        ]);
        if ($request->roles) {
            $data['access'] = implode(',', $request->roles);
        }
        Level::where('id', $level->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Level $level)
    {
        if ($level->users->count() === 0) {
            Level::destroy($level->id);
            return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
        }
    }
}
