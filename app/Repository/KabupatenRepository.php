<?php

namespace App\Repository;

interface KabupatenRepository{
    public function index();
    public function store($data);
    public function destroy($provinsi);
    public function update($data, $provinsi);
}
