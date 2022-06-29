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
                <form action="{{ route('product_update', ['product_id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="form" name="name" class="form-control" id="name" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}" >
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea id="description" name="description" class="form-control" >{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Danh mục</label>
                            <select class="form-control" name="menu_id">
                                @foreach($menu as $item)
                                <option value="{{ $item->id }}" {{($product->menu_id==$item->id)?'selected="selected"':''}}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                            <div class="form-group">
                                <label for="thanhphan">Thành phần</label>
                                <input type="form" name="thanhphan" class="form-control" value="{{ $product->thanhphan }}" id="thanhphan" placeholder="Nhập thành phần" >
                            </div>

                            <div class="form-group">
                                <label for="muavu">Mùa vụ</label>
                                <input type="form" name="muavu" class="form-control" value="{{ $product->muavu }}" id="muavu" placeholder="Nhập mùa vụ" >
                            </div>

                            <div class="form-group">
                                <label for="hansudung">Hạn sử dụng</label>
                                <input type="form" name="hansudung" class="form-control" value="{{ $product->hansudung }}" id="hansudung" placeholder="Nhập hạn sử dụng"  >
                            </div>

                            <div class="form-group">
                                <label for="xuatsu">Xuất sứ</label>
                                <input type="form" name="xuatsu" class="form-control" value="{{ $product->xuatsu }}" id="xuatsu" placeholder="Nhập nơi xuất sứ"  >
                            </div>


                            <div class="form-group">
                                <label for="giaohang">Giao hàng</label>
                                <input type="form" name="giaohang" class="form-control" value="{{ $product->giaohang }}" id="giaohang" placeholder="Nhập giao hàng" >
                            </div>

                        <div class="form-group">
                            <label>Giá</label>
                            <input type="form" name="price" class="form-control" placeholder="Nhập giá sản phẩm" value="{{ $product->price }}" >
                        </div>

                        <div class="form-group">
                            <label>Đơn vị</label>
                            <input type="form" name="unit" class="form-control" value={{$product->unit}} id="unit" placeholder="Nhập đơn vị">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh sản phẩm</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="thumb" accept="image/*">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            </div>
                        </div>

                        <label for="name">Kích hoạt</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="active" value='1'  {{($product->active==1)?'checked=""':''}}>
                            <label class="form-check-label">Có</label>
                        </div>
                        <div  class="form-check">
                            <input class="form-check-input" type="radio" name="active" value='0' {{($product->active==0)?'checked=""':''}}>
                            <label class="form-check-label">Không</label>
                        </div>

                    <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="background-color: #298A08">Cập nhật sản phẩm</button>
                    </div>
                </form>
        </div>
    </div>
@stop
