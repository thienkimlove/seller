@extends('frontend.normal')

@section('normal')
    <div class="body-middle">
        <div class="left-group">
            <div class="content">
                <div class="steps">
                    <a href="{{url('/')}}" title="Trang chủ">trang chủ</a> - <a href="{{url('video')}}" title="Video">Video</a>
                </div>
                <div class="video-content">
                    @if ($mainVideo)
                    <div class="video" id="bigVideo">
                        <iframe src="{{$mainVideo->link}}" frameborder="0" allowfullscreen width="" height=""></iframe>
                    </div>
                    @endif
                    <div class="thumb-video">
                        @foreach ($videos as $video)
                           <a href="{{url('video', $video->slug)}}" title="Trailer" data-src="{{$video->link}}">
                            <img src="{{url('img/cache/324x183', $video->image)}}" alt="" width="324" height="183" class="imgFull">
                            <span class="title">{{$video->title}}</span>
                            <span class="view-count">
                                 Lượt xem {{$video->views}}
                             </span>
                        </a>
                        @endforeach
                    </div>

                    @include('frontend.pagination', ['paginate' => $videos])
                </div>
            </div>
        </div>
        @include('frontend.part.right_group')
    </div>
@endsection