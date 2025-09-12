<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function all(): Collection;
    public function getCategories();
    public function getAllWithFilters($request);
    public function store($request);
    public function update($request, $product);
    public function find(int $id): ?Product;
    public function deleteProduct($product);

}
