<!DOCTYPE html>
<html lang="en">
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
    <title>@yield('title') - {{env('APP_NAME')}}</title>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="/admin/images/favicon.png" />
    <link href="/admin/vendor/wow-master/css/libs/animate.css" rel="stylesheet">
    <link href="/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/vendor/bootstrap-select-country/css/bootstrap-select-country.min.css">
    <link rel="stylesheet" href="/admin/vendor/jquery-nice-select/css/nice-select.css">
    <link href="/admin/vendor/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/vendor/swiper/css/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="/admin/css/style.css" rel="stylesheet">
    @stack('styles')

</head>
<body>

<div id="preloader">
    <div class="loader"></div>
</div>

<div id="main-wrapper" class="wallet-open {{auth()->check() && auth()->user()->role == \App\Models\User::ADMIN_ROLE ? 'active': ''}}">

    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
    @if(auth()->check() && auth()->user()->role == \App\Models\User::ADMIN_ROLE)
    <div class="wallet-bar wow fadeInRight dlab-scroll active" id="wallet-bar" data-wow-delay="0.7s">
        <div class="row ">
            <div class="col-xl-12">
                <div class="card bg-transparent contacts mb-1">
                    <div class="card-header border-0 pb-0 px-3 pt-2">
                        <div>
                            <h2 class="heading mb-0">Agents</h2>

                        </div>
                        <div >
                            <a href="javascript:void(0)" onclick="getLatestActiveAgent()" class="btn-link btn sharp tp-btn btn-primary latest-lead-updates-sync">
                                <i class="fa-solid fa-sync"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body loadmore-content  recent-activity-wrapper p-3 pt-2" id="RecentActivityContent">

                    </div>
                    <div class="card-footer text-center border-0 pt-0 px-3">
                        <a href="{{route('admin.register-admin-agent')}}" class="btn btn-block btn-primary">Register an agent</a>
                    </div>
                </div>
            </div>
            <!-- --/column-- -->



            <!-- --column-- -->

        </div>


    </div>
    <div class="wallet-bar-close"></div>
    @endif
    <div class="content-body">
        <div class="container-fluid">
            @yield('content')
            @include('admin.layouts.footer')
        </div>
    </div>
</div>
<script src="/admin/vendor/global/global.min.js"></script>
<script src="/admin/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<!-- Apex Chart -->
<script src="/admin/vendor/apexchart/apexchart.js"></script>
<!-- Chart piety plugin files -->
<script src="/admin/vendor/peity/jquery.peity.min.js"></script>
<script src="/admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
<!-- ----swiper-slider---- -->
<script src="/admin/vendor/swiper/js/swiper-bundle.min.js"></script>
<!-- Dashboard 1 -->
<script src="/admin/vendor/wow-master/dist/wow.min.js"></script>
<script src="/admin/vendor/bootstrap-datetimepicker/js/moment.js"></script>
<script src="/admin/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/admin/vendor/bootstrap-select-country/js/bootstrap-select-country.min.js"></script>

<script src="/admin/js/dlabnav-init.js"></script>
<script src="/admin/js/custom.min.js"></script>
<script src="/admin/js/demo.js"></script>
<script src="/admin/js/styleSwitcher.js"></script>
<script src="/admin/js/axios.min.js"></script>
@stack('scripts')
<script>

    $(function () {
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());

    });

    $(document).ready(function(){
        $(".booking-calender .fa.fa-clock-o").removeClass(this);
        $(".booking-calender .fa.fa-clock-o").addClass('fa-clock');
    });
    $('.my-select').selectpicker();

</script>
@if(auth()->check() && auth()->user()->role == \App\Models\User::ADMIN_ROLE)
    <script>
        $(function(){
            getLatestActiveAgent()
        });

        function getLatestActiveAgent(){
            axios.get('{{route('admin.latest-active-agents')}}').then(function(res){
                $('.loadmore-content').empty().append(res.data)
            })
        }

    </script>
@endif
</body>
</html>