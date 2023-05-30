<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
// use App\Interfaces\ProductInterface;
// use App\Models\Product;

class ProductController extends Controller
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('shoping_cart', ['data' => $this->repo->getAll()]);   
    }
}
