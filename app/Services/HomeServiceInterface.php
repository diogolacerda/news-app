<?php

namespace App\Services;

interface HomeServiceInterface
{
    public function getAll();
    public function find($id);
}
