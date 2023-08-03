<?php

namespace App\Repository;

interface PendudukRepository{
    public function index();
    public function filterProvinsi($id);
    public function filterKabupaten($id);
    public function kabupaten($id);
    public function store($data);
    public function destroy($provinsi);
    public function update($data, $provinsi);
}
