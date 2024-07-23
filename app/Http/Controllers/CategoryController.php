<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list_admin(){
        $category=Category::select('categories.*','users.name as username')
                    ->leftJoin('users','categories.add_by','users.id')
                    ->get();
        return  view('main.admin.category.list',compact('category'));
    }

    public function addPage_admin(){
        return view('main.admin.category.add');
    }

    public function add_admin(Request $req){
        Validator::make($req->all(),[
            'name'=>'required',
            'image'=>'required'
        ])->validate();
        $data=[
            'name'=>$req->name,
            'add_by'=>Auth::user()->id,
        ];
        $image=uniqid().'_category_'.$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public/category',$image);
        $data['image']=$image;
        Category::create($data);
        return redirect()->route('admin#categoryList')->with(['success'=>'Category create successful.']);
    }

    public function view_admin($id){
        $category=Category::select('categories.*','users.name as username')
        ->leftJoin('users','categories.add_by','users.id')
        ->where('categories.id',$id)->first();
        $productCount=count(Product::where('category_id',$id)->get());
        $category['product']=$productCount;
        return  view('main.admin.category.view',compact('category'));
    }

    public function edit_admin($id){
        $category=Category::where('id',$id)->first();
        return view('main.admin.category.edit',compact('category'));
    }

    public function update_admin(Request $req){
        $data=[
            'name'=>$req->name,
        ];
        if ($req->hasFile('image')) {
            $oldImage=Auth::user()->image;
            if ($oldImage!=null) {
                Storage::delete('public/category/'.$oldImage);
            }
            $image=uniqid().'_category_'.$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/category',$image);
            $data['image']=$image;
        }
        Category::where('id',$req->id)->update($data);
        return redirect()->route('admin#categoryList')->with(['success'=>'Category update successful.']);
    }

    public function delete_admin($id){
        $category=Category::where('id',$id)->first();
        if ($category->image!=null) {
            Storage::delete('public/category/'.$category->image);
        }
        Product::where('category_id',$id)->update(['category_id'=>1]);
        Category::where('id',$id)->delete();
        return redirect()->route('admin#categoryList')->with(['danger'=>'Category delete successful.']);
    }

    public function list_user(){
        $category=Category::select('categories.*','users.name as username')
                    ->leftJoin('users','categories.add_by','users.id')
                    ->get();
        return  view('main.user.category.list',compact('category'));
    }

    public function addPage_user(){
        return view('main.user.category.add');
    }

    public function add_user(Request $req){
        Validator::make($req->all(),[
            'name'=>'required',
            'image'=>'required'
        ])->validate();
        $data=[
            'name'=>$req->name,
            'add_by'=>Auth::user()->id,
        ];
        $image=uniqid().'_category_'.$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public/category',$image);
        $data['image']=$image;
        Category::create($data);
        return redirect()->route('user#categoryList')->with(['success'=>'Category create successful.']);
    }

    public function view_user($id){
        $category=Category::select('categories.*','users.name as username')
        ->leftJoin('users','categories.add_by','users.id')
        ->where('categories.id',$id)->first();
        $productCount=count(Product::where('category_id',$id)->get());
        $category['product']=$productCount;
        return  view('main.user.category.view',compact('category'));
    }

    public function edit_user($id){
        $category=Category::where('id',$id)->first();
        return view('main.user.category.edit',compact('category'));
    }

    public function update_user(Request $req){
        $data=[
            'name'=>$req->name,
        ];
        if ($req->hasFile('image')) {
            $oldImage=Auth::user()->image;
            if ($oldImage!=null) {
                Storage::delete('public/category/'.$oldImage);
            }
            $image=uniqid().'_category_'.$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/category',$image);
            $data['image']=$image;
        }
        Category::where('id',$req->id)->update($data);
        return redirect()->route('user#categoryList')->with(['success'=>'Category update successful.']);
    }

    public function delete_user($id){
        $category=Category::where('id',$id)->first();
        if ($category->image!=null) {
            Storage::delete('public/category/'.$category->image);
        }
        Product::where('category_id',$id)->update(['category_id'=>1]);
        Category::where('id',$id)->delete();
        return redirect()->route('user#categoryList')->with(['danger'=>'Category delete successful.']);
    }

    public function categoryList_customer(){
        $category=Category::when(request('search_key'),function($query){
            $query->whereAny([
                'categories.name',
            ], 'LIKE','%'.request('search_key').'%');
        })->paginate(10);
        for ($i=0; $i <count($category) ; $i++) {
            $category[$i]->count=count(Product::where('category_id',$category[$i]->id)->get());
        }
        return view('main.customer.category.list',compact('category'));
    }

    public function categoryProductList($id){
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
                        })->where('products.active',1)->where('products.category_id',$id)->paginate(10);
        return view('main.customer.product.list',compact('product'));
    }

}
