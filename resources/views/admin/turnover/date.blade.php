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
                        <a class="btn btn-default" href="{{route('turnover_date_chart')}}" style="font-size: 16px; margin-left: 20px ;margin-right: 10px; color: grey"><i class="fas fa-chart-line"></i></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered"  style="text-align: center">
                <tr >
                    <th>STT</th>
                    <th>Tháng</th>
                    <th>Tổng</th>
                </tr>
                <?php $i=1;
                $total = 0;?>

                @foreach($turnover_date as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>Tháng {{ $item->month }} năm {{ $item->year }}</td>
                    <td style="text-align: center">{{ number_format($item->sum) }} VNĐ</td>
                    <?php  $total += $item->sum?>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="text-align: center"><b>Tổng doanh thu</b></td>
                    <td style="text-align: center">{{number_format($total)}} VNĐ</td>
                </tr>
            </table>
        </div>
    </div>
@stop
