<div class="right-group">
    <div class="watched-products">
        <div class="captain">SẢN PHẨM ĐÃ XEM</div>
        <div class="products">
            @foreach (\App\Site::getViewedProductFrontend() as $product)
                @if ((isset($mainProduct) && $product->id != $mainProduct->id) || !isset($mainProduct))
                    <div class="pro">
                        <a href="{{url('san-pham', $product->slug)}}" class="title" title="{{$product->title}}">{{$product->title}}</a>
                        <img src="{{url('img/cache/261x210', $product->image)}}" alt="{{$product->title}}" width="261" height="210">
                        <div class="bottom-pro">
                            <div class="price">
                                @if ($product->old_price)
                                <span class="old-price">{{App\Site::priceFormat($product->old_price)}}</span>
                                @endif
                                <span class="new-price"><red>{{App\Site::priceFormat($product->price)}}</red></span>
                            </div>
                            <a href="{{url('order?product_id='.$product->id)}}" class="buy-btn" title="Mua ngay">
                                <span class="text">Mua ngay</span>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
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
</div>