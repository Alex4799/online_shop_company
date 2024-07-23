<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Mail\SupplierMail;
use Illuminate\Http\Request;
use App\Models\UserInterface;
use App\Models\SupplierProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function list_admin(){
        $supplier=Supplier::select('users.*','suppliers.*')
                ->leftJoin('users','suppliers.user_id','users.id')
                ->get();
        return  view('main.admin.supplier.list',compact('supplier'));
    }

    public function view_admin($id){
        $supplier=Supplier::select('users.*','suppliers.*')
        ->leftJoin('users','suppliers.user_id','users.id')
        ->where('suppliers.id',$id)
        ->first();

        $purchaseCount=count(Purchase::where('supplier_id',$id)->get());
        $supplier['purchase']=$purchaseCount;
        return  view('main.admin.supplier.view',compact('supplier'));
    }

    public function changeStatus_admin($status,$id){
        $supplier=Supplier::where('id',$id)->first();
        $user=User::where('id',$supplier->user_id)->first();
        if ($status==1) {
            User::where('id',$supplier->user_id)->update(['position'=>'supplier']);
            $mailData=[
                'title'=>'Supplier account create successful.',
                'body'=>"Hello $user->name. Your supplier account pending is successful. Now you are supplier."
            ];
            Mail::to($user->email)->send(new SupplierMail($mailData));

        }elseif($status==2){
            $mailData=[
                'title'=>'Supplier account create fail.',
                'body'=>"Hello $user->name. Your supplier account pending is fail. Please contact admin team and discuss about this."
            ];
            Mail::to($user->email)->send(new SupplierMail($mailData));

        }
        Supplier::where('id',$id)->update(['status'=>$status]);
        return redirect()->route('admin#supplierList')->with(['success'=>'Supplier account status change successful.']);
    }

    public function delete_admin($id){
        Supplier::where('id',$id)->delete();
        return redirect()->route('admin#supplierList')->with(['danger'=>'Supplier delete successful.']);
    }

    public function getSupplierInterface_admin(){
        $data=Supplier::where('status',0)->get();
        return response()->json($data, 200);
    }

    public function listProduct_admin(){
        $product=SupplierProduct::select('users.name as user_name','supplier_products.*','categories.name as category_name')
                ->leftJoin('users','supplier_products.user_id','users.id')
                ->leftJoin('categories','supplier_products.category_id','categories.id')
                ->get();
        return view('main.admin.supplier.product.product_list',compact('product'));
    }

    public function addPageProduct_admin(){
        $category=Category::get();
        $brand=Brand::get();
        return view('main.admin.supplier.product.add',compact('category','brand'));
    }

    public function addProduct_admin(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        $data['image']=[];
        foreach ($req->image as $item) {
            $image=uniqid().'_product_'.$item->getClientOriginalName();
            $item->storeAs('public/product',$image);
            array_push($data['image'],$image);
        }
        SupplierProduct::create($data);
        return redirect()->route('user#supplier_productList')->with(['success'=>'Product Create Successful.']);
    }

    public function viewProduct_admin($id){
        $product=SupplierProduct::select('supplier_products.*','users.name as user_name','categories.name as category_name','brands.name as brand_name')
                ->where('supplier_products.id',$id)
                ->leftJoin('users','supplier_products.user_id','users.id')
                ->leftJoin('categories','supplier_products.category_id','categories.id')
                ->leftJoin('brands','supplier_products.brand_id','brands.id')
                ->first();
        return view('main.admin.supplier.product.view',compact('product'));
    }

    public function editProduct_admin($id){
        $product=SupplierProduct::where('id',$id)->first();
        $category=Category::get();
        $brand=Brand::get();
        return view('main.admin.supplier.product.edit',compact('category','product','brand'));
    }

    public function updateProduct_admin(Request $req){
        $product=SupplierProduct::where('id',$req->id)->first();
        $this->validation($req);
        $data=$this->changeFormat($req);
        $data['count']=$product->count+$req->count;
        $data['instock']=$product->instock+$req->count;
        SupplierProduct::where('id',$req->id)->update($data);
        return redirect()->route('user#supplier_productList')->with(['success'=>'Product Update Successful.']);
    }

    public function editImageProduct_admin($id){
        $product=SupplierProduct::where('id',$id)->first();
        return view('main.admin.supplier.product.imageEdit',compact('product'));
    }

    public function updateImageProduct_admin(Request $req){
        $data=SupplierProduct::where('id',$req->id)->first()->image;
        $oldImage=$data[$req->index];
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            Storage::delete('public/product/'.$oldImage);
            $req->file('image')->storeAs('public/product',$newImage);
            $data[$req->index]=$newImage;
        }
        SupplierProduct::where('id',$req->id)->update(['image'=>$data]);
        return back()->with(['success'=>'Image update successful.']);
    }

    public function addImageProduct_admin(Request $req){
        $data=SupplierProduct::where('id',$req->id)->first()->image;
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/product',$newImage);
            array_push($data,$newImage);
        }
        // dd($data);
        SupplierProduct::where('id',$req->id)->update(['image'=>$data]);
        return back()->with(['success'=>'Image add successful.']);
    }

    public function deleteImageProduct_admin($id,$index){
        $data=SupplierProduct::where('id',$id)->first()->image;
        $oldImage=$data[$index];
        Storage::delete('public/product/'.$oldImage);
        unset($data[$index]);
        SupplierProduct::where('id',$id)->update(["image"=>$data]);
        return back()->with(['danger'=>'Image delete successful.']);

    }

    public function deleteProduct_admin($id){
        $product=SupplierProduct::where('id',$id)->first();
        foreach ($product->image as $item) {
            Storage::delete('public/product/'.$item);
        }
        SupplierProduct::where('id',$id)->delete();
        return redirect()->route('user#supplier_productList')->with(['danger'=>'Product Delete Successful.']);
    }

    //user

    public function pendingPage_user(){
        $data=UserInterface::where('id',1)->first();
        return view('main.user.supplier.pending',compact('data'));
    }

    public function pending_user(Request $req){
        if (Hash::check($req->password,Auth::user()->password)) {
            Supplier::create(['user_id'=>Auth::user()->id]);
            return redirect()->route('user#profile')->with(['success'=>'Supplier pending successful.']);
        }else{
            return back()->with(['danger'=>'Wrong Password.Try Again.']);
        }
    }

    public function listProduct_user(){
        $product=SupplierProduct::select('users.name as user_name','supplier_products.*','categories.name as category_name')
                ->leftJoin('users','supplier_products.user_id','users.id')
                ->leftJoin('categories','supplier_products.category_id','categories.id')
                ->where('supplier_products.user_id',Auth::user()->id)->get();
        return view('main.user.supplier.product_list',compact('product'));
    }

    public function addPageProduct_user(){
        $category=Category::get();
        $brand=Brand::get();
        return view('main.user.supplier.add',compact('category','brand'));
    }

    public function addProduct_user(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        $data['image']=[];
        foreach ($req->image as $item) {
            $image=uniqid().'_product_'.$item->getClientOriginalName();
            $item->storeAs('public/product',$image);
            array_push($data['image'],$image);
        }
        SupplierProduct::create($data);
        return redirect()->route('user#supplier_productList')->with(['success'=>'Product Create Successful.']);
    }

    public function viewProduct_user($id){
        $product=SupplierProduct::select('supplier_products.*','users.name as user_name','categories.name as category_name','brands.name as brand_name')
                ->where('supplier_products.id',$id)
                ->leftJoin('users','supplier_products.user_id','users.id')
                ->leftJoin('categories','supplier_products.category_id','categories.id')
                ->leftJoin('brands','supplier_products.brand_id','brands.id')
                ->first();
        return view('main.user.supplier.view',compact('product'));
    }

    public function editProduct_user($id){
        $product=SupplierProduct::where('id',$id)->first();
        $category=Category::get();
        $brand=Brand::get();
        return view('main.user.supplier.edit',compact('category','product','brand'));
    }

    public function updateProduct_user(Request $req){
        $product=SupplierProduct::where('id',$req->id)->first();
        $this->validation($req);
        $data=$this->changeFormat($req);
        $data['count']=$product->count+$req->count;
        $data['instock']=$product->instock+$req->count;
        $data['active']=$req->active;
        SupplierProduct::where('id',$req->id)->update($data);
        return redirect()->route('user#supplier_productList')->with(['success'=>'Product Update Successful.']);
    }

    public function editImageProduct_user($id){
        $product=SupplierProduct::where('id',$id)->first();
        return view('main.user.supplier.imageEdit',compact('product'));
    }

    public function updateImageProduct_user(Request $req){
        $data=SupplierProduct::where('id',$req->id)->first()->image;
        $oldImage=$data[$req->index];
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            Storage::delete('public/product/'.$oldImage);
            $req->file('image')->storeAs('public/product',$newImage);
            $data[$req->index]=$newImage;
        }
        SupplierProduct::where('id',$req->id)->update(['image'=>$data]);
        return back()->with(['success'=>'Image update successful.']);
    }

    public function addImageProduct_user(Request $req){
        $data=SupplierProduct::where('id',$req->id)->first()->image;
        if ($req->hasFile('image')) {
            $newImage=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/product',$newImage);
            array_push($data,$newImage);
        }
        // dd($data);
        SupplierProduct::where('id',$req->id)->update(['image'=>$data]);
        return back()->with(['success'=>'Image add successful.']);
    }

    public function deleteImageProduct_user($id,$index){
        $data=SupplierProduct::where('id',$id)->first()->image;
        $oldImage=$data[$index];
        Storage::delete('public/product/'.$oldImage);
        unset($data[$index]);
        SupplierProduct::where('id',$id)->update(["image"=>$data]);
        return back()->with(['danger'=>'Image delete successful.']);

    }

    public function deleteProduct_user($id){
        $product=SupplierProduct::where('id',$id)->first();
        foreach ($product->image as $item) {
            Storage::delete('public/product/'.$item);
        }
        SupplierProduct::where('id',$id)->delete();
        return redirect()->route('user#supplier_productList')->with(['danger'=>'Product Delete Successful.']);
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
