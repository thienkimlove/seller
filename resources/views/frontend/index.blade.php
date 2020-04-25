@extends('frontend.template')

@section('content')
    <div class="body">
        <div class="fixCen">
           @include('frontend.top_search')
            <div class="group-ontop">
                <div class="common-group4">
                    <div class="captain">DANH MỤC DƯỢC LIỆU</div>
                    <ul class="fixCen pr rs menu-left" id="menu_left">
                        @foreach (\App\Site::getFrontendMedicines(10, true) as $medicine)
                            <li><a class="{{(!empty($currentMedicine->id) && $medicine->id == $currentMedicine->id) ? 'active rs' : 'rs'}}" href="{{url('san-pham?duoc-lieu='.$medicine->slug)}}" title="{{$medicine->title}}">{{$medicine->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="slide-top">
                    @foreach (\App\Site::getFrontendBanners()->where('position_id', 4) as $banner)
                        <a href="{{$banner->link}}" title="">
                            <img src="{{url('files', $banner->image)}}" alt="" class="imgFull" width="852" height="598">
                        </a>
                    @endforeach
                </div>

                <div class="sale right">
                    @foreach (\App\Site::getFrontendBanners()->where('position_id', 3)->slice(0, 2) as $k => $banner)
                        @if ($k == 0)
                            <img src="{{url('files', $banner->image)}}" alt="" class="imgFull sale1" width="421" height="233">
                        @else
                            <div class="sale2-bg">
                                <img src="{{url('files', $banner->image)}}" alt="" class="imgFull sale2" width="421" height="244">
                            </div>
                        @endif
                    @endforeach
                    @if ($gocIndexVideos)
                    <div class="video-conner">
                        <div class="captain">GÓC VIDEO</div>
                        <div class="content">
                            @foreach ($gocIndexVideos->slice(0, 1) as $video)
                                <iframe id="video_conner" width="560" height="315" src="{{$video->link}}" frameborder="0" allowfullscreen></iframe>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
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

            <div class="ads-group ads-group1">
                @foreach (\App\Site::getFrontendBanners()->where('position_id', 7) as $banner)
                    <div class="sp-lienquan">
                        <a href="{{$banner->link}}" title="">
                            <img src="{{url('files', $banner->image)}}" alt="Sản phâm 1" class="imgFull" width="580" height="276">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="common-group2 sp-banchay">
                <div class="tab tab-sm">
                    <div class="captain ct-sm"><h2 class="rs">SẢN PHẨM BÁN CHẠY</h2></div>
                    <a href="javascript:void(0)" class="show-all" title="Xem hết">Xem hết</a>
                </div>
                @if ($banchayIndexProducts)
                    <div class="content">
                        @foreach ($banchayIndexProducts as $product)
                           <div class="product">
                            <a href="{{url('san-pham', $product->slug)}}" class="img-title" title="Sản phẩm">
                                <img src="{{url('img/cache/326x215', $product->image)}}" alt="{{$product->title}}" class="" width="326" height="215">
                            </a>
                            <a href="{{url('san-pham', $product->slug)}}" class="title" title="{{$product->title}}">{{$product->title}}</a>
                            <div class="sumary">
                                {{$product->desc}}
                            </div>
                            @if ($product->old_price)
                            <span class="old-price">{{App\Site::priceFormat($product->old_price)}}</span>
                            @endif
                            <div class="bottom-pro">
                                <div class="current-price">
                                    <strong>{{App\Site::priceFormat($product->price)}}</strong>
                                    <div class="ratting"><span class="rating-value" style="width: 100%"></span></div>
                                </div>
                                <a href="{{url('san-pham', $product->slug)}}" class="buy-btn" title="Mua ngay">
                                    <span class="sl"></span>
                                    <span class="text">Mua ngay</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @include('frontend.part.khuyen_mai')
            @if ($moiIndexProducts)
            <div class="common-group2 sp-moi">
                <div class="tab tab-sm">
                    <div class="captain ct-sm"><h2 class="rs">SẢN PHẨM MỚI</h2></div>
                    <a href="javascript:void(0)" class="show-all" title="Xem hết">Xem hết</a>
                </div>
                <div class="content">
                    @foreach ($moiIndexProducts as $product)
                       <div class="product">
                        <span class="new-icon pa"><img src="{{url('frontend/images/new-icon.png')}}" alt="" class="imgFull" width="147" height="149"></span>
                           <a href="{{url('san-pham', $product->slug)}}" class="img-title" title="Sản phẩm">
                               <img src="{{url('img/cache/326x215', $product->image)}}" alt="{{$product->title}}" class="" width="326" height="215">
                           </a>
                           <a href="{{url('san-pham', $product->slug)}}" class="title" title="{{$product->title}}">{{$product->title}}</a>
                           <div class="sumary">
                               {{$product->desc}}
                           </div>
                           @if ($product->old_price)
                               <span class="old-price">{{App\Site::priceFormat($product->old_price)}}</span>
                           @endif
                           <div class="bottom-pro">
                               <div class="current-price">
                                   <strong>{{App\Site::priceFormat($product->price)}}</strong>
                                   <div class="ratting"><span class="rating-value" style="width: 100%"></span></div>
                               </div>
                               <a href="{{url('san-pham', $product->slug)}}" class="buy-btn" title="Mua ngay">
                                   <span class="sl"></span>
                                   <span class="text">Mua ngay</span>
                               </a>
                           </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="ads-group ads-group2">
                @foreach (\App\Site::getFrontendBanners()->where('position_id', 8) as $banner)
                    <div class="sp-lienquan">
                        <a href="{{$banner->link}}" title="">
                            <img src="{{url('files', $banner->image)}}" alt="Sản phâm 1" class="imgFull" width="580" height="276">
                        </a>
                    </div>
                @endforeach
            </div>

            @include('frontend.part.mach_nho')
        </div>
    </div>
@endsection

@section('script')
    @if (isset($forgot) && $forgot == 0)
       <script>
           $(document).ready(function(){
               forgot('Quá trình đặt lại mật khẩu thất bại!');
           });
       </script>
    @endif
    @if (isset($forgot) && $forgot == 1)
        <script>
            $(document).ready(function(){
                login('Quá trình đặt lại mật khẩu thành công!');
            });
        </script>
    @endif
    @if (isset($forgot) && $forgot == 3)
        <script>
            $(document).ready(function(){
                forgot('Xin kiểm tra email tài khoản để tiếp tục!');
            });
        </script>
    @endif
@endsection
