<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>{{$meta_title}}</title>

    <meta property="og:title" content="{{$meta_title}}">
    <meta property="og:description" content="{{$meta_desc}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{$meta_url}}">
    <meta property="og:image" content="{{$meta_image}}">
    <meta property="og:site_name" content="Cà gai leo Tuệ Linh">
    <meta property="fb:app_id" content="188252524956805" />

    <meta name="twitter:card" content="Card">
    <meta name="twitter:url" content="{{$meta_url}}">
    <meta name="twitter:title" content="{{$meta_title}}">
    <meta name="twitter:description" content="{{$meta_desc}}">
    <meta name="twitter:image" content="{{$meta_image}}">


    <meta itemprop="name" content="{{$meta_title}}">
    <meta itemprop="description" content="{{$meta_desc}}">
    <meta itemprop="image" content="{{$meta_image}}">

    <meta name="ABSTRACT" content="{{$meta_desc}}"/>
    <meta http-equiv="REFRESH" content="1200"/>
    <meta name="REVISIT-AFTER" content="1 DAYS"/>
    <meta name="DESCRIPTION" content="{{$meta_desc}}"/>
    <meta name="KEYWORDS" content="{{$meta_keywords}}"/>
    <meta name="ROBOTS" content="index,follow"/>
    <meta name="AUTHOR" content="Cà gai leo Tuệ Linh"/>
    <meta name="RESOURCE-TYPE" content="DOCUMENT"/>
    <meta name="DISTRIBUTION" content="GLOBAL"/>
    <meta name="COPYRIGHT" content="Copyright 2013 by Goethe"/>
    <meta name="Googlebot" content="index,follow,archive" />
    <meta name="RATING" content="GENERAL"/>
    <link rel="stylesheet" href="{{url('frontend/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/common.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/'.$page_css.'.css')}}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
</head>
<body>
<div class="wrapper home pr">
    <div class="banner-ads left">
        @foreach (\App\Site::getFrontendBanners()->where('position_id', 1) as $banner)
            <a href="{{$banner->link}}" title="Tên quảng cáo">
                <img src="{{url('files', $banner->image)}}" alt="" width="171" height="454">
            </a>
        @endforeach
    </div>
    <div class="banner-ads right">
        @foreach (\App\Site::getFrontendBanners()->where('position_id', 2) as $banner)
            <a href="{{$banner->link}}" title="Tên quảng cáo">
                <img src="{{url('files', $banner->image)}}" alt="" width="171" height="454">
            </a>
        @endforeach
    </div>
    @include('frontend.header')
    @yield('content')
    <div class="bottom-groups">
        <div class="border-top"></div>
        <div class="fixCen">
            <div class="about-us content" id="about-us">
                <span>Về chúng tôi</span>
                <div class="links">
                    <a href="javascript:void(0)" title="Giới thiệu">Giới thiệu</a>
                    <a href="javascript:void(0)" title="Bản tin dược liệu">Bản tin dược liệu</a>
                    <a href="javascript:void(0)" title="Danh mục dược liệu">Danh mục dược liệu</a>
                    <a href="javascript:void(0)" title="Tra cứu theo bệnh">Tra cứu theo bệnh</a>
                    <a href="javascript:void(0)" title="Dược liệu online">Dược liệu online</a>
                    <a href="javascript:void(0)" title="Tư vấn">Tư vấn</a>
                    <a href="javascript:void(0)" title="Chăm sóc sức khỏe">Chăm sóc sức khỏe</a>
                    <a href="{{url('lien-he')}}" title="Liên hệ mua hàng">Liên hệ mua hàng</a>
                    <a href="{{url('video')}}" title="Video">Video</a>
                    <a href="{{url('san-pham')}}" title="Sản phẩm hot">Sản phẩm hot</a>
                </div>
            </div>
            <div class="medicines content" id="medicines">
                <span>Dược liệu</span>
                <div class="links">
                    @foreach (\App\Site::getFrontendMedicines() as $medicine)
                      <a href="{{url('san-pham?duoc-lieu='.$medicine->slug)}}" title="{{$medicine->title}}">{{$medicine->title}}</a>
                    @endforeach
                </div>
            </div>
            <div class="searchByDisease content" id="searchByDisease">
                <span>Tra cứu bệnh</span>
                <div class="links">
                    @foreach (\App\Site::getFrontendDiseases() as $disease)
                        <a href="{{url('san-pham?benh='.$disease->slug)}}" title="{{$disease->title}}">{{$disease->title}}</a>
                    @endforeach
                </div>
            </div>
            <div class="postNews content" id="postNews">
                <span>Đăng kí nhận tin khuyến mại</span>
                <div class="links">
                    {!! Form::open(array('url' => 'save_contact', 'id' => 'dk-news')) !!}
                        <div class="text">
                            Điền email vào form dưới đây để đăng kí nhận tin khuyến mại, mã giảm giá, sản phẩm mới của chúng tôi.
                        </div>
                        <input type="email" name="email" placeholder="Địa chỉ email của bạn" required>
                        <input type="hidden" name="title" value="Email để đăng kí nhận tin khuyến mại, mã giảm giá, sản phẩm mới" />
                        <input type="hidden" name="content" value="Email để đăng kí nhận tin khuyến mại, mã giảm giá, sản phẩm mới" />
                        <input type="hidden" name="status" value="1" />
                        <button id="dk-news-button" type="button">Đăng kí - Nhận tiện ích</button>
                    {!! Form::close() !!}
                    <div class="group-inters">
                        <a href="https://www.facebook.com/CaoduoclieuTueLinh" class="facebook" title="Facebook">
                            <img src="{{url('frontend/images/btn-fb.png')}}" alt="Facebook" width="38" height="38">
                        </a>
                        <a href="javascript:vodi(0)" class="tweeter" title="Tweeter">
                            <img src="{{url('frontend/images/btn-tweet.png')}}" alt="Tweeter" width="38" height="38">
                        </a>
                        <a href="https://www.youtube.com/channel/UClFEvhtA1HtbqjRylfYoLwg" class="youtube" title="Youtube">
                            <img src="{{url('frontend/images/btn-youtube.png')}}" alt="Youtube" width="38" height="38">
                        </a>
                        <a href="https://www.google.com/search?q=giải+độc+gan+tuệ+linh" class="gg" title="G+">
                            <img src="{{url('frontend/images/btn-g+.png')}}" alt="G+" width="39" height="38">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="fixCen">
            <div class="copyright">
                MỌI THÔNG TIN BẢN QUYỀN ĐỀU THUỘC VỀ CÔNG TY TNHH TUỆ LINH
            </div>
            <div class="company-add">
                Website đang trong quá trình hoàn thiện. Mọi đóng góp xin liên hệ: (04) 62824344 - Fax: 04.62824263            </div>
        </div>
    </footer>
    @include('frontend.part.popup')
</div>
</body>
<script src="{{url('frontend/js/jquery-1.11.1.min.js')}}" type="text/javascript"></script>
<script src="{{url('frontend/js/SmoothScroll.js')}}" type="text/javascript"></script>
<script src="{{url('frontend/js/owl.carousel.min.js')}}" type="text/javascript"></script>
<script src="{{url('frontend/js/jquery.easing.min.js')}}" type="text/javascript"></script>
<script src="{{url('frontend/js/common.js')}}" type="text/javascript"></script>
<script src="{{url('frontend/js/home.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=csrf_token]').attr('content') }
    });

    var baseUrl = '{{url('/')}}';

</script>
<script>
    $(document).ready(function(){
        $('#search_on_top_button').click(function(){
            $('#search_on_top').submit();
        });

        $('#dk-news-button').click(function(){
            $('#dk-news').submit();
        });

        $('#dat_hang').click(function(){
            $('#dk-news2').submit();
        });

        $('.hot-keys > select.rule-1').change(function(){
            $('form#search_on_top input[name=medicine]').val($(this).val());
        });
        $('.hot-keys > select.rule-2').change(function(){
            $('form#search_on_top input[name=disease]').val($(this).val());
        });
        $('.hot-keys > select.rule-3').change(function(){
            $('form#search_on_top input[name=delivery]').val($(this).val());
        });
        $('.hot-keys > select.select-4').change(function(){
            $('form#search_on_top input[name=coupon]').val($(this).val());
        });

        $('#select_page, #select_order').change(function(){
            $('#form_select_page_order').submit();
        });

        $('#previous_select_page').click(function(){
           var currentPage =  $('#select_page').val();
           if (currentPage > 1) {
               $('#select_page').val(currentPage - 1);
           }
        });

        $('#next_select_page').click(function(){
            var currentPage =  $('#select_page').val();
            $('#select_page').val(currentPage + 1);
        });

        $('#detail_buy').click(function(){
            window.location.href = baseUrl + '/order?quantity=' + $('#choose_quantity').val() + '&product_id=' + $('#product_id').val();
        });

        $('div.bill-content').on('click', 'a.delete', function(){
            var product_id = $(this).attr('attr-id');
            var coupon_code = $('#coupon_code').val();
            if (product_id) {
                $.post (baseUrl + '/ajax', { 'type' : 'delete_cart', 'product_id' : product_id, 'coupon_code' : coupon_code }, function(res){
                    $('#total_1').html(res.total + ' đ');
                    $('#total_2').html(res.total + ' đ');
                    $('#billing-content').html(res.html);
                });
            }
        });

        $('div.bill-content').on('click', 'button.cap-nhat', function(){
            var coupon_code = $('#coupon_code').val();
            var product_id = $(this).attr('attr-id');
            var quantity = $(this).prev().val();
            if (product_id && quantity) {
                $.post (baseUrl + '/ajax', { 'type' : 'update_cart', 'product_id' : product_id, 'quantity' : quantity, 'coupon_code' : coupon_code }, function(res){
                    $('#total_1').html(res.total + ' đ');
                    $('#total_2').html(res.total + ' đ');
                    $('#billing-content').html(res.html);
                });
            }
        });

        $('div.bill-content').on('click', 'button#refresh', function(){
           // window.location.reload();
            var data = [];
            $('div.bill-content button.cap-nhat').each(function(){
                var product_id = $(this).attr('attr-id');
                var quantity = $(this).prev().val();
                if (product_id && quantity) {
                    data.push({'product_id' : product_id, 'quantity' : quantity});
                }
            });

            if (data.length > 0) {
                var coupon_code = $('#coupon_code').val();
                $.post (baseUrl + '/ajax', { 'type' : 'update_all', 'data' : data, 'coupon_code' : coupon_code }, function(res){
                    $('#total_1').html(res.total + ' đ');
                    $('#total_2').html(res.total + ' đ');
                    $('#billing-content').html(res.html);
                });
            }
        });

        $('div.bill-content').on('click', 'button#continue_buy', function(){
            window.location.href = baseUrl + '/san-pham';
        });

        $('#reload_billing').click(function(e){
            e.preventDefault();
            var coupon_code = $('#coupon_code').val();
            if (coupon_code) {
                $.post (baseUrl + '/ajax', { 'type' : 'update_coupon', 'coupon_code' : coupon_code}, function(res){
                    $('#total_1').html(res.total + ' đ');
                    $('#total_2').html(res.total + ' đ');
                    $('#billing-content').html(res.html);
                });
            }
        });

        $('button.btn-hoantat').click(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: baseUrl + '/place_order',
                data: $('#place_order').serialize(),
                success: function(res) {
                    notify(res);
                }
            });
            return false;
        });

        $('#submit_contact').click(function(){
            $('#contact').submit();
        });

        $('#register_button').click(function(){
            $('#register_error').html('').hide();
            $.ajax({
                type: "POST",
                url: baseUrl + '/register',
                data: $('#register_form').serialize(),
                    success: function(res) {
                    if (res.msg) {
                        $('#register_error').html(res.msg).show();
                    } else {
                        window.location.href = baseUrl;
                    }
                }
            });
        });

        $('#login_button').click(function(e){
            e.preventDefault();
            $('#login_error').html('').hide();
            $.ajax({
                type: "POST",
                url: baseUrl + '/login',
                data: $('#login_form').serialize(),
                success: function(res) {
                    if (res.msg) {
                        $('#login_error').html(res.msg).show();
                    } else {
                        window.location.href = baseUrl;
                    }
                }
            });
        });

        $('#forgot_button').click(function(e){
            e.preventDefault();
            $('#forgot_error').html('').hide();
            $.ajax({
                type: "POST",
                url: baseUrl + '/forgot',
                data: $('#forgot_form').serialize(),
                success: function(res) {
                    if (res.msg) {
                        $('#forgot_error').html(res.msg).show();
                    } else {
                        window.location.href = baseUrl + '?forgot=3';
                    }
                }
            });
        });

    });
</script>
<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v4.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="331941750220018"
  logged_in_greeting="Chào bạn, bạn cần hỗ trợ mua sản phẩm hãy chat với chúng tôi."
  logged_out_greeting="Chào bạn, bạn cần hỗ trợ mua sản phẩm hãy chat với chúng tôi.">
      </div>
@yield('script')
</html>