@extends('main.admin.layout.master')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>

  </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            @foreach ($sale as $item)
                <input type="hidden" value="{{$item->total}}" class="orderTotal">
                <input type="hidden" value="{{$item->date}}" class="orderDate">
            @endforeach

            @foreach ($purchase as $item)
                <input type="hidden" value="{{$item->total}}" class="purchaseTotal">
                <input type="hidden" value="{{$item->date}}" class="purchaseDate">
            @endforeach

            @foreach ($products as $item)
                <input type="hidden" value="{{$item->product_name}}" class="product_name">
                <input type="hidden" value="{{$item->product_qty}}" class="product_qty">
            @endforeach

            @foreach ($supplierProduct as $item)
                <input type="hidden" value="{{$item->product_name}}" class="supplier_product_name">
                <input type="hidden" value="{{$item->product_qty}}" class="supplier_product_qty">
            @endforeach


            <div class="col-lg-10 offset-lg-1">

                <div class="row">
                    <div class="">
                        <div class="row py-3">
                            <h4 class="col-lg-5">Order and Purchase</h4>
                            <div class="dropdown col-lg-3 offset-lg-4">
                                <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (empty(request('cardPlan')))
                                        Daily
                                    @elseif (request('cardPlan')=='month')
                                        Monthly
                                    @elseif (request('cardPlan')=='year')
                                        Yearly
                                    @endif
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('admin#dashboard')}}">Daily</a></li>
                                <li><a class="dropdown-item" href="{{route('admin#dashboard',['cardPlan'=> 'month'])}}">Monthly</a></li>
                                <li><a class="dropdown-item" href="{{route('admin#dashboard',['cardPlan'=> 'year'])}}">Yearly</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Sales Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Sales</h5>

                                    <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$data['orderCount']}}</h6>
                                    </div>
                                    </div>
                                </div>

                                </div>
                            </div><!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sale Price</h5>

                                    <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$data['totalOrderPrice']}} MMK</h6>

                                    </div>
                                    </div>
                                </div>

                                </div>
                            </div><!-- End Revenue Card -->

                            @if (Auth::user()->position!='supplier')
                                <!-- Sales Card -->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="card info-card sales-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Purchase</h5>

                                        <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$data['purchaseCount']}}</h6>
                                        </div>
                                        </div>
                                    </div>

                                    </div>
                                </div><!-- End Sales Card -->

                                <!-- Revenue Card -->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Purchase Price</h5>

                                        <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{$data['totalPurchasePrice']}} MMK</h6>

                                        </div>
                                        </div>
                                    </div>

                                    </div>
                                </div><!-- End Revenue Card -->
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row py-2">
                    <h4 class="col-lg-5">Product Dashboard by Order</h4>
                    <div class="dropdown col-lg-3 offset-lg-4">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (empty(request('productOrderPlan')))
                                Daily
                            @elseif (request('productOrderPlan')=='month')
                                Monthly
                            @elseif (request('productOrderPlan')=='year')
                                Yearly
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin#dashboard')}}">Daily</a></li>
                          <li><a class="dropdown-item" href="{{route('admin#dashboard',['productOrderPlan'=> 'month'])}}">Monthly</a></li>
                          <li><a class="dropdown-item" href="{{route('admin#dashboard',['productOrderPlan'=> 'year'])}}">Yearly</a></li>
                        </ul>
                    </div>
                </div>
                <div id="chart-order-day"></div>

                <div class="row py-2">
                    <h4 class="col-lg-5">Product Dashboard by Purchase</h4>
                    <div class="dropdown col-lg-3 offset-lg-4">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (empty(request('productPurchasePlan')))
                                Daily
                            @elseif (request('productPurchasePlan')=='month')
                                Monthly
                            @elseif (request('productPurchasePlan')=='year')
                                Yearly
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin#dashboard')}}">Daily</a></li>
                          <li><a class="dropdown-item" href="{{route('admin#dashboard',['productPurchasePlan'=> 'month'])}}">Monthly</a></li>
                          <li><a class="dropdown-item" href="{{route('admin#dashboard',['productPurchasePlan'=> 'year'])}}">Yearly</a></li>
                        </ul>
                    </div>
                </div>
                <div id="chart-purchase-day"></div>

                <div class="row py-2">
                    <h4 class="col-lg-5">Product Sell</h4>
                    <div class="dropdown col-lg-3 offset-lg-4">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (empty(request('productTrendPlan')))
                                All
                            @else
                                {{request('productTrendPlan')}}
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin#dashboard')}}">All</a></li>
                          @foreach ($productsOrderDate as $item)
                            <li><a class="dropdown-item" href="{{route('admin#dashboard',['productTrendPlan'=> $item->date])}}">{{$item->date}}</a></li>
                          @endforeach
                        </ul>
                    </div>
                </div>
                <div id="chart-sell-products-qty"></div>

                <div class="row py-2">
                    <h4 class="col-lg-5">Product Purchase</h4>
                    <div class="dropdown col-lg-3 offset-lg-4">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (empty(request('productPurchaseTrandPlan')))
                                All
                            @else
                                {{request('productPurchaseTrandPlan')}}
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin#dashboard')}}">All</a></li>
                          @foreach ($productsPurchaseDate as $item)
                            <li><a class="dropdown-item" href="{{route('admin#dashboard',['productPurchaseTrandPlan'=> $item->date])}}">{{$item->date}}</a></li>
                          @endforeach
                        </ul>
                    </div>
                </div>
                <div id="chart-purchase-products-qty"></div>

                <div class="py-2">
                    <div>
                        <h4 class="col-lg-5 py-2">Best Seller Product</h4>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                  <tr>
                                    <th class="col-1">Image</th>
                                    <th>Product Name</th>
                                    <th>Seller</th>
                                    <th>QTY</th>
                                    <th>Total Price(MMK)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['trandProduct'] as $item)
                                        <tr>
                                            <td class="col-1">
                                                <div id="{{'carouselExampleFade'.$item->id}}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach (json_decode($item->image) as $image)
                                                            <div class="carousel-item @if ($loop->index==0)
                                                                    active
                                                                @endif">
                                                                <img src="{{asset('storage/product/'.$image)}}" class="d-block w-100 " alt="product_image">
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <button class="carousel-control-prev" type="button" data-bs-target="{{'#carouselExampleFade'.$item->id}}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="{{'#carouselExampleFade'.$item->id}}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                    </button>

                                                </div>
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->user_name}}</td>
                                            <td>{{$item->product_qty}}</td>
                                            <td>{{$item->total}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>

                <div class="py-2">
                    <div>
                        <h4 class="col-lg-5 py-2">Best Supplier Product</h4>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                  <tr>
                                    <th class="col-1">Image</th>
                                    <th>Product Name</th>
                                    <th>Supplier</th>
                                    <th>QTY</th>
                                    <th>Total Price(MMK)</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['trandPurchase'] as $item)
                                        <tr>
                                            <td class="col-1">
                                                <div id="{{'carouselExampleFade'.$item->id}}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach (json_decode($item->image) as $image)
                                                            <div class="carousel-item @if ($loop->index==0)
                                                                    active
                                                                @endif">
                                                                <img src="{{asset('storage/product/'.$image)}}" class="d-block w-100 " alt="product_image">
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <button class="carousel-control-prev" type="button" data-bs-target="{{'#carouselExampleFade'.$item->id}}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="{{'#carouselExampleFade'.$item->id}}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                    </button>

                                                </div>
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->user_name}}</td>
                                            <td>{{$item->product_qty}}</td>
                                            <td>{{$item->total}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </section>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.2/apexcharts.min.js" integrity="sha512-yWglrpRYz/pD0pp1cSpWmSVvcFwuuc739X4WHy7hRKB11BGijnz7fuqKRQB7Ksot42IN365OGvuOhSgUejKbmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
        var orderTotalItems=document.querySelectorAll('.orderTotal');
        var orderDateItems=document.querySelectorAll('.orderDate');
        var orderSubTotal=[];
        var orderDate=[];

        var purchaseTotalItems=document.querySelectorAll('.purchaseTotal');
        var purchaseDateItems=document.querySelectorAll('.purchaseDate');
        var purchaseSubTotal=[];
        var purchaseDate=[];

        for (let i = 0; i < orderTotalItems.length; i++) {
            orderSubTotal.push(orderTotalItems[i].value);
        }
        for (let i = 0; i < orderDateItems.length; i++) {
            orderDate.push(orderDateItems[i].value);
        }

        for (let i = 0; i < purchaseTotalItems.length; i++) {
            purchaseSubTotal.push(purchaseTotalItems[i].value);
        }
        for (let i = 0; i < purchaseDateItems.length; i++) {
            purchaseDate.push(purchaseDateItems[i].value);
        }

        var options1 = {
            series: [
                {
                    name: "Order",
                    data: orderSubTotal,
                },
            ],
            chart: {
                height: 350,
                type: 'line',
            zoom: {
                enabled: false
            }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: orderDate,
            }
        };

        var chart1 = new ApexCharts(document.querySelector("#chart-order-day"), options1);
        chart1.render();

        var options3 = {
            series: [
                {
                    name: "Order",
                    data: purchaseSubTotal,
                },
            ],
            chart: {
                height: 350,
                type: 'line',
            zoom: {
                enabled: false
            }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: purchaseDate,
            }
        };

        var chart3 = new ApexCharts(document.querySelector("#chart-purchase-day"), options3);
        chart3.render();


        var ProductName=document.querySelectorAll('.product_name');
        var ProductQty=document.querySelectorAll('.product_qty');
        var products=[];
        var qty=[];
        for (let i = 0; i < ProductName.length; i++) {
            products.push(ProductName[i].value);

        }
        for (let i = 0; i < ProductQty.length; i++) {
            qty.push(ProductQty[i].value);

        }

        var options2 = {
            series: [{
                name: "Order",
                data: qty,
            }],
            chart: {
            height: 350,
            type: 'bar',
            },
            plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                position: 'top', // top, center, bottom
                },
            }
            },
            dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val;
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
            },

            xaxis: {
            categories: products,
            position: 'top',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                type: 'gradient',
                gradient: {
                    colorFrom: '#D8E3F0',
                    colorTo: '#BED1E6',
                    stops: [0, 100],
                    opacityFrom: 0.4,
                    opacityTo: 0.5,
                }
                }
            },
            tooltip: {
                enabled: true,
            }
            },
            yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                return val;
                }
            }

            },
            title: {
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444'
            }
            }
        };

        var chart2 = new ApexCharts(document.querySelector("#chart-sell-products-qty"), options2);
        chart2.render();

        var PurchaseProductName=document.querySelectorAll('.supplier_product_name');
        var PurchaseProductQty=document.querySelectorAll('.supplier_product_qty');
        var purchase_products=[];
        var purchase_qty=[];
        for (let i = 0; i < PurchaseProductName.length; i++) {
            purchase_products.push(PurchaseProductName[i].value);

        }
        for (let i = 0; i < PurchaseProductQty.length; i++) {
            purchase_qty.push(PurchaseProductQty[i].value);

        }

        var options4 = {
            series: [{
                name: "Order",
                data: purchase_qty,
            }],
            chart: {
            height: 350,
            type: 'bar',
            },
            plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                position: 'top', // top, center, bottom
                },
            }
            },
            dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val;
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
            },

            xaxis: {
            categories: purchase_products,
            position: 'top',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                type: 'gradient',
                gradient: {
                    colorFrom: '#D8E3F0',
                    colorTo: '#BED1E6',
                    stops: [0, 100],
                    opacityFrom: 0.4,
                    opacityTo: 0.5,
                }
                }
            },
            tooltip: {
                enabled: true,
            }
            },
            yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                return val;
                }
            }

            },
            title: {
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444'
            }
            }
        };

        var chart4 = new ApexCharts(document.querySelector("#chart-purchase-products-qty"), options4);
        chart4.render();


</script>
@endsection
