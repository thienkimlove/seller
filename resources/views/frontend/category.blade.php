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
                    <a href="{{url('/')}}" title="Trang chủ">trang chủ</a> - <a href="{{url($category->slug)}}" title="Chuyên mục">{{$category->title}}</a>
                </div>
                <div class="list-news">
                    @if ($hotPost)
                    <div class="hot-news">
                        <div class="post" id="post-hot-news">
                            <a href="{{url($hotPost->slug.'.html')}}" title="{{$hotPost->title}}" class="img-title">
                                <img src="{{url('img/cache/432x311', $hotPost->image)}}" alt="" width="432" height="311">
                            </a>
                            <div class="right">
                                <a href="{{url($hotPost->slug.'.html')}}" class="title" title="{{$hotPost->title}}">
                                    {{$hotPost->title}}
                                </a>
                                <div class="sumary">
                                    {{$hotPost->desc}}
                                </div>
                            </div>
                        </div>
                        <div class="border pa"></div>
                    </div>
                    @endif
                    <div class="news">
                        @foreach ($posts as $post)
                           <div class="post post-news">
                            <a href="{{url($post->slug.'.html')}}" title="{{$post->title}}" class="img-title">
                                <img src="{{url('img/cache/276x157', $post->image)}}" alt="" width="276" height="157">
                            </a>
                            <div class="right">
                                <a href="{{url($post->slug.'.html')}}" class="title" title="{{$post->title}}">
                                    {{$post->title}}
                                </a>
                                <div class="sumary">
                                   {{$post->desc}}
                                </div>
                                <a href="{{url($post->slug.'.html')}}" class="view-detail" title="Xem chi tiết">Xem chi tiết>></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                   @include('frontend.pagination', ['paginate' => $posts])
                </div>
            </div>
            <div class="btn-group-like-share">
                <div class="btn-like-share-fb">
                    <div class='fb-like' data-action='like' data-href='{{url($category->slug)}}' data-layout='button_count' data-share='true' data-show-faces='false' data-width='520'></div>

                </div>
                <div class="btn-like-gg">
                    <div class="g-plusone" data-size="standard" data-href="{{url($category->slug)}}"></div>
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
                <div class="fb-comments" data-href="{{url($category->slug)}}" data-width="100%" data-numposts="5" data-mobile="1"></div>
            </div>
        </div>
        @include('frontend.part.right_group')
    </div>
@endsection