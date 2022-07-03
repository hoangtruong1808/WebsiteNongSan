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
        <form action="{{ route('voucher_update',['voucher_id'=>$voucher->ID]) }}" method="post">
            @csrf()
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Mã khuyến mãi</label>
                    <div style=" display:block">
                        <input type="text" id="code" name="code" style="width:10%; display:unset" class="form-control" value="{{ $voucher->code }}" readonly />
                        <a class="btn btn-default" onclick="RandomID();"><i class="fa fa-rotate-left"></i></a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="value">Mức giảm giá</label>
                    <div style=" display:block">
                        <input type="form" name="value" class="form-control" id="value" placeholder="Nhập mức giảm giá" style="width:85%; display:unset" value="{{ $voucher->value }}" >
                        <select class="form-control"  style="display:unset; width:14%" id="unit" name="unit">
                            <option>Chọn đơn vị</option>
                            <option value="%" {{($voucher->unit=="%")?'selected="selected"':''}}>%</option>
                            <option value="VNĐ" {{($voucher->unit=="VNĐ")?'selected="selected"':''}}>VNĐ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Giá trị đơn hàng áp dụng</label>
                    <div style=" display:block">
                        <label for="order_min" style="font-weight: normal">Từ: </label>
                        <input type="form" name="order_min" class="form-control"  style="width:44%; display:unset"  id="order_min" value="{{ $voucher->order_min }}">
                        <label for="order_max" style="font-weight: normal; margin-left: 3%">Đến: </label>
                        <input type="form" name="order_max" class="form-control"  style="width:44%; display:unset"  id="order_max" value="{{ $voucher->order_max }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng mã</label>
                    <input type="form" name="quantity" class="form-control" id="quantity"  value="{{ $voucher->quantity }}" placeholder="Nhập số lượng mã">
                </div>
                <div class="form-group">
                    <label for="name">Thời gian áp dụng</label>
                    <div style=" display:block">
                        <label for="date_start" style="font-weight: normal">Từ: </label>
                        <input type="datetime-local" name="date_start" class="form-control"  style="width:44%; display:unset"  id="date_start" value="{{ $voucher->date_start }}">
                        <label for="date_end" style="font-weight: normal; margin-left: 3%">Đến: </label>
                        <input type="datetime-local" name="date_end" class="form-control"  style="width:44%; display:unset"  id="date_end" value="{{ $voucher->date_end }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="describe">Mô tả</label>
                    <textarea id="describe" name="describe" class="form-control">{{ $voucher->describe }}</textarea>
                </div>

                <!-- /.card-body -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" style="background-color: #298A08">Cập nhật mã khuyến mãi</button>
            </div>
        </form>
        </div>
    <script>
        // How to use
        function RandomID(){
            var iteration = 0;
            var password = "";
            var randomNumber;
            if(special == undefined){
                var special = false;
            }
            while(iteration < 8){
                randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
                if(!special){
                    if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
                    if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
                    if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
                    if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
                }
                iteration++;
                password += String.fromCharCode(randomNumber);
            }
            $("#code").val(password);
        }
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@stop
