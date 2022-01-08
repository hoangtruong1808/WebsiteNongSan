@extends('admin/main')

@section('content')
    <section class="panel">
        <div class="panel-body minimal">
            <div class="table-inbox-wrap ">
                <table class="table table-inbox table-hover">
            <tbody>
                @foreach($message as $value)
                    @if($value->status == 0)
                    <tr class="unread">
                        <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                        <td class="view-message  dont-show"><a href="{{ route('customer_detail',['customer_id'=>$value->customer_id]) }}">{{ $value->name }}</a></td>
                        <td class="view-message "><a href="">{{ $value->content }}</a></td>
                        <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                        <td class="view-message  text-right">{{ $value->time }}</td>
                    </tr>
                    @else
                    <tr class="">
                        <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                        <td class="view-message dont-show"><a href="{{ route('customer_detail',['customer_id'=>$value->customer_id]) }}" style="color: black">{{ $value->name }}</a></td>
                        <td class="view-message">{{ $value->content }}</td>
                        <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                        <td class="view-message text-right">{{ $value->time }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
            </table>

            </div>
        </div>
    </section>
@stop