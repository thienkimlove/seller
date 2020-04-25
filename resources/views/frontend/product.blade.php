@extends('frontend.normal')

@section('normal')

    <div class="body-middle">
        <div class="left-group1">
            <div class="common-group4">
                <div class="captain">DANH MỤC DƯỢC LIỆU</div>
                <ul class="fixCen pr rs menu-left" id="menu_left">
                    @foreach (\App\Site::getFrontendMedicines() as $medicine)
                        <li><a class="{{(!empty($currentMedicine->id) && $medicine->id == $currentMedicine->id) ? 'active rs' : 'rs'}}" href="{{url('san-pham?duoc-lieu='.$medicine->slug)}}" title="{{$medicine->title}}">{{$medicine->title}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="news-km-colunm">
                <div class="captain">
                    TIN KHUYẾN MẠI
                </div>
                <div class="content">
                    @foreach (\App\Site::getTinKhuyenmaiFrontend() as $coupon)
                      <div class="most-post">
                        <a href="{{url('khuyen-mai', $coupon->slug)}}" title="{{$coupon->title}}" class="img-title">
                            <img src="{{url('img/cache/119x99', $coupon->image)}}" alt="" width="119" height="99">
                        </a>
                        <a href="{{url('khuyen-mai', $coupon->slug)}}" class="title" title="{{$coupon->title}}">
                            {{$coupon->title}}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="hotline2 pr">
                <img src="{{url('frontend/images/banner-hotline.jpg')}}" alt="" width="290" height="242">
                <div class="group-call pa">
                    <strong><a href="tel:19006482" title="1900 6482">1900 6482</a></strong> <br>
                    <strong><a href="tel:0912571190" title="0912 571 190">0912 571 190</a></strong>
                </div>
            </div>
        </div>
        <div class="right-group1">
            @include('frontend.top_search', [
                'medicine' => isset($choose_medicine) ? $choose_medicine : null,
                'disease' => isset($choose_disease) ? $choose_disease : null,
                'delivery' => isset($choose_delivery) ? $choose_delivery : null,
                'coupon' => isset($choose_coupon) ? $choose_coupon : null,
                'q' => isset($choose_q) ? $choose_q : null,
             ])
            <div class="content">
                <div class="steps">
                    <div class="left">
                        <a href="{{url('/')}}" title="Trang chủ">trang chủ</a> - <a href="{{url('san-pham')}}" title="Sản phẩm">Sản phẩm
                            &nbsp;&nbsp;<slash>|</slash></a>&nbsp;&nbsp;
                        Tìm thấy <number>{{$products->count()}}</number> sản phẩm
                    </div>
                    <div class="right">
                        {!! Form::open(array('url' => 'san-pham', 'method' => 'GET', 'class' => 'form2', 'id' => 'form_select_page_order')) !!}

                            {!! Form::select('order', \App\Site::getProductOrders(), isset($order) ? $order : null, ['id' => 'select_order']) !!}

                            @if ($products->lastPage() > 1)
                            <div class="page">
                                <span id="previous_select_page">&larr;</span>
                                {!! Form::select('page', \App\Site::getPage($products), isset($page_number) ? $page_number : null, ['class' => 'select_page', 'id' => 'select_page']) !!}
                                <span id="next_select_page">&rarr;</span>
                            </div>
                             @endif
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="products">
                    @foreach ($products as $product)
                    <div class="pro">
                        <a href="{{url('san-pham', $product->slug)}}" class="img-title" title="{{$product->title}}">
                            <img src="{{url('img/cache/261x210', $product->image)}}" alt="" width="261" height="210">
                        </a>
                        <div class="center-pro">
                            <a href="{{url('san-pham', $product->slug)}}" class="title" title="{{$product->title}}">
                                {{$product->title}}
                            </a>
                            <span class="ham-luong"><green>{{$product->hamluong}}</green></span>
                            <div class="cong-dung">{{$product->congdung}}</div>
                            <span class="npp">Nhà phân phối: <green>Tuệ Linh</green></span>
                            <span>MT: {{$product->product_code}}</span>
                            <div class="ratting"><span class="rating-value" style="width: 100%"></span></div>
                            <a href="{{url('san-pham', $product->slug)}}" class="view-detail" title="Xem thông tin">Xem thông tin</a>
                        </div>
                        <div class="right-pro">
                            @if ($product->old_price)
                                <div class="row1"><strong>Giá niêm yết: </strong> <green2>{{App\Site::priceFormat($product->old_price)}}</green2></div>
                                <div class="row2"><strong>Giá mới: </strong> <green2>{{App\Site::priceFormat($product->price)}}</green2></div>
                            @else
                                <div class="row2"><strong>Giá : </strong> <green2>{{App\Site::priceFormat($product->price)}}</green2></div>
                            @endif
                            <a href="{{url('order?product_id='.$product->id)}}" class="buy-btn" title="Mua ngay">Mua ngay</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @include('frontend.pagination', ['paginate' => $products])

            </div>
        </div>
    </div>

@endsection