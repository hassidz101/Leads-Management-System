@extends('admin.layouts.master')

@section('title', 'Register')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="clearfix">
                <div class="card card-bx profile-card author-profile m-b30">
                    <div class="card-body">
                        <div class="p-5">
                            <div class="author-profile">
                                <div class="author-media">
                                    <img class="profile--image" src="/admin/images/user.jpg" alt="">
                                    <div class="upload-link" title="" data-toggle="tooltip" data-placement="right" data-original-title="update">
                                        <input type="file" onchange="showImage(this)" name="profile_img" class="update-flie">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <h6 class="title"><nmsn id="targeta"></nmsn> <nmsn id="targetb"></nmsn></h6>
                                    <span id="accounttype2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="info-list">
                            <ul>
                                <li>Name<span id="target"></span></li>
                                <li>Surname<span id="target2"></span></li>
                                <li>Phone<span id="target3"></span></li>
                                <li>Email<span id="target4"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-3">
                            <div id="accountstatus2" class="form-control rounded text-center bg-white"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card profile-card card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">Registration</h6>
                </div>
                <form class="profile-form" id="registrationForm">
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-success d-none"></div>
                        <div class="row">
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Name</label>
                                <input id="source" name="name" type="text" class="form-control" oninput="copyData('source', 'target', 'targeta')">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Surname</label>
                                <input id="source2" name="surname" type="text" class="form-control" oninput="copyData('source2', 'target2', 'targetb')" placeholder="e.g. Doe">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Phone</label>
                                <input id="source3" name="phone" type="text" class="form-control" oninput="copyData('source3', 'target3')" placeholder="e.g. +41798765432">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">Email</label>
                                <input id="source4" name="email" type="text" class="form-control" oninput="copyData('source4', 'target4')" placeholder="e.g. john@mail.com">
                            </div>
                            <div class="col-sm-3 m-b30">
                                <label class="form-label">Username</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">@</div>
                                    <input type="text" name="username" class="form-control" placeholder="e.g. johndoe">
                                </div>
                            </div>
                            <div class="col-sm-3 m-b30">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="col-sm-3 m-b30">
                                <label class="form-label">Account status</label><br>
                                <select id="accountstatus" name="is_active" class="selectpicker">
                                    <option disabled selected value="" class="selectopt">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-sm-3 m-b30">
                                <label class="form-label">Agent roles</label><br>
                                <select id="accounttype" name="role" class="selectpicker">
                                    <option disabled selected value="" class="selectopt">Select Role</option>
                                    <option value="agent">Agent</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" onclick="onSave(this)" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyData(sourceId, targetId, targetaId, targetbId, sourceId2, targetId2, sourceId3, targetId3, sourceId4, targetId4) {
            var data = document.getElementById(sourceId).value;
            document.getElementById(targetId).innerHTML = data;
            document.getElementById(targetaId).innerHTML = data;
            var data = document.getElementById(sourceId2).value;
            document.getElementById(targetId2).innerHTML = data;
            document.getElementById(targetbId).innerHTML = data;
            var data = document.getElementById(sourceId3).value;
            document.getElementById(targetId3).innerHTML = data;
            var data = document.getElementById(sourceId4).value;
            document.getElementById(targetId4).innerHTML = data;
        }

        $(function(){
            $("#accountstatus2").html($("#accountstatus").val());
            $("#accountstatus").change(function() {
                $("#accountstatus2").html($(this).find(':selected').text());
            });

            $("#accounttype2").html($("#accounttype").val());
            $("#accounttype").change(function() {
                $("#accounttype2").html($(this).val());
            });
        });

        function onSave(input){
            $(input).attr('disabled', true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            $('.alert-danger').addClass('d-none').empty("");
            $('.alert-success').addClass('d-none').empty("");
            let data = new FormData();
            data.append('name', $('input[name=name]').val());
            data.append('surname', $('input[name=surname]').val());
            data.append('email', $('input[name=email]').val());
            data.append('password', $('input[name=password]').val());
            data.append('phone', $('input[name=phone]').val());
            data.append('username', $('input[name=username]').val());
            data.append('is_active', $('select[name=is_active]').find(':selected').val());
            data.append('role', $('select[name=role]').find(':selected').val());
            if($('input[name=profile_img]')[0].files.length > 0){
                data.append('profile_img', $('input[name=profile_img]')[0].files[0]);
            }
            axios.post('{{route('admin.register-user')}}', data).then(function(res){
                if(res.data.status == 'success'){
                    $('.alert-success').removeClass('d-none').html(res.data.message);
                    setTimeout(function(){
                        window.location.reload()
                    }, 2500);
                }
            }).catch(function(error){
                if(error.response.status == 422){
                    $.each(error.response.data.errors, function(key, value){
                        $(':input[name="'+key+'"]').addClass('has-error').after('<span class="text-danger">'+value[0]+'</span>');
                    });
                }
            }).finally(function(){
                $(input).attr('disabled', false);
            });
        }

        function showImage(input) {
            if($(input)[0].files.length > 0){
                $('.profile--image').attr('src', URL.createObjectURL($(input)[0].files[0]))
            }
        }

    </script>
@endpush