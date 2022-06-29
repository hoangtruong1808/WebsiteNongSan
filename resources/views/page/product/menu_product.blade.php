		@extends('/page/main')

		@section('content')
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8 mb-5 text-center">
						<ul class="product-category">
							<li><a class="menu-href all-product"  style="cursor:pointer" data-menu_id="0">Tất cả</a></li>
                            @foreach ($menu as $item)
                                <li><a class="menu-href {{($item->id==$menu_id)?"active": ""}}"  style="cursor:pointer" data-menu_id="{{ $item->id }}">{{ $item->name }}</a></li>
                            @endforeach
						</ul>
					</div>
					<div class="col-md-4">
                        <div class="input-group">
{{--                            <input type="text" name="key" id="search-query" multiple>--}}
                            <input type='text' name="key" id='example_email' name='example_email' class='form-control' value=''>
                            <span class="input-group-btn"  style="margin-left: 10px">
                                <div class="btn btn-primary" id="search-btn">Tìm</div>
                            </span>
                        </div>
					</div>
				</div>
	            </br>
				<div class="row list-product">
				</div>
				<div class="row mt-5">
                    <div class="col text-center" style="margin-left:45%">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>
			    </div>
			</div>
		</section>
        <script type="text/javascript" language="javascript">
            var url = "/san-pham-api";
            var query ="";
            var menu_id;
            var search_query_array = [];
            var product_id;
            var favorite_type;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function() {
                url = "/san-pham-api?menu_id="+{{$menu_id}};
                console.log(url);
                $.getJSON(url, function(data) {
                    console.log(data);
                    LoadPage(data.page_number);
                    var string;
                    $.each(data.product, function( product_key, product ) {
                        LoadData(product);
                    });
                    $( ".add-to-favorite" ).click(function() {
                        favorite_type = $(this).attr('data-type');
                        product_id = $(this).attr('data-id');
                        $.ajax({
                            url: "{{route('favorite_product')}}",
                            method: 'POST',
                            data: {_token: CSRF_TOKEN,
                                name: name,
                                product_id: product_id,
                                favorite_type: favorite_type,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                if (favorite_type == 'add-favorite'){
                                    swal("Thành công", "Yêu thích sản phẩm thành công", "success");
                                    $("#add-to-favorite-"+product_id).attr('data-type', 'remove-favorite');
                                    $("#add-to-favorite-"+product_id).attr('title', 'Bỏ yêu thích');
                                    $("#add-to-favorite-"+product_id).attr('style', 'background-color: #e1f3c8; color: #82ae46;');
                                }
                                else{
                                    swal("Thành công", "Bỏ yêu thích sản phẩm thành công", "success");
                                    $("#add-to-favorite-"+product_id).attr('data-type', 'add-favorite');
                                    $("#add-to-favorite-"+product_id).attr('title', 'Yêu thích');
                                    $("#add-to-favorite-"+product_id).attr('style', '');
                                }
                            }
                        });
                    });
                });
                $('.menu-href').click(function(){
                    $(".menu-href").not(this).removeClass( "active" );
                    // $("not($(this))").addClass( "active" );
                    $(this).addClass( "active" );
                    $('.list-product').empty();
                    menu_id = $(this).attr("data-menu_id") ;
                    query="";
                    url = "/san-pham-api?menu_id="+menu_id;
                    // url += "&menu_id="+menu_id;
                    $.getJSON(url, function(data) {
                        var string;
                        LoadPage(data.page_number);
                        $.each(data.product, function( product_key, product ) {
                            LoadData(product);
                        });
                        $( ".add-to-favorite" ).click(function() {
                            favorite_type = $(this).attr('data-type');
                            product_id = $(this).attr('data-id');
                            $.ajax({
                                url: "{{route('favorite_product')}}",
                                method: 'POST',
                                data: {_token: CSRF_TOKEN,
                                    name: name,
                                    product_id: product_id,
                                    favorite_type: favorite_type,
                                },
                                dataType: 'JSON',
                                success: function (data) {
                                    if (favorite_type == 'add-favorite'){
                                        swal("Thành công", "Yêu thích sản phẩm thành công", "success");
                                        $("#add-to-favorite-"+product_id).attr('data-type', 'remove-favorite');
                                        $("#add-to-favorite-"+product_id).attr('title', 'Bỏ yêu thích');
                                        $("#add-to-favorite-"+product_id).attr('style', 'background-color: #e1f3c8; color: #82ae46;');
                                    }
                                    else{
                                        swal("Thành công", "Bỏ yêu thích sản phẩm thành công", "success");
                                        $("#add-to-favorite-"+product_id).attr('data-type', 'add-favorite');
                                        $("#add-to-favorite-"+product_id).attr('title', 'Yêu thích');
                                        $("#add-to-favorite-"+product_id).attr('style', '');
                                    }
                                }
                            });
                        });
                    });
                });
                $('#search-btn').click(function(){
                    $(".menu-href").removeClass( "active" );
                    $('.list-product').empty();
                    query = $('#example_email').val();
                    menu_id = 0;
                    url = "/san-pham-api?query="+query;
                    $.getJSON(url, function(data) {
                        var string;
                        LoadPage(data.page_number);
                        $.each(data.product, function( product_key, product ) {
                            LoadData(product);
                        });
                        $( ".add-to-favorite" ).click(function() {
                            favorite_type = $(this).attr('data-type');
                            product_id = $(this).attr('data-id');
                            $.ajax({
                                url: "{{route('favorite_product')}}",
                                method: 'POST',
                                data: {_token: CSRF_TOKEN,
                                    name: name,
                                    product_id: product_id,
                                    favorite_type: favorite_type,
                                },
                                dataType: 'JSON',
                                success: function (data) {
                                    if (favorite_type == 'add-favorite'){
                                        swal("Thành công", "Yêu thích sản phẩm thành công", "success");
                                        $("#add-to-favorite-"+product_id).attr('data-type', 'remove-favorite');
                                        $("#add-to-favorite-"+product_id).attr('title', 'Bỏ yêu thích');
                                        $("#add-to-favorite-"+product_id).attr('style', 'background-color: #e1f3c8; color: #82ae46;');
                                    }
                                    else{
                                        swal("Thành công", "Bỏ yêu thích sản phẩm thành công", "success");
                                        $("#add-to-favorite-"+product_id).attr('data-type', 'add-favorite');
                                        $("#add-to-favorite-"+product_id).attr('title', 'Yêu thích');
                                        $("#add-to-favorite-"+product_id).attr('style', '');
                                    }
                                }
                            });
                        });
                    });
                });
                $( ".add-to-favorite" ).click(function() {
                    favorite_type = $(this).attr('data-type');
                    product_id = $(this).attr('data-id');
                    $.ajax({
                        url: "{{route('favorite_product')}}",
                        method: 'POST',
                        data: {_token: CSRF_TOKEN,
                            name: name,
                            product_id: product_id,
                            favorite_type: favorite_type,
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            if (favorite_type == 'add-favorite'){
                                swal("Thành công", "Yêu thích sản phẩm thành công", "success");
                                $("#add-to-favorite-"+product_id).attr('data-type', 'remove-favorite');
                                $("#add-to-favorite-"+product_id).attr('title', 'Bỏ yêu thích');
                                $("#add-to-favorite-"+product_id).attr('style', 'background-color: #e1f3c8; color: #82ae46;');
                            }
                            else{
                                swal("Thành công", "Bỏ yêu thích sản phẩm thành công", "success");
                                $("#add-to-favorite-"+product_id).attr('data-type', 'add-favorite');
                                $("#add-to-favorite-"+product_id).attr('title', 'Yêu thích');
                                $("#add-to-favorite-"+product_id).attr('style', '');
                            }
                        }
                    });


                });

            });
            function LoadData(product){
                var storage_url = 'storage/product/'+product.thumb;
                console.log(product.is_favorite);
                string=					'<div class="col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated">';
                string+=					'<div class="product">';
                string+=                '<a href="/san-pham/'+product.id+'" class="img-prod"><img class="img-fluid" style="height: 202px; width: 100%" src="'+storage_url+'" alt="Colorlib Template">'
                string+=                '<div class="overlay"></div>';
                string+=                '</a>';
                string+=                '<div class="text py-3 pb-4 px-3 text-center">';
                string+=                '<h3><a href="#">'+product.name+' '+product.unit+'</a></h3>';
                string+=                '<div class="d-flex">';
                string+=                '<div class="pricing">';
                string+=                '<p class="price"><span>'+product.price+ ' VNĐ </span></p>';
                string+='</div>';
                //start
                string+='<div class="bottom-area d-flex px-3">';
                string+='<div class="m-auto d-flex">';
                string+='<a class="add-to-cart d-flex justify-content-center align-items-center mx-1" title="Thêm giỏ hàng" >';
                string+='<span><i class="fas fa-cart-plus"></i></span>';
                string+='</a>';
                @if (isset($_SESSION['id']))
                    if(product.is_favorite == 0)
                    {
                        string+='<a class="heart add-to-favorite d-flex justify-content-center align-items-center" id="add-to-favorite-'+product.id+'" data-type="add-favorite" data-id="'+product.id+'" title="Yêu thích">';

                    }
                    else {
                        string += '<a class="heart add-to-favorite d-flex justify-content-center align-items-center" id="add-to-favorite-'+product.id+'" data-type="remove-favorite" data-id="'+product.id+'" title="Bỏ yêu thích" style="background-color: #e1f3c8; color: #82ae46;">';
                    }
                //
                string+='<span><i class="fas fa-heart"></i></span>';
                string+='</a>';
                @endif
                string+='</div>';
             string+='</div>';

                //end
                string+=									"	</div>";
                string+=									"	</div>";
                string+=									'<div class="bottom-area d-flex px-3">';
                string+=										'<div class="m-auto d-flex">';
                string+=									"	</div>";
                string+=									"	</div>";
                string+=									"	</div>";
                string+=									"	</div>";
                string+=									"	</div>";
                $('.list-product').append(string);
            }
            function LoadPage(PageNumber){
                var current_page = 1;
                var xhtml = "";
                xhtml += '<li class="page-item active"><a class="page-link product-page" data-page="1">1</a></li>';
                for(var i=2; i<=PageNumber; i++){
                    xhtml += '<li class="page-item "><a class="page-link product-page" data-page="'+i+'">'+i+'</a></li>';
                }
                // xhtml += '<li class="page-item"><a class="page-link next-page" href="#">Next</a></li>';
                $('.pagination').empty();
                $('.pagination').append(xhtml);
                $('.product-page').click(function(){
                    // $(".menu-href").removeClass( "active" );
                    $('.list-product').empty();
                    $(this).parents().addClass( "active" );
                    $(".product-page").not(this).parents().removeClass( "active" );
                    current_page = $(this).attr("data-page");
                    url ="/san-pham-api?menu_id="+menu_id+"&page="+current_page+"&query="+query;
                    $.getJSON(url, function(data) {
                        $.each(data.product, function( product_key, product ) {
                            LoadData(product);
                        });
                    });
                });
            }

    $(function() {
        $('#current_emails').text($('#example_email').val());
        $('#example_email').multiple_emails();
        $('#example_email').change( function(){
            $('#current_emails').text($(this).val());
        });
    });
    (function( $ ){

        $.fn.multiple_emails = function() {

            return this.each(function() {
                var $orig = $(this);
                $list = $('<ul class="multiple_emails-ul" />'); // create html elements - list of email addresses as unordered list

                if ($(this).val() != '') {
                    $.each(jQuery.parseJSON($(this).val()), function( index, val ) {
                        $list.append($('<li class="multiple_emails-email"><span class="email_name">' + val + '</span></li>')
                            .prepend($('<a href="#" class="multiple_emails-close" title="Remove"><span class="glyphicon glyphicon-remove"></span></a>')
                                .click(function(e) { $(this).parent().remove(); refresh_emails(); e.preventDefault(); })
                            )
                        );
                    });
                }

                var $input = $('<input type="text" class="multiple_emails-input text-left" />').keyup(function(event) { // input

                    $(this).removeClass('multiple_emails-error');
                    var input_length = $(this).val().length;

                    //if(event.which == 8 && input_length == 0) { $list.find('li').last().remove(); }
                    if(event.which == 13 || event.which == 188 ) { // key press is enter, space or comma

                        var val = $(this).val(); // remove space/comma from value

                        if (val !== "") {
                            $list.append($('<li class="multiple_emails-email"><span class="email_name">' + val + '</span></li>')
                                .prepend($('<a href="#" class="multiple_emails-close" title="Remove" style="font-weight: bold; color:palevioletred">x </a>')
                                    .click(function(e) { $(this).parent().remove(); refresh_emails(); e.preventDefault(); })
                                )
                            );
                            refresh_emails ();
                            $(this).val('');
                        }
                        else { $(this).val(val).addClass('multiple_emails-error'); }
                    }
                });

                var $container = $('<div class="multiple_emails-container" />').click(function() { $input.focus(); } ); // container div

                $container.append($list).append($input).insertAfter($(this)); // insert elements into DOM

                function refresh_emails () {
                    var emails = [];
                    $('.multiple_emails-email span.email_name').each(function() { emails.push($(this).html());	});
                    $orig.val(emails).trigger('change');
                }

                return $(this).hide();

            });

        };



    })(jQuery);

    </script>


		@stop

