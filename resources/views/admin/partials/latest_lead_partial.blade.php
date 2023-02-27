@foreach($leads as $lead)
    <tr>
        <td class="whitesp-no p-0">
            <div class="d-flex py-sm-3 py-1 align-items-center trans-info">
                <span class="icon me-3">
                    {!! dashboard_lead_icon($lead->lead_status) !!}
                </span>
                <div>
                    <h6 class="font-w500 fs-15 mb-0">{{$lead->full_name}}</h6>
                    <span class="fs-14 font-w400"><a href="/admin/app-profile.html">{{ucfirst(str_replace('_', ' ', $lead->status))}}</a></span>
                </div>
            </div>
        </td>
        <td class="whitesp-no">
            <a href="{{!empty($lead->agent) ? route('admin.profile', ['id' => $lead->agent->faker_id]): "javascript:void(0)"}}" class="tb-mail">
                {{!empty($lead->agent) ? '@'.$lead->agent->username: "No agent assign"}}
            </a>
        </td>
        <td class="text-end">
            <a href="{{route('admin.lead-detail-view', ['id' => $lead->faker_id])}}"><span class="btn light btn-primary btn-sm">View lead</span></a>
        </td>
    </tr>
@endforeach