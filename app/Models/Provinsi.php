<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function provToKab()
    {
        return $this->hasMany(Kabupaten::class, 'id_provinsi', 'id');
    }
    
    public function provToPend()
    {
        return $this->hasMany(Penduduk::class, 'id_provinsi', 'id');
    }
}
