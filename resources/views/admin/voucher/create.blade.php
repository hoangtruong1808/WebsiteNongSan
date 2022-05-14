    @extends('admin/main')

    @section('content')

        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('voucher_store') }}" method="post">
            @csrf()
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Mã khuyến mãi</label>
                    <div style=" display:block">
                        <input type="text" id="code" name="code" style="width:10%; display:unset" class="form-control" readonly />
                        <a class="btn btn-default" onclick="RandomID();"><i class="fa fa-rotate-left"></i></a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="value">Mức giảm giá</label>
                    <div style=" display:block">
                        <input type="form" name="value" class="form-control" id="value" placeholder="Nhập mức giảm giá" style="width:85%; display:unset" >
                        <select class="form-control"  style="display:unset; width:14%" id="unit" name="unit">
                            <option>Chọn đơn vị</option>
                            <option value="%">%</option>
                            <option value="VNĐ">VNĐ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Giá trị đơn hàng áp dụng</label>
                    <div style=" display:block">
                        <label for="order_min" style="font-weight: normal">Từ: </label>
                        <input type="form" name="order_min" class="form-control"  style="width:46%; display:unset"  id="order_min">
                        <label for="order_max" style="font-weight: normal; margin-left: 3%">Đến: </label>
                        <input type="form" name="order_max" class="form-control"  style="width:46%; display:unset"  id="order_max">
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng mã</label>
                    <input type="form" name="quantity" class="form-control" id="quantity" placeholder="Nhập số lượng mã">
                </div>
                <div class="form-group">
                    <label for="quantity_per_account">Số lượng mã cho mỗi tài khoản</label>
                    <input type="form" name="quantity_per_account" class="form-control" id="quantity_per_account" placeholder="Nhập số lượng mã cho mỗi tài khoản">
                </div>
                <div class="form-group">
                    <label for="name">Thời gian áp dụng</label>
                    <div style=" display:block">
                        <label for="date_start" style="font-weight: normal">Từ: </label>
                        <input type="datetime-local" name="date_start" class="form-control"  style="width:46%; display:unset"  id="date_start">
                        <label for="date_end" style="font-weight: normal; margin-left: 3%">Đến: </label>
                        <input type="datetime-local" name="date_end" class="form-control"  style="width:46%; display:unset"  id="date_end">
                    </div>
                </div>
                <div class="form-group">
                    <label for="describe">Mô tả</label>
                    <textarea id="describe" name="describe" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="customer_type">Áp dụng với khách hàng </label>
                    <select class="form-control" id="customer_type" name="customer_type">
                        <option value="0">Tất cả khách hàng</option>
                        <option value="1">Khách hàng vip</option>
                        <option value="2">Khách hàng thường</option>
                    </select>
                </div>


            <!-- /.card-body -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" style="background-color: #298A08">Tạo voucher</button>
            </div>
        </form>
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
