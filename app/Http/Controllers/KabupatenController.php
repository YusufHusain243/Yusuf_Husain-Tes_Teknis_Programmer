<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Http\Requests\StoreKabupatenRequest;
use App\Http\Requests\UpdateKabupatenRequest;
use App\Repository\KabupatenRepository;

class KabupatenController extends Controller
{
    protected $kabupatenRepository;

    public function __construct(KabupatenRepository $kabupatenRepository)
    {
        $this->kabupatenRepository = $kabupatenRepository;
    }

    public function index()
    {
        return view('kelolaKabupaten', [
            'data' => $this->kabupatenRepository->index(),
        ]);
    }
    public function store(StoreKabupatenRequest $request)
    {
        if ($request->validated()) {
            if ($this->kabupatenRepository->store($request->all())) {
                return redirect('/kelolaKabupaten')->with('KabupatenSuccess', 'Tambah Kabupaten Berhasil');
            }
            return redirect('/kelolaKabupaten')->with('KabupatenError', 'Tambah Kabupaten Gagal');
        }
    }

    public function update(UpdateKabupatenRequest $request, Kabupaten $kabupaten)
    {
        if ($request->validated()) {
            if ($this->kabupatenRepository->update($request->all(), $kabupaten)) {
                return redirect('/kelolaKabupaten')->with('KabupatenSuccess', 'Edit Kabupaten Berhasil');
            }
            return redirect('/kelolaKabupaten')->with('KabupatenError', 'Edit Kabupaten Gagal');
        }
    }

    public function destroy(Kabupaten $kabupaten)
    {
        if ($this->kabupatenRepository->destroy($kabupaten)) {
            return redirect('/kelolaKabupaten')->with('KabupatenSuccess', 'Hapus Kabupaten Berhasil');
        }
        return redirect('/kelolaKabupaten')->with('KabupatenError', 'Hapus Kabupaten Gagal');
    }
}
