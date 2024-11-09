<?php

namespace App\Repositories;

interface HomeRepositoryInterface
{
    public function all();
    public function find($id);
    public function search($search, $categoryId);
}
