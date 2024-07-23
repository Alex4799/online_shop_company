<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function list_admin(){
        $brand=Brand::select('brands.*','users.name as user_name')
                ->leftJoin('users','brands.user_id','users.id')
                ->get();
        return  view('main.admin.brand.list',compact('brand'));
    }

    public function addPage_admin(){
        return view('main.admin.brand.add');
    }

    public function add_admin(Request $req){
        Validator::make($req->all(),[
            'name'=>'required',
            'image'=>'required'
        ])->validate();
        $data=[
            'name'=>$req->name,
            'user_id'=>Auth::user()->id,
        ];
        $image=uniqid().'_brand_'.$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public/brand',$image);
        $data['image']=$image;
        Brand::create($data);
        return redirect()->route('admin#brandList')->with(['success'=>'Brand create successful.']);
    }

    public function view_admin($id){
        $brand=Brand::select('brands.*','users.name as user_name')
                ->leftJoin('users','brands.user_id','users.id')
                ->where('brands.id',$id)
                ->first();
        $productCount=count(Product::where('brand_id',$id)->get());
        $brand['product']=$productCount;
        return  view('main.admin.brand.view',compact('brand'));
    }

    public function edit_admin($id){
        $brand=Brand::where('id',$id)->first();
        return view('main.admin.brand.edit',compact('brand'));
    }

    public function update_admin(Request $req){
        $data=[
            'name'=>$req->name,
        ];
        if ($req->hasFile('image')) {
            $oldImage=Brand::where('id',$req->id)->first()->image;
            if ($oldImage!=null) {
                Storage::delete('public/brand/'.$oldImage);
            }
            $image=uniqid().'_brand_'.$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/brand',$image);
            $data['image']=$image;
        }
        Brand::where('id',$req->id)->update($data);
        return redirect()->route('admin#brandList')->with(['success'=>'Brand update successful.']);
    }

    public function delete_admin($id){
        $brand=Brand::where('id',$id)->first();
        if ($brand->image!=null) {
            Storage::delete('public/brand/'.$brand->image);
        }
        Product::where('brand_id',$id)->update(['brand_id'=>1]);
        Brand::where('id',$id)->delete();
        return redirect()->route('admin#brandList')->with(['danger'=>'Brand delete successful.']);
    }

    public function list_user(){
        $brand=Brand::get();
        return  view('main.user.brand.list',compact('brand'));
    }

    public function addPage_user(){
        return view('main.user.brand.add');
    }

    public function add_user(Request $req){
        Validator::make($req->all(),[
            'name'=>'required',
            'image'=>'required'
        ])->validate();
        $data=[
            'name'=>$req->name,
            'user_id'=>Auth::user()->id,
        ];
        $image=uniqid().'_brand_'.$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public/brand',$image);
        $data['image']=$image;
        Brand::create($data);
        return redirect()->route('user#brandList')->with(['success'=>'Brand create successful.']);
    }

    public function view_user($id){
        $brand=Brand::where('brands.id',$id)->first();
        $productCount=count(Product::where('brand_id',$id)->get());
        $brand['product']=$productCount;
        return  view('main.user.brand.view',compact('brand'));
    }

    public function edit_user($id){
        $brand=Brand::where('id',$id)->first();
        return view('main.user.brand.edit',compact('brand'));
    }

    public function update_user(Request $req){
        $data=[
            'name'=>$req->name,
        ];
        if ($req->hasFile('image')) {
            $oldImage=Brand::where('id',$req->id)->first()->image;
            if ($oldImage!=null) {
                Storage::delete('public/brand/'.$oldImage);
            }
            $image=uniqid().'_brand_'.$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/brand',$image);
            $data['image']=$image;
        }
        Brand::where('id',$req->id)->update($data);
        return redirect()->route('user#brandList')->with(['success'=>'Brand update successful.']);
    }

    public function delete_user($id){
        $brand=Brand::where('id',$id)->first();
        if ($brand->image!=null) {
            Storage::delete('public/brand/'.$brand->image);
        }
        Product::where('brand_id',$id)->update(['brand_id'=>null]);
        Brand::where('id',$id)->delete();
        return redirect()->route('user#brandList')->with(['danger'=>'Brand delete successful.']);
    }

    public function brandList_customer(){
        $brand=Brand::when(request('search_key'),function($query){
            $query->whereAny([
                'brands.name',
            ], 'LIKE','%'.request('search_key').'%');
        })->paginate(10);
        for ($i=0; $i <count($brand) ; $i++) {
            $brand[$i]->count=count(Product::where('brand_id',$brand[$i]->id)->get());
        }
        return view('main.customer.brand.list',compact('brand'));
    }

    public  function brandProductList($id){
        $product=Product::select('categories.name as category_name','brands.name as brand_name','users.name as user_name','products.*')
        ->leftJoin('categories','products.category_id','categories.id')
        ->leftJoin('brands','products.brand_id','brands.id')
        ->leftJoin('users','products.user_id','users.id')
        ->when(request('search_key'),function($query){
            $query->whereAny([
                'products.name',
                'categories.name',
                'brands.name',
            ], 'LIKE','%'.request('search_key').'%');
        })->when(request('min'),function($query){
            $query->whereBetween('products.price', [request('min'), request('max')]);
        })->where('products.active',1)->where('products.brand_id',$id)->paginate(10);
        return view('main.customer.product.list',compact('product'));
    }
}
