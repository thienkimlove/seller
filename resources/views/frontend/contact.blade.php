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
                    <a href="{{url('/')}}" title="Trang chủ">trang chủ</a> - <a href="{{url('lien-he')}}" title="Liên hệ">Liên hệ</a>
                </div>
                <div class="content">
                  {!! Form::open(array('url' => 'save_contact', 'id' => 'contact')) !!}
                        <div class="form-row">
                            <label for="name">Họ và tên</label>
                            <input type="text" name="name" placeholder="Nhập họ và tên" required>
                        </div>
                        <div class="form-row">
                            <label for="phone">Điện thoại</label>
                            <input type="tel" name="phone" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-row">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Nhập email" required>
                        </div>
                        <div class="form-row">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" placeholder="Nhập tiêu đề" required>
                        </div>
                        <div class="form-row">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="" cols="30" rows="10" placeholder="Nhập nội dung"></textarea>
                        </div>
                        {{--<div class="errors">A có thể show lỗi ở đây, nếu không thì xóa dòng này đi :))</div>--}}
                        <div class="contain-btn form-row">
                            <button id="submit_contact" type="button">Gửi</button>
                            <button type="reset">Nhập lại</button>
                        </div>
                   {!! Form::close() !!}
                    <div class="address-group">
                        Địa chỉ liên hệ <br>
                        <strong>Tại Hà Nội</strong><br>
                        Tầng 5, tòa nhà 29T1, phố Hoàng Đạo Thúy, Trung Hòa, Cầu Giấy, Hà Nội. <br>
                        Điện thoại: (04) 62824263 <br>
                        Fax: 0426824263 <br> <br>
                        <strong>Chi nhánh Hồ Chí Mình</strong> <br>
                        156/17 Tô Hiến Thành - P15 - Quận 10, TP.HCM <br>
                        Điện thoại: (083) 9797779 <br>
                        Fax: 0862648632 <br>
                        Đường dây nóng: 0912571190
                    </div>
                    <div class="embed-ggmap">
                        <img src="{{url('frontend/images/gg-map.jpg')}}" alt="" class="imgFull" width="728" height="425">
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
        </div>
        @include('frontend.part.right_group')
    </div>
@endsection