<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryServiceInterface
{
    public function getAll(): LengthAwarePaginator;
    public function find($id): Category;
    public function store(array $data): Category;
    public function update($id, array $data): Category;
    public function delete($id): void;
}
