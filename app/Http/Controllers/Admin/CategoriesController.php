<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function catSubcatList(Request $request){
        $data =  [
            'pageTitle' => 'Categories & sub categories maagmet'
        ];
        return view('back.pages.admin.cats-subcats-list',$data);

    }
    public function addCategory(Request $request){
        $data = [
            'pageTitle' => 'add category'
        ];
        return view('back.pages.admin.add-category',$data);
    }
}
