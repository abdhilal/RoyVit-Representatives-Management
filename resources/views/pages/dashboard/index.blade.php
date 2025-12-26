@extends('layouts.app')
@section('title')
    {{ __('dashboard') }}
@endsection
@section('breadcrumb')
    {{ __('dashboard') }}
@endsection
@section('breadcrumbActive')
    {{ __('dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @php
                $totalVisits = $data['doctorVisitsAll'] ?? 0;
                $pZero = $totalVisits ? round(($data['doctorVisitsZero'] / $totalVisits) * 100, 2) : 0;
                $pOne = $totalVisits ? round(($data['doctorVisitsOne'] / $totalVisits) * 100, 2) : 0;
                $pTwo = $totalVisits ? round(($data['doctorVisitsTwo'] / $totalVisits) * 100, 2) : 0;
                $pThree = $totalVisits ? round(($data['doctorVisitsThree'] / $totalVisits) * 100, 2) : 0;
                $pFour = $totalVisits ? round(($data['doctorVisitsFour'] / $totalVisits) * 100, 2) : 0;
                $pFive = $totalVisits ? round(($data['doctorVisitsFive'] / $totalVisits) * 100, 2) : 0;
            @endphp





            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Quick buttons') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row row-cols-2 g-3">
                        @can('create-doctor_visits')
                            <div class="col">
                                <a href="{{ route('doctorVisits.create') }}" class="btn btn-outline-primary btn-lg w-100 py-3 shadow-sm rounded-3 d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-solid fa-stethoscope"></i>{{ __('Register a new visit') }}
                                </a>
                            </div>
                        @endcan
                        @can('create-doctors')
                            <div class="col">
                                <a href="{{ route('doctors.create') }}" class="btn btn-outline-success btn-lg w-100 py-3 shadow-sm rounded-3 d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-solid fa-user-doctor"></i>{{ __('Add New Doctor') }}
                                </a>
                            </div>
                        @endcan
                        <div class="col">
                            <a href="{{ route('representativeStores.onlyshow') }}" class="btn btn-outline-info btn-lg w-100 py-3 shadow-sm rounded-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-solid fa-warehouse"></i>{{ __('My storehouse') }}
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('doctorVisits.index') }}" class="btn btn-outline-dark btn-lg w-100 py-3 shadow-sm rounded-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-solid fa-list"></i>{{ __('My visits') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card text-center p-3">
                <div class="row mb-3 p-2 bg-primary text-white">
                    <div class="col-12 text-center">
                        <h4><b>{{ __('Total Visits') . ' ' . $data['totalVisits'] }}</b></h4>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-6 col-md-4">
                        <b>{{ __('They were visited zero times') }}</b>
                        <div class="flot-chart-placeholder mt-3" id="donut-zero"></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <b>{{ __('They were visited once') }}</b>
                        <div class="flot-chart-placeholder mt-3" id="donut-one"></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <b>{{ __('They were visited twice') }}</b>
                        <div class="flot-chart-placeholder mt-3" id="donut-two"></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <b>{{ __('They were visited three times') }}</b>
                        <div class="flot-chart-placeholder mt-3" id="donut-three"></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <b>{{ __('They were visited four times') }}</b>
                        <div class="flot-chart-placeholder mt-3" id="donut-four"></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <b>{{ __('They were visited five times') }}</b>
                        <div class="flot-chart-placeholder mt-3" id="donut-five"></div>
                    </div>
                </div>
            </div>



        </div>

    </div>
    </div>

    @push('scripts')
        <script>
            (function() {
                var charts = [{
                        id: '#donut-five',
                        percent: {{ $pFive }},
                        title: '{{ $data['doctorVisitsFive'] ?? 0 }} ' + '{{ __('Visit') }}'
                    },
                    {
                        id: '#donut-four',
                        percent: {{ $pFour }},
                        title: '{{ $data['doctorVisitsFour'] ?? 0 }} ' + '{{ __('Visit') }}'
                    },
                    {
                        id: '#donut-three',
                        percent: {{ $pThree }},
                        title: '{{ $data['doctorVisitsThree'] ?? 0 }} ' + '{{ __('Visit') }}'
                    },
                    {
                        id: '#donut-two',
                        percent: {{ $pTwo }},
                        title: '{{ $data['doctorVisitsTwo'] ?? 0 }} ' + '{{ __('Visit') }}'
                    },
                    {
                        id: '#donut-one',
                        percent: {{ $pOne }},
                        title: '{{ $data['doctorVisitsOne'] ?? 0 }} ' + '{{ __('Visit') }}'
                    },
                    {
                        id: '#donut-zero',
                        percent: {{ $pZero }},
                        title: '{{ $data['doctorVisitsZero'] ?? 0 }} ' + '{{ __('Visit') }}'
                    },
                ];
                charts.forEach(function(c) {
                    var p = Math.max(0, Math.min(100, c.percent));
                    var textPercent = (Math.round(p * 100) / 100).toFixed(2).replace(/\.00$/, '') + '%';
                    var options = {
                        chart: {
                            type: 'donut',
                            height: 180,
                            events: {
                                animationEnd: function(ctx) {
                                    try {
                                        if (p > 0) {
                                            ctx.toggleDataPointSelection(0);
                                            ctx.toggleDataPointSelection(0);
                                            ctx.toggleDataPointSelection(0);
                                        }
                                    } catch (e) {}
                                }
                            }
                        },
                        series: [p, 100 - p],
                        labels: ["{{ __('Percentage') }}", "{{ __('Remainder') }}"],
                        dataLabels: {
                            enabled: true
                        },
                        legend: {
                            show: false
                        },
                        colors: ['#3eb95f', '#e74b2b'],
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '65%',
                                    labels: {
                                        show: true,
                                        name: {
                                            show: true,
                                            fontSize: '15px',
                                            fontWeight: 700,
                                            color: '#adb5bd',
                                            formatter: function() {
                                                return c.title;
                                            }
                                        },
                                        value: {
                                            show: true,
                                            fontSize: '15px',
                                            fontWeight: 700,
                                            formatter: function() {
                                                return textPercent;
                                            }
                                        },
                                        total: {
                                            show: false
                                        }
                                    }
                                }
                            }
                        }
                    };
                    var el = document.querySelector(c.id);
                    if (el) {
                        var chart = new ApexCharts(el, options);
                        chart.render();
                    }
                });
            })();
        </script>
    @endpush
@endsection
