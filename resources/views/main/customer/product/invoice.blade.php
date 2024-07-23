<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .width{
            border: 1px dotted black ;
            border-radius: 5px;
            padding: 10px;
        }
        .width11{
            width: 110px;
        }
        .text-yellow{
          color: yellow;
        }
        .text-green{
          color: green;
        }
        .text-red{
          color: red;
        }
        .text-center{
            text-align: center
        }
        td{
            padding: 10px 0 10px 0;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="width">
            <table>
                <tr>
                    <td colspan="3"><div class="text-center">{{$data->company_name}}</div></td>
                </tr>
                <tr>
                    <td class="width11"><div>{{date('d-m-Y', strtotime($data->created_at))}}</div></td>
                    <td class="width11"></td>
                    <td class="width11"><div>{{$data->invoice_id}}</div></td>
                </tr>
                <tr>
                    <td class="width11"><div>Product</div></td>
                    <td class="width11"><div>QTY</div></td>
                    <td class="width11"><div>Price</div></td>
                </tr>
                @foreach ($data->product as $item)
                    <tr>
                        <td class="width11">{{$item->name}}</td>
                        <td class="width11">{{$item->qty}}</td>
                        <td class="width11">{{$item->total}} MMK</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan='3'><hr></td>
                </tr>
                <tr>
                    <td class="width11"><div>Total</div></td>
                    <td class="width11"></td>
                    <td class="width11"><div>{{$data->total_price}} MMK</div></td>
                </tr>
                <tr>
                    <td class="width11"><div>Seller Name</div></td>
                    <td class="width11"></td>
                    <td class="width11"><div>{{$data->seller_name}}</div></td>
                </tr>
                <tr>
                    <td class="width11"><div>User Name</div></td>
                    <td class="width11"></td>
                    <td class="width11"><div>{{$data->user_name}}</div></td>
                </tr>
                <tr>
                    <td class="width11"><div>User Email</div></td>
                    <td class="width11"></td>
                    <td class="width11"><div>{{$data->user_email}}</div></td>
                </tr>
                <tr>
                    <td class="width11"><div>User Phone</div></td>
                    <td class="width11"></td>
                    <td class="width11"><div>{{$data->user_phone}}</div></td>
                </tr>
                <tr>
                    <td class="width11"><div>User Address</div></td>
                    <td class="width11"></td>
                    <td class="width11"><div>{{$data->user_address}}</div></td>
                </tr>
                <tr>
                    <td class="width11"><div>Order Status</div></td>
                    <td class="width11"></td>
                    <td class="width11"><div>
                        @if ($data->status==0)
                            <div class="text-yellow">Pending</div>
                        @elseif ($data->status==1)
                            <div class="text-green">Deliver</div>
                        @elseif ($data->status==2)
                            <div class="text-green">Success</div>
                        @elseif ($data->status==4)
                            <div class="text-red">Cancel</div>
                        @else
                            <div class="text-red">Fail</div>
                        @endif
                    </div></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
