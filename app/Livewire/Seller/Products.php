<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    public $perPage = 9;
    public function render()
    {
        return view('livewire.seller.products',['products' => Product::where('user_type','seller')
    ->where('seller_id',auth('seller')->id())
            ->paginate($this->perPage)
        ]);
    }
}
