@extends('main.user.layout.master')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>

  </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            @foreach ($sale as $item)
                <input type="hidden" value="{{$item->total}}" class="total">
                <input type="hidden" value="{{$item->date}}" class="date">
            @endforeach

            @foreach ($products as $item)
            <input type="hidden" value="{{$item->product_name}}" class="product_name">
            <input type="hidden" value="{{$item->product_qty}}" class="product_qty">
            @endforeach

            <div class="col-lg-10 offset-lg-1">

                <div class="row">
                    <div class="">
                        <div class="d-flex justify-content-end py-3">
                            <div class="dropdown">
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
                                <li><a class="dropdown-item" href="{{route('user#myDashboard')}}">Daily</a></li>
                                <li><a class="dropdown-item" href="{{route('user#myDashboard',['cardPlan'=> 'month'])}}">Monthly</a></li>
                                <li><a class="dropdown-item" href="{{route('user#myDashboard',['cardPlan'=> 'year'])}}">Yearly</a></li>
                                </ul>
                            </div>
                        </div>
                        <h4 class="">Order</h4>
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
                        </div>

                            @if (Auth::user()->position!='supplier')
                                <h4 class="">Purchase</h4>
                                <div class="row">
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
                                </div>
                            @endif

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
                          <li><a class="dropdown-item" href="{{route('user#myDashboard')}}">Daily</a></li>
                          <li><a class="dropdown-item" href="{{route('user#myDashboard',['productOrderPlan'=> 'month'])}}">Monthly</a></li>
                          <li><a class="dropdown-item" href="{{route('user#myDashboard',['productOrderPlan'=> 'year'])}}">Yearly</a></li>
                        </ul>
                    </div>
                </div>
                <div id="chart-order-day"></div>

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
                          <li><a class="dropdown-item" href="{{route('user#myDashboard')}}">All</a></li>
                          @foreach ($productsOrderDate as $item)
                            <li><a class="dropdown-item" href="{{route('user#myDashboard',['productTrendPlan'=> $item->date])}}">{{$item->date}}</a></li>
                          @endforeach
                        </ul>
                    </div>
                </div>
                <div id="chart-products-qty"></div>

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
        var TotalItems=document.querySelectorAll('.total');
        var dateItems=document.querySelectorAll('.date');
        var subTotal=[];
        var date=[];
        for (let i = 0; i < TotalItems.length; i++) {
            subTotal.push(TotalItems[i].value);

        }
        for (let i = 0; i < dateItems.length; i++) {
            date.push(dateItems[i].value);

        }
        var options1 = {
            series: [{
                name: "Order",
                data: subTotal,
            }],
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
                categories: date,
            }
        };

        var chart1 = new ApexCharts(document.querySelector("#chart-order-day"), options1);
        chart1.render();


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

        var chart2 = new ApexCharts(document.querySelector("#chart-products-qty"), options2);
        chart2.render();


</script>
@endsection
