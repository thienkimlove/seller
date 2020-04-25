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
                    <a href="{{url('/')}}" title="Trang chủ">trang chủ</a> - <a href="{{url('khuyen-mai')}}" title="Sản phẩm">Khuyến mại</a> - <a href="javascript:void(0)" title="{{$mainCoupon->title}}">{{$mainCoupon->title}}</a>
                </div>
                <div class="detail-news">
                    <div class="title"><h3 class="rs">{{$mainCoupon->title}}</h3></div>
                    <div class="date">Ngày {{$mainCoupon->created_at->format('d/m/Y')}}</div>
                    <div class="content">
                       {!! $mainCoupon->content !!}
                        <div class="data-tags">
                            <span><strong>TAGS</strong></span>
                            @foreach ($mainCoupon->tags as $tag)
                               <a href="{{url('tu-khoa', $tag->slug)}}" title="{{$tag->title}}">{{$tag->title}}</a>
                            @endforeach
                        </div>
                        <div class="btn-group-like-share">
                            <div class="btn-like-share-fb">
                                <div class='fb-like' data-action='like' data-href='{{url('khuyen-mai', $mainCoupon->slug)}}' data-layout='button_count' data-share='true' data-show-faces='false' data-width='520'></div>

                            </div>
                            <div class="btn-like-gg">
                                <div class="g-plusone" data-size="standard" data-href="{{url('khuyen-mai', $mainCoupon->slug)}}"></div>
                            </div>
                        </div>
                    </div>
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
                <div class="fb-comments" data-href="{{url('khuyen-mai', $mainCoupon->slug)}}" data-width="100%" data-numposts="5" data-mobile="1"></div>
            </div>
        </div>
        @include('frontend.part.right_group')
    </div>
@endsection