<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Benda;
use App\Models\Berat;
use App\Models\Jenis_Paket;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Validator;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paket = Paket::all();
        $benda = Benda::all();
        $berat = Berat::all();
        $jenis_paket = Jenis_Paket::all();
        $layanan = Layanan::all();

        return view('paket.index', compact('paket', 'benda', 'berat', 'jenis_paket', 'layanan'));
    }

    public function data(){
        $paket = Paket::orderBy('id', 'desc')->get();

        return datatables()
        ->of($paket)
        ->addIndexColumn()
        ->addColumn('benda_id', function($paket){
            return !empty($paket->benda->nama) ? $paket->benda->nama : '-';
        })
        ->addColumn('jenis_paket_id', function($paket){
            return !empty($paket->jenis_paket->nama) ? $paket->jenis_paket->nama : '-';
        })
        ->addColumn('layanan_id', function($paket){
            return !empty($paket->layanan->nama) ? $paket->layanan->nama : '-';
        })
        ->addColumn('berat_id', function($paket){
            return !empty($paket->berat->nama) ? $paket->berat->nama : '-';
        })
        ->addColumn('aksi', function($paket){
            return'
            <div class="btn-group">
                <button onclick="editData(`'.route('paket.update', $paket->id).'`)" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`'.route('paket.destroy', $paket->id).'`)" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paket.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'benda_id' => 'required',
            'jenis_paket_id' => 'required',
            'layanan_id' => 'required',
            'berat_id' => 'required',
            'harga' => 'required|numeric'
        ]);

       $paket = Paket::create([
        'benda_id' =>$request->benda_id,
        'jenis_paket_id' => $request->jenis_paket_id,
        'layanan_id' => $request->layanan_id,
        'berat_id' => $request->berat_id,
        'harga' => $request->harga
       ]);

       return response()->json([
        'success' => true,
        'massage' => 'Data berhasil disimpan',
        'data' => $paket
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paket = Paket::find($id);
        return response()->json($paket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paket = Paket::find($id);
        $benda = Benda::find($id);
        $jenis_paket = Jenis_Paket::find($id);
        $layanan = Layanan::find($id);
        $berat = Berat::find($id);
        $paket->benda_id = $request->benda_id;
        $paket->jenis_paket_id = $request->jenis_paket_id;
        $paket->layanan_id = $request->layanan_id;
        $paket->berat_id = $request->berat_id;
        $paket->harga = $request->harga;
        return view('paket.form', compact('paket', 'benda', 'jenis_paket', 'layanan', 'berat' )); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::find($id);
        $paket->benda_id = $request->benda_id;
        $paket->jenis_paket_id = $request->jenis_paket_id;
        $paket->layanan_id = $request->layanan_id;
        $paket->berat_id = $request->berat_id;
        $paket->harga = $request->harga;
        $paket->update();
        return response()->json('Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paket = Paket::find($id);
        $paket->delete();
    }
}
