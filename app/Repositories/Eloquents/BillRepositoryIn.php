<?php

namespace App\Repositories\Eloquents;

use App\Bill;
use app\Contracts\BillRepositoryInterface;

class BillRepositoryIn extends ElequentRepository implements BillRepositoryInterface
{
    public function getModel()
    {
        return Bill::class;
    }
}
