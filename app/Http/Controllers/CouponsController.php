<?php

namespace App\Http\Controllers;

use App\Category;
use App\Code;
use App\Tag;
use Illuminate\Http\Request;
use Validator;

class CouponsController extends AdminController
{

    public $model = 'coupons';

    public $validator = [
        'title' => 'required'
    ];

    private function init()
    {
        return '\\App\\' . ucfirst(str_singular($this->model));
    }

    public function index(Request $request)
    {
        $modelClass = $this->init();
        $searchKeyword = null;
        $searchCate = null;
        $contents = $modelClass::latest('created_at');

        if ($request->input('q')) {
            $searchKeyword = urldecode($request->input('q'));
            $contents = $contents->where('title', 'like', '%'.$searchKeyword.'%');
        }

        if ($request->input('cat')) {
            $searchCate = $request->input('cat');
            $category = Category::find($searchCate);
            $contents = ($category->subCategories->count() == 0) ? $contents->where('category_id', $category->id) : $contents->whereIn('category_id', $category->subCategories->pluck('id')->all());
        }

        $contents = $contents->paginate(config('site.item_per_page'));

        return view('admin.'.$this->model.'.index', compact('contents', 'searchKeyword', 'searchCate'))->with('model', $this->model);
    }

    public function create()
    {
        $modelClass = $this->init();
        $content = new $modelClass;
        return view('admin.'.$this->model.'.form', compact('content'))->with('model', $this->model);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validator);

        if ($validator->fails()) {
            return redirect('admin/'.$this->model.'/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();

        if ($request->file('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->saveImage($request->file('image'));
        } else {
            unset($data['image']);
        }


        $modelClass = $this->init();
        $content = $modelClass::create($data);

        $tagIds = [];
        if (isset($data['tag_list']) && $data['tag_list']) {
            foreach ($request->input('tag_list') as $tag) {
                $tagIds[] = Tag::firstOrCreate(['title' => $tag])->id;
            }
        }

        if ($tagIds) {
            $content->tags()->sync($tagIds);
        }

        $productIds = [];
        if (isset($data['product_list']) && $data['product_list']) {
            foreach ($request->input('product_list') as $product_id) {
                $productIds[] = $product_id;
            }
        }

        if ($productIds) {
            $content->products()->sync($productIds);
        }


        //generate codes for coupon

        if (isset($data['num_of_codes']) && $data['num_of_codes'] > 0 && isset($data['discount']) && $data['discount'] > 0) {

            for ($i = 0; $i < $data['num_of_codes']; $i ++) {
                $random_string = strtoupper(substr(md5(uniqid(time())), 0, 8));
                 Code::firstOrCreate(['code' => $random_string], [
                    'code' => $random_string,
                    'valid_from' => (isset($data['valid_from']) && $data['valid_from']) ? $data['valid_from'] : null,
                    'valid_to' => (isset($data['valid_to']) && $data['valid_to']) ? $data['valid_to'] : null,
                    'discount' => intval($data['discount']),
                    'is_discount_percent' => $data['is_discount_percent'],
                    'coupon_id' => $content->id
                ])->id;
            }

        }


        flash()->success('Thêm mới thành công!');
        return redirect('admin/'.$this->model);

    }

    public function edit($id)
    {
        $modelClass = $this->init();
        $content = $modelClass::find($id);
        return view('admin.'.$this->model.'.form', compact('content'))->with('model', $this->model);
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), $this->validator);

        if ($validator->fails()) {
            return redirect('admin/'.$this->model.'/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $modelClass = $this->init();
        $content = $modelClass::find($id);
        $data = $request->all();
        if ($request->file('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->saveImage($request->file('image'), $content->image);
        } else {
            unset($data['image']);
        }
        $content->update($data);

        $tagIds = [];
        if (isset($data['tag_list']) && $data['tag_list']) {
            foreach ($request->input('tag_list') as $tag) {
                $tagIds[] = Tag::firstOrCreate(['title' => $tag])->id;
            }
        }

        if ($tagIds) {
            $content->tags()->sync($tagIds);
        }

        $productIds = [];
        if (isset($data['product_list']) && $data['product_list']) {
            foreach ($request->input('product_list') as $product_id) {
                $productIds[] = $product_id;
            }
        }

        if ($productIds) {
            $content->products()->sync($productIds);
        }

        //generate codes for coupon

        if (isset($data['num_of_codes']) && $data['num_of_codes'] > 0 && isset($data['discount']) && $data['discount'] > 0) {

            for ($i = 0; $i < $data['num_of_codes']; $i ++) {
                $random_string = strtoupper(substr(md5(uniqid(time())), 0, 8));
                Code::firstOrCreate(['code' => $random_string], [
                    'code' => $random_string,
                    'valid_from' => (isset($data['valid_from']) && $data['valid_from']) ? $data['valid_from'] : null,
                    'valid_to' => (isset($data['valid_to']) && $data['valid_to']) ? $data['valid_to'] : null,
                    'discount' => intval($data['discount']),
                    'is_discount_percent' => $data['is_discount_percent'],
                    'coupon_id' => $content->id
                ])->id;
            }

        }

        flash()->success('Chỉnh sửa thành công!');
        return redirect('admin/'.$this->model);
    }

    public function destroy($id)
    {
        $modelClass = $this->init();
        $content = $modelClass::find($id);
        $content->delete();
        flash()->success('Xóa thành công!');
        return redirect('admin/'.$this->model);
    }
}