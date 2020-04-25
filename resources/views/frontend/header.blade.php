<header class="pr">
    <div class="bg-top">
        <a href="javascript:void(0)" class="miniMenu-btn pa open-top-nav" data-menu="#top-nav"><span></span></a>
        <a href="javascript:void(0)" class="miniMenu-btn pa open-main-nav" data-menu="#main-nav"></a>
    </div>
    <nav id="top-nav" class="menu-mb pr">
        <ul class="fixCen pr rs top-nav-child">
            @foreach (\App\Site::getFrontendMedicines() as $medicine)
                <li><a class="{{(!empty($currentMedicine->id) && $medicine->id == $currentMedicine->id) ? 'active rs' : 'rs'}}" href="{{url('san-pham?duoc-lieu='.$medicine->slug)}}" title="{{$medicine->title}}">{{$medicine->title}}</a></li>
            @endforeach
                @if (session()->has('frontend_login'))
                    <li><a href="javascript:void(0)">Welcome, {{session()->get('frontend_login')->username}}</a></li>
                    <li><a class="rs dk-btn" href="{{url('logout')}}" title="Đăng xuất">
                            <span class="text">Đăng xuất</span>
                        </a></li>

                @else


                    <li><a class="rs dn-btn" href="javascript:void(0)" title="Đăng nhập" onclick="login();">
                            <img src="{{url('frontend/images/icon-dn.png')}}" alt="Đăng nhập" width="42" height="43">
                            <span class="text">Đăng nhập</span>
                        </a></li>
                    <li><a class="rs dk-btn" href="javascript:void(0)" title="Đăng kí" onclick="register();">
                            <img src="{{url('frontend/images/icon-dk.png')}}" alt="Đăng kí" width="43" height="43">
                            <span class="text">Đăng kí</span>
                        </a></li>
                @endif
        </ul>
    </nav>
    <div class="fixCen">
        <div class="head-info" id="head-info">
            <h1 class="rs"><a class="rs logo" id="logo" href="{{url('/')}}" title="Dược liệu Tuệ Linh" target="_blank">
                    <img src="{{url('frontend/images/logo.png')}}" alt="Dược liệu Tuệ Linh" width="224" height="87" class="imgFull">
                </a></h1>
            <span class="hotline" id="hotline">
                    <a href="tel:19006639">
                        <img src="{{url('frontend/images/hotline.png')}}" alt="" width="215" height="84" class="imgFull">
                    </a>
                </span>
            <div class="cart" id="cart">
                     <span class="pro-total cart-child" onclick="toOrder('{{url('order')}}')">
                         <img src="{{url('frontend/images/icon-giohang.png')}}" alt="Giỏ hàng" width="39" height="40">
                         <span>Giỏ hàng ({{\App\Site::getCartFrontend()}})</span>
                     </span>
                <a class="payment-fee cart-child rs" href="javascript:void(0)" title="Cước thanh toán">
                    <img src="{{url('frontend/images/icon-car.png')}}" alt="Cước thanh toán" width="55" height="37">
                    <span>Cước vận chuyển</span>
                </a>
            </div>
        </div>
        <nav id="main-nav" class="menu-mb pr">
            <ul class="fixCen pr rs main-nav-child">
                <li><a href="{{url('/')}}" title="Trang chủ">
                        trang chủ
                        <img src="{{url('frontend/images/home-icon.png')}}" alt="Trang chủ" width="64" height="42">
                    </a></li>
                <li><a class="rs" href="http://www.duoclieutuelinh.vn/" title="Tra cứu cây thuốc" target="_blank">Tra cứu cây thuốc</a>
                </li>
                <li class="parentMenu"><a class="rs" href="{{url('phat-trien-duoc-lieu')}}" title="Phát triển dược liệu">Phát triển dược liệu</a>
                    <ul class="submenu">
                        <li><a class="rs" href="{{url('giong-duoc-lieu')}}" title="Trồng và nhân giống dược liệu">Trồng và nhân giống dược liệu</a></li>
                        <li><a class="rs" href="{{url('quy-trinh-trong-giong-duoc-lieu')}}" title="Quy trình trồng giống dược liệu">Quy trình trồng giống dược liệu</a></li>
                        <li><a class="rs" href="{{url('hop-tac-phat-trien-duoc-lieu')}}" title="Hợp tác phát triển dược liệu">Hợp tác phát triển dược liệu</a></li>
                    </ul>
                </li>
                <li class="parentMenu"><a class="{{(isset($page) && $page == 'product') ? 'rs active' : 'rs'}}" href="{{url('san-pham')}}" title="Sản phẩm">Sản phẩm</a>
                    <ul class="submenu">
                        <li><a class="rs" href="{{url('san-pham?sort=khuyen-mai')}}" title="Sản phẩm khuyến mại">Sản phẩm khuyến mại</a></li>
                        <li><a class="rs" href="{{url('san-pham')}}" title="Sản phẩm bán chạy">Sản phẩm bán chạy</a></li>
                        <li><a class="rs" href="{{url('san-pham')}}" title="Sản phẩm mới">Sản phẩm mới</a></li>
                        <li><a class="rs" href="{{url('san-pham')}}" title="Sản phẩm theo dược liệu">Sản phẩm theo dược liệu</a></li>
                        <li><a class="rs" href="{{url('san-pham')}}" title="Sản phẩm theo bệnh">Sản phẩm theo bệnh</a></li>
                    </ul>
                </li>
                <li><a class="{{(isset($page) && $page == 'coupon') ? 'rs active' : 'rs'}}" href="{{url('khuyen-mai')}}" title="Khuyến mại">Khuyến mại</a>
                <li class="parentMenu">
                    <a class="{{(isset($page) && $page == 'news') ? 'rs active' : 'rs'}}" href="{{url('tin-tuc')}}" title="Tin tức">Tin tức</a>
                    <ul class="submenu">
                        <li><a class="rs" href="{{url('tin-moi')}}" title="Tin mới">Tin mới</a></li>
                        <li><a class="rs" href="{{url('mach-nho-cho-ban')}}" title="Mách nhỏ cho bạn">Mách nhỏ cho bạn</a></li>
                    </ul>
                </li>
                </li>
                <li><a class="{{(isset($page) && $page == 'video') ? 'rs active' : 'rs'}}" href="{{url('video')}}" title="Video">Video</a></li>
                <li><a class="{{(isset($page) && $page == 'contact') ? 'rs active' : 'rs'}}" href="{{url('lien-he')}}" title="Liên hệ">Liên hệ</a></li>
            </ul>
        </nav>
    </div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91609816-1', 'auto');
  ga('send', 'pageview');

</script>
</header>