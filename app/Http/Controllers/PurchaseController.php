<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Purchase;
use App\Mail\PurchaseMail;
use App\Models\PurchaseList;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Mail\ProductAlertMail;
use App\Models\SupplierProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{

    //admin
    public function list_admin(){
        $purchase=Purchase::select('purchases.*','supplier_products.name','users.name as user_name')
                    ->leftJoin('users','purchases.user_id','users.id')
                    ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                    ->get();
                    return view('main.admin.purchase.list',compact('purchase'));
    }

    public function view_admin($id){
        $purchase=Purchase::select('purchases.*','supplier_products.*','users.name as user_name','payment_methods.name as payment_method','purchases.id as purchase_id')
                        ->leftJoin('users','purchases.user_id','users.id')
                        ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                        ->leftJoin('payment_methods','purchases.payment_id','payment_methods.id')
                        ->where('purchases.id',$id)->first();
        $purchase->image=json_decode($purchase->image);
        return view('main.admin.purchase.view',compact('purchase'));
    }

    // user
    public function supplierList_user(){
        $supplier=User::where('position','supplier')->get();
        return view('main.user.purchase.supplierList',compact('supplier'));
    }

    public function productList_user($id){
        $product=SupplierProduct::select('users.name as user_name','supplier_products.*','categories.name as category_name')
                ->leftJoin('users','supplier_products.user_id','users.id')
                ->leftJoin('categories','supplier_products.category_id','categories.id')
                ->where('supplier_products.active',1)
                ->where('user_id',$id)->get();
        return view('main.user.purchase.productList',compact('product'));
    }

    public function productView_user($id){
        $product=SupplierProduct::select('users.name as user_name','supplier_products.*','categories.name as category_name')
        ->leftJoin('users','supplier_products.user_id','users.id')
        ->leftJoin('categories','supplier_products.category_id','categories.id')
        ->where('supplier_products.id',$id)->first();
        return view('main.user.purchase.productView',compact('product'));
    }

    public function list_user(){
        $purchase=Purchase::select('purchases.*','supplier_products.name','users.name as user_name')
                        ->leftJoin('users','purchases.supplier_id','users.id')
                        ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                        ->where('purchases.user_id',Auth::user()->id)->get();
                // dd($purchase->toArray());
        return view('main.user.purchase.list',compact('purchase'));
    }

    public function addPage_user($id){
        $product=SupplierProduct::select('users.name as user_name','supplier_products.*','categories.name as category_name')
        ->leftJoin('users','supplier_products.user_id','users.id')
        ->leftJoin('categories','supplier_products.category_id','categories.id')
        ->where('supplier_products.id',$id)->first();
        $method=PaymentMethod::where('user_id',$product->user_id)->get();
        return view('main.user.purchase.add',compact('product','method'));
    }

    public function add_user(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);

        $count=intval($req->count);
        $total=intval($req->price);
        $total_price=$count*$total;
        $data['total_price']=$total_price;

        $image=uniqid().'_slip_'.$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public/payment',$image);
        $data['payment_slip']=$image;



        Purchase::create($data);

        $product=SupplierProduct::select('supplier_products.*','users.name as username','users.email as useremail')
                            ->leftJoin('users','supplier_products.user_id','users.id')
                            ->where('supplier_products.id',$req->product_id)->first();
        $instock=$product->instock-$count;
        if ($instock<10) {
            $productMail=[
                'title'=>"Product Alert Mail.",
                'body'=>"Hello $product->username.
                The instock of your product $product->name is under 10.
                This product will be out of stock soon."
            ];
            Mail::to($product->useremail)->send(new ProductAlertMail($productMail));
        }
        SupplierProduct::where('id',$req->product_id)->update(['instock'=>$instock]);

        return redirect()->route('user#listPurchase')->with(['success'=>'Purchase send successful.']);
    }

    public function view_user($id){
        $purchase=Purchase::select('purchases.*','supplier_products.*','users.name as user_name','payment_methods.name as payment_method','purchases.id as purchase_id')
                        ->leftJoin('users','purchases.supplier_id','users.id')
                        ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                        ->leftJoin('payment_methods','purchases.payment_id','payment_methods.id')
                        ->where('purchases.id',$id)->first();
        $purchase->image=json_decode($purchase->image);
        return view('main.user.purchase.view',compact('purchase'));
    }

    // supplier

    public function list_supplier(){
        $purchase=Purchase::select('purchases.*','supplier_products.name','users.name as user_name')
                    ->leftJoin('users','purchases.user_id','users.id')
                    ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                    ->where('purchases.supplier_id',Auth::user()->id)->get();
                    return view('main.user.purchase.listSupplier',compact('purchase'));
    }

    public function view_supplier($id){
        $purchase=Purchase::select('purchases.*','supplier_products.*','users.name as user_name','payment_methods.name as payment_method','purchases.id as purchase_id')
                        ->leftJoin('users','purchases.user_id','users.id')
                        ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                        ->leftJoin('payment_methods','purchases.payment_id','payment_methods.id')
                        ->where('purchases.id',$id)->first();
        $purchase->image=json_decode($purchase->image);
        return view('main.user.purchase.viewSupplier',compact('purchase'));
    }

    public function changeStatus_supplier($status,$id){
        $purchase=Purchase::select('purchases.*','users.name as user_name','users.email as user_email')
                        ->leftJoin('users','purchases.user_id','users.id')
                        ->where('purchases.id',$id)->first();
        if ($status==1) {
            $mailData=[
                'title'=>"Purchase success.",
                'body'=>"Hello $purchase->user_name. Your purchase ID - $id is successful.
                 We will deliver your product within 1 week.
                 If you don't receive you can contact admin team or supplier."
            ];
            Mail::to($purchase->user_email)->send(new PurchaseMail($mailData));
        }elseif($status=2){
            $mailData=[
                'title'=>"Purchase fail.",
                'body'=>"Hello $purchase->name. Your purchase ID - $id is fail. Please contact supplier who you ordered."
            ];
            Mail::to($purchase->user_email)->send(new PurchaseMail($mailData));
        }

        Purchase::where('id',$id)->update(['status'=>$status]);
        return back()->with(['success'=>'Purchase change status successful.']);
    }

    public function getPurchaseinterface(){
        $data=Purchase::where('supplier_id',Auth::user()->id)->where('status',0)->get();
        return response()->json($data, 200);
    }

    // private function

    private function validation($req){
        Validator::make($req->all(),[
            'product_id'=>'required',
            'count'=>'required',
            'image'=>'required',
            'payment_id'=>'required',

        ])->validate();
    }

    private function changeFormat($req){
        return [
            'product_id'=>$req->product_id,
            'user_id'=>Auth::user()->id,
            'supplier_id'=>$req->supplier_id,
            'payment_id'=>$req->payment_id,
            'qty'=>$req->count,
        ];

    }


}
