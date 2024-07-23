<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Models\UserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminProfile(){
        return view('main.admin.account.profile');
    }

    public function adminProfileUpdate(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        if ($req->hasFile('image')) {
            $oldImage=Auth::user()->image;
            if ($oldImage!=null) {
                Storage::delete('public/profile/'.$oldImage);
            }
            $image=uniqid().'_profile_'.$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/profile',$image);
            $data['image']=$image;
        }
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('admin#profile')->with(['success'=>'Profile update successful.']);
    }

    public function adminDeleteProfile($id){
        $oldImage=User::where('id',$id)->first()->image;
        Storage::delete('public/profile/'.$oldImage);
        User::where('id',$id)->update(['image'=>null]);
        return redirect()->route('admin#profile')->with(['danger'=>'Profile photo delete successful.']);
    }

    public function adminList(){
        $admins=User::where('role','admin')->get();
        return view('main.admin.list.list',compact('admins'));
    }

    public function adminAddPage(){
        return view('main.admin.list.add');
    }

    public function adminAdd(Request $req){
        Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required'],
            'address'=>['required'],
            'gender'=>['required'],
            'position'=>['required'],
            'password' => ['required'],
            'password_confirmation'=>['required','same:password'],
        ])->validate();

        User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'phone' => $req['phone'],
            'address' => $req['address'],
            'gender' => $req['gender'],
            'role'=>'admin',
            'position'=>$req['position'],
            'password' => Hash::make($req['password']),
        ]);
        return redirect()->route('admin#list')->with(['success'=>'Admin account create successful.']);
    }

    public function adminView($id){
        $admin=User::where('id',$id)->first();
        return view('main.admin.list.view',compact('admin'));
    }

    public function adminDelete($id){
        $admin=User::where('id',$id)->first();
        if ($admin->image!=null) {
            Storage::delete('public/profile/'.$admin->image);
        }
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['danger'=>'Admin account delete successful.']);
    }

    public function userList(){
        $users=User::where('role','user')->get();
        return view('main.admin.user.list',compact('users'));
    }

    public function userAddPage(){
        return view('main.admin.user.add');
    }

    public function userAdd(Request $req){
        Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required'],
            'address'=>['required'],
            'gender'=>['required'],
            'position'=>['required'],
            'password' => ['required'],
            'password_confirmation'=>['required','same:password'],
        ])->validate();

        User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'phone' => $req['phone'],
            'address' => $req['address'],
            'gender' => $req['gender'],
            'role'=>'user',
            'position'=>$req['position'],
            'password' => Hash::make($req['password']),
        ]);
        return redirect()->route('admin#userList')->with(['success'=>'User account create successful.']);
    }

    public function userView($id){
        $user=User::where('id',$id)->first();
        return view('main.admin.user.view',compact('user'));
    }

    public function userDelete($id){
        $user=User::where('id',$id)->first();
        if ($user->image!=null) {
            Storage::delete('public/profile/'.$user->image);
        }
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList')->with(['danger'=>'User account delete successful.']);
    }

    public function dashboard(){
            if (request('productOrderPlan')=='month') {
                $sale=Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('sum(total_price) as total'))
                ->where('status',2)
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            }else if (request('productOrderPlan')=='year') {
                $sale=Order::select(DB::raw('Year(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',2)
                ->groupBy('date')
                ->get();
            }else{
                $sale=Order::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',2)
                ->groupBy('date')
                ->get();
            }

            if (request('productPurchasePlan')=='month') {
                $purchase=Purchase::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            }else if (request('productPurchasePlan')=='year') {
                $purchase=Purchase::select(DB::raw('Year(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->get();
            }else{
                $purchase=Purchase::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->groupBy('date')
                ->get();
            }


            $products=OrderList::select('products.name as product_name',DB::raw('sum(order_lists.qty) as product_qty'))
                        ->when(request('productTrendPlan'),function($search_item){
                            $search_item->where('order_lists.created_at','like','%'.request('productTrendPlan').'%');
                        })
                        ->leftJoin('orders','order_lists.invoice_id','orders.invoice_id')
                        ->where('orders.status',2)
                        ->leftJoin('products','order_lists.product_id','products.id')
                        ->groupBy('product_name')
                        ->get();

            $supplierProduct=Purchase::select('supplier_products.name as product_name',DB::raw('sum(purchases.qty) as product_qty'))
            ->when(request('productPurchaseTrandPlan'),function($search_item){
                $search_item->where('purchases.created_at','like','%'.request('productPurchaseTrandPlan').'%');
            })
            ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
            ->where('purchases.status',1)
            ->groupBy('product_name')
            ->get();

            $productsPurchaseDate=Purchase::select(DB::raw('Date(created_at) as date'))->groupBy('date')->get();

            $productsOrderDate=Order::select(DB::raw('Date(created_at) as date'))->groupBy('date')->get();

            if (request('cardPlan')=='month') {
                $productSale=Order::where('status',2)->where('created_at','like','%'.Carbon::now()->format('Y-m').'%')->get();
                $productPurchase=Purchase::where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y-m').'%')->get();
            } else if(request('cardPlan')=='year') {
                $productSale=Order::where('status',2)->where('created_at','like','%'.Carbon::now()->format('Y').'%')->get();
                $productPurchase=Purchase::where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y').'%')->get();
            } else{
                $productSale=Order::where('status',2)->where('created_at','like','%'.Carbon::now()->format('Y-m-d').'%')->get();
                $productPurchase=Purchase::where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y-m-d').'%')->get();
            }


            $totalOrderPrice=0;
            foreach ($productSale as $item) {
                $totalOrderPrice+=$item->total_price;
            };

            $totalPurchasePrice=0;
            foreach ($productPurchase as $item) {
                $totalPurchasePrice+=$item->total_price;
            }

            $trandProduct=OrderList::select('products.name','products.image','users.name as user_name',DB::raw('sum(order_lists.qty) as product_qty'),DB::raw('sum(order_lists.total) as total'))
                            ->leftJoin('orders','order_lists.invoice_id','orders.invoice_id')
                            ->leftJoin('products','order_lists.product_id','products.id')
                            ->leftJoin('users','orders.seller_id','users.id')
                            ->where('orders.status',2)
                            ->groupBy('product_id')->orderBy('total','desc')->get();

            $trandPurchase=Purchase::select('products.name','products.image','users.name as user_name',DB::raw('sum(purchases.qty) as product_qty'),DB::raw('sum(purchases.total_price) as total'))
                            ->leftJoin('users','purchases.supplier_id','users.id')
                            ->leftJoin('products','purchases.product_id','products.id')
                            ->where('purchases.status',1)
                            ->groupBy('product_id')->orderBy('total','desc')->get();
            // dd($trandProduct->toArray());

            $data=[
                'orderCount'=>count($productSale),
                'totalOrderPrice'=>$totalOrderPrice,
                'purchaseCount'=>count($productPurchase),
                'totalPurchasePrice'=>$totalPurchasePrice,
                'trandProduct'=>$trandProduct,
                'trandPurchase'=>$trandPurchase
            ];
        return view('main.admin.dashboard.dashboard',compact('sale','products','productsOrderDate','productsPurchaseDate','supplierProduct','purchase','data'));

    }

    public function report(){
        return view('main.admin.dashboard.report');
    }

    public function viewReport(Request $req){
        $sale=Order::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',2)
                ->whereBetween('created_at', [$req->start, $req->end])
                ->groupBy('date')
                ->get();

        $purchase=Purchase::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
            ->where('status',1)
            ->whereBetween('created_at', [$req->start, $req->end])
            ->groupBy('date')
            ->get();


        $products=OrderList::select('products.name as product_name',DB::raw('sum(order_lists.qty) as product_qty'))
                    ->leftJoin('products','order_lists.product_id','products.id')
                    ->leftJoin('orders','order_lists.invoice_id','orders.invoice_id')
                    ->where('orders.status',2)
                    ->whereBetween('order_lists.created_at', [$req->start, $req->end])
                    ->groupBy('product_name')
                    ->get();

        $supplierProduct=Purchase::select('supplier_products.name as product_name',DB::raw('sum(purchases.qty) as product_qty'))
                            ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                            ->whereBetween('purchases.created_at', [$req->start, $req->end])
                            ->where('purchases.status',1)
                            ->groupBy('product_name')
                            ->get();

        $productSale=Order::where('status',2)->whereBetween('created_at', [$req->start, $req->end])->get();
        $productPurchase=Purchase::where('status',1)->whereBetween('created_at', [$req->start, $req->end])->get();

        $totalOrderPrice=0;
        foreach ($productSale as $item) {
            $totalOrderPrice+=$item->total_price;
        };

        $totalPurchasePrice=0;
        foreach ($productPurchase as $item) {
            $totalPurchasePrice+=$item->total_price;
        }

        $trandProduct=OrderList::select('products.name','products.image','users.name as user_name',DB::raw('sum(order_lists.qty) as product_qty'),DB::raw('sum(order_lists.total) as total'))
                        ->leftJoin('orders','order_lists.invoice_id','orders.invoice_id')
                        ->leftJoin('users','orders.seller_id','users.id')
                        ->whereBetween('order_lists.created_at', [$req->start, $req->end])
                        ->leftJoin('products','order_lists.product_id','products.id')
                        ->where('status',2)
                        ->groupBy('product_id')->orderBy('total','desc')->get();

        $trandPurchase=Purchase::select('products.name','products.image','users.name as user_name',DB::raw('sum(purchases.qty) as product_qty'),DB::raw('sum(purchases.total_price) as total'))
                        ->leftJoin('users','purchases.supplier_id','users.id')
                        ->whereBetween('purchases.created_at', [$req->start, $req->end])
                        ->leftJoin('products','purchases.product_id','products.id')
                        ->where('status',1)
                        ->groupBy('product_id')->orderBy('total','desc')->get();

        $purchaseList=Purchase::select('purchases.*','supplier_products.name as product_name','users.name as user_name')
                    ->leftJoin('users','purchases.user_id','users.id')
                    ->whereBetween('purchases.created_at', [$req->start, $req->end])
                    ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                    ->get();

        $orderList=Order::select('orders.*')
                ->whereBetween('orders.created_at', [$req->start, $req->end])
                ->get();


        $data=[
            'orderCount'=>count($productSale),
            'totalOrderPrice'=>$totalOrderPrice,
            'purchaseCount'=>count($productPurchase),
            'totalPurchasePrice'=>$totalPurchasePrice,
            'trandProduct'=>$trandProduct,
            'trandPurchase'=>$trandPurchase,
            'purchaseList'=>$purchaseList,
            'orderList'=>$orderList,
            'start'=>$req->start,
            'end'=>$req->end,
        ];

        return view('main.admin.dashboard.viewReport',compact('sale','products','supplierProduct','purchase','data'));
    }

    private function validation($req){
        Validator::make($req->all(),[
            'name'=>['required'],
            'address'=>['required'],
            'phone'=>['required'],
            'email'=>['required'],
            'gender'=>['required'],

        ])->validate();
    }

    private function changeFormat($req){
        return [
            'name'=>$req->name,
            'address'=>$req->address,
            'phone'=>$req->phone,
            'email'=>$req->email,
            'gender'=>$req->gender,
        ];
    }
}
