<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Outlet;
use App\Models\Paket;

class Detail_Transaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id', 
        'paket_id', 
        'qty'
    ];

    public function transaksi(){
        return $this->belongsToMany(Transaksi::class);
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }

    public function paket(){
        return $this->belongsTo(Paket::class);
    }
}
