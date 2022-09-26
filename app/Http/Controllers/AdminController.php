<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        $datas = Admin::all();

        return view('admin.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('admin.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_admin' => 'required',
            'nama_admin' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        Admin::create([
            'id_admin' => $request->id_admin,
            'nama_admin' => $request->nama_admin,
            'alamat' => $request->alamat,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil disimpan');
    }

    public function edit($id) {
        $data = Admin::where('id_admin', $id)->first();

        return view('admin.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_admin' => 'required',
            'nama_admin' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        Admin::where('id_admin', $id)->update([
            'id_admin' => $request->id_admin,
            'nama_admin' => $request->nama_admin,
            'alamat' => $request->alamat,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil diubah');
    }

    public function delete($id) {
        Admin::where('id_admin', $id)->delete();

        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil dihapus');
    }

}
