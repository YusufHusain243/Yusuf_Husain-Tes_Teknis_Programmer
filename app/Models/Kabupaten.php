<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kabToProv()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi', 'id');
    }

    public function kabToPend()
    {
        return $this->hasMany(Penduduk::class, 'id_kabupaten', 'id');
    }
}
