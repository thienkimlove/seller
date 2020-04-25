@extends('frontend.normal')

@section('normal')
    <div class="body-middle">
        <div class="left-group">
            <div class="content">
                <div class="steps">
                    <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a> -
                    @if ($choose_medicine && !$choose_disease)
                        <a href="{{url('san-pham?duoc-lieu='.$currentMedicine->slug)}}" title="{{$currentMedicine->title}}">{{$currentMedicine->title}}</a>
                    @else
                        <a href="{{url('san-pham?benh='.$currentDisease->slug)}}" title="{{$currentDisease->title}}">{{$currentDisease->title}}</a>
                    @endif
                </div>
                <div class="list-news">
                    <div class="products" id="sanpham">
                        @foreach ($products as $product)
                            <div class="product">
                                <a href="{{url('san-pham', $product->slug)}}" class="img-title" title="Sản phẩm">
                                    <img src="{{url('img/cache/326x215', $product->image)}}" alt="{{$product->title}}" class="" width="326" height="215">
                                </a>
                                <a href="{{url('san-pham', $product->slug)}}" class="title" title="{{$product->title}}">{{$product->title}}</a>
                                <div class="sumary">
                                    {{$product->desc}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @include('frontend.pagination', ['paginate' => $products])
                </div>
            </div>
            <div class="btn-group-like-share">
                <div class="btn-like-share-fb">
                    <div class='fb-like' data-action='like' data-href='{{Request::url()}}' data-layout='button_count' data-share='true' data-show-faces='false' data-width='520'></div>

                </div>
                <div class="btn-like-gg">
                    <div class="g-plusone" data-size="standard" data-href="{{Request::url()}}"></div>
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
                <div class="fb-comments" data-href="{{Request::url()}}" data-width="100%" data-numposts="5" data-mobile="1"></div>
            </div>
        </div>
        @include('frontend.part.right_group')
    </div>
@endsection