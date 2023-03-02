<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Aapp\Models\Paket;

class Berat extends Model
{
    use HasFactory;

    protected $table = 'berat';

    protected $fillable = ['nama'];

    public function paket(){
        return $this->belongsToMany(Paket::class);
    }
}
