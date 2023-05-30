<?php

namespace App\Repositories;
use App\Models\Product;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

interface ProductInterface
{
    public function getAll();
    public function getById($id);
    // public function create(array $data);
    public function update_qty($id, array $data);
    public function delete($id);
    public function coupon_list();
    public function sum_price();

    public function getUserByEmail($email);
}

class ProductRepository implements ProductInterface
{
    public function getAll() 
    {
        return Product::whereNull('deleted_at')->get();
    }

    public function getById($id)
    {
        return Product::where('id', $id)->get();
    }

    public function update_qty($id, $data) 
    {
        $product = Product::find($id);
        $product->quantity = $data['qty'];
        $product->total_price = $product->price * $data['qty'];
        $product->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $product->save();

        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->deleted_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $product->save();

        return $product;
    }

    public function sum_price()
    {
        return Product::whereNull('deleted_at')->sum('total_price');
    }

    public function coupon_list()
    {
        return Discount::all();
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}