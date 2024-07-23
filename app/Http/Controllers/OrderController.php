<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Mail\VerifyMail;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\UserInterface;
use App\Mail\ProductAlertMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    // customer

    public function addPage_customer($id){
        $product=Product::where('id',$id)->first();
        $method=PaymentMethod::where('user_id',$product->user_id)->get();
        return view('main.customer.product.order',compact('product','method'));
    }

    public function userVerify(Request $req){
        $interface=UserInterface::where('id',1)->first();
        $mailData=[
            'title'=>"Verify User Info.",
            'body'=>"Hello $req->username. Your email has a order of product in $interface->company_name Company Website.
             Please verify your info.",
            'info'=>"Username - $req->username <br> Phone - $req->phone <br> Address - $req->address<br>",
            'otp'=>$req->otp,
        ];
        Mail::to($req->email)->send(new VerifyMail($mailData));
        $data=[
            'status'=>'successful',
        ];
        return response()->json($data, 200);
    }

    public function orderSummary_customer($invoice_id){
        $data=Order::select('users.name as seller_name','orders.*')
                    ->leftJoin('users','orders.seller_id','users.id')
                    ->where('invoice_id',$invoice_id)->first();
                    // dd($data);
        $product=OrderList::select('products.*','categories.name as category_name','order_lists.*')
                    ->leftJoin('products','order_lists.product_id','products.id')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('order_lists.invoice_id',$invoice_id)->get();

        return view('main.customer.product.summary',compact('data','product'));
    }

    public function orderAdd_customer(Request $req){

        $data=$this->changeFormat($req);

        $image=uniqid().'_slip_'.$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public/payment',$image);
        $data['payment_slip']=$image;

        $invoice='OID-'.rand(10001,99999);
        $data['invoice_id']=$invoice;

        $decode_product=json_decode($req->product);


        foreach ($decode_product as $item) {
            $product=Product::select('products.*','users.name as username','users.email as useremail')
                        ->leftJoin('users','products.user_id','users.id')
                        ->where('products.id',$item->product_id)->first();
            $instock=intval($product->instock)-intval($item->qty);
            Product::where('id',$item->product_id)->update(['instock'=>$instock]);
            if ($instock<10) {
                $productMail=[
                    'title'=>"Product Alert Mail.",
                    'body'=>"Hello $product->username.
                    The instock of your product $product->name is under 10.
                    This product will be out of stock soon."
                ];
                Mail::to($product->useremail)->send(new ProductAlertMail($productMail));
            }
            $list=[
                'product_id'=>$item->product_id,
                'qty'=>$item->qty,
                'total'=>intval($item->qty)*intval($product->price),
                'invoice_id'=>$invoice,

            ];
            OrderList::create($list);
            $data['seller_id']=$product->user_id;
        }



        Order::create($data);

        $orderMail=[
            'title'=>"Product Alert Mail.",
            'body'=>"Hello $req->username. Your Order $invoice is now pending.
                If you want to check the order you can use this invoice number."
        ];
        Mail::to($req->email)->send(new OrderMail($orderMail));
        return redirect()->route('customer#orderSummary',$invoice)->with(['success'=>'Purchase send successful.']);
    }

    public function cancel($id){
        $order=Order::select('orders.*')->where('orders.id',$id)->first();

        $orderList=OrderList::where('invoice_id',$order->invoice_id)->get();
        foreach ($orderList as $item) {
            $product=Product::where('id',$item->product_id)->first()->instock;
            $instock=$product+$item->qty;
            Product::where('id',$item->product_id)->update(['instock'=>$instock]);
        }
        Order::where('id',$id)->update(['status'=>4]);
        return redirect()->route('customer#orderSummary',$order->invoice_id)->with(['success'=>'Purchase send successful.']);
    }

    public function downloadInvoice_user($invoice_id){
        $data=Order::select('users.name as seller_name','orders.*')
                    ->leftJoin('users','orders.seller_id','users.id')
                    ->where('invoice_id',$invoice_id)->first();
        $data['company_name']=UserInterface::where('id',1)->first()->company_name;
        $data['product']=OrderList::select('products.*','categories.name as category_name','order_lists.*')
                            ->leftJoin('products','order_lists.product_id','products.id')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->where('order_lists.invoice_id',$invoice_id)->get();
        $pdf = Pdf::loadView('main.customer.product.invoice', ['data'=>$data]);
        return $pdf->download($invoice_id.'.pdf');
    }

    public function checkPage(){
        return view('main.customer.product.check');
    }

    public function check(Request $req){
        $order=Order::where('invoice_id',$req->invoice)->first();
        if (isset($order)) {
            return redirect()->route('customer#orderSummary',$req->invoice);
        }else{
            return back()->with(['warning'=>'There is no order. Please check the invoice number']);
        }
    }

    // user

    public function list_seller(){
        $order=Order::where('orders.seller_id',Auth::user()->id)->get();
        return view('main.user.order.list',compact('order'));
    }

    public function view_seller($invoice_id){
        $data=Order::select('users.name as seller_name','orders.*')
                    ->leftJoin('users','orders.seller_id','users.id')
                    ->where('invoice_id',$invoice_id)->first();
                    // dd($data);
        $product=OrderList::select('products.*','categories.name as category_name','order_lists.*')
                    ->leftJoin('products','order_lists.product_id','products.id')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('order_lists.invoice_id',$invoice_id)->get();
        return view('main.user.order.view',compact('data','product'));
    }

    public function changeStatus_seller($status,$id){
        $order=Order::where('orders.id',$id)->first();
        if ($status==1) {
            $mailData=[
                'title'=>"Order Deliver.",
                'body'=>"Hello $order->user_name. Your payment of Order ID - $order->invoice_id is successful.
                 We will deliver your product within 1 week.
                 If you don't receive you can contact admin team or seller."
            ];
        }elseif ($status==2) {
            $mailData=[
                'title'=>"Order Success.",
                'body'=>"Hello $order->user_name. Your Order ID - $order->invoice_id is successful finished.
                 If you don't receive you can contact admin team or seller."
            ];
        }elseif($status==3){
            $mailData=[
                'title'=>"Order fail.",
                'body'=>"Hello $order->user_name. Your purchase ID - $id is fail. Please contact seller who you ordered."
            ];
            $orderList=OrderList::where('invoice_id',$order->invoice_id)->get();
            foreach ($orderList as $item) {
                $product=Product::where('id',$item->product_id)->first()->instock;
                $instock=$product+$item->qty;
                Product::where('id',$item->product_id)->update(['instock'=>$instock]);
            }
        }
        Mail::to($order->user_email)->send(new OrderMail($mailData));
        Order::where('id',$id)->update(['status'=>$status]);
        return redirect()->route('seller#listOrder')->with(['success'=>'Order change status successful.']);
    }

    public function getOrderinterface(){
        $data=Order::where('seller_id',Auth::user()->id)->where('status',0)->get();
        return response()->json($data, 200);
    }

    //admin

    public function list_admin(){
        $order=Order::select('orders.*','users.name as seller_name')
                ->leftJoin('users','orders.seller_id','users.id')
                ->get();
        return view('main.admin.order.list',compact('order'));
    }

    public function view_admin($invoice_id){
        $data=Order::select('users.name as seller_name','orders.*')
                    ->leftJoin('users','orders.seller_id','users.id')
                    ->where('invoice_id',$invoice_id)->first();
                    // dd($data);
        $product=OrderList::select('products.*','categories.name as category_name','order_lists.*')
                    ->leftJoin('products','order_lists.product_id','products.id')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('order_lists.invoice_id',$invoice_id)->get();

        return view('main.admin.order.view',compact('data','product'));
    }


    // private function
    private function changeFormat($req){
        return [
            'user_name'=>$req->username,
            'user_email'=>$req->email,
            'user_phone'=>$req->phone,
            'user_address'=>$req->address,
            'payment_id'=>$req->payment_id,
            'total_price'=>$req->total_price,
        ];

    }
}
