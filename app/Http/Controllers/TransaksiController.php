<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Outlet;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

use Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bulan = date('m');
        $tahun = date('Y');
        $maxid = Transaksi::max('id')+1;

        $transaksi = Transaksi::all();
        $outlet = Outlet::all();
        $member = Member::all();
        $user = User::all();


        $kode_invoice = 'INV'. '/'. $maxid. '/'. $bulan. '/'. $tahun;

        return view('transaksi.index', compact('transaksi', 'outlet', 'member', 'kode_invoice','user'));
    }

    public function data(){
        $transaksi = Transaksi::orderBy('id', 'desc')->get();

        return datatables()
        ->of($transaksi)
        ->addIndexColumn()
        ->editColumn('outlet_id', function($transaksi){
            return $transaksi->outlet->nama;
        })
        ->editColumn('member_id', function($transaksi){
            return $transaksi->member->nama;
        })
        ->editColumn('user_id', function($transaksi){
            return $transaksi->user->nama;
        })
        ->addColumn('aksi', function($transaksi){
            return'
            <div class="btn-group">
                <button onclick="editData(`'.route('transaksi.update', $transaksi->id).'`)" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`'.route('transaksi.destroy', $transaksi->id).'`)" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i></button>
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
        return view('transaksi.form');
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
            'outlet_id' => 'required',
            'kode_invoice' => 'required',
            'member_id' => 'required',
            'tanggal' => 'required',
            'batas_waktu' => 'required',
            'tanggal_bayar' => 'required',
            'biaya_tambahan' => 'required|min:0',
            'diskon' => 'required|min:0',
            'status' => 'required',
            'bayar' => 'required',
            'user_id' => 'required'
        ]);

        $transaksi = transaksi::create([
            'outlet_id' => $request->outlet_id,
            'kode_invoice' => $request->kode_invoice,
            'member_id' =>$request->member_id,
            'tanggal' => $request->tanggal,
            'batas_waktu' => $request->batas_waktu,
            'tanggal_bayar' => $request->tanggal_bayar,
            'biaya_tambahan' => $request->biaya_tambahan,
            'diskon' => $request->diskon,
            'status' => $request->status,
            'bayar' => $request->bayar,
            'user_id' => $request->user_id
           ]);
    
           return response()->json([
            'success' => true,
            'massage' => 'Data berhasil disimpan',
            'data' => $transaksi
           ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = transaksi::find($id);
        
        return response()->json($transaksi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $outlet = Outlet::find($id);
        $member = Member::find($id);
        $user = User::find($id);
        $transaksi->outlet_id = $request->outlet_id;
        $transaksi->kode_invoice = $request->kode_invoice;
        $transaksi->member_id = $request->member_id;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->batas_waktu = $request->batas_waktu;
        $transaksi->tanggal_bayar = $request->tanggal_bayar;
        $transaksi->biaya_tambahan = $request->biaya_tambahan;
        $transaksi->diskon = $request->diskon;
        $transaksi->status = $request->status;
        $transaksi->bayar = $request->bayar;
        $transaksi->user_id = $request->user_id;
        return view('transaksi.form', compact('transaksi', 'outlet', 'member', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->outlet_id = $request->outlet_id;
        $transaksi->kode_invoice = $request->kode_invoice;
        $transaksi->member_id = $request->member_id;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->batas_waktu = $request->batas_waktu;
        $transaksi->tanggal_bayar = $request->tanggal_bayar;
        $transaksi->biaya_tambahan = $request->biaya_tambahan;
        $transaksi->diskon = $request->diskon;
        $transaksi->status = $request->status;
        $transaksi->bayar = $request->bayar;
        $transaksi->user_id = $request->user_id;
        $transaksi->update();
        return response()->json('Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
    }
}
