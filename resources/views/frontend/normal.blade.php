@extends('frontend.template')

@section('content')
    <div class="body">
        <div class="fixCen">
            <div class="ads-top common-group6">
                @foreach (\App\Site::getFrontendBanners()->where('position_id', 5)->slice(0, 2) as $k => $banner)
                    <a href="{{$banner->link}}" class="ads-top{{$k+1}}">
                        <img src="{{url('files', $banner->image)}}" alt="" class="imgFull" width="539" height="153">
                    </a>
                @endforeach
            </div>
            <div class="common-group3">
                <div class="el el1">
                    <img src="{{url('frontend/images/icon-freegiaohang.png')}}" alt="" class="imgFull" width="233" height="60">
                </div>
                <div class="el el1">
                    <img src="{{url('frontend/images/icon-doihang.png')}}" alt="" class="imgFull" width="206" height="52">
                </div>
                <div class="el el1">
                    <img src="{{url('frontend/images/icon-hoantien.png')}}" alt="" class="imgFull" width="226" height="48">
                </div>
                <div class="el el1">
                    <img src="{{url('frontend/images/icon-thanhtoan.png')}}" alt="" class="imgFull" width="212" height="40">
                </div>
            </div>
            @yield('normal')
            @include('frontend.part.khuyen_mai')
            <div class="common-group3">
                <div class="el el1">
                    <img src="{{url('frontend/images/icon-freegiaohang.png')}}" alt="" class="imgFull" width="233" height="60">
                </div>
                <div class="el el1">
                    <img src="{{url('frontend/images/icon-doihang.png')}}" alt="" class="imgFull" width="206" height="52">
                </div>
                <div class="el el1">
                    <img src="{{url('frontend/images/icon-hoantien.png')}}" alt="" class="imgFull" width="226" height="48">
                </div>
                <div class="el el1">
                    <img src="{{url('frontend/images/icon-thanhtoan.png')}}" alt="" class="imgFull" width="212" height="40">
                </div>
            </div>
            @include('frontend.part.mach_nho')
        </div>
    </div>
@endsection
