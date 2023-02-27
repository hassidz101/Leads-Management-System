@extends('admin.layouts.master')

@section('title', 'Admin/Agents')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <div class="d-flex align-items-center">
                            <h2 class="heading">Admin/Agents</h2>
                        </div>
                        <div class="right-area folder-layout-tab">
                            <a href="{{route('admin.register-admin-agent')}}" class="btn btn-primary">Register an admin/agent</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="row">
                        @foreach($allData as $val)
                            <div class="col-xl-4 col-md-6">
                            <div class="card contact_list ">
                                <div class="card-body">
                                    <div class="user-content">
                                        <div class="user-info">
                                            <div class="user-img">
                                                <img src="{{!empty($val->profile_img) ? '/profiles/'.$val->profile_img : '/admin/images/user.jpg'}}" alt="">
                                            </div>
                                            <div class="user-details">
                                                <h4 class="user-name">{{ucfirst($val->full_name)}}</h4>
                                                <span class="number">{{ucfirst($val->role)}}</span>
                                                <span class="mail">{{'@'.$val->username}}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{route('admin.profile', ['id' => $val->faker_id])}}" class="btn-link btn sharp tp-btn btn-primary pill agents-icons-profile">
                                                <i class="fa-regular fa-user profile-link"></i>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="contact-icon">
                                        <a href="tel:{{$val->phone}}">
                                            <div class="icon agents-icons">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                        </a>
                                        <a href="mailto:{{$val->email}}">
                                            <div class="icon agents-icons">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                        </a>
                                        <a href="{{route('setting-account', ['id' => $val->faker_id])}}">
                                            <div class="icon agents-icons">
                                                <i class="fa-solid fa-cog"></i>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" onclick="deleteAgent('{{route('admin.delete-agent', ['id' => $val->faker_id])}}')">
                                            <div class="icon agents-icons trash">
                                                <i class="fa-solid fa-trash-alt"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function deleteAgent(url){
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
                    axios.get(url).then(function (response) {
                        if (response.data.status == 'success'){
                            Swal.fire(
                                'Deleted!',
                                'Record has been deleted.',
                                'success'
                            )
                            setTimeout(function(){
                                window.location.reload()
                            }, 1500);
                        }else{
                            Swal.fire(
                                'Failed!',
                                response.data.message,
                                'error'
                            )
                        }
                    });

                }
            });
        }
    </script>
@endpush