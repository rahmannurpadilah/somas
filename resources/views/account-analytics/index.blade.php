@extends('admin.layout')
@section('content')
    @include('partials.alert')
    <div class="kt-container-fixed">
        <div class="kt-container-fixed">
            <h1 class="text-xl font-medium leading-none text-mono">
                        Manage User
                    </h1>
            <div class="flex flex-wrap justify-between">
                <div
                    class="kt-card gap-4 p-5 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                    <div class="flex items-center gap-4">
                        <!-- Logo kiri -->
                        <img alt="" class="w-8 h-8" src="{{ asset('assets/media/brand-logos/instagram-03.svg') }}" />

                        <div class="flex flex-col">
                            <span class="text-lg font-semibold text-mono">
                                Platform
                            </span>
                            <span class="text-2xl font-bold text-secondary-foreground">
                                150,000
                            </span>
                        </div>
                    </div>
                </div>

                <div
                    class="kt-card gap-4 p-5 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                    <div class="flex items-center gap-4">
                        <!-- Logo kiri -->
                        <img alt="" class="w-8 h-8"
                            src="{{ asset('assets/media/brand-logos/paper.svg') }}" />

                        <div class="flex flex-col">
                            <span class="text-lg font-semibold text-mono">
                                Total Followers
                            </span>
                            <span class="text-2xl font-bold text-secondary-foreground">
                                 160,000
                            </span>
                        </div>
                    </div>
                </div>

                <div
                    class="kt-card gap-4 p-5 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
                    <div class="flex items-center gap-4">
                        <!-- Logo kiri -->
                        <img alt="" class="w-8 h-8"
                            src="{{ asset('assets/media/brand-logos/pinterest-circle.svg') }}" />

                        <div class="flex flex-col">
                            <span class="text-lg font-semibold text-mono">
                                Content Posted Today
                            </span>
                            <span class="text-2xl font-bold text-secondary-foreground">
                                 3
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="kt-card h-full">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">
                            Post Ratings
                        </h3>
                        <div class="flex gap-5">
                            <label class="flex items-center gap-2">
                                <input class="kt-switch" name="check" type="checkbox" value="1" />
                                <span class="kt-label">
                                    Referrals only
                                </span>
                            </label>
                            <select class="kt-select w-36" data-kt-select="true" data-kt-select-placeholder="Select period"
                                name="kt-select">
                                <option>
                                    None
                                </option>
                                <option value="1">
                                    1 month
                                </option>
                                <option value="2">
                                    3 month
                                </option>
                                <option value="3">
                                    6 month
                                </option>
                                <option value="4">
                                    12 month
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="kt-card-content flex flex-col justify-end items-stretch grow px-3 py-1">
                        <div id="earnings_chart">
                        </div>
                        <div class="mx-5 mb-4">
                            <h2>Daily</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
