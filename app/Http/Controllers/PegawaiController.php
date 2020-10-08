<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = Pegawai::paginate(3);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            //dijalankan jika ada pencarian
            $pegawai = Pegawai::where('nama_pegawai', 'LIKE', "%$filterKeyword%")->paginate(3);
        }
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validasi = Validator::make($data, [
            'username' => 'required|max:100|unique:pegawais',
            'password' => 'required|max:50',
            'nama_pegawai' => 'required|max:255',
            'jk'=> 'required',
            'alamat' => 'required|max:255',
            'is_aktif' => 'required'
            
        ]);
        // dd($data);
        if ($validasi->fails()) {
            return redirect()->route('pegawai.create')->withInput()->withErrors($validasi);
        }


        $data['password'] = password_hash($request->input('password'),PASSWORD_DEFAULT);
        Pegawai::create($data);
        return redirect()->route('pegawai.index')->with('status', 'Data pegawai Berhasil ditambahkan');

    }

    public function show()
    {

    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrfail($id);
        return view('pegawai.edit',compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $data = $request->all();

        $validator = Validator::make($data,[
            'password' => 'sometimes|nullable|min:6|max:50',
            'nama_pegawai' => 'required|max:255',
            'alamat' => 'required|max:255'
        ]);

        if ($validator->fails()) 
        {
            return redirect()->route('pegawai.edit',[$id])->withErrors($validator);
        }
        if ($request->input('password')) 
        {
            $data['password'] = password_hash($request->input('password'),PASSWORD_DEFAULT);
        }
        else {
            $data = Arr::except($data,['password']);
        }

        $pegawai->update($data);
        return redirect()->route('pegawai.index')->with('status',' Data pegawai Berhasil diupdate');

    }

    public function destroy($id)
    {
        $data = Pegawai::findOrFail($id);
        $data->delete();
        return redirect()->route('pegawai.index')->with('status','Data pegawai berhasil didelete');
    }

}
