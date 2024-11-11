<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsServiceInterface
{
    public function getAll(): LengthAwarePaginator;
    public function find($id): News;
    public function store(array $data): News;
    public function update($id, array $data): News;
    public function delete($id): void;
}
