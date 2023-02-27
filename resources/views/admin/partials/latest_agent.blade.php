@foreach($agents as $val)
<div class="d-flex align-items-center student">
    <span class="dz-media">
        <img src="{{!empty($val->profile_img) ? '/profiles/'.$val->profile_img : '/admin/images/user.jpg'}}" alt="" width="50">
    </span>
    <div class="user-info">
        <h6 class="name">{{$val->full_name}}</h6>
        <span class="text-wrap status-{{!empty($val->user_online_status) ? 'online': 'offline'}}"><i class="fa-solid fa-circle"></i> {{!empty($val->user_online_status) ? 'Online': 'Offline'}}</span>
    </div>
    <div class="indox">
        <a href="{{route('admin.profile', ['id' => $val->faker_id])}}">
            <i class="fa-regular fa-user"></i>
        </a>
    </div>
</div>
@endforeach