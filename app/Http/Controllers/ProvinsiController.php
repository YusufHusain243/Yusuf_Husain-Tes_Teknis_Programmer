<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Http\Requests\StoreProvinsiRequest;
use App\Http\Requests\UpdateProvinsiRequest;
use App\Repository\ProvinsiRepository;

class ProvinsiController extends Controller
{
    protected $provinsiRepository;

    public function __construct(ProvinsiRepository $provinsiRepository)
    {
        $this->provinsiRepository = $provinsiRepository;
    }
    
    public function index()
    {
        return view('kelolaProvinsi', [
            'data' => $this->provinsiRepository->index(),
        ]);
    }

    public function store(StoreProvinsiRequest $request)
    {
        if ($request->validated()) {
            if ($this->provinsiRepository->store($request->all())) {
                return redirect('/kelolaProvinsi')->with('ProvinsiSuccess', 'Tambah Provinsi Berhasil');
            }
            return redirect('/kelolaProvinsi')->with('ProvinsiError', 'Tambah Provinsi Gagal');
        }
    }

    public function update(UpdateProvinsiRequest $request, Provinsi $provinsi)
    {
        if ($request->validated()) {
            if ($this->provinsiRepository->update($request->all(),$provinsi)) {
                return redirect('/kelolaProvinsi')->with('ProvinsiSuccess', 'Edit Provinsi Berhasil');
            }
            return redirect('/kelolaProvinsi')->with('ProvinsiError', 'Edit Provinsi Gagal');
        }
    }
    
    public function destroy(Provinsi $provinsi)
    {
        if ($this->provinsiRepository->destroy($provinsi)) {
            return redirect('/kelolaProvinsi')->with('ProvinsiSuccess', 'Hapus Provinsi Berhasil');
        }
        return redirect('/kelolaProvinsi')->with('ProvinsiError', 'Hapus Provinsi Gagal');
    }
}
