@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Code</h1>
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
                {!! Form::label('code', 'Code') !!}
                {!! Form::text('code', null, ['class' => 'form-control']) !!}
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
                    {!! Form::label('coupon_id', 'Khuyến mãi') !!}
                    {!! Form::select('coupon_id', \App\Site::getCoupons(), null, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('valid_from', 'Thời hạn active của code từ') !!}
                    {!! Form::text('valid_from',  null, ['class' => 'form-control', 'id' => 'valid_from']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('valid_to', 'Thời hạn active của code đến') !!}
                    {!! Form::text('valid_to',  null, ['class' => 'form-control', 'id' => 'valid_to']) !!}
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