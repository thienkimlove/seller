@if ($khuyenmaiIndexProducts = \App\Site::getKhuyenMaiFrontend())
    <div class="common-group2 sp-km">
        <div class="tab tab-sm">
            <div class="captain ct-sm"><h2 class="rs">SẢN PHẨM KHUYẾN MẠI</h2></div>
            <a href="javascript:void(0)" class="show-all" title="Xem hết">Xem hết</a>
        </div>
        <div class="content">
            @foreach ($khuyenmaiIndexProducts as $product)
                <div class="product">
                        <span class="sale-icon pa">
                            <img src="{{url('frontend/images/icon-off.png')}}" alt="" width="100" height="100" class="imgFull">
                        </span>
                    <a href="{{url('san-pham', $product->slug)}}" class="img-title" title="Sản phẩm">
                        <img src="{{url('img/cache/326x215', $product->image)}}" alt="{{$product->title}}" class="" width="326" height="215">
                    </a>
                    <a href="{{url('san-pham', $product->slug)}}" class="title" title="{{$product->title}}">{{$product->title}}</a>
                    <div class="sumary">
                        {{$product->desc}}
                    </div>
                    @if ($product->old_price)
                        <span class="old-price">{{App\Site::priceFormat($product->old_price)}}</span>
                    @endif
                    <div class="bottom-pro">
                        <div class="current-price">
                            <strong>{{App\Site::priceFormat($product->price)}}</strong>
                            <div class="ratting"><span class="rating-value" style="width: 100%"></span></div>
                        </div>
                        <a href="{{url('san-pham', $product->slug)}}" class="buy-btn" title="Mua ngay">
                            <span class="sl"></span>
                            <span class="text">Mua ngay</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif