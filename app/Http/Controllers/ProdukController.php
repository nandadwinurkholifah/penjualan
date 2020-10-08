<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Kategori;
use App\Produk;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        
        $produk = Produk::paginate(5);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $produk = Produk::where('nama_produk','LIKE',"$filterKeyword")->paginate(5);
        }
        return view('produk.index',compact('produk'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create',compact('kategori'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'nama_produk' => 'required|max:255',
            'kd_kategori' => 'required',
            'harga' => 'required|numeric',
            'gambar_produk' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('produk.create')->withErrors($validator)->withInput();
        }

        if ($request->file('gambar_produk')->isValid()) {
            $gambar_produk = $request->file('gambar_produk');
            $extention = $gambar_produk->getClientOriginalExtension();
            $namaFoto = "produk/".date('YmdHis').".".$extention;
            $upload_path = 'public/upload/produk';
            $request->file('gambar_produk')->move($upload_path,$namaFoto);
            $input['gambar_produk'] = $namaFoto;
        }
        $input['stok'] = 0;
        Produk::create($input);
        return redirect()->route('produk.index')->with('status','Produk Berhasil Disimpan');
    }

    public function edit($id)
    {
        $kategori = Kategori::all();
        $produk = Produk::findOrFail($id);
        return view('produk.edit',compact('kategori','produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $input = $request->all();

        $validator = Validator::make($input,[
            'nama_produk' => 'required|max:255',
            'kd_kategori' => 'required',
            'harga' => 'required|numeric',
            'gambar_produk' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('produk.edit', [$id])->withErrors($validator);
        }

        if ($request->hasFile('gambar_produk')) {
            if ($request->file('gambar_produk')->isValid()) {
                Storage::disk('upload')->delete($produk->gambar_produk);

                $gambar_produk = $request->file('gambar_produk');
                $extention = $gambar_produk->getClientOriginalExtension();
                $namaFoto = "produk/" . date('YmdHis') . "." . $extention;
                $upload_path = 'public/upload/produk';
                $request->file('gambar_produk')->move($upload_path, $namaFoto);
                $input['gambar_produk'] = $namaFoto;
            }
        }

        $produk->update($input);
        return redirect()->route('produk.index')->with('status', 'Produk Berhasil diupdate');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        Storage::disk('upload')->delete($produk->gambar_produk);
        return redirect()->route('produk.index')->with('status','Data Produk Berhasil dihapus');
    }
}

