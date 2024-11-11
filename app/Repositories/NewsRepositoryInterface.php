<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsRepositoryInterface
{
    public function all(): Collection;
    public function find($id): News;
    public function create(array $data): News;
    public function update($id, array $data): News;
    public function delete($id): void;
    public function search($search, $categoryId): LengthAwarePaginator;
}
