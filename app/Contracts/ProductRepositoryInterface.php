<?php

namespace App\Contracts;

use App\Contracts\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function allEvent();

    public function allCategory();

    public function storeProductImage($v, $product_id);

    public function deleteProductImage($id);
}