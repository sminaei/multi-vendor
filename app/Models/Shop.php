<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'seller_id','shop_name','shop_phone',
       ' shop_address', 'shop_description', 'shop_logo'
    ];
}
