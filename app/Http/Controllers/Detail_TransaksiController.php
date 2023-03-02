<?php

namespace App\Http\Controllers;

use App\Models\Detail_Transaksi;
use App\Models\Transaksi;
use App\Models\Paket;
use Illuminate\Http\Request;

use Validator;

class Detail_TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail_transaksi = Detail_Transaksi::all();
        $transaksi = Transaksi::all();
        $paket = Paket::all();
        
        return view('detail_transaksi.index', compact('detail_transaksi', 'transaksi','paket',));

    }

    public function data(){
        $detail_transaksi = Detail_Transaksi::orderBy('id', 'desc')->get();

        return datatables()
        ->of($detail_transaksi)
        ->addIndexColumn()
        ->addColumn('transaksi_id', function($detail_transaksi){
            return !empty($detail_transaksi->transaksi->nama) ? $detail_transaksi->transaksi->nama : '-';
        })
        ->addColumn('paket_id', function($paket){
            return !empty($detail_transaksi->paket->nama) ? $detail_transaksi->paket->nama : '-';
        })
        ->addColumn('aksi', function($paket){
            return'
            <div class="btn-group">
                <button onclick="editData(`'.route('detail_transaksi.update', $detail_transaksi->id).'`)" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`'.route('detail_transaksi.destroy', $detail_transaksi->id).'`)" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i></button>
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
        return view('detail_transaksi.form');
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
            'transaksi_id' => 'required',
            'paket_id' => 'required',
            'qty' => 'required|numeric'
        ]);

       $paket = Paket::create([
        'transaksi_id' =>$request->transaksi_id,
        'paket_id' => $request->paket_id,
        'qty' => $request->qty
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
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $detail_transaksi = Detail_Transaksi::find($id);
        return response()->json($detail_transaksi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $detail_transaksi = Detail_Transaksi::find($id);
        $transaksi = Transaksi::find($id);
        $paket = Paket::find($id);
        $detail_transaksi->transaksi_id = $request->transaksi_id;
        $detail_transaksi->paket_id = $request->paket_id;
        $detail_transaksi->qty = $request->qty;
        return view('detail_transaksi.form', compact('paket', 'transaksi', 'detail_transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $detail_transaksi = Detail_Transaksi::find($id);
        $detail_transaksi->transaksi_id = $request->transaksi_id;
        $detail_transaksi->paket_id = $request->paket_id;
        $detail_transaksi->qty = $request->qty;
        $detail_transaksi->update();
        return response()->json('Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $detail_transaksi = Detail_Transaksi::find($id);
        $detail_transaksi->delete();
    }
}
