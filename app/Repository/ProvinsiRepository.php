<?php

namespace App\Repository;

interface ProvinsiRepository{
    public function index();
    public function store($data);
    public function destroy($provinsi);
    public function update($data, $provinsi);
}
