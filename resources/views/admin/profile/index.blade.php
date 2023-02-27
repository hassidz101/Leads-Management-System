@extends('admin.layouts.master')

@section('title', 'Profile')

@push('styles')
    <link href="/admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo rounded"></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="{{!empty($user->profile_img) ? '/profiles/'.$user->profile_img: '/admin/images/user.jpg'}}" class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{$user->full_name}}</h4>
                                <p>{{'@'.$user->username}}</p>
                            </div>
                            <div class="dropdown ms-auto">
                                <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li class="dropdown-item"><a href="tel:{{$user->phone}}"><i class="fa fa-phone text-primary me-2"></i> Call</a></li>
                                    <li class="dropdown-item"><a href="mailto:{{$user->email}}"><i class="fa fa-envelope text-primary me-2"></i> Mail</a></li>
                                    <li class="dropdown-item"><a href="{{route('setting-account', ['id' => $user->faker_id])}}"><i class="fa fa-cog text-primary me-2"></i> Settings</a></li>
                                    @if(auth()->user()->role == App\Models\User::ADMIN_ROLE && auth()->id() != $user->id)
                                        <li class="dropdown-item"><a href="javascript:void(0)"><i class="fa fa-trash-alt text-danger me-2"></i> Delete</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="row">

                <div class="swiper mySwiper-counter position-relative overflow-hidden">
                    <div class="swiper-wrapper ">
                        <!-- ---swiper-slide--- -->
                        <div class="swiper-slide">
                            <div class="card counter">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-box-icon">
                                        <i class="fa-solid fa-exclamation-triangle info-page-unprocessed"></i>
                                    </div>
                                    <div  class="chart-num">
                                        <h2 class="font-w600 mb-0">{{number_format($unProcessedLeads)}}</h2>
                                        <p>
                                            Unprocessed
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card counter">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-box-icon">
                                        <i class="fa-solid fa-handshake info-page-appointment"></i>
                                    </div>
                                    <div  class="chart-num">
                                        <h2 class="font-w600 mb-0">{{number_format($appointmentLeads)}}</h2>
                                        <p>
                                            Appointment
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card counter">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-box-icon">
                                        <i class="fa-solid fa-phone-slash info-page-not-reached"></i>
                                    </div>
                                    <div class="chart-num">
                                        <h2 class="font-w600 mb-0">{{number_format($notReachedLeads)}}</h2>
                                        <p>
                                            Not reached
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card counter">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-box-icon">
                                        <i class="fa-solid fa-calendar-day info-page-deadline"></i>
                                    </div>
                                    <div class="chart-num">
                                        <h2 class="font-w600 mb-0">{{number_format($deadlineLeads)}}</h2>
                                        <p>
                                            Deadline
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card counter">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-box-icon">
                                        <i class="fa-solid fa-times-circle info-page-closed"></i>
                                    </div>
                                    <div class="chart-num">
                                        <h2 class="font-w600 mb-0">{{number_format($closedLeads)}}</h2>
                                        <p>
                                            Closed
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card counter">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-box-icon">
                                        <i class="fa-solid fa-exclamation-circle info-page-not-closed"></i>
                                    </div>
                                    <div class="chart-num">
                                        <h2 class="font-w600 mb-0">{{number_format($notClosedLeads)}}</h2>
                                        <p>
                                            Not closed
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card counter">
                                <div class="card-body d-flex align-items-center">
                                    <div class="card-box-icon">
                                        <i class="fa-solid fa-sad-tear info-page-no-interests"></i>
                                    </div>
                                    <div class="chart-num">
                                        <h2 class="font-w600 mb-0">{{number_format($noInterestLeads)}}</h2>
                                        <p>
                                            No interests
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-xl-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lead Datatable</h4>

                    <span>
                        <a href="{{route('admin.lead-add-edit')}}" class="btn btn-block btn-primary">Create lead</a>
                    </span>
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
                                                <a class="dropdown-item" href="view-lead.html"><i class="fa fa-eye text-primary me-2"></i> View</a>
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
        (function($) {
            /* "use strict" */
            var dlabChartlist = function(){

                var screenWidth = $(window).width();
                //let draw = Chart.controllers.line.__super__.draw; //draw shadow
                var activity = function(){
                    var optionsArea = {
                        series: [{
                            name: "Persent",
                            data: [60, 70, 80, 50, 60, 90]
                        },
                            {
                                name: "Visitors",
                                data: [40, 50, 40, 60, 90, 90]
                            }
                        ],
                        chart: {
                            height: 300,
                            type: 'area',
                            group: 'social',
                            toolbar: {
                                show: false
                            },
                            zoom: {
                                enabled: false
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: [3, 3, 3],
                            colors:['var(--secondary)','var(--primary)'],
                            curve: 'straight'
                        },
                        legend: {
                            show:false,
                            tooltipHoverFormatter: function(val, opts) {
                                return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
                            },
                            markers: {
                                fillColors:['var(--secondary)','var(--primary)'],
                                width: 10,
                                height: 10,
                                strokeWidth: 0,
                                radius: 16
                            }
                        },
                        markers: {
                            size: [8,8],
                            strokeWidth: [4,4],
                            strokeColors: ['var(--secondary)','var(--primary)'],
                            border:2,
                            radius: 2,
                            colors:['#fff','#fff','#fff'],
                            hover: {
                                size: 10,
                            }
                        },
                        xaxis: {
                            categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                            labels: {
                                style: {
                                    colors: '#3E4954',
                                    fontSize: '14px',
                                    fontFamily: 'Poppins',
                                    fontWeight: 100,

                                },
                            },
                            axisBorder:{
                                show: false,
                            }
                        },
                        yaxis: {
                            labels: {
                                minWidth: 20,
                                offsetX:-16,
                                style: {
                                    colors: '#3E4954',
                                    fontSize: '14px',
                                    fontFamily: 'Poppins',
                                    fontWeight: 100,

                                },
                            },
                        },
                        fill: {
                            colors:['#fff','#fff'],
                            type:'gradient',
                            opacity: 1,
                            gradient: {
                                shade:'light',
                                shadeIntensity: 1,
                                colorStops: [
                                    [
                                        {
                                            offset: 0,
                                            color: '#fff',
                                            opacity: 0
                                        },
                                        {
                                            offset: 0.6,
                                            color: '#fff',
                                            opacity: 0
                                        },
                                        {
                                            offset: 100,
                                            color: '#fff',
                                            opacity: 0
                                        }
                                    ],
                                    [
                                        {
                                            offset: 0,
                                            color: '#fff',
                                            opacity: .4
                                        },
                                        {
                                            offset: 50,
                                            color: '#fff',
                                            opacity: 0.25
                                        },
                                        {
                                            offset: 100,
                                            color: '#fff',
                                            opacity: 0
                                        }
                                    ]
                                ]

                            },
                        },
                        colors:['#1EA7C5','#FF9432'],
                        grid: {
                            borderColor: '#f1f1f1',
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: false
                                }
                            },
                        },

                        responsive: [{
                            breakpoint: 1602,
                            options: {
                                markers: {
                                    size: [6,6,4],
                                    hover: {
                                        size: 7,
                                    }
                                },chart: {
                                    height: 230,
                                },
                            },

                        }]


                    };
                    if(jQuery("#activity").length > 0){

                        var dzchart = new ApexCharts(document.querySelector("#activity"), optionsArea);
                        dzchart.render();

                        jQuery('#dzNewSeries').on('change',function(){
                            jQuery(this).toggleClass('disabled');
                            dzchart.toggleSeries('Persent');
                        });

                        jQuery('#dzOldSeries').on('change',function(){
                            jQuery(this).toggleClass('disabled');
                            dzchart.toggleSeries('Visitors');
                        });

                    }

                }
                var chartBarRunning = function(){
                    var options  = {
                        series: [
                            {
                                name: 'Income',
                                data: [31, 40, 28,31, 40, 28,31, 40, 28,31, 40, 28]
                            },
                            {
                                name: 'Expense',
                                data: [11, 32, 45,38, 25, 20,36, 45, 15,11, 32, 45]
                            },

                        ],
                        chart: {
                            type: 'bar',
                            height: 350,


                            toolbar: {
                                show: false,
                            },

                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                endingShape:'rounded',
                                columnWidth: '45%',
                                borderRadius: 5,

                            },
                        },
                        colors:['#', '#77248B'],
                        dataLabels: {
                            enabled: false,
                        },
                        markers: {
                            shape: "circle",
                        },
                        legend: {
                            show: false,
                            fontSize: '12px',
                            labels: {
                                colors: '#000000',

                            },
                            markers: {
                                width: 30,
                                height: 30,
                                strokeWidth: 0,
                                strokeColor: '#fff',
                                fillColors: undefined,
                                radius: 35,
                            }
                        },
                        stroke: {
                            show: true,
                            width: 6,
                            colors: ['transparent']
                        },
                        grid: {
                            borderColor: 'rgba(252, 252, 252,0.2)',
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Agu', 'Sep', 'Oct','Nev','Dec'],
                            labels: {
                                style: {
                                    colors: '#ffffff',
                                    fontSize: '13px',
                                    fontFamily: 'poppins',
                                    fontWeight: 100,
                                    cssClass: 'apexcharts-xaxis-label',
                                },
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                                borderType: 'solid',
                                color: '#78909C',
                                height: 6,
                                offsetX: 0,
                                offsetY: 0
                            },
                            crosshairs: {
                                show: false,
                            }
                        },
                        yaxis: {
                            labels: {
                                offsetX:-16,
                                style: {
                                    colors: '#ffffff',
                                    fontSize: '13px',
                                    fontFamily: 'poppins',
                                    fontWeight: 100,
                                    cssClass: 'apexcharts-xaxis-label',
                                },
                            },
                        },
                        fill: {
                            opacity: 1,
                            colors:['#ffffff', '#FFD125'],
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "$ " + val + " thousands"
                                }
                            }
                        },
                        responsive: [{
                            breakpoint: 575,
                            options: {
                                plotOptions: {
                                    bar: {
                                        columnWidth: '1%',
                                        borderRadius: -1,
                                    },
                                },
                                chart:{
                                    height:250,
                                },
                                series: [
                                    {
                                        name: 'Projects',
                                        data: [31, 40, 28,31, 40, 28,31, 40]
                                    },
                                    {
                                        name: 'Projects',
                                        data: [11, 32, 45,31, 40, 28,31, 40]
                                    },

                                ],
                            }
                        }]
                    };

                    if(jQuery("#chartBarRunning").length > 0){

                        var chart = new ApexCharts(document.querySelector("#chartBarRunning"), options);
                        chart.render();

                        jQuery('#dzIncomeSeries').on('change',function(){
                            jQuery(this).toggleClass('disabled');
                            chart.toggleSeries('Income');
                        });

                        jQuery('#dzExpenseSeries').on('change',function(){
                            jQuery(this).toggleClass('disabled');
                            chart.toggleSeries('Expense');
                        });

                    }

                }
                var pieChart = function(){
                    var options = {
                        series: [23,5,32,2, 7,9, 14],
                        chart: {
                            type: 'donut',
                            height:200,
                            innerRadius: 50,
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: 0,
                        },
                        plotOptions: {
                            pie: {
                                startAngle: 0,
                                endAngle: 360,
                                donut: {
                                    size: '80%',
                                },
                            },
                        },
                        colors:[ '#0869E1', '#2BC844', '#9568FF' ,'#ED3DD1', '#FF5166', '#FFBF00', '#2A353A'],
                        labels: ['Unprocessed', 'Appointment', 'Not reached', 'Deadline', 'Closed', 'Not closed', 'No interests'],
                        legend: {
                            position: 'bottom',
                            show:false
                        },
                        responsive: [{
                            breakpoint: 768,

                            options: {
                                chart: {
                                    width:200
                                },
                            }
                        }]
                    };

                    var chart = new ApexCharts(document.querySelector("#pieChart"), options);
                    chart.render();
                }

                var redial = function() {
                    var options = {
                        series: [5],
                        chart: {
                            width: 180,
                            height: 180,
                            type: 'radialBar',
                        },
                        colors:["#1EBA62"],
                        plotOptions: {
                            radialBar: {
                                startAngle: -180,
                                endAngle: 120,
                                hollow: {
                                    size: '60%',
                                    background: 'var(--rgba-primary-1)',
                                    margin:15
                                },
                                dataLabels: {
                                    show: true,
                                    name: {
                                        offsetY: 20,
                                        show: true,
                                        color: '#888',
                                        fontSize: '12px'
                                    },
                                    value: {
                                        formatter: function(val) {
                                            return val + "%"
                                        },
                                        offsetY: -10,
                                        color: '#000000',
                                        fontWeight:700,
                                        fontSize: '18px',
                                        show: true,
                                    }
                                },
                                track: {
                                    background: '#FFF',
                                }
                            }
                        },
                        stroke: {
                            lineCap: 'round'
                        },
                        labels: [''],
                        responsive: [{
                            breakpoint: 575,
                            options: {
                                chart: {
                                    height: 200,
                                },
                            }
                        }],
                    };
                    var chart = new ApexCharts(document.querySelector("#redial"), options);
                    chart.render();
                }

                var swipercard = function() {
                    var swiper = new Swiper('.mySwiper-counter', {
                        speed: 1500,
                        slidesPerView: 4,
                        spaceBetween: 40,
                        parallax: true,
                        loop:false,
                        breakpoints: {

                            300: {
                                slidesPerView: 1,
                                spaceBetween: 30,
                            },
                            576: {
                                slidesPerView: 2,
                                spaceBetween: 30,
                            },
                            991: {
                                slidesPerView: 3,
                                spaceBetween: 30,
                            },
                            1200: {
                                slidesPerView: 4,
                                spaceBetween: 30,
                            },
                        },
                    });
                }
                var swiperreview = function() {
                    var swiper = new Swiper('.mySwiper', {
                        slidesPerView: 1,
                        spaceBetween: 40,
                        loop:false,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        breakpoints: {

                            300: {
                                slidesPerView: 1,
                                spaceBetween: 30,
                            },
                            991: {
                                slidesPerView: 2,
                                spaceBetween: 30,
                            },
                            1200: {
                                slidesPerView: 3,
                                spaceBetween: 30,
                            },
                        },
                    });
                }




                /* Function ============ */
                return {
                    init:function(){
                    },


                    load:function(){
                        activity();
                        chartBarRunning();
                        pieChart();
                        redial();
                        swipercard();
                        swiperreview();

                    },

                    resize:function(){
                        chartBarRunning();
                    }
                }

            }();



            jQuery(window).on('load',function(){
                setTimeout(function(){
                    dlabChartlist.load();
                }, 1000);

            });



        })(jQuery);
    </script>
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
    </script>
    @if($user->role == App\Models\User::ADMIN_ROLE)
    <script>
        function deleteLead(url){
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