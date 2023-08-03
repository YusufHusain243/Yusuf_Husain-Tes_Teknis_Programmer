<?php

namespace App\Repository;

use App\Models\Kabupaten;
use App\Models\Provinsi;

class KabupatenImplements implements KabupatenRepository
{
    public function index()
    {
        return [
            'kabupaten' => Kabupaten::all(),
            'provinsi' => Provinsi::all(),
        ];
    }

    public function store($data)
    {
        return Kabupaten::create($data);
    }

    public function destroy($kabupaten)
    {
        return $kabupaten->delete();
    }

    public function update($data, $kabupaten)
    {
        return $kabupaten->update($data);
    }
}
