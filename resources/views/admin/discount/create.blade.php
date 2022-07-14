    @extends('admin/main')

    @section('content')
        <style>
            .select2-container--default .select2-selection--single{
                padding:6px;
                height: 37px;
                position: relative;
            }
        </style>
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
                <form action="{{ route('discount_store') }}" method="post">
                    @csrf()
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Sản phẩm</label>
                            <div style=" display:block">
                                <select class="form-control input-lg select2 select2-hidden-accessible area" style="width: 100%;" tabindex="-1" aria-hidden="true" name="product_id">
                                    <option value="" selected disabled hidden>Chọn sản phẩm</option>
                                    @foreach($product as $value)
                                        <option value="{{ $value->id }}">{{$value->name . ' ' . $value->unit}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="value">Mức giảm giá</label>
                            <div style=" display:block">
                                <input type="form" name="value" class="form-control" id="value" placeholder="Nhập mức giảm giá (%)" style="width:85%; display:unset" >
                                <select class="form-control"  style="display:unset; width:14%" id="unit" name="unit">
                                    <option value="%">%</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Thời gian áp dụng</label>
                            <div style=" display:block">
                                <label for="date_start" style="font-weight: normal">Từ: </label>
                                <input type="datetime-local" name="date_start" class="form-control" min="{{date("Y-m-d\TH:i")}}" style="width:35%; display:unset"  id="date_start">
                                <label for="date_end" style="font-weight: normal; margin-left: 3%">Đến: </label>
                                <input type="datetime-local" name="date_end" class="form-control"  min="{{date("Y-m-d\TH:i")}}" style="width:35%; display:unset"  id="date_end">
                            </div>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="background-color: #298A08">Tạo khuyến mãi</button>
                    </div>
                </form>
            </div>
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
                $('.select2').select2();
                $('#example').DataTable();
            } );
        </script>
    @stop
