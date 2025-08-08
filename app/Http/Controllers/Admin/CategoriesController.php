<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoriesController extends Controller
{
    public function catSubcatList(Request $request)
    {
        $data = [
            'pageTitle' => 'Categories & sub categories management'
        ];
        return view('back.pages.admin.cats-subcats-list', $data);

    }

    public function addCategory(Request $request)
    {
        $data = [
            'pageTitle' => 'add category'
        ];
        return view('back.pages.admin.add-category', $data);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:5|unique:categories,category_name',
            'category_image' => 'required|image|mimes:png,jpg,jpeg,svg'
        ], [
            'category_name.required' => ':Attribute is required',
            'category_name.min' => ':Attribute must contain at least 5 character',
            'category_name.unique' => 'This :Attribute already exist ',
            'category_image.required' => ':Attribute is required',
            'category_image.image' => ':Attribute is must be an image',
            'category_image.mimes' => ':Attribute must be in JPG,PNG,SVG format',

        ]);
        if ($request->hasFile('category_image')) {
            $path = 'images/categories/';
            $file = $request->file('category_image');
            $file_name = time() . '_' . $file->getClientOriginalName();
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path));
            }
            $upload = $file->move(public_path($path), $file_name);
            if ($upload) {
                $category = new Category();
                $category->category_name = $request->category_name;
                $category->category_image = $file_name;
                $saved = $category->save();

                if ($saved) {
                    return redirect()->route('admin.manage-categories.add-category')->with('success',
                        '<b>' . ucfirst($request->category_name) . '</b> category has been successfully added');
                } else {
                    return redirect()->route('admin.manage-categories.add-category')->with('fail', 'something went wrong');
                }
            } else {
                return redirect()->route('admin.manage-categories.add-category')->with('fail', 'something went wrong');
            }
        }
    }

    public function editCategory(Request $request)
    {
        $category_id = $request->id;
        $category = Category::findOrFail($category_id);
        $data = [
            'pageTitle' => 'Edit category',
            'category' => $category
        ];
        return view('back.pages.admin.edit-category', $data);
    }

    public function updateCategory(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::findOrFail($category_id);
        $request->validate([
            'category_name' => 'required|min:5|unique:categories,category_name,' . $category_id,
            'category_image' => 'nullable|image|mimes:png,jpg,jpeg,svg'
        ], [
            'category_name.required' => ':Attribute is required',
            'category_name.min' => ':Attribute must contain at least 5 character',
            'category_name.unique' => 'This :Attribute already exist ',
            'category_image.required' => ':Attribute is required',
            'category_image.image' => ':Attribute is must be an image',
            'category_image.mimes' => ':Attribute must be in JPG,PNG,SVG format',
        ]);
        if ($request->hasFile('category_image')) {
            $path = 'images/categories/';
            $file = $request->file('category_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $old_category_image = $category->category_image;
            $upload = $file->move(public_path($path), $filename);
            if ($upload) {
                //delete old image
                if (File::exists(public_path($path . $old_category_image))) {
                    File::delete(public_path($path . $old_category_image));

                    $category->category_name = $request->category_name;
                    $category->category_image = $filename;
                    $category->category_slug = null;
                    $saved = $category->save();

                    if ($saved) {
                        return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('success',
                            '<b>' . ucfirst($request->category_name) . '</b> category has been successfully updated');
                    } else {
                        return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('fail', 'something went wrong');
                    }
                } else {
                    return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('fail', 'error when uploading image');
                }

            } else {
                $category->category_name = $request->category_name;
                $category->category_slug = null;
                $saved = $category->save();
                if ($saved) {
                    return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('success',
                        '<b>' . ucfirst($request->category_name) . '</b> category has been successfully added');
                } else {
                    return redirect()->route('admin.manage-categories.edit-category', ['id' => $category_id])->with('fail', 'something went wrong');
                }
            }
        }
    }
    public function addSubCategory(Request $request){
        $independent_subcategories = SubCategory::where('is_child_of',0)->get();
        $categories = Category::all();
        $data = [
            'pageTitle'=> 'add sub category',
            'categories' => $independent_subcategories
        ];
        return view('back.pages.admin.add-subcategory',$data);

    }
    public function storeSubCategory(Request $request)
    {
        $request->validate([
            'parent_category' => 'required|exists:categories,id',
            'subcategory_name' => 'required|min:5|unique:sub_categories,subcategory_name'
        ],[
            'parent_category.required' => ':Attribute is required',
            'parent_category_exists' => ':Attribute is not exist in categories table',
            'subcategory_name.required' => ':Attribute is required',
            'subcategory_name.min' => ':Attribute must contain at least 5 character',
            'subcategory_name.unique' => ':Attribute is already exist',
        ]);
        $subcategory = new SubCategory();
        $subcategory->category_id = $request->parent_category;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->is_child_of = $request->is_child_of;
        $saved =  $subcategory->save();
        if($saved){
            return redirect()->route('admin.manage-categories.add-subcategory')->with('succes', '<b>' . ucfirst($request->subcategory_name) . '</b> sub category has been successfully added');
        }else{
            return redirect()->route('admin.manage-categories.add-subcategory')->with('fail', 'something went wrong');

        }

    }
}

