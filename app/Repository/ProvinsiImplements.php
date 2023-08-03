<?php

namespace App\Repository;

use App\Models\Provinsi;

class ProvinsiImplements implements ProvinsiRepository
{
    public function index()
    {
        return Provinsi::all();
    }

    public function store($data)
    {
        return Provinsi::create($data);
    }

    public function destroy($provinsi)
    {
        return $provinsi->delete();
    }

    public function update($data, $provinsi)
    {
        return $provinsi->update($data);
    }
}
