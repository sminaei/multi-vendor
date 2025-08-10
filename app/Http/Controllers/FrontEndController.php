<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function homePage(){
        $data = [
            'pageTitle' => 'online shopping website'
        ];
        return view('front.pages.home',$data);
    }
}
