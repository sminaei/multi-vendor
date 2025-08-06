<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class AdminCategoriesSubcategoriesList extends Component
{
    public function render()
    {
        return view('livewire.admin-categories-subcategories-list',[
            'categories' => Category::orderBy('ordering','asc')->get()
        ]);
    }
}
