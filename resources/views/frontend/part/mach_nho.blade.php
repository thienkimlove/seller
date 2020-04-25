<div class="common-group1">
    @if ($machIndexPosts = \App\Site::getMachNhoFrontend())
        <div class="block-1 content">
            <div class="captain">MÁCH NHỎ CHO BẠN</div>
            <div class="block-content block-ct-group1">
                @foreach ($machIndexPosts as $post)
                    <div class="post post-group1">
                        <a class="img-title" href="{{url($post->slug.'.html')}}" title="{{$post->title}}">
                            <img class="imgFull" src="{{url('img/cache/520x296', $post->image)}}" alt="Tin tức" width="520" height="296">
                        </a>
                        <div class="right">
                            <a href="{{url($post->slug.'.html')}}" class="title" title="{{$post->title}}">{{$post->title}}</a>
                            <div class="sumary">
                                {{$post->desc}}
                            </div>
                            <a href="{{url($post->slug.'.html')}}" class="view-more" title="Đọc tiếp">Đọc tiếp</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="block-2 content">
        <div class="captain">TẠI SAO CHỌN CHÚNG TÔI</div>
        <div class="block-content block-ct-group1">
            <div class="rea rea1">
                                <span class="icon">
                                    <img src="{{url('frontend/images/icon$.png')}}" alt="Đại lý chính hãng" width="42" height="47">
                                </span>
                <div class="concept">
                    <div class="text-above">ĐẠI LÝ CHÍNH HÃNG</div>
                    <div class="text-below">NÊN GIÁ RẺ BẤT NGỜ</div>
                </div>
            </div>
            <div class="rea rea2">
                                <span class="icon">
                                    <img src="{{url('frontend/images/icon-haha.png')}}" alt="Nhân viên chăm sóc khách hàng" width="52" height="38">
                                </span>
                <div class="concept">
                    <div class="text-above">NHÂN VIÊN CHĂM SÓC KHÁCH HÀNG</div>
                    <div class="text-below">NHIỆT TÌNH VÀ CHU ĐÁO</div>
                </div>
            </div>
            <div class="rea rea3">
                                <span class="icon">
                                    <img src="{{url('frontend/images/icon-chuot.png')}}" alt="Đặt hàng và mua hàng online" width="34" height="57">
                                </span>
                <div class="concept">
                    <div class="text-above">ĐẶT HÀNG & MUA HÀNG ONLINE</div>
                    <div class="text-below">ĐƯỢC GỌI VÀ NHẬN HÀNG SAU ÍT PHÚT</div>
                </div>
            </div>
            <div class="rea rea4">
                                <span class="icon">
                                    <img src="{{url('frontend/images/icon-gift.png')}}" alt="Tham gia các chương trình khuyến mại" width="45" height="39">
                                </span>
                <div class="concept">
                    <div class="text-above">THAM GIA CÁC CHƯƠNG TRÌNH</div>
                    <div class="text-below">KHUYẾN MẠI VÀ GIẢM GIÁ QUANH NĂM</div>
                </div>
            </div>
            <div class="rea rea5">
                                <span class="icon">
                                    <img src="{{url('frontend/images/icon-$2.png')}}" alt="Thanh toán tiện lợi" width="46" height="47">
                                </span>
                <div class="concept">
                    <div class="text-above">THANH TOÁN TIỆN LỢI</div>
                    <div class="text-below">THANH TOÁN AN TOÀN VÀ BẢO MẬT</div>
                </div>
            </div>
            <div class="rea rea6">
                                <span class="icon">
                                    <img src="{{url('frontend/images/icon-s.png')}}" alt="Dễ dàng tìm kiếm sản phẩm" width="46" height="46">
                                </span>
                <div class="concept">
                    <div class="text-above">DỄ DÀNG TÌM KIẾM SẢN PHẨM</div>
                    <div class="text-below">AN TOÀN VÀ BẢO MẬT</div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-3 content">
        <div class="captain">CỘNG ĐỒNG KHÁCH HÀNG</div>
        <div class="block-content block-ct-group1">
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftuelinh.vn%2F%3Ffref%3Dts&tabs=timeline&width=453&height=200&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="453" height="200" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </div>
    </div>
</div>