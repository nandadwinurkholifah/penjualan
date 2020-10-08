<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $supplier = Supplier::paginate(3);
        $filterKeyword =$request->get('keyword'); 
        if ($filterKeyword) 
        {
            //dijalankan jika ada pencarian
            $supplier = Supplier::where('nama_supplier','LIKE',"%$filterKeyword%")->paginate(3);
        }
        return view('supplier.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validasi = Validator::make($data, [
            'nama_supplier' => 'required|max:255',
            'alamat_supplier' => 'required|max:255'
        
        ]);

        if ($validasi->fails()) {
            return redirect()->route('supplier.create')->withInput()->withErrors($validasi);
        }
        Supplier::create($data);
        return redirect()->route('supplier.index')->with('status', 'Supplier Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findorfail($id);
        return view('supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findorfail($id);
        $data = $request->all();

        $validasi = Validator::make($data, [
            'nama_supplier' => 'required|max:255',
            'alamat_supplier' => 'required|max:255'
        ]);
        if ($validasi->fails()) {
            return redirect()->route('supplier.edit', $id)->withErrors($validasi);
        }
        // if ($request->input('password')) {
        //     $data['password'] = bcrypt($data['password']);
        // } else {
        //     $data = Arr::except($data, ['password']);
        // }

        $supplier->update($data);
        return redirect()->route('supplier.index')->with('status', 'Supplier Berhasil diupdate ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findorfail($id);
        $supplier->delete();
        
        return redirect()->route('supplier.index',compact('supplier'))->with('status','Supplier berhasil didelete');
    }
}
