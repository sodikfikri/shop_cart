<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $connection = 'mysql';
    protected $table = 'product';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    // public $table = 'product';
    
    // public $fillable = [
    //     'name',
    //     'code',
    //     'description',
    //     'price',
    //     'image',
    //     'quantity',
    //     'coupon_id',
    // ];

    // /**
    //  * The attributes that should be casted to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'id' => 'integer',
    //     'name' => 'string',
    //     'code' => 'string',
    //     'description' => 'string',
    //     'price' => 'integer',
    //     'image' => 'string',
    //     'quantity' => 'integer',
    //     'coupon_id' => 'integer'
    // ];

    // /**
    //  * Validation rules
    //  *
    //  * @var array
    //  */
    // public static $rules = [
    //     'name' => 'required|string|max:100',
    //     'code' => 'required|string|max:20',
    //     'description' => 'string',
    //     'price' => 'required|integer',
    //     'image' => 'string',
    //     'quantity' => 'required|integer',
    //     'coupon_id' => 'integer'
    // ];

}
