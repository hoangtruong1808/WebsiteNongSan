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
                            <input type="text" name="key" id="search-query">
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
                    });
                });
                $('#search-btn').click(function(){
                    $(".menu-href").removeClass( "active" );
                    $('.list-product').empty();
                    query = $('#search-query').val();
                    menu_id = 0;
                    url = "/san-pham-api?query="+query;
                    $.getJSON(url, function(data) {
                        var string;
                        LoadPage(data.page_number);
                        $.each(data.product, function( product_key, product ) {
                            LoadData(product);
                        });
                    });
                });

            });
            function LoadData(product){
                var storage_url = 'storage/product/'+product.thumb;
                // console.log(product.id);
                string=					'<div class="col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated">';
                string+=					'<div class="product">';
                string+=                '<a href="/san-pham/'+product.id+'" class="img-prod"><img class="img-fluid" style="height: 202px; width: 100%" src="'+storage_url+'" alt="Colorlib Template">'
                string+=                '<div class="overlay"></div>';
                string+=                '</a>';
                string+=                '<div class="text py-3 pb-4 px-3 text-center">';
                string+=                '<h3><a href="#">'+product.name+'</a></h3>';
                string+=                '<div class="d-flex">';
                string+=                '<div class="pricing">';
                string+=                '<p class="price"><span>'+product.price+ ' vnđ /'+product.unit+'</span></p>';
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
        </script>
		@stop
