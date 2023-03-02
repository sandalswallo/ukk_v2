<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jenis_Paket;
use App\Models\Benda;
use App\Models\Layanan;
use App\Models\Berat;

class Paket extends Model
{
    use HasFactory;

    
protected $table = 'paket';

    protected $fillable = ['jenis_paket_id', 'benda_id', 'layanan_id', 'berat_id','harga'];

    public function jenis_paket(){
        return $this->belongsTo(Jenis_Paket::class);
    }
    public function benda(){
        return $this->belongsTo(Benda::class);
    }
    public function layanan(){
        return $this->belongsTo(Layanan::class);
    }
    public function berat(){
        return $this->belongsTo(Berat::class);
    }
}
