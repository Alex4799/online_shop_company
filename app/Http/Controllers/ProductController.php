<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list_admin(){
        $product=Product::select('products.*','users.name as user_name','categories.name as category_name')
                ->leftJoin('users','products.user_id','users.id')
                ->leftJoin('categories','products.category_id','categories.id')
                ->get();
        return view('main.admin.products.list',compact('product'));
    }

    public function addPage_admin(){
        $category=Category::get();
        $brand=Brand::get();
        return view('main.admin.products.add',compact('category','brand'));
    }

    public function add_admin(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        $data['image']=[];
        foreach ($req->image as $item) {
            $image=uniqid().'_product_'.$item->getClientOriginalName();
            $item->storeAs('public/product',$image);
            array_push($data['image'],$image);
        }
        Product::create($data);
        return redirect()->route('admin#productList')->with(['success'=>'Product Create Successful.']);
    }

    public function view_admin($id){
        $product=Product::select('products.*','users.name as user_name','categories.name as category_name','brands.name as brand_name')
                ->where('products.id',$id)
                ->leftJoin('users','products.user_id','users.id')
                ->leftJoin('categories','products.category_id','categories.id')
                ->leftJoin('brands','products.brand_id','brands.id')
                ->first();
        return view('main.admin.products.view',compact('product'));
    }

    public function edit_admin($id){
        $product=Product::where('id',$id)->first();
        $category=Category::get();
        $brand=Brand::get();
        return view('main.admin.products.edit',compact('category','product','brand'));
    }

    public function update_admin(Request $req){
        $product=Product::where('id',$req->id)->first();
        $this->validation($req);
        $data=$this->changeFormat($req);
        $data['count']=$product->count+$req->count;
        $data['instock']=$product->instock+$req->count;
        $data['active']=$req->active;
        Product::where('id',$req->id)->update($data);
        return redirect()->route('admin#productList')->with(['success'=>'Product Update Successful.']);
    }

    public function editImage_admin($id){
        $product=Product::where('id',$id)->first();
        return view('main.admin.products.imageEdit',compact('product'));
    }

    public function updateImage_admin(Request $req){
        $data=Product::where('id',$req->id)->first()->image;
        $oldImage=$data[$req->index];
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            Storage::delete('public/product/'.$oldImage);
            $req->file('image')->storeAs('public/product',$newImage);
            $data[$req->index]=$newImage;
            Product::where('id',$req->id)->update(['image'=>$data]);
            return back()->with(['success'=>'Image update successful.']);
        }

        return back()->with(['danger'=>'Image field is required.']);

    }

    public function addImage_admin(Request $req){
        $data=Product::where('id',$req->id)->first()->image;
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/product',$newImage);
            array_push($data,$newImage);
            Product::where('id',$req->id)->update(['image'=>$data]);
            return back()->with(['success'=>'Image add successful.']);
        }
        return back()->with(['danger'=>'Image field is required.']);
    }

    public function deleteImage_admin($id,$index){
        $data=Product::where('id',$id)->first()->image;
        $oldImage=$data[$index];
        Storage::delete('public/product/'.$oldImage);
        unset($data[$index]);
        Product::where('id',$id)->update(["image"=>$data]);
        return back()->with(['danger'=>'Image delete successful.']);

    }

    public function delete_admin($id){
        $product=Product::where('id',$id)->first();
        foreach ($product->image as $item) {
            Storage::delete('public/product/'.$item);
        }
        Product::where('id',$id)->delete();
        return redirect()->route('admin#productList')->with(['danger'=>'Product Delete Successful.']);
    }

    public function list_user(){
        $product=Product::select('products.*','users.name as user_name','categories.name as category_name')
                ->leftJoin('users','products.user_id','users.id')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('user_id',Auth::user()->id)
                ->get();
        return view('main.user.products.list',compact('product'));
    }

    public function addPage_user(){
        $category=Category::get();
        $brand=Brand::get();
        return view('main.user.products.add',compact('category','brand'));
    }

    public function add_user(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        $data['image']=[];
        foreach ($req->image as $item) {
            $image=uniqid().'_product_'.$item->getClientOriginalName();
            $item->storeAs('public/product',$image);
            array_push($data['image'],$image);
        }
        Product::create($data);
        return redirect()->route('user#productList')->with(['success'=>'Product Create Successful.']);
    }

    public function view_user($id){
        $product=Product::select('products.*','users.name as user_name','categories.name as category_name','brands.name as brand_name')
                ->where('products.id',$id)
                ->leftJoin('users','products.user_id','users.id')
                ->leftJoin('categories','products.category_id','categories.id')
                ->leftJoin('brands','products.brand_id','brands.id')
                ->first();
        return view('main.user.products.view',compact('product'));
    }

    public function edit_user($id){
        $product=Product::where('id',$id)->first();
        $category=Category::get();
        $brand=Brand::get();
        return view('main.user.products.edit',compact('category','product','brand'));
    }

    public function update_user(Request $req){
        $product=Product::where('id',$req->id)->first();
        $this->validation($req);
        $data=$this->changeFormat($req);
        $data['count']=$product->count+$req->count;
        $data['instock']=$product->instock+$req->count;
        $data['active']=$req->active;
        Product::where('id',$req->id)->update($data);
        return redirect()->route('user#productList')->with(['success'=>'Product Update Successful.']);
    }

    public function editImage_user($id){
        $product=Product::where('id',$id)->first();
        return view('main.user.products.imageEdit',compact('product'));
    }

    public function updateImage_user(Request $req){
        $data=Product::where('id',$req->id)->first()->image;
        $oldImage=$data[$req->index];
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            Storage::delete('public/product/'.$oldImage);
            $req->file('image')->storeAs('public/product',$newImage);
            $data[$req->index]=$newImage;
            Product::where('id',$req->id)->update(['image'=>$data]);
            return back()->with(['success'=>'Image update successful.']);
        }
        return back()->with(['danger'=>'Image field is required.']);

    }

    public function addImage_user(Request $req){
        $data=Product::where('id',$req->id)->first()->image;
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/product',$newImage);
            array_push($data,$newImage);
            Product::where('id',$req->id)->update(['image'=>$data]);
            return back()->with(['success'=>'Image add successful.']);
        }
        return back()->with(['danger'=>'Image field is required.']);
        // dd($data);

    }

    public function deleteImage_user($id,$index){
        $data=Product::where('id',$id)->first()->image;
        if (isset($data[$index])) {
            $oldImage=$data[$index];
            Storage::delete('public/product/'.$oldImage);
            unset($data[$index]);
            Product::where('id',$id)->update(["image"=>$data]);
        }
        return back()->with(['danger'=>'Image delete successful.']);
    }

    public function delete_user($id){
        $product=Product::where('id',$id)->first();
        foreach ($product->image as $item) {
            Storage::delete('public/product/'.$item);
        }
        Product::where('id',$id)->delete();
        return redirect()->route('user#productList')->with(['danger'=>'Product Delete Successful.']);
    }

    public function allList_customer(){
        $product=Product::select('categories.name as category_name','brands.name as brand_name','users.name as user_name','products.*')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->leftJoin('brands','products.brand_id','brands.id')
                        ->leftJoin('users','products.user_id','users.id')
                        ->where('products.active',1)
                        ->when(request('search_key'),function($query){
                            $query->whereAny([
                                'products.name',
                                'categories.name',
                                'brands.name',
                            ], 'LIKE','%'.request('search_key').'%');
                        })->when(request('min'),function($query){
                            $query->whereBetween('products.price', [request('min'), request('max')]);
                        })->paginate(10);
        return view('main.customer.product.list',compact('product'));
    }

    public function view_customer($id){
        $product=Product::select('categories.name as category_name','brands.name as brand_name','users.name as user_name','products.*')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->leftJoin('brands','products.brand_id','brands.id')
                        ->leftJoin('users','products.user_id','users.id')
                        ->where('products.id',$id)->first();
        $method=PaymentMethod::where('user_id',$product->user_id)->get();
        return view('main.customer.product.view',compact('product','method'));
    }

    public function get_customer(Request $req){
        $data=[];
        $cart=$req->cart;
        foreach ($cart as $item) {
            $product=Product::select('products.*','users.name as user_name','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->leftJoin('users','products.user_id','users.id')
                ->where('products.id',$item['product_id'])->first();
            array_push($data,$product);
        };
        return response()->json($data, 200);
    }

    private function validation($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'price'=>'required',
            'count'=>'required',
        ])->validate();
    }

    private function changeFormat($req){
        return [
            'name'=>$req->name,
            'description'=>$req->description,
            'category_id'=>$req->category_id,
            'brand_id'=>$req->brand_id,
            'price'=>$req->price,
            'count'=>$req->count,
            'instock'=>$req->count,
            'user_id'=>Auth::user()->id,
        ];
    }
}
