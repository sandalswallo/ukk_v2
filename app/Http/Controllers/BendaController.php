<?php

namespace App\Http\Controllers;

use App\Models\Benda;
use Illuminate\Http\Request;
use Validator;


class BendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $benda = Benda::all();
        return view('benda.index', compact('benda'));
    }

    public function data(){
        $benda = Benda::orderBy('id', 'desc')->get();

        return datatables()
        ->of($benda)
        ->addIndexColumn()
        ->addColumn('aksi', function($benda){
            return'
            <div class="btn-group">
                <button onclick="editData(`'.route('benda.update', $benda->id).'`)" class="btn btn-flat btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`'.route('benda.destroy', $benda->id).'`)" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i></button>
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
        return view('benda.form');
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

       $benda = Benda::create([
        'nama' => $request->nama
       ]);

       return response()->json([
        'success' => true,
        'massage' => 'Data berhasil disimpan',
        'data' => $benda
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\benda  $benda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $benda = Benda::find($id);
        return response()->json($benda);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\benda  $benda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $benda = Benda::find($id);
        return view('benda.form', compact('benda')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\benda  $benda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $benda = Benda::find($id);
        $benda->nama = $request->nama;
        $benda->update();
        return response()->json('Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\benda  $benda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $benda = Benda::find($id);
        $benda->delete();
    }
}
