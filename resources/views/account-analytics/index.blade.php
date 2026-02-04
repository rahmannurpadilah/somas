 @extends('admin.layout')
@section('content')
    @include('partials.alert')

    <div class="kt-container-fixed">
        <h1 class="text-xl font-medium leading-none text-mono mb-5">
            Account Tracking
        </h1>

        <style>
            .channel-stats-bg {
                background-image: url('{{ asset('assets/media/images/2600x1600/bg-3.png') }}');
            }

            .dark .channel-stats-bg {
                background-image: url('{{ asset('assets/media/images/2600x1600/bg-3-dark.png') }}');
            }
        </style>

        <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">

            <div class="lg:col-span-1">
                <div class="grid grid-cols-2 gap-5 h-full">
                    <div class="kt-card flex flex-col p-5 bg-cover bg-no-repeat channel-stats-bg">
                        <div class="mb-10">
                            {{-- <img alt="" class="w-8 h-8" src="{{ asset('assets/media/brand-logos/instagram-03.svg') }}" /> --}}
                            {{-- <img src="{{ asset('assets/media/brand-logos/' . strtolower($s->platform) . '.svg') }}"
                                                    class="w-3 h-3" alt="{{ $s->platform }}"> --}}
                            <i class="ki-duotone ki-share" style="font-size: 40px;"></i>
                        </div>

                        <div class="mt-auto flex flex-col gap-1">
                            <span
                                class="text-2xl lg:text-3xl font-bold text-mono tracking-tight text-gray-900 dark:text-white">
                                instagram
                            </span>
                            <span
                                class="text-xs font-semibold text-secondary-foreground uppercase tracking-widest opacity-70">
                                Platform
                            </span>
                        </div>
                    </div>


                    <div class="kt-card flex flex-col p-5 bg-cover bg-no-repeat channel-stats-bg">
                        <div class="mb-10">
                            <i class="ki-duotone ki-people text-secondary text-5xl" style="font-size: 40px;"></i>
                        </div>

                        <div class="mt-auto flex flex-col gap-1">
                            <span
                                class="text-2xl lg:text-3xl font-bold text-mono tracking-tight text-gray-900 dark:text-white">
                                24K
                            </span>
                            <span
                                class="text-xs font-semibold text-secondary-foreground uppercase tracking-widest opacity-70">
                                Followers
                            </span>
                        </div>
                    </div>

                    <div class="kt-card flex flex-col p-5 bg-cover bg-no-repeat channel-stats-bg">
                        <div class="mb-10">
                            <i class="ki-duotone ki-users text-secondary text-5xl" style="font-size: 40px;"></i>
                        </div>
                        <div class="mt-auto flex flex-col gap-1">
                            <span
                                class="text-2xl lg:text-3xl font-bold text-mono tracking-tight text-gray-900 dark:text-white">
                                10K
                            </span>
                            <span
                                class="text-xs font-semibold text-secondary-foreground uppercase tracking-widest opacity-70">
                                Following
                            </span>
                        </div>
                    </div>

                    <div class="kt-card flex flex-col p-5 bg-cover bg-no-repeat channel-stats-bg">
                        <div class="mb-10">
                            <i class="ki-duotone ki-like text-primary text-5xl" style="font-size: 40px;"></i>
                        </div>
                        <div class="mt-auto flex flex-col gap-1">
                            <span
                                class="text-2xl lg:text-3xl font-bold text-mono tracking-tight text-gray-900 dark:text-white">
                                1M
                            </span>
                            <span
                                class="text-xs font-semibold text-secondary-foreground uppercase tracking-widest opacity-70">
                                Total Likes
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="kt-card h-full flex flex-col">
                    <div class="kt-card-header flex justify-between items-center px-5 py-4">
                        <h3 class="kt-card-title text-lg font-semibold">Growth Chart</h3>
                         <select class="kt-select w-48 text-sm" id="chart_data_selector">
                                <option value="followers">Followers Count</option>
                                <option value="likes">Total Likes</option>
                                <option value="engagement">Engagement Rate Per-week</option>
                            </select>
                    </div>
                    <div class="kt-card-body grow p-5 flex flex-col justify-center">
                        <div id="post_chart" class="w-full h-[250px]"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
   @push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var element = document.getElementById('post_chart');
        if (!element) return;

        // 1. Data Source (Engagement disetel per minggu/7 hari terakhir)
        const dataSources = {
            followers: {
                name: 'Followers',
                data: [2000, 2100, 2150, 2300, 2400, 2450, 2500],
                categories: ['Feb 01', 'Feb 02', 'Feb 03', 'Feb 04', 'Feb 05', 'Feb 06', 'Feb 07'],
                color: '#0095E8',
                suffix: ' users'
            },
            likes: {
                name: 'Total Likes',
                data: [150, 230, 180, 400, 320, 500, 450],
                categories: ['Feb 01', 'Feb 02', 'Feb 03', 'Feb 04', 'Feb 05', 'Feb 06', 'Feb 07'],
                color: '#F1416C',
                suffix: ' likes'
            },
            engagement: {
                name: 'Engagement Rate',
                data: [3.2, 4.5, 2.9, 5.1],
                categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                color: '#50CD89',
                suffix: '%'
            }
        };

        var options = {
            series: [{
                name: dataSources.followers.name,
                data: dataSources.followers.data
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: 250,
                toolbar: { show: false }
            },
            colors: [dataSources.followers.color],
            fill: {
                type: 'gradient',
                gradient: { opacityFrom: 0.4, opacityTo: 0, stops: [0, 80, 100] }
            },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: dataSources.followers.categories,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#A1A5B7', fontSize: '12px' } }
            },
            yaxis: {
                labels: {
                    style: { colors: '#A1A5B7', fontSize: '12px' },
                    formatter: function (val) { return val; }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        let type = document.getElementById('chart_data_selector').value;
                        return val + dataSources[type].suffix;
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();

        document.getElementById('chart_data_selector').addEventListener('change', function () {
            const selectedValue = this.value;
            const newData = dataSources[selectedValue];

            chart.updateOptions({
                series: [{
                    name: newData.name,
                    data: newData.data
                }],
                colors: [newData.color],
                xaxis: {
                    categories: newData.categories // Ini penting agar sumbu X berubah jadi "Week"
                }
            });
        });
    });
</script>
@endpush

@endsection





