<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Paket;
use Illuminate\Http\Request;
use Validator;

class Jenis_PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_paket = Jenis_Paket::all();
        return view('jenis_paket.index', compact('jenis_paket'));
    }

    public function data(){
        $jenis_paket = Jenis_Paket::orderBy('id', 'desc')->get();

        return datatables()
        ->of($jenis_paket)
        ->addIndexColumn()
        ->addColumn('aksi', function($jenis_paket){
            return'
            <div class="btn-group">
                <button onclick="editData(`'.route('jenis_paket.update', $jenis_paket->id).'`)" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`'.route('jenis_paket.destroy', $jenis_paket->id).'`)" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i></button>
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
        return view('jenis_paket.form');
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
            'nama' => 'required|alpha'   
        ]);

       $jenis_paket = Jenis_Paket::create([
        'nama' => $request->nama
       ]);

       return response()->json([
        'success' => true,
        'massage' => 'Data berhasil disimpan',
        'data' => $jenis_paket
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jenis_paket  $jenis_paket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenis_paket = Jenis_Paket::find($id);
        return response()->json($jenis_paket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jenis_paket  $jenis_paket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis_paket = Jenis_Paket::find($id);
        return view('jenis_paket.form', compact('jenis_paket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jenis_paket  $jenis_paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jenis_paket = Jenis_Paket::find($id);
        $jenis_paket->nama = $request->nama;
        $jenis_paket->update();
        return response()->json('Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jenis_paket  $jenis_paket
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $jenis_paket = Jenis_Paket::find($id);
        $jenis_paket->delete();
    }
}
