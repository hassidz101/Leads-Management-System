<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="" />
<meta name="author" content="" />
<meta name="robots" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="" />
<meta property="og:title" content="" />
<meta property="og:description" content="" />
<meta property="og:image" content="" />
<meta name="format-detection" content="telephone=no">

<!-- PAGE TITLE HERE -->
<title>Sign in - {{env('APP_NAME')}}</title>
<link rel="shortcut icon" type="image/png" href="/admin/images/favicon.png" />
<link href="/admin/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">
<link href="/admin/css/style.css" rel="stylesheet">

</head>

<body class="body  h-100" style="background-image: url('/admin/images/login-bg-1.jpg'); background-size:cover;">
<div class="container h-100">
    <div class="row h-100 align-items-center justify-contain-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row m-0">
                        <div class="col-xl-6 col-md-6 sign text-center">
                            <div>
                                <div class="text-center my-5">
                                    <a href="index.html"><img src="images/logo-full.png" alt=""></a>
                                </div>
                                <img src="/admin/images/log.png" class="img-fix bitcoin-img sd-shape7"></img>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="sign-in-your py-4 px-2">
                                <h4 class="fs-20">Sign in your account</h4>
                                <span>Welcome to the Cryptodvice customer relationship management!</span>
                                <div class="login-social">
                                    <a href="javascript:void(0);" class="btn d-block btn-light my-3">Terms and Conditions</a>
                                    <a href="javascript:void(0);" class="btn d-block btn-dark my-3">Privacy Policy</a>
                                </div>
                                <form id="loginForm">
                                    @csrf
                                    <div class="alert alert-danger d-none"></div>
                                    <div class="alert alert-success d-none"></div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter your password">
                                    </div>
                                    <div class="row d-flex justify-content-between mt-4 mb-2">
                                        <div class="mb-3">
                                            <div class="form-check custom-checkbox ms-1">
                                                <input type="checkbox" class="form-check-input" id="basic_checkbox_1" name="toc" value="1">
                                                <label class="form-check-label" for="basic_checkbox_1">I agree to the terms and conditions and privacy policy</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            Forgot Password? Please <a href="mailto:jordan@mail.com"><u>contact</u></a> the administrator.
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" onclick="submitLogin(this)" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="/admin/vendor/global/global.min.js"></script>
    <script src="/admin/js/dlabnav-init.js"></script>
    <script src="/admin/js/axios.min.js"></script>
    <script>
        function submitLogin(input){
            $(input).attr('disabled', true);
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            $('.alert-danger').addClass('d-none').empty("");
            $('.alert-success').addClass('d-none').empty("");
            axios.post('{{route('admin.login_post')}}', $('#loginForm').serialize()).then(function(res){
                if(res.data.status == 'success'){
                    $('.alert-success').removeClass('d-none').html(res.data.message);
                    setTimeout(function(){
                        window.location.replace(res.data.route)
                    }, 2500);
                }else{
                    $('.alert-danger').removeClass('d-none').html(res.data.message);
                }
            }).catch(function(error){
                if(error.response.status == 422){
                    $.each(error.response.data.errors, function(key, value){
                        $('input[name="'+key+'"]').addClass('has-error').after('<span class="text-danger">'+value[0]+'</span>');
                    });
                }
            }).finally(function(){
                $(input).attr('disabled', false);
            });
        }
    </script>
</body>
</html>