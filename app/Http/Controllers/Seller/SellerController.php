<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function login(Request $request){
        $data = [
            'pageTitle' => 'seller login'
        ];
        return view('back.pages.seller.auth.login',$data);
    }
    public function register(Request $request){
        $data = [
            'pageTitle' => 'Create seller account'
        ];
        return view('back.pages.seller.auth.register',$data);

    }
    public function home(Request $request){
        $data = [
            'pageTitle' => 'Create seller account'
        ];
        return view('back.pages.seller.home',$data);
    }
}
