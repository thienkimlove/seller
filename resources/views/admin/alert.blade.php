@foreach ($notifications as $notification)
    <li attr-id="{{$notification->id}}">
        <a href="{{ ($notification->type == 'contacts') ? url('admin/contacts') : url('admin/orders')  }}">
            <div>
                <i class="fa fa-comment fa-fw"></i> {{($notification->type == 'contacts')? 'Liên hệ đặt hàng' : 'Đơn hàng'}}
                <span class="pull-right text-muted small">{{ $notification->created_at->diffForHumans()  }}</span>
            </div>
        </a>
    </li>
    <li class="divider"></li>
@endforeach