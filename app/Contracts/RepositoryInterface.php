<?php

namespace App\Contracts;

interface RepositoryInterface
{
    public function findOrFail($id);

    public function getAll();

    public function find($id);

    public function create(array $arr);

    public function update($id, array $arr);

    public function delete($id);
}
