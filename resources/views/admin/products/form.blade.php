@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sản phẩm</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            @if ($content->id)
                <h2>Chỉnh sửa</h2>
                {!! Form::model($content, ['method' => 'PATCH', 'route' => [$model.'.update', $content->id], 'files' => true]) !!}
            @else
                <h2>Thêm mới</h2>
                {!! Form::model($content, ['route' => [$model.'.store'], 'files' => true]) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', 'Tên sản phẩm') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('seo_title', 'Tên sản phẩm (SEO)') !!}
                {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('desc', 'Mô tả ngắn (Dùng cho phần Meta Description)') !!}
                {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('keywords', 'Các từ khóa (Dùng cho phần Meta Keywords)') !!}
                {!! Form::textarea('keywords', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content', 'Nội dung sản phẩm') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control ckeditor']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('content1', 'Nội dung sản phẩm 1') !!}
                    {!! Form::textarea('content1', null, ['class' => 'form-control ckeditor']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('content2', 'Nội dung sản phẩm 2') !!}
                    {!! Form::textarea('content2', null, ['class' => 'form-control ckeditor']) !!}
                </div>

            <div class="form-group">
                {!! Form::label('image', 'Ảnh sản phẩm') !!}
                @if ($content->image)
                    <img src="{{url('img/cache/small/' . $content->image)}}" />
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>



            <div class="form-group">
                {!! Form::label('medicine_id', 'Chọn dược liệu') !!}
                {!! Form::select('medicine_id', \App\Site::getMedicines(), null, ['class' => 'form-control']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('disease_id', 'Chọn bệnh') !!}
                    {!! Form::select('disease_id', \App\Site::getDiseases(), null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('delivery_id', 'Dạng bào chế') !!}
                    {!! Form::select('delivery_id', \App\Site::getDeliveries(), null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('price', 'Gía sản phẩm') !!}
                    {!! Form::number('price', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('old_price', 'Gía cũ') !!}
                    {!! Form::number('old_price', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('hamluong', 'Hàm lượng') !!}
                    {!! Form::text('hamluong', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('congdung', 'Công dụng') !!}
                    {!! Form::text('congdung', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('quycach', 'Quy cách sản phẩm') !!}
                    {!! Form::text('quycach', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('product_code', 'Mã sản phẩm') !!}
                    {!! Form::text('product_code', null, ['class' => 'form-control']) !!}
                </div>



                <div class="form-group">
                    {!! Form::label('loai_san_pham', 'Loại sản phẩm') !!}
                    {!! Form::text('loai_san_pham', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('available', 'Còn hàng') !!}
                    {!! Form::select('available', \App\Site::getAvailable(), null, ['class' => 'form-control']) !!}
                </div>

            <div class="form-group">
                {!! Form::label('tag_list', 'Từ khóa') !!}
                {!! Form::select('tag_list[]', \App\Tag::pluck('title', 'title')->all(), null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
            </div>



            <div class="form-group">
                {!! Form::label('status', 'Status') !!}
                {!! Form::select('status', \App\Site::getStatus(), null, ['class' => 'form-control']) !!}
            </div>

             <div class="form-group">
                {!! Form::submit('Lưu', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}

            @include('admin.list')

        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('#tag_list').select2({
            placeholder : 'choose or add new tag',
            tags : true //allow to add new tag which not in list.
        });
    </script>
@endsection