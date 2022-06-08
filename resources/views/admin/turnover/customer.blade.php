@extends('admin/main')

@section('content')
    <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
            <div class="card-header" style="background-color: #298A08; " >
                <div class="row">
                    <div class="col-sm-11">
                        <h3 class="card-title" style="padding-top: 5px">{{ $title }}</h3>
                    </div>
                    <div class="col-sm-1">
                        <a class="btn btn-default" href="{{route('turnover_customer_chart')}}" style="font-size: 16px; margin-left: 20px ;margin-right: 10px; color: grey"><i class="fas fa-chart-line"></i></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" >
                <tr  style="text-align: center">
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Thông tin</th>
                    <th>Trạng thái</th>
                    <th>Tổng</th>
                </tr>
                <?php $i=1;
                $total = 0;?>

                @foreach($turnover_customer as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td style="text-align: left">
                        <div> Địa chỉ: {{ $item->address }}</div>
                        <div> SĐT: {{ $item->phone }}</div>
                        <div> Email: {{ $item->email }}</div>
                    </td>
                    <td  style="text-align: center">
                        @if($item->is_deleted == 1)
                        <span class="badge badge-dark">Bị khóa</span>
                        @else($item->is_deleted == 0)
                        <span class="badge badge-success">Hoạt động</span>
                        @endif
                    </td>
                    <td style="text-align: center">{{ number_format($item->sum) }} VNĐ</td>
                    <?php  $total += $item->sum?>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: center"><b>Tổng doanh thu</b></td>
                    <td style="text-align: center">{{number_format($total)}} VNĐ</td>
                </tr>
            </table>
        </div>
    </div>
@stop
