<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use http\Env\Request;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class AdminCategoriesSubcategoriesList extends Component
{
    protected $listeners = [
        "updateCategoriesOrdering",
        "deleteCategory"
    ];
    public function updateCategoriesOrdering($positions){
        foreach ($positions as $position){
            $index = $position[0];
            $newPosition = $position[1];
            Category::where('id',$index)->update([
                'ordering' => $newPosition
            ]);
            $this->showToaster('success','Categories ordering has been successfully updated');
        }
            foreach ($positions as $position){
                $index = $position[0];
                $newPosition = $position[1];
                Category::where('id',$index)->update([
                    'ordering' => $newPosition
                ]);
                $this->showToaster('success','Categories ordering has been successfully updated');
            }
    }
    public function deleteCategory($category_id){
        $category = Category::findOrFail($category_id);
        $path = 'images/categories/';
        $category_image = $category->category_image;

        //if category has subcategory

        if (File::exists(public_path($path.$category_image))){
            File::delete($path.$category_image);
        }
        $delete = $category->delete();
        if ($delete){
            $this->showToaster('success','category successfully deleted');
        }else{
            $this->showToaster('error','something went wrong');
        }

    }


    public function showToaster($type,$message){
        return $this->dispatchBrowserEvent('showToaster',[
            'type' => $type,
            'message' => $message
        ]);

    }
    public function render()
    {
        return view('livewire.admin-categories-subcategories-list',[
            'categories' => Category::orderBy('ordering','asc')->get(),
            'subcategories' => SubCategory::orderBy('ordering','asc')->get()
        ]);
    }
}
