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
                        <a class="btn btn-default" href="{{route('turnover_based_on_date')}}"  style="font-size: 16px; margin-left: 20px ;margin-right: 10px; color: grey"><i class="fas fa-table"></i></a>
                    </div>
                </div>
            </div>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        var json_data = @json($data);
        var ctx = document.getElementById("myChart");
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
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
        });
    </script>
@stop
