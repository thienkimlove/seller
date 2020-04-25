@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Khuyến mãi</h1>
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
                {!! Form::label('title', 'Tên bài Khuyến mãi') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('seo_title', 'Tên bài Khuyến mãi (SEO)') !!}
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
                {!! Form::label('content', 'Nội dung bài') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control ckeditor']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Ảnh bài Khuyến mãi') !!}
                @if ($content->image)
                    <img src="{{url('img/cache/small/' . $content->image)}}" />
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tag_list', 'Từ khóa') !!}
                {!! Form::select('tag_list[]', \App\Tag::pluck('title', 'title')->all(), null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('product_list', 'Danh sách sản phẩm') !!}
                    {!! Form::select('product_list[]', \App\Product::pluck('title', 'id')->all(), null, ['id' => 'product_list', 'class' => 'form-control', 'multiple']) !!}
                </div>


            @if (!$content->id || $content->codes->count() == 0)
                <div class="form-group">
                    {!! Form::label('num_of_codes', 'Số lượng mã khuyến mại cần tạo') !!}
                    {!! Form::number('num_of_codes', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('discount', 'Giảm') !!}
                    {!! Form::number('discount', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('is_discount_percent', 'Loại giảm') !!}
                    {!! Form::select('is_discount_percent', \App\Site::getDiscountType(), null, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('valid_from', 'Thời hạn active của code từ') !!}
                    {!! Form::text('valid_from',  null, ['class' => 'form-control', 'id' => 'valid_from']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('valid_to', 'Thời hạn active của code đến') !!}
                    {!! Form::text('valid_to',  null, ['class' => 'form-control', 'id' => 'valid_to']) !!}
                </div>
             @endif


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

        $('#product_list').select2({
            placeholder : 'chọn sản phẩm',
            tags : false //allow to add new tag which not in list.
        });

        $(document).ready(function(){
            jQuery.datetimepicker.setLocale('vi');

            jQuery('#valid_from, #valid_to').datetimepicker({
                i18n:{
                    vi:{
                        months:[
                            'Thang 1','Thang 2','Thang 3','Thang 4',
                            'Thang 5','Thang 6','Thang 7','Thang 8',
                            'Thang 9','Thang 10','Thang 11','Thang 12',
                        ],
                        dayOfWeek:[
                            "Chu Nhat", "Thu 2", "Thu 3", "Thu 4",
                            "Thu 5", "Thu 6", "Thu 7",
                        ]
                    }
                },
                timepicker:true,
                format:'Y-m-d'
            });

        });
    </script>
@endsection