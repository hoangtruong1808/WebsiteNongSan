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
                    <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data">
                        @csrf()
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="form" name="name" class="form-control" id="name" placeholder="Nhập tên sản phẩm">
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Danh mục</label>
                                <select class="form-control" name="menu_id">
                                    @foreach($menu as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="thanhphan">Thành phần</label>
                                <input type="form" name="thanhphan" class="form-control" id="thanhphan" placeholder="Nhập thành phần">
                            </div>

                            <div class="form-group">
                                <label for="xuatsu">Xuất xứ</label>
                                <input type="form" name="xuatsu" class="form-control" id="xuatsu" placeholder="Nhập nơi xuất xứ">
                            </div>

                            <div class="form-group">
                                <label for="giaohang">Giao hàng</label>
                                <input type="form" name="giaohang" class="form-control" id="giaohang" placeholder="Nhập giao hàng">
                            </div>

                            <div class="form-group">
                                <label>Giá</label>
                                <input type="form" name="price" class="form-control" placeholder="Nhập giá sản phẩm">
                            </div>

                            <div class="form-group">
                                <label>Đơn vị</label>
                                <input type="form" name="unit" class="form-control" id="unit" placeholder="Nhập đơn vị">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Ảnh sản phẩm</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="thumb">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                </div>
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
                            <button type="submit" class="btn btn-primary" style="background-color: #298A08">Tạo sản phẩm</button>
                        </div>
                    </form>
            </div>
        </div>
    @stop
