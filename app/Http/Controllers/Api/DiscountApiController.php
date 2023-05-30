<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ProductRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountApiController extends Controller
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list(Request $req)
    {
        $data = $this->repo->coupon_list();

        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Berhasi mendapatkan data'
            ],
            'data' => $data
        ]);
    } 
}
