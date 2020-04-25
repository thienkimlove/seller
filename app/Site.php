<?php

namespace App;

class Site
{
    public static function moduleEnable($key_type, $key_content, $key_value)
    {
        $modules = Module::where('key_type', $key_type)
            ->where('key_content', $key_content)
            ->where('key_value', $key_value)
            ->get();

        return ($modules->count() > 0)? $modules->first() : null;
    }


    public static function getCategories()
    {
        return array(0 => 'Chọn chuyên mục cha') + Category::pluck('title', 'id')->all();
    }

    public static function getBannerPositions()
    {
        return array(0 => 'Chọn vị trí') + Position::pluck('name', 'id')->all();
    }

    public static function getMedicines()
    {
        return array(0 => 'Dược liệu') + Medicine::pluck('title', 'id')->all();
    }

    public static function getDiseases()
    {
        return array(0 => 'Bệnh') + Disease::pluck('title', 'id')->all();
    }

    public static function getDeliveries()
    {
        return array(0 => 'Dạng bào chế') + Delivery::pluck('title', 'id')->all();
    }


    public static function getCoupons()
    {
        return array(0 => 'Khuyến mãi') + Coupon::pluck('title', 'id')->all();
    }


    public static function getAvailable()
    {
        return array(1 => 'Còn', 0 => 'Hết');
    }

    public static function getStatus()
    {
        return array(1 => 'Active', 0 => 'Inactive');
    }

    public static function getDiscountType()
    {
        return array(0 => 'Giảm theo số', 1 => 'Giảm theo phần trăm giá');
    }

    public static function getNoChildCategories()
    {
        return array(0 => 'Chọn chuyên mục') + Category::whereDoesntHave('subCategories')->pluck('title', 'id')->all();
    }

    public static function getFrontendBanners()
    {
        return Banner::all();
    }

    public static function getFrontendMedicines($limit = 7, $index = null)
    {

        if ($index) {
            $machModules = Module::where('key_type', 'show_on_index')->where('key_content', 'medicines')->pluck('key_value')->all();
            return Medicine::whereIn('id', $machModules)->limit($limit)->get();
        }
        return Medicine::limit($limit)->get();
    }

    public static function getFrontendDiseases($limit = 7)
    {
        return Disease::limit($limit)->get();
    }

    public static function getMachNhoFrontend()
    {
        $machModules = Module::where('key_type', 'mach_index')->where('key_content', 'posts')->pluck('key_value')->all();
        $machIndexPosts = null;

        if ($machModules) {
            $machIndexPosts = Post::where('status', true)->whereIn('id', $machModules)->get();
        }

        return $machIndexPosts;
    }

    public static function getKhuyenMaiFrontend()
    {
        $khuyenmaiIndexProducts = null;

        $khuyenmaiIndexProductModules = Module::where('key_type', 'khuyenmai_index')->where('key_content', 'products')->pluck('key_value')->all();

        if ($khuyenmaiIndexProductModules) {
            $khuyenmaiIndexProducts = Product::where('status', true)->whereIn('id', $khuyenmaiIndexProductModules)->get();
        }

        return $khuyenmaiIndexProducts;
    }

    public static function getViewedProductFrontend()
    {
        if (session()->has('product_viewed')) {
            $productViewedIds = session()->get('product_viewed');
        } else {
            $productViewedIds = Product::where('status', true)->latest('created_at')->pluck('id')->all();
        }

        return Product::whereIn('id', $productViewedIds)->limit(3)->get();
    }

    public static function getTinKhuyenmaiFrontend()
    {
        return Coupon::where('status', true)->latest('created_at')->limit(5)->get();
    }

    public static function getProductOrders()
    {
        return array('' => 'Sắp xếp theo') + ['cheap' => 'Giá rẻ nhất', 'expensive' => 'Giá đắt nhất', 'buy' => 'Mua nhiều nhất'];
    }

    public static function getPage($paginate)
    {
        $pages = [];
        for ($i = 1; $i <  $paginate->lastPage(); $i++) {
            $pages[$i] = 'Trang '.$i;
        }
        return $pages;
    }

    public static function getCartFrontend()
    {
        if (session()->has('cart')) {
            return sizeof(session()->get('cart'));
        } else {
            return 0;
        }
    }

    public static function getSearchMedicines()
    {
        return array(0 => 'Dược liệu') + Medicine::pluck('title', 'slug')->all();
    }

    public static function getSearchDiseases()
    {
        return array(0 => 'Bệnh') + Disease::pluck('title', 'slug')->all();
    }

    public static function priceFormat($number)
    {
        return number_format($number, 0, ',', '.').'đ';
    }
}