<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;
use App\Models\Member;
use App\Models\User;

class transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'outlet_id', 
        'kode_invoice', 
        'member_id', 
        'tanggal', 
        'batas_waktu',
        'tanggal_bayar',
        'biaya_tambahan',
        'diskon',
        'status',
        'bayar',
        'user_id',
    ];

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
