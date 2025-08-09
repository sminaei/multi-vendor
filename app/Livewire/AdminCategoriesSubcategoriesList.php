<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use http\Env\Request;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriesSubcategoriesList extends Component
{
    use WithPagination;
    public $categoriesPerPage = 1;
    public $subCategoriesPerPage = 1;
    protected $listeners = [
        "updateCategoriesOrdering",
        "deleteCategory",
        "updateSubCategoryOrdering",
        "updateChildSubCategoryOrdering"
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
    public function updateSubCategoryOrdering($positions){
        foreach ($positions as $position){
            $index = $position[0];
            $newPosition = $position[1];
            SubCategory::where('id',$index)->update([
                'ordering' => $newPosition
            ]);
            $this->showToaster('success','Child sub Categories ordering has been successfully updated');
        }
    }
    public function updateChildSubCategoryOrdering($positions)
    {
        foreach ($positions as $position){
            $index = $position[0];
            $newPosition = $position[1];
            SubCategory::where('id',$index)->update([
                'ordering' => $newPosition
            ]);
            $this->showToaster('success','sub Categories ordering has been successfully updated');
        }
    }

        public function deleteCategory($category_id){
        $category = Category::findOrFail($category_id);
        $path = 'images/categories/';
        $category_image = $category->category_image;


            if ($category->subcategories->count() > 0) {
                //check  if there are product related to one of  child sub categories
                foreach ($category->subcategories as $subcategory) {
                    $subcategory = SubCategory::findOrFail($category_id);
                    $subcategory->delete();
                }

            }

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
    public function deleteSubCategory($subcategory_id)
    {
        $subcategory = SubCategory::findOrFail($subcategory_id);

        //if category has subcategory

        if ($subcategory->children->count() > 0) {
            //check  if there are product related to one of  child sub categories
            foreach ($subcategory->children as $child) {
                SubCategory::where('id', $child->id)->delete();
            }
            $subcategory->delete();
            $this->showToaster('success', 'Sub category has been successfully deleted');
        } else {
            $subcategory->delete();
            $this->showToaster('success', 'Sub category has been successfully deleted');

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
            'categories' => Category::orderBy('ordering','asc')->paginate($this->categoriesPerPage,['*'],'categoriesPage'),
            'subcategories' => SubCategory::where('is_child_of',0)->orderBy('ordering','asc')->paginate($this->subCategoriesPerPage,['*'],'subCategoriesPage')
        ]);
    }
}
