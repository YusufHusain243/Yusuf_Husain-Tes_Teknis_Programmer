<?php

namespace App\Repository;

use App\Models\Kabupaten;
use App\Models\Penduduk;
use App\Models\Provinsi;
use Illuminate\Support\Facades\DB;

class PendudukImplements implements PendudukRepository
{
    public function index()
    {
        $penduduk = DB::table('penduduks')
            ->select(['penduduks.*', 'kabupatens.name AS kab', 'provinsis.name AS prov'])
            ->join('kabupatens', 'penduduks.id_kabupaten', '=', 'kabupatens.id')
            ->join('provinsis', 'penduduks.id_provinsi', '=', 'provinsis.id')
            ->get();
        return [
            'penduduk' => $penduduk,
            'kabupaten' => Kabupaten::all(),
            'provinsi' => Provinsi::all(),
        ];
    }

    public function kabupaten($id)
    {
        return Kabupaten::where('id_provinsi', $id)->get();
    }

    public function filterKabupaten($id)
    {
        $penduduk = DB::table('penduduks')
            ->select(['penduduks.*', 'kabupatens.name AS kab', 'provinsis.name AS prov'])
            ->join('kabupatens', 'penduduks.id_kabupaten', '=', 'kabupatens.id')
            ->join('provinsis', 'penduduks.id_provinsi', '=', 'provinsis.id')
            ->where('penduduks.id_kabupaten', '=', $id)
            ->get();
        return [
            'penduduk' => $penduduk,
            'kabupaten' => Kabupaten::all(),
            'provinsi' => Provinsi::all(),
        ];
    }

    public function filterProvinsi($id)
    {
        $penduduk = DB::table('penduduks')
            ->select(['penduduks.*', 'kabupatens.name AS kab', 'provinsis.name AS prov'])
            ->join('kabupatens', 'penduduks.id_kabupaten', '=', 'kabupatens.id')
            ->join('provinsis', 'penduduks.id_provinsi', '=', 'provinsis.id')
            ->where('penduduks.id_provinsi', $id)
            ->get();
        return [
            'penduduk' => $penduduk,
            'kabupaten' => Kabupaten::all(),
            'provinsi' => Provinsi::all(),
        ];
    }

    public function store($data)
    {
        return Penduduk::create($data);
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
