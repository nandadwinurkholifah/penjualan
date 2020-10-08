<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::paginate(3);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            //dijalankan jika ada pencarian
            $kategori = Kategori::where('kategori', 'LIKE', "%$filterKeyword%")->paginate(3);
        }
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $input =$request->all();

        $validasi = Validator::make($input,[
            'kategori' => 'required|max:225',
            'gambar_kategori' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validasi->fails()) {
            return redirect()->route('kategori.create')->withErrors($validasi)->withInput();
        }

        $gambar_kategori = $request->file('gambar_kategori');
        $extention = $gambar_kategori->getClientOriginalExtension();

        if ($request->file('gambar_kategori')->isValid()) {
            $namaFoto = "kategori/".date('YmdHis').".".$extention;
            $upload_path = 'public/upload/kategori';
            $request->file('gambar_kategori')->move($upload_path,$namaFoto);
            $input['gambar_kategori'] = $namaFoto;
        }
        Kategori::create($input);
        return redirect()->route('kategori.index')->with('status','Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findorfail($id);
        return view('kategori.edit',compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findorfail($id);

        $input = $request->all();

        $validasi = Validator::make($input,[
            'kategori' => 'required|max:225',
            'gambar_kategori' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validasi->fails()) {
            return redirect()->route('kategori.edit',[$id])->withErrors($validasi);
        }

        if ($request->hasFile('gambar_kategori')) {
            if ($request->file('gambar_kategori')->isValid())
            {
                Storage::disk('upload')->delete($kategori->gambar_kategori);

                $gambar_kategori = $request->file('gambar_kategori');
                $extention = $gambar_kategori->getClientOriginalExtension();
                $namaFoto = "kategori/" . date('YmdHis') . "." . $extention;
                $upload_path = 'public/upload/kategori';
                $request->file('gambar_kategori')->move($upload_path, $namaFoto);
                $input['gambar_kategori'] = $namaFoto;
            }
        }

        $kategori->update($input);
        return redirect()->route('kategori.index')->with('status','Kategori Berhasil diupdate');
    }

    public function destroy(Request $request, $id)
    {
        $kategori = Kategori::findOrfail($id);
        $kategori->delete();
        Storage::disk('upload')->delete($kategori->gambar_kategori);
        return redirect()->route('kategori.index')->with('status','Kategori Berhasil dihapus');
    }
}
