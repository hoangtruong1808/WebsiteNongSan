    @extends('admin/main')

    @section('content')

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('menu_store') }}" method="post">
                        @csrf()
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input type="form" name="name" class="form-control" id="name" placeholder="Nhập tên danh mục">
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>

                            <label for="name">Kích hoạt</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="active" value='1' checked="">
                                <label class="form-check-label">Có</label>
                            </div>
                            <div  class="form-check">
                                <input class="form-check-input" type="radio" name="active" value='0'>
                                <label class="form-check-label">Không</label>
                            </div>

                        <!-- /.card-body -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" style="background-color: #298A08">Tạo danh mục</button>
                        </div>
                    </form>
    @stop
