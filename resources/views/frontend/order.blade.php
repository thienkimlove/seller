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
            <div class="video-conner">
                <div class="captain">GÓC VIDEO</div>
                <div class="content">
                    <iframe id="video_conner" width="560" height="500" src="https://www.youtube.com/embed/l9sqTDl9ULc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
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
                        <a href="{{url('/')}}" title="Trang chủ">trang chủ</a> - <a href="{{url('order')}}" title="Đặt hàng">đặt hàng</a>
                    </div>
                    <div class="right">
                        <form action="" class="form2">
                            <select name="" id="">
                                <option value="0">Sắp xếp theo</option>
                                <option value="1">Giá rẻ nhất</option>
                                <option value="1">Giá đắt nhất</option>
                                <option value="1">Mua nhiều nhất</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="booking-content">
                    <div class="bill-content" id="billing-content">
                        @include('frontend.part.billing', ['products' => $products])
                    </div>
                    <div class="group-hotline">
                        <div class="call-hotline">
                            <strong>Ngại đặt hàng? Gọi ngay hotline</strong>
                            <a href="tel:0912571190" title="Gọi hotline 0912 571 190">0912 571 190</a>
                        </div>
                        {!! Form::open(array('url' => 'save_contact', 'id' => 'dk-news2', 'class' => 'dat-hang')) !!}
                        <div class="text"><strong>Ngại gọi điện? Vui lòng nhập số điện thoại</strong></div>
                        <input type="tel" name="phone" placeholder="Số điện thoại">
                        <input type="hidden" name="title" value="Đặt hàng khi xem sảm phẩm" />
                        @if ($products->count() > 0)
                        <input type="hidden" name="content" value="Đặt hàng khi xem sảm phẩm : ID={{$products->first()->id}} - Name:{{$products->first()->title}}" />
                        @else
                            <input type="hidden" name="content" value="Đặt hàng khi xem sảm phẩm " />
                        @endif
                        <input type="hidden" name="status" value="1" />
                        <input type="hidden" name="redirect_url" value="{{Request::fullUrl()}}" />
                        <button type="button" id="dat_hang">Gửi</button>
                        {!! Form::close() !!}
                    </div>
                    <span class="text">Bạn muốn đặt hàng ngay mà không cần đăng kí, vui lòng điền thông tin dưới đây: </span>
                    <div class="not-regis">
                        <div class="form-regis">
                            <div class="info">
                                <div class="captain">
                                    <number>1</number>
                                    <strong>Thông tin đặt hàng</strong>
                                </div>
                                {!! Form::open(array('url' => 'place_order', 'id' => 'place_order')) !!}
                                    <span>Họ và tên (Phân biệt bằng khoảng trắng)</span> <br>
                                    <input type="text" name="delivery_name" value="" placeholder="Nhập họ và tên" required> <br>
                                    <span>Điện thoại</span> <br>
                                    <input type="tel" name="delivery_phone" value="{{session()->has('frontend_login') ? session()->get('frontend_login')->phone : ''}}" placeholder="Điện thoại" required> <br>
                                    <span>Địa chỉ email</span> <br>
                                    <input type="email" name="delivery_email" value="{{session()->has('frontend_login') ? session()->get('frontend_login')->email : ''}}" placeholder="Địa chỉ email" required>
                                    <span>Địa chỉ giao hàng</span> <br>
                                    <input type="text" name="delivery_address" value="{{session()->has('frontend_login') ? session()->get('frontend_login')->address : ''}}" placeholder="Địa chỉ giao hàng" required>
                                    <div class="row-bt">
                                        <span>Bạn có 1 mã giảm giá?</span>
                                        <input type="text" id="coupon_code" name="coupon_code" placeholder="Mã giảm giá">
                                        <button id="reload_billing">Cập nhật</button>
                                    </div>
                                    <span>Ghi chú</span> <br>
                                    <textarea name="note" cols="30" rows="4"></textarea>
                                {!! Form::close() !!}
                                <img src="{{url('frontend/images/img1.jpg')}}" alt="" width="465" height="123" class="img-bt">
                            </div>
                        </div>
                        <div class="info-bill">
                            <div class="captain">
                                <number>2</number>
                                <strong>Thông tin đơn hàng</strong>
                            </div>
                            <div class="content">
                                <div>
                                    <strong>Tổng tiền</strong> <red id="total_1">{{App\Site::priceFormat($total)}}</red>
                                </div>
                                <div><strong>Phí vận chuyển</strong> <red>Miễn phí với đơn nội thành trên 300k và đơn 500k đối với các tỉnh</red></div>
                                <div><strong>Thành tiền</strong> <red id="total_2">{{App\Site::priceFormat($total)}}</red></div>
                                <button type="button" class="btn-hoantat">
                                    <img src="{{url('frontend/images/btn-hoantat.jpg')}}" alt="" class="imgFull">
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection