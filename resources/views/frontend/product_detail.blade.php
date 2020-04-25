@extends('frontend.normal')

@section('normal')
    @include('frontend.top_search', [
               'medicine' => isset($choose_medicine) ? $choose_medicine : null,
               'disease' => isset($choose_disease) ? $choose_disease : null,
               'delivery' => isset($choose_delivery) ? $choose_delivery : null,
               'coupon' => isset($choose_coupon) ? $choose_coupon : null,
               'q' => isset($choose_q) ? $choose_q : null,
            ])
    <div class="body-middle">
        <div class="left-group">
            <div class="content">
                <div class="steps">
                    <a href="{{url('/')}}" title="Trang chủ">trang chủ</a> - <a href="{{url('san-pham')}}" title="Sản phẩm">Sản phẩm</a> - {{$mainProduct->title}}
                </div>
                <div class="pro">
                    <div class="left-pro">
                        <img src="{{url('img/cache/326x215', $mainProduct->image)}}" alt="" width="326" height="215">
                        <a href="javascript:void(0)" class="share" title="{{$mainProduct->title}}">{{$mainProduct->title}}</a>
                        @if ($mainProduct->old_price)
                            <div class="row1"><strong>Giá niêm yết: </strong> <green2>{{App\Site::priceFormat($mainProduct->old_price)}}</green2></div>
                            <div class="row2"><strong>Giá mới: </strong> <red>{{App\Site::priceFormat($mainProduct->price)}}</red></div>
                        @else
                            <div class="row2"><strong>Giá : </strong> <red>{{App\Site::priceFormat($mainProduct->price)}}</red></div>
                        @endif
                        <div class="mua-ngay">
                            <select name="" id="choose_quantity" class="sl-sp">
                                <option value="0">Số lương</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                            <input  type="hidden" id="product_id" value="{{$mainProduct->id}}" />
                            <a href="javascript:void(0)" id="detail_buy" class="buy-btn" title="Mua ngay">Mua ngay</a>
                        </div>
                    </div>
                    <div class="right-pro">
                        <a href="javascript:void(0)" class="title" title="{{$mainProduct->title}}">
                            {{$mainProduct->title}}
                        </a>
                        <div class="rate">
                            <strong>Đánh giá </strong>
                            <div class="ratting"><span class="rating-value" style="width: 100%"></span></div>
                        </div>
                        <div class="cong-dung">{{$mainProduct->congdung}}</div>

                        <span class="ma-sp">Mã sản phẩm: <strong>{{$mainProduct->product_code}}</strong></span>
                        <span class="loai-sp">Loại sản phẩm: <strong>{{$mainProduct->medicine->title}}</strong></span>
                        <span class="nph-sp">Nhà phân phối: <strong>Tuệ Linh</strong></span>
                        @if (isset($mainProduct->delivery->title) && $mainProduct->delivery->title)
                        <span class="dang-bc">Dạng bào chế: <strong>{{$mainProduct->delivery->title}}</strong></span>
                        @endif
                        @if ($mainProduct->quycach)
                        <span class="quy-cach">Quy cách sản phẩm: <strong>{{$mainProduct->quycach}}</strong></span>
                        @endif
                        @if ($mainProduct->hamluong)
                        <span class="ham-luong">Hàn lượng: <strong>{{$mainProduct->hamluong}}</strong></span>
                        @endif

                    </div>
                    <div class="bottom-pro">
                        <div class="call-hotline">
                            <strong>Ngại đặt hàng? Gọi ngay hotline</strong>
                            <a href="tel:0912571190" title="Gọi hotline 0912 571 190">0912 571 190</a>
                        </div>
                        {!! Form::open(array('url' => 'save_contact', 'id' => 'dk-news2', 'class' => 'dat-hang')) !!}
                            <div class="text"><strong>Ngại gọi điện? Vui lòng nhập số điện thoại</strong></div>
                            <input type="tel" name="phone" placeholder="Số điện thoại">
                            <input type="hidden" name="title" value="Đặt hàng khi xem sảm phẩm" />
                            <input type="hidden" name="content" value="Đặt hàng khi xem sảm phẩm ID={{$mainProduct->id}} | Name={{$mainProduct->title}}" />
                            <input type="hidden" name="status" value="1" />
                            <input type="hidden" name="redirect_url" value="{{Request::fullUrl()}}" />
                            <button type="button" id="dat_hang">Gửi</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="des-pro">
                    <div class="tabs tab-pro">
                        <a href="javascript:void(0)" class="tab-1 active" data-content=".tab-1-content" title="Thông tin mô tả">Thông tin mô tả</a>
                        <a href="javascript:void(0)" class="tab-2" data-content=".tab-2-content" title="Thông tin mô tả">Thông tin mô tả</a>
                        <a href="javascript:void(0)" class="tab-3" data-content=".tab-3-content" title="Đánh giá sản phẩm">Đánh giả sản phẩm</a>
                    </div>
                    <div class="tab-content tab-1-content active">
                        {!! $mainProduct->content !!}
                        <div class="tags">
                            <label><h4>TAGS</h4></label>
                            @foreach ($mainProduct->tags as $tag)
                              <a href="{{url('san-pham?tag='.$tag->id)}}" title="{{$tag->title}}">{{$tag->title}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-content tab-2-content">
                        {!! $mainProduct->content1 !!}
                        <div class="tags">
                            <label><h4>TAGS</h4></label>
                            @foreach ($mainProduct->tags as $tag)
                                <a href="{{url('san-pham?tag='.$tag->id)}}" title="{{$tag->title}}">{{$tag->title}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-content tab-3-content">
                        {!! $mainProduct->content2 !!}
                        <div class="tags">
                            <label><h4>TAGS</h4></label>
                            @foreach ($mainProduct->tags as $tag)
                                <a href="{{url('san-pham?tag='.$tag->id)}}" title="{{$tag->title}}">{{$tag->title}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group-like-share">
                <div class="btn-like-share-fb">
                    <div class='fb-like' data-action='like' data-href='{{url('san-pham', $mainProduct->slug)}}' data-layout='button_count' data-share='true' data-show-faces='false' data-width='520'></div>

                </div>
                <div class="btn-like-gg">
                    <div class="g-plusone" data-size="standard" data-href="{{url('san-pham', $mainProduct->slug)}}"></div>
                </div>
            </div>
            <div class="ads-top common-group6">
                @foreach (\App\Site::getFrontendBanners()->where('position_id', 6)->slice(0, 2) as $k => $banner)
                <a href="{{$banner->link}}" class="ads-top{{$k+1}}">
                    <img src="{{url('files', $banner->image)}}" alt="" class="imgFull" width="539" height="153">
                </a>
                @endforeach
            </div>
            <div class="comment-bottom">
                <div class="fb-comments" data-href="{{url('san-pham', $mainProduct->slug)}}" data-width="100%" data-numposts="5" data-mobile="1"></div>
            </div>
        </div>
        @include('frontend.part.right_group')
    </div>
@endsection