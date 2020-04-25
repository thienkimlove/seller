<div class="search-ontop common-group5">

        <div class="hot-keys">
            <strong>Tìm theo: </strong>
            {!! Form::select('choose_medicine', \App\Site::getSearchMedicines(), isset($choose_medicine) ? $choose_medicine : null, ['class' => 'rule-1']) !!}
            {!! Form::select('choose_disease', \App\Site::getSearchDiseases(), isset($choose_disease) ? $choose_disease : null, ['class' => 'rule-2']) !!}
            {!! Form::select('choose_delivery', \App\Site::getDeliveries(), isset($choose_delivery) ? $choose_delivery : null, ['class' => 'rule-3']) !!}
            {!! Form::select('choose_coupon', \App\Site::getCoupons(), isset($choose_coupon) ? $choose_coupon : null, ['class' => 'select-4']) !!}
        </div>
    {!! Form::open(array('url' => 'san-pham', 'method' => 'GET', 'id' => 'search_on_top')) !!}
        <input type="text" name="q" placeholder="Nhập từ khóa tìm kiếm ..." value="{{ isset($choose_q) ? $choose_q : '' }}" required>
        <input type="hidden" name="medicine" value="{{ isset($choose_medicine) ? $choose_medicine : '' }}" />
        <input type="hidden" name="disease" value="{{ isset($choose_disease) ? $choose_disease : '' }}" />
        <input type="hidden" name="delivery" value="{{ isset($choose_delivery) ? $choose_delivery : '' }}" />
        <input type="hidden" name="coupon" value="{{ isset($choose_coupon) ? $choose_coupon : '' }}" />
        <button type="button" id="search_on_top_button" ><img src="{{url('frontend/images/btn-1.png')}}" alt="" width="94" height="33"></button>
      {!! Form::close() !!}
</div>