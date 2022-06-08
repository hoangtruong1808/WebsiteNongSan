@extends('page/main')

@section('content')
    <style>
        p.bubble {
            position: relative;
            width: 300px;
            text-align: center;
            line-height: 1.4em;
            margin: 0px auto;
            background-color: #fff;
            border: 6px solid #82ae46 ;
            border-radius: 30px;
            font-family: sans-serif;
            padding: 0px;
            font-size: 14px;
        }

        p.thought {
            margin-left: 60%;
            width: 300px;
            border-radius: 200px;
            padding: 30px;
        }

        p.bubble:before,
        p.bubble:after {
            content: ' ';
            position: absolute;
            width: 0;
            height: 0;
        }

        p.thought:before,
        p.thought:after {
            left: 10px;
            bottom: -30px;
            width: 40px;
            height: 40px;
            background-color: #fff;
            border: 6px solid #82ae46 ;
            -webkit-border-radius: 28px;
            -moz-border-radius: 28px;
            border-radius: 28px;
        }

        p.thought:after {
            width: 20px;
            height: 20px;
            left: 5px;
            bottom: -40px;
            -webkit-border-radius: 18px;
            -moz-border-radius: 18px;
            border-radius: 18px;
        }
    </style>
    <section class="ftco-section" style="padding-top: 40px">
        <p class="bubble thought">
            <b>Mỗi đơn hàng trên 250.000 VNĐ sẽ nhận ngay được một lần quay</b>
        </p>
        <div align="center" style="margin-bottom: 0px">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                    </td>
                    <td width="438" height="582" class="the_wheel" style="background: url({{asset('rotate_template/wheel_back.png')}})" align="center" valign="center">
                        <canvas id="canvas" width="434" height="434">
                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                        </canvas>
                    </td>
                </tr>
            </table>
            <button id="spin_start" class="btn" onClick="startSpin();">Quay ngay</button>
            <button id="spin_reset" class="btn" onClick="resetWheel();">Tiếp tục quay</button><br>
            <div style="font-size: 18px">Số lượt quay còn: <b id="rotate_quantity">{{$rotate_quantity}}</b> lượt</div>
        </div>

    </section>
    <script>
        //Thông số vòng quay
        let duration = 5; //Thời gian kết thúc vòng quay
        let spins    = 15; //Quay nhanh hay chậm 3, 8, 15
        let theWheel = new Winwheel({
            'numSegments'  : 6,     // Chia 8 phần bằng nhau
            'outerRadius'  : 212,   // Đặt bán kính vòng quay
            'textFontSize' : 18,    // Đặt kích thước chữ
            'rotationAngle': 0,     // Đặt góc vòng quay từ 0 đến 360 độ.
            'segments'     :        // Các thành phần bao gồm màu sắc và văn bản.
                [
                    {'fillStyle' : '#eae56f', 'text' : '10.000 đồng', 'val' : 10000},
                    {'fillStyle' : '#89f26e', 'text' : '20.000 đồng', 'val' : 20000},
                    {'fillStyle' : '#7de6ef', 'text' : '30.000 đồng', 'val' : 30000},
                    {'fillStyle' : '#e7706f', 'text' : '40.000 đồng', 'val' : 40000},
                    {'fillStyle' : '#eae56f', 'text' : '50.000 đồng', 'val' : 50000},
                    {'fillStyle' : '#89f26e', 'text' : '60.000 đồng', 'val' : 60000},

                ],
            'animation' : {
                'type'     : 'spinToStop',
                'duration' : duration,
                'spins'    : spins,
                'callbackSound'    : playSound,     //Hàm gọi âm thanh khi quay
                'soundTrigger'     : 'pin',         //Chỉ định chân là để kích hoạt âm thanh
                'callbackFinished' : alertPrize,    //Hàm hiển thị kết quả trúng giải thưởng
            },
            'pins' :
                {
                    'number' : 32   //Số lượng chân. Chia đều xung quanh vòng quay.
                }
        });

        //Kiểm tra vòng quay
        let wheelSpinning = false;

        //Tạo âm thanh và tải tập tin tick.mp3.
        let audio = new Audio('tick.mp3');
        function playSound() {
            audio.pause();
            audio.currentTime = 0;
            audio.play();
        }

        //Hiển thị các nút vòng quay
        function statusButton(status) {
            if ( status==1 ) { //trước khi quay
                document.getElementById('spin_start').removeAttribute("disabled");
                document.getElementById('spin_reset').classList.add("hide");
            } else if ( status==2 ) { //đang quay
                document.getElementById('spin_start').setAttribute("disabled", false);
                document.getElementById('spin_reset').classList.add("hide");
            } else if ( status==3 ) { //kết quả
                document.getElementById('spin_reset').classList.remove("hide");
            } else {
                alert('Các giá trị của status: 1, 2, 3');
            }
        }
        statusButton(1);

        //startSpin
        function startSpin() {
            if($("#rotate_quantity").html()>0){
                if (wheelSpinning == false) {
                    //CSS hiển thị button
                    statusButton(2);

                    //Hàm bắt đầu quay
                    theWheel.startAnimation();

                    //Khóa vòng quay
                    wheelSpinning = true;
                }
            }
            else{
                swal("Không thành công", "Bạn không còn lượt quay", "success");
            }
            // Ensure that spinning can't be clicked again while already running.
        }

        //Result
        function randomcode(){
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
            return password;
        }
        function alertPrize(indicatedSegment) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var code = randomcode();
            $.ajax({
                method: "POST",
                url: "{{route('store_rotate')}}",
                data:{
                    _token: CSRF_TOKEN,
                    val: indicatedSegment.val,
                    code: code,
                },
                success:function(data) {
                    $("#rotate_quantity").html($("#rotate_quantity").html()-1);
                    swal("Chúc mừng", "Chúc mừng bạn nhận được voucher " + indicatedSegment.text, "success");
                }
            });

            //CSS hiển thị button
            statusButton(3);
        }

        //resetWheel
        function resetWheel() {
            //CSS hiển thị button
            statusButton(1);

            theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
            theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
            theWheel.draw();                // Call draw to render changes to the wheel.

            wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
        }
    </script>
@stop
