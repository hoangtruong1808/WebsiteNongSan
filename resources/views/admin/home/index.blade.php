@extends('admin/main')

@section('content')
    <style>
        .card-title{
            font-weight: bold;
        }
    </style>
        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Trang chủ</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$data['product_count']}}</h3>
                                    <p>Tổng sản phẩm</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-carrot"></i>
                                </div>
                                <a href="{{route('product_show')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{$data['new_order_count']}}</h3>
                                    <p>Đơn hàng mới</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <a href="{{route('order_show')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{$data['customer_count']}}</h3>
                                    <p>Khách hàng</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="{{route('customer_show')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{$data['staff_count']}}</h3>
                                    <p>Nhân viên</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-house-user"></i>
                                </div>
                                <a href="{{route('staff_show')}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <section class="col-lg-6 connectedSortable">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Đơn đặt hàng
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart" height="400" style="margin-left: 135px"></canvas>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Sản phẩm bán chạy</h3>
                                    <div class="card-tools">
                                        <a href="#" class="btn btn-tool btn-sm">
                                            <i class="fas fa-bars"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-striped table-valign-middle">
                                        <thead>
                                        <tr>
                                            <th width="200">Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Đã bán</th>
                                            <th>Doanh thu</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data['best_seller'] as $key=>$value)
                                        <tr>
                                            <td>
                                                {{$value->product_name . ' '.$value->unit}}
                                            </td>
                                            <td>
                                                {{number_format($value->price)}} VNĐ
                                            </td>
                                            <td>
                                                {{ceil($value->sum)}}
                                            </td>
                                            <td>
                                                {{number_format(ceil($value->sum * $value->price))}} VNĐ
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </section>


                        <section class="col-lg-6 connectedSortable">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Doanh thu theo tháng
                                    </h3>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body" style="height: 440px">
                                    <canvas id="mydateChart" height="210"></canvas>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Tổng quan cửa hàng</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <p class="text-success text-xl">
                                            <i class="ion ion-ios-refresh-empty"></i>
                                        </p>
                                        <p class="d-flex flex-column text-right">
                                             <span class="font-weight-bold">
                                            <i class="fas fa-arrow-up" style="color: green;"></i> 50%
                                            </span>
                                            <span class="text-muted">Số lượng đơn hàng</span>
                                        </p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <p class="text-warning text-xl">
                                            <i class="ion ion-ios-cart-outline"></i>
                                        </p>
                                        <p class="d-flex flex-column text-right">
                                            <span class="font-weight-bold">
                                            <i class="fas fa-arrow-up" style="color: green;"></i> 20%
                                            </span>
                                            <span class="text-muted">Số lượng khách hàng</span>
                                        </p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-0">
                                        <p class="text-danger text-xl">
                                            <i class="ion ion-ios-people-outline"></i>
                                        </p>
                                        <p class="d-flex flex-column text-right">
                                            <span class="font-weight-bold">
                                            <i class="fas fa-arrow-up" style="color: green;"></i>  70%
                                            </span>
                                            <span class="text-muted">Doanh thu</span>
                                        </p>
                                    </div>

                                </div>
                            </div>

                        </section>

                    </div>

                </div>

                <script>
                    var ctx = document.getElementById("myChart");
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Đang xử lý', 'Đang giao hàng', 'Đã nhận hàng', 'Đơn hàng bị hủy'],
                            datasets: [{
                                label: '# of Tomatoes',
                                data: [{{$data['new_order_count']}}, {{$data['shipping_order_count']}}, {{$data['confirm_order_count']}}, {{$data['cancel_order_count'] }}],
                                backgroundColor: [
                                    '#17a2b8',
                                    '#007bff',
                                    '#28a745',
                                    '#dc3545'
                                ],
                                borderColor: [
                                    '#17a2b8',
                                    '#007bff',
                                    '#28a745',
                                    '#dc3545'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            //cutoutPercentage: 40,
                            responsive: false,

                        }
                    });

                    var json_data = @json($data_date);
                    var ctx2 = document.getElementById("mydateChart");
                    const data = {
                        labels: json_data.name,
                        datasets: [{
                            label: 'My First Dataset',
                            data: json_data.money,
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                    }
                    var mydateChart = new Chart(ctx2, {
                        type: 'line',
                        data: data,
                    });
                </script>
@stop
