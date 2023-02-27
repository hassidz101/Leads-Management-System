@extends('admin.layouts.master')

@section('title', 'Leads')

@push('styles')
    <link href="/admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lead Datatable</h4>
                    <span>
                        <a href="{{route('admin.lead-add-edit')}}" class="btn btn-block btn-primary">Create a lead</a>
                    </span>
                </div>
                <div class="mb-3 mt-2 row" style="margin-left: 8px !important;">
                    <label class="col-form-label" for="validationCustom00">Lead status
                    </label>
                    <div class="col-lg-6">
                        <select name="lead_status" onchange="filterData(this)" class="default-select wide form-control" id="validationCustom00">
                            <option value="all" {{$leadStatus == "all" ? "selected": ""}}>All</option>
                            <option value="unprocessed" {{$leadStatus == "unprocessed" ? "selected": ""}}>Unprocessed</option>
                            <option value="appointment" {{$leadStatus == "appointment" ? "selected": ""}}>Appointment</option>
                            <option value="not_reached" {{$leadStatus == "not_reached" ? "selected": ""}}>Not reached</option>
                            <option value="deadline" {{$leadStatus == "deadline" ? "selected": ""}}>Deadline</option>
                            <option value="closed" {{$leadStatus == "closed" ? "selected": ""}}>Closed</option>
                            <option value="not_closed" {{$leadStatus == "not_closed" ? "selected": ""}}>Not closed</option>
                            <option value="no_interests" {{$leadStatus == "no_interests" ? "selected": ""}}>No interests</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Investment amount</th>
                                <th>Reachability</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leads as $lead)
                            <tr>
                                <td><img onclick="openAssignModal(this, '{{route('admin.assign-lead', ['id' => $lead->faker_id])}}', '{{$lead->full_name}}', '{{$lead->agent}}')" class="rounded-circle proimgpoi" width="35" src="{{!empty($lead->agent) && !empty($lead->agent->profile_img) ? '/profiles/'.$lead->agent->profile_img: '/admin/images/user.jpg'}}" alt=""></td>
                                <td>{{$lead->full_name}}</td>
                                <td>{{$lead->investment_amount}}</td>
                                <td>{{$lead->reachability}}</td>
                                <td>
                                    {!! lead_table_icon($lead->lead_status) !!}
                                </td>
                                <td>{{date('d/m/Y h:i A', strtotime($lead->created_at))}}</td>
                                <td>
                                    <div class="dropdown ms-auto text-end">
                                        <div class="btn sharp btn-primary tp-btn ms-auto" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-v"></i>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{route('admin.lead-detail-view', ['id' => $lead->faker_id])}}"><i class="fa fa-eye text-primary me-2"></i> View</a>
                                            <a class="dropdown-item" href="tel:{{$lead->phone}}"><i class="fa fa-phone text-primary me-2"></i> Call</a>
                                            <a class="dropdown-item" href="mailto:{{$lead->email}}"><i class="fa fa-envelope text-primary me-2"></i> Mail</a>
                                            @if($user->role == App\Models\User::ADMIN_ROLE)
                                                <a class="dropdown-item" onclick="deleteLead('{{route('admin.delete-lead', ['id' => $lead->faker_id])}}')" href="javascript:void(0)">
                                                    <i class="fa fa-trash-alt text-danger me-2"></i> Delete
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="basicModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title lead--name"><img class="rounded-circle modal--agent-img" width="35" src="/admin/images/profile/small/pic6.jpg" alt=""> &nbsp; Raphael Zumsteg</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="alert alert-success d-none"></div>
                        <label class="form-label select--label"></label><br>
                        <select id="agentpicker" class="selectpicker assign-agent">
                            <option disabled selected value="" class="selectag">Select agent</option>
                            @foreach($agents as $val)
                            <option value="{{$val->id}}">{{$val->full_name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="assignLead(this)" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(function(){
            $('#example3').DataTable({
                language: {
                    paginate: {
                        next: '<i class="fa-solid fa-angle-right"></i>',
                        previous: '<i class="fa-solid fa-angle-left"></i>'
                    }
                },
            });
        });
        {{--var leadDataTable = '';--}}
        {{--$(function(){--}}
        {{--    leadDataTable = $('#example3').DataTable({--}}
        {{--        language: {--}}
        {{--            paginate: {--}}
        {{--                next: '<i class="fa-solid fa-angle-right"></i>',--}}
        {{--                previous: '<i class="fa-solid fa-angle-left"></i>'--}}
        {{--            }--}}
        {{--        },--}}
        {{--        "serverSide": true,--}}
        {{--        "processing": true,--}}
        {{--        "ajax":{--}}
        {{--            "url": `{{route('admin.lead-data')}}`,--}}
        {{--            // "data": function(data) {--}}
        {{--            //     data.lead_status = $('#lead_status_filter').val();--}}
        {{--            // }--}}
        {{--        },--}}
        {{--        "columns":[--}}
        {{--            {--}}
        {{--                data: 'image',--}}
        {{--                'render': function(data, type, row, meta) {--}}
        {{--                    return `<img class="rounded-circle proimgpoi" width="35" src="/admin/images/profile/small/pic6.jpg" alt="">`;--}}
        {{--                }--}}
        {{--            },--}}
        {{--            {--}}
        {{--                data: 'full_name',--}}
        {{--                'render': function(data, type, row, meta) {--}}
        {{--                    return row.first_name+' '+row.last_name;--}}
        {{--                }--}}
        {{--            },--}}
        {{--            {data: 'investment_amount'},--}}
        {{--            {data: 'investment_amount'},--}}
        {{--            {--}}
        {{--                data: 'created_at',--}}
        {{--                'render': function(data, type, row, meta) {--}}
        {{--                    return moment(row.created_at).format('DD/MM/YYYY');--}}
        {{--                }--}}
        {{--            },--}}
        {{--            {--}}
        {{--                data: 'actions',--}}
        {{--                'render': function(data, type, row, meta) {--}}
        {{--                    return `<div class="dropdown ms-auto text-end">--}}
        {{--                        <div class="btn sharp btn-primary tp-btn ms-auto" data-bs-toggle="dropdown">--}}
        {{--                            <i class="fa-solid fa-ellipsis-v"></i>--}}
        {{--                        </div>--}}
        {{--                        <div class="dropdown-menu dropdown-menu-end">--}}
        {{--                            <a class="dropdown-item" href="view-lead.html"><i class="fa fa-eye text-primary me-2"></i> View</a>--}}
        {{--                            <a class="dropdown-item" href="tel:${row.phone}"><i class="fa fa-phone text-primary me-2"></i> Call</a>--}}
        {{--                            <a class="dropdown-item" href="mailto:${row.email}"><i class="fa fa-envelope text-primary me-2"></i> Mail</a>--}}
        {{--                            <a class="dropdown-item" href="javascript:void(0)">--}}
        {{--                                <i class="fa fa-trash-alt text-danger me-2"></i> Delete--}}
        {{--                            </a>--}}
        {{--                        </div>--}}
        {{--                    </div>`;--}}
        {{--                }--}}
        {{--            },--}}
        {{--        ],--}}
        {{--    });--}}
        {{--});--}}
        let url;
        function openAssignModal(input, route, full_name, body) {
            url = route;
            if(body){
                let data = JSON.parse(body)
                $('.assign-agent').val(data.id);
                $('.modal--agent-img').attr('src', `/profiles/${data.profile_img}`);
                $('.select--label').html(`This lead is currently assigned to agent <strong>${data.full_name}</strong>, if you want to assign this lead to another agent, then choose an agent from the dropdown list.`)
            }else {
                $('.modal--agent-img').attr('src', `/admin/images/user.jpg`);
                $('.assign-agent').val("");
                $('.select--label').text(`This lead is currently not assigned to any agent, if you want to assign this lead to any agent, then choose an agent from the dropdown list.`)
            }
            $('.lead--name').text(full_name);
            $('.selectpicker').selectpicker('refresh');
            $('#basicModal').modal('toggle');
        }

        function assignLead(input){
            $('.alert-success').addClass('d-none').text('')
            $(input).attr('disabled', true);
            if($('.assign-agent').find(':selected').val()){
                axios.post(url, {agent_id: $('.assign-agent').find(':selected').val()}).then(function (res) {
                    if(res.data.status == "success"){
                        $('.alert-success').removeClass('d-none').text('Lead has been assigned to agent.')
                        $(input).attr('disabled', false);
                        setTimeout(function () {
                            $('#basicModal').modal('toggle');
                            window.location.reload()
                        }, 1500);
                    }
                })
            }
        }

        function filterData(input) {
            let val = $(input).find(':selected').val();
            window.location.href = '{{route('admin.lead-view')}}?lead_status='+val;
        }
    </script>
    @if($user->role == App\Models\User::ADMIN_ROLE)
        <script>
            function deleteLead(route){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get(route).then(function (response) {
                            if (response.data.status == 'success'){
                                Swal.fire(
                                    'Deleted!',
                                    'Lead has been deleted.',
                                    'success'
                                )
                                setTimeout(function(){
                                    window.location.reload()
                                }, 1500);
                            }
                        });

                    }
                });
            }
        </script>
    @endif
@endpush