<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;

class BankController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.banks', [
            'title_bar' => 'Data Bank',
            'banks'     => Bank::with('user')->latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required'],
            'bank'      => ['required'],
            'nomor'     => ['required', 'unique:banks'],
        ]);
        $data['user_id'] = auth()->user()->id;
        Bank::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Bank $bank)
    {
        return response()->json($bank);
    }

    public function update(Request $request, Bank $bank)
    {
        $data = $request->validate([
            'name'  => 'required',
            'bank'  => 'required',
            'nomor' => $request->number !== $bank->number ? ['required', 'unique:banks'] : ['required']
        ]);
        $data['user_id'] = auth()->user()->id;
        Bank::where('id', $bank->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Bank $bank)
    {
        Bank::destroy($bank->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
