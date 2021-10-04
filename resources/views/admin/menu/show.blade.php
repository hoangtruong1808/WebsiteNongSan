@extends('admin/main')

@section('content')

            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th style="width: 700px">Mô tả</th>
                    <th>Kích hoạt</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php $i=1 ?>
                @foreach($menu as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td style="text-align: left">{{ $item->description }}</td>
                    <td>{{ $item->active }}</td>
                    <td>
                        <a href="{{ route('menu_edit',['menu_id' => $item->id]) }}"> <i class="fas fa-edit"></i>
                        </a>                   
                    </td>
                    <td>
                        <a href="{{ route('menu_destroy', ['menu_id' => $item->id]) }}" onclick="confirm('Bạn có chắc chắn xóa không?')"> <i class="fas fa-trash-alt"></i>
                        </a>                   
                    </td>
                </tr>
                @endforeach
            </table>    
@stop