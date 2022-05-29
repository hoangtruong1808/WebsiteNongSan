@extends('admin/main')

@section('content')
    <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
            <div class="card-header" style="background-color: #298A08; " >
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>
                </div>
            </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('menu_update',['menu_id'=>$menu->id]) }}" method="post">
                    @csrf()
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input type="form" name="name" class="form-control" value="{{ $menu->name }}" id="name" placeholder="Nhập tên danh mục">
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea id="description" name="description" class="form-control">{{ $menu->description}}
                            </textarea>
                        </div>

                        <label for="name">Kích hoạt</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="active" value='1' {{($menu->active==1)?'checked=""':''}}>
                            <label class="form-check-label">Có</label>
                        </div>
                        <div  class="form-check">
                            <input class="form-check-input" type="radio" name="active" value='0' {{($menu->active==0)?'checked=""':''}}>
                            <label class="form-check-label">Không</label>
                        </div>

                    <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="background-color: #298A08">Cập nhật danh mục</button>
                    </div>
                </form>
        </div>
    </div>
@stop
