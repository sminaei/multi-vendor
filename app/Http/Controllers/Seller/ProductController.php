<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Rules\ValidatePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        $data = [
            'pageTitle' => 'Add Product',
            'categories' => Category::orderBy('category_name', 'asc')->get()
        ];
        return view('back.pages.seller.add-product', $data);
    }

    public function getProductCategory(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::findOrFail($category_id);
        $subCategories = SubCategory::where('category_id', $category_id)->where('is_child_of', 0)->orderBy('subcategory_name', 'asc')->get();
        $html = '';
        foreach ($subCategories as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->subcategory_name . '</option>';
            if (count($item->children) > 0) {
                foreach ($item->children as $child) {
                    $html .= '<option value="' . $child->id . '">' . $child->subcategory_name . '</option>';
                }
            }
        }
        return response()->json(['status' => 1, 'data' => $html]);

    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'summary' => 'required|min:100',
            'product_image' => 'required|mimes:png,jpg,jpeg|max:1024',
            'category' => 'required|exists:categories,id',
            'subcategory' => 'required|exists:sub_categories,id',
            'price' => ['required', new ValidatePrice],
            'compare_price' => ['nullable', new ValidatePrice]
        ], [
            'name.required' => 'enter product name',
            'name.unique' => 'this product name is already taken',
            'summary.required' => 'write summary for this product ',
            'product_image.required' => 'choose product image',
            'category.required' => 'select product category',
            'subcategory.required' => 'select product sub category',
            'price.required' => 'enter product price',
            'compare_price.required' => 'enter product compare price',
        ]);
        $product_image = null;
        if ($request->hasFile('product_image')) {
            $path = 'images/products/';
            $file = $request->file('product_image');
            $filename = 'PIMG_' . time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $upload = $file->move(public_path($path), $filename);
            if ($upload) {
                $product_image = $filename;
            } else {
                return back()->with('error', 'image not uploaded');
            }
            $product = new Product();
            $product->user_type = 'seller';
            $product->seller_id = auth('seller')->id();
            $product->name = $request->name;
            $product->summary = $request->summary;
            $product->category = $request->category;
            $product->subcategory = $request->subcategory;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->visibility = $request->visibility;
            $product->product_image = $product_image;
            $saved = $product->save();
            if ($saved) {
                return response(['status' => 1, 'msg' => 'new product has been successfully created']);
            } else {
                return response(['status' => 0, 'msg' => 'something went wrong']);

            }
        }
    }
    public function allProducts(){
          $data = [
            'pageTitle' => 'My Products',

        ];
        return view('back.pages.seller.products', $data);

    }

    public function editProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $categories = Category::orderBy('category_name','asc')->get();
        $subcategories = SubCategory::where('category_id',$product->category)
        ->where('is_child_of',0)
        ->orderBy('subcategory_name','asc')->get();
        $data = [
            'pageTitle' => 'Edit Product',
            'categories' => $categories,
            'subcategories' => $subcategories,
            'product' => $product,
        ];
        return view('back.pages.seller.edit-products', $data);

    }

    public function updateProduct(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product_image = $product->product_image;
        $request->validate([
            'name' => 'required|unique:products,name,'.$product->id,
            'summary' => 'required|min:100',
            'product_image' => 'nullable|mimes:png,jpg,jpeg|max:1024',
            'subcategory' =>'required|exists:sub_categories,id',
            'price' => ['required', new ValidatePrice()],
            'compare_price' => ['nullable', new ValidatePrice()],
        ],[
            'name.required' => 'enter product name',
            'name.unique' => 'this name is already taken',
            'summary.required' => 'write product summary',
            'subcategory.required' => 'enter subcategory name',
            'price.required' => 'enter product price ',
        ]);
        if ($request->hasFile('product_image')){
            $path = 'images/products/';
            $file = $request->hasFile('product_image');
            $filename = 'PIMG_'.time().uniqid().'.'.$file->getClientOriginalExtension();
            $old_product_image = $product->product_image;
            $upload = $file->move(public_path($path),$filename);
            if ($upload){
                if (File::exists(public_path($path.$old_product_image))){
                    File::delete(public_path($path.$old_product_image));
                }
                $product_image = $filename;
            }
        }
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->summary = $request->summary;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->visibility = $request->visibility;
        $product->product_image = $request->product_image;
        $updated = $product->save();
        if($updated){
            return response()->json(['status'=> 1,'msg'=> 'product successfully updated']);
        }else{
            return response()->json(['status'=> 0,'msg'=> 'something went wrong']);

        }

    }
    public function uploadProductImages(Request $request){
        $product = Product::findOrFail($request->product_id);
        $path = "images/products/additionals/";
        $file = $request->file('file');
    }
}
