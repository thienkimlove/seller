<table>
    <tr>
        <th>STT</th>
        <th>Mã hàng</th>
        <th>Sản phẩm</th>
        <th>Giá bán</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
    </tr>
    @foreach ($products as $k => $product)
        <tr>
            <td>{{$k+1}}</td>
            <td>{{$product->product_code}}</td>
            <td>
                <div class="summary">
                    <img src="{{url('img/cache/326x215', $product->image)}}" alt="" width="125" height="199">
                    <div class="sp">
                        <div class="name">{{$product->title}}</div>
                        <div class="status">Còn hàng</div>
                    </div>
                </div>
            </td>
            <td>{{App\Site::priceFormat($product->price)}}</td>
            <td>
                <div class="center">
                    <input type="number" value="{{$cart[$product->id]}}">
                    <button type="button" attr-id="{{$product->id}}" class="cap-nhat">Cập nhật</button>
                    <a href="javascript:void(0)" attr-id="{{$product->id}}" class="delete" title="Xóa khỏi giỏ hàng">Xóa khỏi giỏ hàng</a>
                </div>
            </td>
            <td>{{App\Site::priceFormat($product->price*$cart[$product->id])}}</td>
        </tr>
    @endforeach
</table>

<div class="btn-group">
    <button type="" id="refresh">Cập nhật</button>
    <button type="button" id="continue_buy">Tiếp tục mua hàng</button>
</div>