@extends('admin.layout')
@section('content')
    @include('partials.alert')
    <div class="kt-container-fixed">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justif-ceter gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Content Ideas Tables
                    </h1>
                </div>
                {{-- <div class="flex items-center">
                    <a href="{{ route('content-ideas.calendar') }}" class="kt-btn kt-btn-primary">
                        Calendar View
                    </a>
                </div> --}}
            </div>
        </div>

        <div class="grid gap-5 lg:gap-7.5">
            <div class="kt-card kt-card-grid min-w-full">
                <div class="kt-card-header flex-wrap gap-2">
                    <h3 class="kt-card-title text-sm">
                        Showing 4 ideas
                    </h3>
                    <div class="flex flex-wrap">
                        <div class="flex">
                            <label class="kt-input">
                                <i class="ki-filled ki-magnifier"></i>
                                <input data-kt-datatable-search="#team_crew_table" placeholder="Search Contentideas"
                                    type="text" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="kt-card-content">
                    <div data-kt-datatable="true" data-kt-datatable-state-save="false" id="team_crew_table">
                        <div class="kt-scrollable-x-auto">
                            <table class="kt-table table-auto kt-table-border" data-kt-datatable-table="true">
                                <thead>
                                    <tr>
                                        <th class="w-[60px] text-center">
                                            No
                                        </th>
                                        <th class="min-w-[300px]">Platform</th>
                                        <th class="min-w-[180px]">Original Url</th>
                                        <th class="min-w-[180px]">Original Caption</th>
                                        <th class="min-w-[180px]">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($content as $c)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="font-medium text-mono">
                                                {{ $c->platform }}<br>
                                                <span class="text-sm text-secondary-foreground"></span>
                                            </td>
                                            <td>{{ $c->original_url }}</td>
                                            <td>
                                                <span class="kt-badge kt-badge-outline kt-badge-primary">
                                                    {{ $c->original_caption }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="kt-menu flex-inline" data-kt-menu="true">
                                                    <div class="kt-menu-item" data-kt-menu-item-offset="0, 10px"
                                                        data-kt-menu-item-placement="bottom-end"
                                                        data-kt-menu-item-placement-rtl="bottom-start"
                                                        data-kt-menu-item-toggle="dropdown"
                                                        data-kt-menu-item-trigger="click">
                                                        <button
                                                            class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                                            <i class="ki-filled ki-dots-vertical text-lg">
                                                            </i>
                                                        </button>
                                                        <div class="kt-menu-dropdown kt-menu-default w-full max-w-[175px]"
                                                            data-kt-menu-dismiss="true">
                                                            <div class="kt-menu-item">
                                                                <a class="kt-menu-link"
                                                                    href="{{ route('content-ideas.details', $c->id) }}">
                                                                    <span class="kt-menu-icon">
                                                                        <i class="ki-filled ki-pencil">
                                                                        </i>
                                                                    </span>
                                                                    <span class="kt-menu-title">
                                                                        Details
                                                                    </span>
                                                                </a>
                                                                <a href="{{ route('content-ideas.calendar') }}"
                                                                    class="kt-menu-link">
                                                                        <span class="kt-menu-icon">
                                                                        <i class="ki-filled ki-calendar">
                                                                        </i>
                                                                    </span>
                                                                    <span class="kt-menu-title">
                                                                        Calendar View
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="kt-card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-secondary-foreground text-sm font-medium">
                            <div class="flex items-center gap-2 order-2 md:order-1">
                                Show
                                <select class="kt-select w-16" data-kt-datatable-size="true" name="perpage"></select>
                                per page
                            </div>
                            <div class="flex items-center gap-4 order-1 md:order-2">
                                <span data-kt-datatable-info="true"></span>
                                <div class="kt-datatable-pagination" data-kt-datatable-pagination="true"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
