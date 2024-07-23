<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\UserInterface;

class CustomerController extends Controller
{
    public function home(){
        $data=UserInterface::where('id',1)->first();
        $user=User::where('role','user')->get();
        $category=Category::get();
        $product=Product::get();
        $brand=Brand::get();
        return view('main.customer.home.home',compact('data','user','category','product','brand'));
    }

    public function about(){
        $data=UserInterface::where('id',1)->first();
        return view('main.customer.about.about',compact('data'));
    }

    public function contact(){
        $data=UserInterface::where('id',1)->first();
        return view('main.customer.contact.contact',compact('data'));
    }

    public function cartList_customer(){
        return view('main.customer.product.cart');
    }

}
