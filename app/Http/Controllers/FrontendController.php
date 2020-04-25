<?php

namespace App\Http\Controllers;

use App\Account;
use App\Category;
use App\Code;
use App\Contact;
use App\Coupon;
use App\Disease;
use App\Medicine;
use App\Module;
use App\Notification;
use App\Order;
use App\Post;
use App\Product;
use App\Tag;
use App\Token;
use App\Video;
use Illuminate\Http\Request;
use Mail;
use Validator;

class FrontendController extends Controller
{

    protected function generateMeta($case = null, $meta = [], $mainContent = null)
    {
        $defaultLogo = url(env('LOGO_URL'));
        switch ($case) {
            default :
                return [
                    'meta_title' => env('META_INDEX_TITLE'),
                    'meta_desc' => env('META_INDEX_DESC'),
                    'meta_keywords' => env('META_INDEX_KEYWORD'),
                    'meta_url' => url('/'),
                    'meta_image' => $defaultLogo
                ];
                break;

            case 'lien-he' :
                return [
                    'meta_title' => env('META_CONTACT_TITLE'),
                    'meta_desc' => env('META_CONTACT_DESC'),
                    'meta_keywords' => env('META_CONTACT_KEYWORD'),
                    'meta_url' => url('lien-he'),
                    'meta_image' => $defaultLogo
                ];
                break;
            case 'video' :

                return [
                    'meta_title' => !empty($meta['title']) ? $meta['title'] : env('META_VIDEO_TITLE'),
                    'meta_desc' => !empty($meta['desc']) ? $meta['desc'] : env('META_VIDEO_DESC'),
                    'meta_keywords' => !empty($meta['keywords']) ? $meta['keywords'] : env('META_VIDEO_KEYWORD'),
                    'meta_url' => ($mainContent) ? url('video/' . $mainContent->slug) : url('video'),
                    'meta_image' => ($mainContent) ? url('img/cache/120x120/' . $mainContent->image) : $defaultLogo
                ];

                break;

            case 'product' :

                return [
                    'meta_title' => !empty($meta['title']) ? $meta['title'] : env('META_PRODUCT_TITLE'),
                    'meta_desc' => !empty($meta['desc']) ? $meta['desc'] : env('META_PRODUCT_DESC'),
                    'meta_keywords' => !empty($meta['keywords']) ? $meta['keywords'] : env('META_PRODUCT_KEYWORD'),
                    'meta_url' => ($mainContent) ? url('product/' . $mainContent->slug) : url('product'),
                    'meta_image' => ($mainContent) ? url('img/cache/120x120/' . $mainContent->image) : $defaultLogo
                ];

            case 'order' :

                return [
                    'meta_title' => !empty($meta['title']) ? $meta['title'] : env('META_ORDER_TITLE'),
                    'meta_desc' => !empty($meta['desc']) ? $meta['desc'] : env('META_ORDER_DESC'),
                    'meta_keywords' => !empty($meta['keywords']) ? $meta['keywords'] : env('META_ORDER_KEYWORD'),
                    'meta_url' => ($mainContent) ? url('order/' . $mainContent->slug) : url('order'),
                    'meta_image' => ($mainContent) ? url('img/cache/120x120/' . $mainContent->image) : $defaultLogo
                ];

            case 'coupon' :

                return [
                    'meta_title' => !empty($meta['title']) ? $meta['title'] : env('META_COUPON_TITLE'),
                    'meta_desc' => !empty($meta['desc']) ? $meta['desc'] : env('META_COUPON_DESC'),
                    'meta_keywords' => !empty($meta['keywords']) ? $meta['keywords'] : env('META_COUPON_KEYWORD'),
                    'meta_url' => ($mainContent) ? url('coupon/' . $mainContent->slug) : url('coupon'),
                    'meta_image' => ($mainContent) ? url('img/cache/120x120/' . $mainContent->image) : $defaultLogo
                ];

            case 'post' :
                return [
                    'meta_title' => $meta['title'],
                    'meta_desc' => $meta['desc'],
                    'meta_keywords' => $meta['keywords'],
                    'meta_url' => url($mainContent->slug . '.html'),
                    'meta_image' => url('img/cache/120x120/' . $mainContent->image)
                ];
                break;
            case 'category' :
                return [
                    'meta_title' => $meta['title'],
                    'meta_desc' => $meta['desc'],
                    'meta_keywords' => $meta['keywords'],
                    'meta_url' => url($mainContent->slug),
                    'meta_image' => $defaultLogo
                ];
                break;

            case 'tag' :
                return [
                    'meta_title' => $meta['title'],
                    'meta_desc' => $meta['desc'],
                    'meta_keywords' => $meta['keywords'],
                    'meta_url' => url('tu-khoa', $mainContent->slug),
                    'meta_image' => $defaultLogo
                ];
                break;

        }

    }

    public function index()
    {
        $page = 'index';
        $page_css = 'home';

        $forgot = null;

        if (request()->input('forgot')) {
            $forgot = request()->input('forgot');
        }


        $gocModules = Module::where('key_type', 'goc_index')->where('key_content', 'videos')->pluck('key_value')->all();
        $gocIndexVideos = null;

        if ($gocModules) {
            $gocIndexVideos = Video::where('status', true)->whereIn('id', $gocModules)->get();
        }


        $banchayIndexProducts = null;

        $banchayIndexProductModules = Module::where('key_type', 'banchay_index')->where('key_content', 'products')->pluck('key_value')->all();

        if ($banchayIndexProductModules) {
            $banchayIndexProducts = Product::where('status', true)->whereIn('id', $banchayIndexProductModules)->get();
        }


        $moiIndexProducts = null;

        $moiIndexProductModules = Module::where('key_type', 'moi_index')->where('key_content', 'products')->pluck('key_value')->all();

        if ($moiIndexProductModules) {
            $moiIndexProducts = Product::where('status', true)->whereIn('id', $moiIndexProductModules)->get();
        }

        return view('frontend.index', compact(
            'page',
            'page_css',
            'gocIndexVideos',
            'banchayIndexProducts',
            'moiIndexProducts',
            'forgot'
        ))->with($this->generateMeta());
    }

    public function coupon($value = null)
    {
        if ($value) {
            $page = 'coupon';
            $page_css = 'chitiettintuc';

            $mainCoupon = Coupon::findBySlug($value);
            $mainCoupon->update(['views' => (int)$mainCoupon->views + 1]);

            return view('frontend.coupon', compact('mainCoupon', 'page', 'page_css'))->with($this->generateMeta('coupon', [
                'title' => ($mainCoupon->seo_title) ? $mainCoupon->seo_title : $mainCoupon->title,
                'desc' => $mainCoupon->desc,
                'keyword' => ($mainCoupon->tagList) ? implode(',', $mainCoupon->tagList) : null,
            ], $mainCoupon));

        } else {
            $page = 'coupon';
            $page_css = 'sanpham';
            $coupons = Coupon::where('status', true)->latest('created_at')->paginate(10);
            return view('frontend.coupon_list', compact('page', 'page_css', 'coupons'))->with($this->generateMeta('coupon'));
        }
    }

    public function video($value = null)
    {
        $page = 'video';
        $page_css = 'video';
        $mainVideo = null;
        $meta_title = $meta_desc = $meta_keywords = null;
        $videos = Video::paginate(6);

        if ($videos->count() > 0) {
            $mainVideo = $videos->first();
        }

        if ($value) {
            $mainVideo = Video::where('slug', $value)->first();
            $meta_title = ($mainVideo->seo_title) ? $mainVideo->seo_title : $mainVideo->title;
            $meta_desc = $mainVideo->desc;
            $meta_keywords = $mainVideo->keywords;
            $mainVideo->update(['views' => (int)$mainVideo->views + 1]);
        }


        return view('frontend.video', compact('videos', 'mainVideo', 'page_css', 'page'))->with($this->generateMeta('video', [
            'title' => $meta_title,
            'desc' => $meta_desc,
            'keywords' => $meta_keywords,
        ], $mainVideo));

    }

    public function tag($value)
    {
        $page = 'tags';
        $page_css = 'sanpham';

        $tag = Tag::findBySlug($value);

        if ($tag) {
            $posts = Post::where('status', true)->whereHas('tags', function ($q) use ($tag) {
                $q->where('id', $tag->id);
            })->latest('created_at')->paginate(10);

            $meta_title = ($tag->seo_title) ? $tag->seo_title : $tag->title;
            $meta_desc = $tag->desc;
            $meta_keywords = $tag->keywords;

            return view('frontend.tag', compact('posts', 'tag', 'page', 'page_css'))->with
            ($this->generateMeta('tag', [
                'title' => $meta_title,
                'desc' => $meta_desc,
                'keywords' => $meta_keywords,
            ], $tag));
        }
    }


    public function main($value)
    {

        if (preg_match('/([a-z0-9\-]+)\.html/', $value, $matches)) {

            $page = 'news';
            $page_css = 'chitiettintuc';

            $mainPost = Post::findBySlug($matches[1]);
            $mainPost->update(['views' => (int)$mainPost->views + 1]);

            return view('frontend.post', compact('mainPost', 'page', 'page_css'))->with($this->generateMeta('post', [
                'title' => ($mainPost->seo_title) ? $mainPost->seo_title : $mainPost->title,
                'desc' => $mainPost->desc,
                'keywords' => ($mainPost->tagList) ? implode(',', $mainPost->tagList) : null,
            ], $mainPost));

        } else {

            //category
            $page = 'news';
            $page_css = 'sanpham';
            $hotPost = null;
            $category = Category::findBySlug($value);
            if ($category) {
                $hotPostModules = Module::where('key_type', 'hot_in_category')->where('key_content', 'posts')->pluck('key_value')->all();
                $hotPost = Post::where('status', true)->whereIn('id', $hotPostModules);
                if ($category->subCategories->count() == 0) {
                    $hotPost = $hotPost->where('category_id', $category->id);
                } else {
                    $hotPost = $hotPost->whereIn('category_id', $category->subCategories->pluck('id')->all());
                }

                $hotPost = $hotPost->latest('created_at')->limit(1)->get();

                if ($hotPost) {
                    $hotPost = $hotPost->first();
                }

                $posts = ($category->subCategories->count() == 0) ? Post::where('status', true)->where('category_id', $category->id) : Post::where('status', true)->whereIn('category_id', $category->subCategories->pluck('id')->all());

                if ($hotPost) {
                    $posts = $posts->where('id', '<>', $hotPost->id);
                }
                $posts = $posts->latest('created_at')->paginate(10);

                return view('frontend.category', compact('page', 'page_css', 'category', 'hotPost', 'posts'))->with($this->generateMeta('category', [
                    'title' => ($category->seo_name) ? $category->seo_name : $category->name,
                    'desc' => ($category->desc) ? $category->desc : null,
                    'keywords' => ($category->keywords) ? $category->keywords : null,
                ], $category));
            }
        }
    }

    public function contact()
    {
        $page = 'contact';
        $page_css = 'lienhe';

        return view('frontend.contact', compact('page', 'page_css'))->with($this->generateMeta('lien-he'));
    }

    public function saveContact(Request $request)
    {
        $data = $request->all();
        $contact = Contact::create($data);
        Notification::create([
            'type' => 'contacts',
            'notify_id' => $contact->id
        ]);
        if (isset($data['redirect_url'])) {
            return redirect($data['redirect_url']);
        }
        return redirect(url('/'));
    }

    public function product($value = null)
    {
        $data = request()->all();
        $page = 'product';
        $page_css = ($value) ? 'chitietchuyenmuc' : 'chuyenmuc';

        if ($value) {
            $mainProduct = Product::findBySlug($value);

            if ($mainProduct) {
                $meta = [
                    'title' => $mainProduct->title,
                    'desc' => $mainProduct->desc,
                    'keywords' => $mainProduct->keywords
                ];

                $productViewedIds = [];

                if (session()->has('product_viewed')) {
                    $productViewedIds = session()->get('product_viewed');
                }

                if (!in_array($mainProduct->id, $productViewedIds)) {
                    array_push($productViewedIds, $mainProduct->id);
                }

                session()->put('product_viewed', $productViewedIds);

                return view('frontend.product_detail', compact('page', 'page_css', 'mainProduct'))
                    ->with($this->generateMeta('product', $meta, $mainProduct));

            } else {
                return redirect('/');
            }
        } else {
            $page_number = isset($page) ? $page : 1;

            $choose_medicine = null;
            $choose_disease = null;
            $choose_delivery = null;
            $choose_coupon = null;
            $choose_q = null;
            $order = null;

            $currentMedicine = null;
            $currentDisease = null;

            $products = Product::where('status', true);

            if (isset($data['duoc-lieu']) && $data['duoc-lieu']) {
                $currentMedicine = Medicine::findBySlug($data['duoc-lieu']);
                $choose_medicine = $data['duoc-lieu'];
                $products = $products->where('medicine_id', $currentMedicine->id);
            }

            if (isset($data['benh']) && $data['benh']) {
                $currentDisease = Disease::findBySlug($data['benh']);
                $choose_disease = $data['benh'];
                $products = $products->where('disease_id', $currentDisease->id);
            }

            if (isset($data['delivery']) && $data['delivery']) {
                $choose_delivery = $data['delivery'];
                $products = $products->where('delivery_id', $data['delivery']);
            }

            if (isset($data['coupon']) && $data['coupon']) {
                $choose_coupon = $data['coupon'];
                $couponProductIds = Coupon::find($data['coupon'])->products->pluck('id')->all();
                $products = $products->whereIn('id', $couponProductIds);
            }

            if (isset($data['q']) && $data['q']) {
                $choose_q = $data['q'];
                $products = $products->where('title', 'like', '%' . urldecode($choose_q) . '%');
            }

            if (isset($data['order']) && $data['order']) {
                $order = $data['order'];
                if ($order == 'cheap') {
                    $products = $products->orderBy('price', 'asc');
                } else if ($order == 'expensive') {
                    $products = $products->orderBy('price', 'desc');
                } else if ($order == 'buy') {
                    $products = $products->withCount('orders')->orderBy('orders_count', 'desc');
                }
            }

            if (isset($data['sort']) && $data['sort']) {
                if ($data['sort'] == 'khuyen-mai') {
                    $products = $products->whereHas('coupons');
                }
            }

            $view = 'product';
            if (($choose_medicine && !$choose_disease) || (!$choose_medicine && $choose_disease)) {
                $page_css = 'sanphamtheoduoclieu';
                $view = 'list';
            }


            $products = $products->paginate(10);

            return view('frontend.' . $view, compact(
                'products',
                'page',
                'page_css',
                'page_number',
                'choose_medicine',
                'choose_disease',
                'choose_delivery',
                'choose_coupon',
                'choose_q',
                'order',
                'currentMedicine',
                'currentDisease'
            ))->with($this->generateMeta('product'));
        }
    }

    public function order()
    {
        $data = request()->all();
        $productId = null;

        $page = 'product';
        $page_css = 'dathang';

        $cart = (session()->has('cart')) ? session()->get('cart') : [];

        if (isset($data['product_id']) && $data['product_id']) {
            $productId = $data['product_id'];
            $product = Product::find($productId);
            if ($product) {
                //update to cart.
                if (isset($cart[$productId])) {
                    if (isset($data['quantity']) && $data['quantity']) {
                        $cart[$productId] = intval($data['quantity']);
                    }
                } else {
                    $cart[$productId] = (isset($data['quantity']) && $data['quantity']) ? intval($data['quantity']) : 1;
                }
            }
        }
        session()->put('cart', $cart);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $total = 0;

        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        return view('frontend.order', compact('page', 'page_css', 'products', 'cart', 'total'))->with($this->generateMeta('order'));
    }

    public function ajax()
    {
        $data = request()->all();

        $product_id = (isset($data['product_id']) && $data['product_id']) ? $data['product_id'] : null;
        $cart = (session()->has('cart')) ? session()->get('cart') : [];

        if ($data['type'] == 'delete_cart' && $product_id) {
            if (isset($cart[$product_id])) {
                unset($cart[$product_id]);
            }
        }

        if ($data['type'] == 'update_cart' && $product_id && isset($data['quantity'])) {
            $cart[$product_id] = intval($data['quantity']);
        }

        if ($data['type'] == 'update_all' && isset($data['data'])) {
            foreach ($data['data'] as $item) {
                $cart[$item['product_id']] = intval($item['quantity']);
            }
        }

        $discountArs = [];

        if (isset($data['coupon_code']) && $data['coupon_code']) {
            //check if valid coupon.
            $checkCode = Code::where('code', $data['coupon_code'])->where('is_used', false)->get();
            if ($checkCode->count() > 0) {
                $checkCode = $checkCode->first();
                foreach ($checkCode->coupon->products as $product) {
                    $discountArs[$product->id] = [
                        'discount' => $checkCode->discount,
                        'is_percent' => $checkCode->is_discount_percent
                    ];
                }
            }

        }

        session()->put('cart', $cart);
        $products = Product::whereIn('id', array_keys($cart))->get();
        $total = 0;

        foreach ($products as $product) {
            if (isset($discountArs[$product->id])) {
                $product->price = ($discountArs[$product->id]['is_percent']) ? $product->price - round(($product->price * $discountArs[$product->id]['discount']) / 100) : $product->price - $discountArs[$product->id]['discount'];
            }
            $total += $product->price * $cart[$product->id];
        }
        return response()->json(['total' => $total, 'html' => view('frontend.part.billing', compact('products', 'cart'))->render()]);

    }

    public function place_order()
    {
        $data = request()->all();
        $cart = (session()->has('cart')) ? session()->get('cart') : [];
        $coupon_code = (isset($data['coupon_code']) && $data['coupon_code']) ? trim($data['coupon_code']) : null;
        $discountArs = [];
        $checkCode = null;

        $response = [
            'status' => false,
            'msg' => null
        ];

        if ($cart) {
            if (!empty($data['delivery_name']) && !empty($data['delivery_phone']) && !empty($data['delivery_email']) && !empty($data['delivery_address'])) {
                if ($coupon_code) {
                    //check if valid coupon.
                    $checkCode = Code::where('code', $coupon_code)->where('is_used', false)->get();
                    if ($checkCode->count() > 0) {
                        $checkCode = $checkCode->first();
                        foreach ($checkCode->coupon->products as $product) {
                            $discountArs[$product->id] = [
                                'discount' => $checkCode->discount,
                                'is_percent' => $checkCode->is_discount_percent
                            ];
                        }
                    }
                }

                $products = Product::whereIn('id', array_keys($cart))->get();
                $data['final_price'] = 0;
                $data['status'] = 1;
                $useCoupon = false;
                $orderProduct = [];

                foreach ($products as $product) {
                    if (isset($discountArs[$product->id])) {
                        $useCoupon = true;
                        $product->price = ($discountArs[$product->id]['is_percent']) ? $product->price - round(($product->price * $discountArs[$product->id]['discount']) / 100) : $product->price - $discountArs[$product->id]['discount'];
                    }
                    $data['final_price'] += $product->price * $cart[$product->id];
                    $orderProduct[$product->id] = ['quantity' => $cart[$product->id]];
                }
                try {
                    $order = Order::create($data);
                    if ($useCoupon) {
                        $checkCode->update(['is_used' => true]);
                    }
                    $order->products()->sync($orderProduct);
                    session()->forget('cart');
                    Notification::create([
                        'type' => 'orders',
                        'notify_id' => $order->id
                    ]);
                    $response['msg'] = 'Bạn đã đặt hàng thành công! Chúng tôi sẽ liên lạc với bạn!';
                    $response['status'] = true;
                } catch (\Exception $e) {
                    $response['msg'] = 'Có lỗi xảy ra trong quá trình đặt hàng! Xin thử lại!';
                }
            } else {
                $response['msg'] = 'Xin điền đầy đủ thông tin cho đơn hàng!';
            }

        } else {
            $response['msg'] = 'Xin điền đầy đủ thông tin cho đơn hàng!';
        }

        return response()->json($response);
    }

    public function logout()
    {
        session()->forget('frontend_login');
        return redirect('/');
    }

    public function register()
    {
        $data = request()->all();
        $ajaxResponseMsg = null;

        $messages = [
            'username.required' => 'Xin điền vào tài khoản đăng nhập!',
            'username.unique' => 'Tài khoản đăng nhập đã tồn tại!',
            'password.required' => 'Xin nhập vào mật khẩu!',
            'password.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự!',
            'password.max' => 'Mật khẩu không được lớn hơn 12 ký tự!',
            'city.required' => 'Xin nhập vào thành phố!',
            'address.required' => 'Xin nhập vào địa chỉ!',
            'email.required' => 'Xin nhập vào địa chỉ email!',
            'email.email' => 'Email không đúng định dạng!',
            'email.unique' => 'Email đã tồn tại trong hệ thống!',
        ];

        $validator = Validator::make($data, [
            'username' => 'required|unique:accounts',
            'password' => 'required|min:6|max:12',
            'city' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:accounts',
        ], $messages);


        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $ajaxResponseMsg .= $message . '<br/>';
            }
        } else {
            try {
                $data['password'] = \Hash::make($data['password']);
                $account = Account::create($data);
                session()->put('frontend_login', $account);
            } catch (\Exception $e) {
                $ajaxResponseMsg = 'Có lỗi xảy ra trong quá trình đăng ký! Xin thử lại!';
            }
        }

        return response()->json(['msg' => $ajaxResponseMsg]);
    }

    public function login()
    {
        $data = request()->all();

        $ajaxResponseMsg = null;


        $messages = [
            'username.required' => 'Xin điền vào tài khoản đăng nhập!',
            'password.required' => 'Xin nhập vào mật khẩu!',
        ];

        $validator = Validator::make($data, [
            'username' => 'required',
            'password' => 'required',
        ], $messages);


        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $ajaxResponseMsg .= $message . '<br/>';
            }
        } else {
            try {
                $account = Account::where('username', $data['username'])->get();
                $loginAccount = null;
                if ($account->count() > 0) {
                    foreach ($account as $acc) {
                        if (\Hash::check($data['password'], $acc->password)) {
                            $loginAccount = $acc;
                        }
                    }
                }
                if ($loginAccount) {
                    session()->put('frontend_login', $loginAccount);
                } else {
                    $ajaxResponseMsg = 'Tài khoản hoặc mật khẩu không đúng! Xin thử lại!';
                }

            } catch (\Exception $e) {
                $ajaxResponseMsg = 'Có lỗi xảy ra trong quá trình đăng nhập! Xin thử lại!';
            }
        }
        return response()->json(['msg' => $ajaxResponseMsg]);
    }

    public function forgot()
    {
        $data = request()->all();
        $ajaxResponseMsg = null;

        $messages = [
            'username.required' => 'Xin điền vào tài khoản đăng nhập!',
            'password.required' => 'Xin nhập vào mật khẩu mới!',
        ];

        $validator = Validator::make($data, [
            'username' => 'required',
            'password' => 'required',
        ], $messages);


        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $ajaxResponseMsg .= $message . '<br/>';
            }
        } else {
            try {
                $account = Account::where('username', $data['username'])->get();

                if ($account->count() == 0) {
                    $ajaxResponseMsg = 'Tài khoản không đúng! Xin thử lại!';
                }

                $account = $account->first();

                $token = md5(time());

                Token::create([
                    'account_id' => $account->id,
                    'token' => $token,
                    'password' => \Hash::make($data['password']),
                    'status' => true
                ]);


                Mail::send('mails.forget_password', ['token' => $token, 'username' => $account->username], function ($m) use ($account) {
                    $m->from(env('MAIL_USERNAME'), 'Tue Linh')
                        ->to($account->email)
                        ->subject('Quên mật khẩu!');
                });


            } catch (\Exception $e) {
                $ajaxResponseMsg = 'Có lỗi xảy ra trong quá trình quên mật khẩu! Xin thử lại!';
            }
        }

        return response()->json(['msg' => $ajaxResponseMsg]);
    }

    public function reset($token)
    {
        $status = false;
        if ($token) {
            try {
                $access = Token::where('token', $token)->where('status', true)->get();
                if ($access->count() > 0) {
                    $access = $access->first();
                    Account::find($access->account_id)->update(['password' => $access->password]);
                    $access->update(['status' => false]);
                    $status = true;
                }
            } catch (\Exception $e) {

            }
        }

        if ($status) {
            return redirect('/?forgot=1');
        } else {
            return redirect('/?forgot=0');
        }
    }

}