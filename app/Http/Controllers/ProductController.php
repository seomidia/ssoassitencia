<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        return view('vendor.voyager.produtos.produtos');
    }
    public function Single($slug){
        return view('product.single');
    }

}
