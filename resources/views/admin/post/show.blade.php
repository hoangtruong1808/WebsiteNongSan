@extends('admin/main')

@section('content')
            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>STT</th>
                    <th>Đơn vị</th>
                    <th>Phương thức</th>
                    <th>Sản phẩm</th>
                    <th>Nhóm</th>
                    <th>Giá</th>
                    <th>Sản lượng TB</th>
                    <th>Duyệt</th>
                    <th>Không duyệt</th>
                </tr>
                <?php
                $message = Session::get('message');
                if($message) {
                    echo '<div class="alert alert-success" style="width: 100%">'.$message.'</div>';
                    Session::put('message', null);
                }
                $stt=1;
                ?>
                <?php
                if (isset($_GET['page']))
                {
                    $page = $_GET['page'];
                }
                else $page = 1;
                $a = ( $page-1)*10+1; ?>
                @foreach($post as $item)
                <tr>
                    <td>{{ $a++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->method }}</td>
                    <td>{{ $item->product }}</td>
                    <td>{{ $item->group }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->averageyield }}</td>
                    <td>
                        @if ($item->status== "Đã duyệt")
                        Đã duyệt
                        @else
                        <a href="{{ route('post_approve',['post_id' => $item->id]) }}" style="color:blue"><i class="fas fa-check"></i>
                        </a>
                        @endif
                    </td>
                    <td>
                        @if ($item->status== "Không được duyệt")
                        Không duyệt
                        @else
                        <a href="{{ route('post_cancel', ['post_id' => $item->id]) }}" style="color:red"> <i class="fas fa-backspace"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $post->links('pagination::bootstrap-4') }}
@stop
