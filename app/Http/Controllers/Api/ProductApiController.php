<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ProductRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function detail(Request $request)
    {
        $data = $this->repo->getById($request->id);

        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Berhasi mendapatkan data'
            ],
            'data' => $data[0]
        ]);
    }

    public function update_qty(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;

        if ($qty <= 0) {
            return response()->json([
                'meta' => [
                    'code' => 400,
                    'message' => 'Kuantitas tidal boleh kurang dari 1'
                ]
            ]);
        }

        $this->repo->update_qty($id, ['qty' => $qty]);

        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Berhasi mengubah kuantitas'
            ]
        ]);
    }

    public function get_total_price()
    {
        $data = $this->repo->sum_price();
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Berhasi mendapatkan data'
            ],
            'data' => $data
        ]);
    }

    public function delete_data(Request $request)
    {
        $data = $this->repo->delete($request->id);
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Berhasi menghapus data'
            ]
        ]);
    }
}
