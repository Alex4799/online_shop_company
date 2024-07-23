<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userProfile(){
        // dd(Auth::user()->show_category);
        return view('main.user.account.profile');
    }

    public function userProfileUpdate(Request $req){
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
        return redirect()->route('user#profile')->with(['success'=>'Profile update successful.']);
    }

    public function showCategory(){
        return view('main.user.account.showCategory');
    }

    public function addShowCategory(Request $req){
        $data=User::where('id',Auth::user()->id)->first()->show_category;
        array_push($data,$req->category);
        User::where('id',Auth::user()->id)->update(['show_category'=>$data]);
        return back()->with(['success'=>'Category add successful.']);
    }

    public function updateCategory(Request $req){
        $data=User::where('id',Auth::user()->id)->first()->show_category;
        $data[$req->index]=$req->category;
        User::where('id',Auth::user()->id)->update(['show_category'=>$data]);
        return back()->with(['success'=>'Category update successful.']);
    }

    public function deleteCategory($index){
        $data=User::where('id',Auth::user()->id)->first()->show_category;
        unset($data[$index]);
        User::where('id',Auth::user()->id)->update(['show_category'=>$data]);
        return back()->with(['danger'=>'Category delete successful.']);
    }

    public function userDeleteProfile($id){
        $oldImage=User::where('id',$id)->first()->image;
        Storage::delete('public/profile/'.$oldImage);
        User::where('id',$id)->update(['image'=>null]);
        return redirect()->route('user#profile')->with(['danger'=>'Profile photo delete successful.']);
    }

    public function adminList(){
        $admins=User::where('role','admin')->get();
        return view('main.user.admin.list',compact('admins'));
    }

    public function adminView($id){
        $admin=User::where('id',$id)->first();
        return view('main.user.admin.view',compact('admin'));
    }

    public function userList_customer(){
        $user=User::when(request('search_key'),function($query){
            $query->whereAny([
                'users.name',
            ], 'LIKE','%'.request('search_key').'%');
        })->where('role','user')->where('position','seller')->paginate(10);
        for ($i=0; $i <count($user) ; $i++) {
            $user[$i]->count=count(Product::where('user_id',$user[$i]->id)->get());
        }
        return view('main.customer.user.list',compact('user'));
    }

    public function seller_profile_customer($id){
        $user=User::where('id',$id)->first();
        return view('main.customer.user.profile',compact('user'));
    }

    public  function userProductList($id){
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
        })->where('products.active',1)->where('products.user_id',$id)->paginate(10);
        return view('main.customer.product.list',compact('product'));
    }

    public function myDashboard(){
        if (Auth::user()->position=='supplier') {
            if (request('productOrderPlan')=='month') {
                $sale=Purchase::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->where('supplier_id',Auth::user()->id)
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            }else if (request('productOrderPlan')=='year') {
                $sale=Purchase::select(DB::raw('Year(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',1)
                ->where('supplier_id',Auth::user()->id)
                ->groupBy('date')
                ->get();
            }else{
                $sale=Purchase::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('supplier_id',Auth::user()->id)
                ->where('status',1)
                ->groupBy('date')
                ->get();
            }

            $products=Purchase::select('products.name as product_name',DB::raw('sum(purchases.qty) as product_qty'))
                        ->when(request('productTrendPlan'),function($search_item){
                            $search_item->where('purchases.created_at','like','%'.request('productTrendPlan').'%');
                        })
                        ->where('supplier_id',Auth::user()->id)
                        ->leftJoin('products','purchases.product_id','products.id')
                        ->where('purchases.status',1)
                        ->groupBy('product_name')
                        ->get();

            $productsOrderDate=Purchase::select(DB::raw('Date(created_at) as date'))->groupBy('date')->get();

            if (request('cardPlan')=='month') {
                $productSale=Purchase::where('supplier_id',Auth::user()->id)->where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y-m').'%')->get();
            } else if(request('cardPlan')=='year') {
                $productSale=Purchase::where('supplier_id',Auth::user()->id)->where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y').'%')->get();
            } else{
                $productSale=Purchase::where('supplier_id',Auth::user()->id)->where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y-m-d').'%')->get();
            }


            $totalOrderPrice=0;
            foreach ($productSale as $item) {
                $totalOrderPrice+=$item->total_price;
            };

            $trandProduct=Purchase::select('products.name','products.image',DB::raw('sum(purchases.qty) as product_qty'),DB::raw('sum(purchases.total_price) as total'))
                            ->where('supplier_id',Auth::user()->id)
                            ->leftJoin('products','purchases.product_id','products.id')
                            ->where('purchases.status',1)
                            ->groupBy('product_id')->orderBy('total','desc')->get();
            // dd($trandProduct->toArray());

            $data=[
                'orderCount'=>count($productSale),
                'totalOrderPrice'=>$totalOrderPrice,
                'trandProduct'=>$trandProduct,
            ];
        }else{
            if (request('productOrderPlan')=='month') {
                $sale=Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('sum(total_price) as total'))
                ->where('status',2)
                ->where('seller_id',Auth::user()->id)
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            }else if (request('productOrderPlan')=='year') {
                $sale=Order::select(DB::raw('Year(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('status',2)
                ->where('seller_id',Auth::user()->id)
                ->groupBy('date')
                ->get();
            }else{
                $sale=Order::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                ->where('seller_id',Auth::user()->id)
                ->where('status',2)
                ->groupBy('date')
                ->get();
            }


            $products=OrderList::select('products.name as product_name',DB::raw('sum(order_lists.qty) as product_qty'))
                        ->when(request('productTrendPlan'),function($search_item){
                            $search_item->where('order_lists.created_at','like','%'.request('productTrendPlan').'%');
                        })
                        ->leftJoin('orders','order_lists.invoice_id','orders.invoice_id')
                        ->leftJoin('products','order_lists.product_id','products.id')
                        ->where('orders.status',2)
                        ->groupBy('product_name')
                        ->get();

            $productsOrderDate=Order::select(DB::raw('Date(created_at) as date'))->groupBy('date')->get();

            if (request('cardPlan')=='month') {
                $productSale=Order::where('seller_id',Auth::user()->id)->where('status',2)->where('created_at','like','%'.Carbon::now()->format('Y-m').'%')->get();
                $productPurchase=Purchase::where('user_id',Auth::user()->id)->where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y-m').'%')->get();
            } else if(request('cardPlan')=='year') {
                $productSale=Order::where('seller_id',Auth::user()->id)->where('status',2)->where('created_at','like','%'.Carbon::now()->format('Y').'%')->get();
                $productPurchase=Purchase::where('user_id',Auth::user()->id)->where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y').'%')->get();
            } else{
                $productSale=Order::where('seller_id',Auth::user()->id)->where('status',2)->where('created_at','like','%'.Carbon::now()->format('Y-m-d').'%')->get();
                $productPurchase=Purchase::where('user_id',Auth::user()->id)->where('status',1)->where('created_at','like','%'.Carbon::now()->format('Y-m-d').'%')->get();
            }


            $totalOrderPrice=0;
            foreach ($productSale as $item) {
                $totalOrderPrice+=$item->total_price;
            };

            $totalPurchasePrice=0;
            foreach ($productPurchase as $item) {
                $totalPurchasePrice+=$item->total_price;
            }

            $trandProduct=OrderList::select('products.name','products.image',DB::raw('sum(order_lists.qty) as product_qty'),DB::raw('sum(order_lists.total) as total'))
                            ->leftJoin('orders','order_lists.invoice_id','orders.invoice_id')
                            ->where('orders.seller_id',Auth::user()->id)
                            ->where('orders.status',2)
                            ->leftJoin('products','order_lists.product_id','products.id')
                            ->groupBy('product_id')->orderBy('total','desc')->get();
            // dd($trandProduct->toArray());

            $data=[
                'orderCount'=>count($productSale),
                'totalOrderPrice'=>$totalOrderPrice,
                'purchaseCount'=>count($productPurchase),
                'totalPurchasePrice'=>$totalPurchasePrice,
                'trandProduct'=>$trandProduct,
            ];

        }
        return view('main.user.account.dashboard',compact('sale','products','productsOrderDate','data'));

    }

    public function report(){
        return view('main.user.account.report');
    }

    public function viewReport(Request $req){
        if (Auth::user()->position=='supplier') {
            $sale=Purchase::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                        ->where('supplier_id',Auth::user()->id)
                        ->whereBetween('purchases.created_at', [$req->start, $req->end])
                        ->where('status',1)
                        ->groupBy('date')
                        ->get();

            $products=Purchase::select('products.name as product_name',DB::raw('sum(purchases.qty) as product_qty'))
                            ->where('supplier_id',Auth::user()->id)
                            ->whereBetween('purchases.created_at', [$req->start, $req->end])
                            ->leftJoin('products','purchases.product_id','products.id')
                            ->groupBy('product_name')
                            ->where('purchases.status',1)
                            ->get();

            $productSale=Purchase::where('supplier_id',Auth::user()->id)->whereBetween('purchases.created_at', [$req->start, $req->end])->where('status',1)->get();


            $totalOrderPrice=0;
            foreach ($productSale as $item) {
                $totalOrderPrice+=$item->total_price;
            };

            $trandProduct=Purchase::select('products.name','products.image',DB::raw('sum(purchases.qty) as product_qty'),DB::raw('sum(purchases.total_price) as total'))
                                ->where('supplier_id',Auth::user()->id)
                                ->whereBetween('purchases.created_at', [$req->start, $req->end])
                                ->leftJoin('products','purchases.product_id','products.id')
                                ->where('status',1)
                                ->groupBy('product_id')->orderBy('total','desc')->get();


            $list=Purchase::select('purchases.*','supplier_products.name as product_name','users.name as user_name')
                            ->leftJoin('users','purchases.user_id','users.id')
                            ->whereBetween('purchases.created_at', [$req->start, $req->end])
                            ->leftJoin('supplier_products','purchases.product_id','supplier_products.id')
                            ->where('purchases.supplier_id',Auth::user()->id)->get();
            $data=[
                'orderCount'=>count($productSale),
                'totalOrderPrice'=>$totalOrderPrice,
                'trandProduct'=>$trandProduct,
                'list'=>$list,
                'start'=>$req->start,
                'end'=>$req->end,
            ];
        }else{
            $sale=Order::select(DB::raw('Date(created_at) as date'), DB::raw('sum(total_price) as total'))
                    ->where('seller_id',Auth::user()->id)
                    ->whereBetween('orders.created_at', [$req->start, $req->end])
                    ->where('status',2)
                    ->groupBy('date')
                    ->get();

            $products=OrderList::select('products.name as product_name',DB::raw('sum(order_lists.qty) as product_qty'))
                        ->leftJoin('orders','order_lists.invoice_id','orders.invoice_id')
                        ->leftJoin('products','order_lists.product_id','products.id')
                        ->whereBetween('order_lists.created_at', [$req->start, $req->end])
                        ->where('orders.status',2)
                        ->groupBy('product_name')
                        ->get();

            $productSale=Order::where('seller_id',Auth::user()->id)->where('status',2)->whereBetween('orders.created_at', [$req->start, $req->end])->get();
            $productPurchase=Purchase::where('user_id',Auth::user()->id)->where('status',1)->whereBetween('purchases.created_at', [$req->start, $req->end])->get();

            $totalOrderPrice=0;
            foreach ($productSale as $item) {
                $totalOrderPrice+=$item->total_price;
            };

            $totalPurchasePrice=0;
            foreach ($productPurchase as $item) {
                $totalPurchasePrice+=$item->total_price;
            }

            $trandProduct=OrderList::select('products.name','products.image',DB::raw('sum(order_lists.qty) as product_qty'),DB::raw('sum(order_lists.total) as total'))
                            ->leftJoin('orders','order_lists.invoice_id','orders.invoice_id')
                            ->where('orders.seller_id',Auth::user()->id)
                            ->where('orders.status',2)
                            ->whereBetween('order_lists.created_at', [$req->start, $req->end])
                            ->leftJoin('products','order_lists.product_id','products.id')
                            ->groupBy('product_id')->orderBy('total','desc')->get();

            $list=Order::select('orders.*','orders.invoice_id as id')
                    ->whereBetween('orders.created_at', [$req->start, $req->end])
                    ->where('orders.seller_id',Auth::user()->id)->get();
            $data=[
                'orderCount'=>count($productSale),
                'totalOrderPrice'=>$totalOrderPrice,
                'purchaseCount'=>count($productPurchase),
                'totalPurchasePrice'=>$totalPurchasePrice,
                'trandProduct'=>$trandProduct,
                'list'=>$list,
                'start'=>$req->start,
                'end'=>$req->end,
            ];

        }
        return view('main.user.account.viewReport',compact('sale','products','data'));

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
