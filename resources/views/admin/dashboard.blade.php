@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles style1">
                        <div class="d-flex align-items-center">
                            <h2 class="heading">Dashboard</h2>
                            <!-- <p class="text-warning ms-2">Welcome Back Yatin Sharma !</p> -->
                        </div>
                    </div>
                </div>
            </div>
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
                                    <h2 class="font-w600 mb-0">{{$notClosedLeads}}</h2>
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
                                    <h2 class="font-w600 mb-0">{{$noInterestLeads}}</h2>
                                    <p>
                                        No interests
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 wow fadeInUp" data-wow-delay="1.5s">
                    <div class="card">
                        <div class="card-header border-0 flex-wrap">
                            <h2 class="heading">Latest lead updates</h2>
                            <div class="d-flex align-items-center">
                                <a href="javascript:void(0)" onclick="getLatestLead()" class="btn-link btn sharp tp-btn btn-primary latest-lead-updates-sync">
                                    <i class="fa-solid fa-sync"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="table-responsive">
                                <table class="table-responsive-md table display mb-4 order-table card-table text-black no-footer student-tbl">
                                    <tbody class="latest_leads_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ----column-- -->
                <div class="col-xl-4 wow fadeInUp" data-wow-delay="1s">
                    <div class="card">
                        <div class="card-header border-0">
                            <h2 class="heading">Lead status</h2>
                            <div class="dropdown custom-dropdown">
                                <div class="btn sharp btn-primary tp-btn " data-bs-toggle="dropdown">
                                    <svg width="6" height="20" viewBox="0 0 6 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.19995 10.001C5.19995 9.71197 5.14302 9.42576 5.03241 9.15872C4.9218 8.89169 4.75967 8.64905 4.55529 8.44467C4.35091 8.24029 4.10828 8.07816 3.84124 7.96755C3.5742 7.85694 3.28799 7.80001 2.99895 7.80001C2.70991 7.80001 2.4237 7.85694 2.15667 7.96755C1.88963 8.07816 1.64699 8.24029 1.44261 8.44467C1.23823 8.64905 1.0761 8.89169 0.965493 9.15872C0.854882 9.42576 0.797952 9.71197 0.797952 10.001C0.798085 10.5848 1.0301 11.1445 1.44296 11.5572C1.85582 11.9699 2.41571 12.2016 2.99945 12.2015C3.58319 12.2014 4.14297 11.9694 4.55565 11.5565C4.96832 11.1436 5.20008 10.5838 5.19995 10L5.19995 10.001ZM5.19995 3.00101C5.19995 2.71197 5.14302 2.42576 5.03241 2.15872C4.9218 1.89169 4.75967 1.64905 4.55529 1.44467C4.35091 1.24029 4.10828 1.07816 3.84124 0.967552C3.5742 0.856941 3.28799 0.800011 2.99895 0.800011C2.70991 0.800011 2.4237 0.856941 2.15667 0.967552C1.88963 1.07816 1.64699 1.24029 1.44261 1.44467C1.23823 1.64905 1.0761 1.89169 0.965493 2.15872C0.854883 2.42576 0.797953 2.71197 0.797953 3.00101C0.798085 3.58475 1.0301 4.14453 1.44296 4.55721C1.85582 4.96988 2.41571 5.20164 2.99945 5.20151C3.58319 5.20138 4.14297 4.96936 4.55565 4.5565C4.96832 4.14364 5.20008 3.58375 5.19995 3.00001L5.19995 3.00101ZM5.19995 17.001C5.19995 16.712 5.14302 16.4258 5.03241 16.1587C4.9218 15.8917 4.75967 15.6491 4.55529 15.4447C4.35091 15.2403 4.10828 15.0782 3.84124 14.9676C3.5742 14.8569 3.28799 14.8 2.99895 14.8C2.70991 14.8 2.4237 14.8569 2.15666 14.9676C1.88963 15.0782 1.64699 15.2403 1.44261 15.4447C1.23823 15.6491 1.0761 15.8917 0.965493 16.1587C0.854882 16.4258 0.797952 16.712 0.797952 17.001C0.798084 17.5848 1.0301 18.1445 1.44296 18.5572C1.85582 18.9699 2.41571 19.2016 2.99945 19.2015C3.58319 19.2014 4.14297 18.9694 4.55565 18.5565C4.96832 18.1436 5.20008 17.5838 5.19995 17L5.19995 17.001Z" fill="#0869E1"/>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{route('admin.lead-view', ['lead_status' => 'unprocessed'])}}">Unprocessed</a>
                                    <a class="dropdown-item" href="{{route('admin.lead-view', ['lead_status' => 'appointment'])}}">Appointment</a>
                                    <a class="dropdown-item" href="{{route('admin.lead-view', ['lead_status' => 'not_reached'])}}">Not reached</a>
                                    <a class="dropdown-item" href="{{route('admin.lead-view', ['lead_status' => 'deadline'])}}">Deadline</a>
                                    <a class="dropdown-item" href="{{route('admin.lead-view', ['lead_status' => 'closed'])}}">Closed</a>
                                    <a class="dropdown-item" href="{{route('admin.lead-view', ['lead_status' => 'not_closed'])}}">Not closed</a>
                                    <a class="dropdown-item" href="{{route('admin.lead-view', ['lead_status' => 'no_interests'])}}">No interests</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0 pb-2">
                            <div id="pieChart" class="d-inline-block"></div>
                            <div class="chart-items">
                                <!-- --row-- -->
                                <div class="row">
                                    <!-- ----column-- -->
                                    <div class=" col-xl-12 col-sm-12">
                                        <div class="text-start mt-2">
                                            <span class="text-black font-w600 mb-3 d-block fs-14">Legend</span>

                                            <div class="color-picker">
                                                <span class="mb-0 col-8 fs-14">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#0869E1"/>
                                                    </svg>
                                                    Unprocessed
                                                </span>
                                                <h5>{{number_format($unProcessedLeads)}}</h5>
                                            </div>

                                            <div class="color-picker">
                                                <span class="mb-0 col-8 fs-14">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#2BC844"/>
                                                    </svg>
                                                    Appointment
                                                </span>
                                                <h5>{{number_format($appointmentLeads)}}</h5>
                                            </div>

                                            <div class="color-picker">
                                                <span class="mb-0 col-8 fs-14">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#9568FF"/>
                                                    </svg>
                                                    Not reached
                                                </span>
                                                <h5>{{number_format($notReachedLeads)}}</h5>
                                            </div>

                                            <div class="color-picker">
                                                <span class="mb-0 col-8 fs-14">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#ED3DD1"/>
                                                    </svg>
                                                    Deadline
                                                </span>
                                                <h5>{{number_format($deadlineLeads)}}</h5>
                                            </div>

                                            <div class="color-picker">
                                                <span class="mb-0 col-8 fs-14">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#FF5166"/>
                                                    </svg>
                                                    Closed
                                                </span>
                                                <h5>{{$closedLeads}}</h5>
                                            </div>

                                            <div class="color-picker">
                                                <span class="mb-0 col-8 fs-14">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#FFBF00"/>
                                                    </svg>
                                                    Not closed
                                                </span>
                                                <h5>{{$notClosedLeads}}</h5>
                                            </div>

                                            <div class="color-picker">
                                                <span class="mb-0 col-8 fs-14">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#2A353A"/>
                                                    </svg>
                                                    No interests
                                                </span>
                                                <h5>{{$noInterestLeads}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ----/column-- -->
                                </div>
                                <!-- --/row-- -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card Upgrade">
                        <div class="card-body d-flex align-items-center ps-0">
                            <div class="d-inline-block position-relative donut-chart-sale ">
                                <div id="redial"></div>
                            </div>
                            <div class="upgread-stroage">
                                <h4 class="fs-20">Unprocessed leads</h4>
                                <p>Percentage of unprocessed leads.</p>
                                <a href="{{route('admin.lead-view', ['lead_status' => 'unprocessed'])}}" class="btn btn-success">Process leads</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div>
                                    <h4 class="fs-28 mb-0">{{number_format($totalLeads)}}</h4>
                                    <span class="fs-18 text-secondary font-w600 mb-3 d-block">Total leads generated.</span>
                                </div>
                                <div class="compose-btn">
                                    <a href="{{route('admin.lead-view')}}" class="btn btn-secondary ">Lead datatable</a>
                                </div>
                            </div>
                            <p class="mb-0">Total number of leads generated by visitors and system administrator.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function($) {
            /* "use strict" */
            let unProcessedLeadCount = '{{!empty($unProcessedLeads) ? number_format(($unProcessedLeads*100)/$totalLeads, 2) : 0}}';
            let unProcessedLeads = '{{$unProcessedLeads}}';
            let appointmentLeads = '{{$appointmentLeads}}';
            let notReachedLeads = '{{$notReachedLeads}}'
            let deadlineLeads = '{{$deadlineLeads}}';
            let closedLeads = '{{$closedLeads}}';
            let notClosedLeads = '{{$notClosedLeads}}';
            let noInterestLeads = '{{$noInterestLeads}}';
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
                        series: [Number(unProcessedLeads),Number(appointmentLeads),Number(notReachedLeads),Number(deadlineLeads),Number(closedLeads),Number(notClosedLeads),Number(noInterestLeads)],
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
                        series: [Number(unProcessedLeadCount)],
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
        $(function () {
            getLatestLead();
        })
        function getLatestLead(){
            axios.get('{{route('admin.dashboard-lead-partial')}}').then(function(res){
                $('.latest_leads_data').empty().append(res.data);
            });
        }
    </script>
@endpush