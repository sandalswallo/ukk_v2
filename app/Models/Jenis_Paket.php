<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paket;

class jenis_paket extends Model
{
    use HasFactory;

    protected $table = 'jenis_paket';

    protected $fillable = ['nama'];

    public function paket(){
        return $this->belongsToMany(Paket::class);
    }

}
