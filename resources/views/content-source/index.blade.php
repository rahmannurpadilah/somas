@extends('admin.layout')

@section('content')
    @include('partials.alert')

    <div class="kt-container-fixed">

        <div class="flex items-center justify-between pb-6">
            <h1 class="text-xl font-medium text-mono">Content Source</h1>

            <a href="{{ route('content-source.create') }}" class="kt-btn kt-btn-primary">
                Add Content Source
                <i class="ki-filled ki-plus ml-1"></i>
            </a>
        </div>

        <div class="grid gap-5 lg:gap-7.5">
            <div class="kt-card kt-card-grid min-w-full">
                <div class="kt-card-header flex-wrap gap-2">
                    <h3 class="kt-card-title text-sm">
                        Showing {{ $sources->count() }} Content Source
                    </h3>
                    <div class="flex flex-wrap">
                        <div class="flex">
                            <label class="kt-input">
                                <i class="ki-filled ki-magnifier"></i>
                                <input data-kt-datatable-search="#team_crew_table" placeholder="Search content"
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
                                        <th class="min-w-[180px]">Type</th>
                                        <th class="min-w-[180px]">Identifier</th>
                                        <th class="min-w-[180px]">Category</th>
                                        <th class="min-w-[180px]">Status</th>
                                        <th class="min-w-[180px]">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sources as $s)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="font-medium text-mono">
                                                <div class="flex items-center gap-2">
                                                     <img src="{{ asset('assets/media/brand-logos/' . strtolower($s->platform) . '.svg') }}"
                                                    class="w-6 h-6 shrink-0" alt="{{ $s->platform }}">
                                                {{ $s->platform }}
                                                </div>
                                                <br>
                                                <span class="text-sm text-secondary-foreground"></span>
                                            </td>
                                            <td>{{ $s->type }}</td>
                                            <td>
                                                <span class="kt-badge kt-badge-outline kt-badge-success">
                                                    {{ $s->identifier }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="kt-badge kt-badge-outline kt-badge-info">
                                                    {{ $s->category ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="kt-badge kt-badge-outline kt-badge-warning">
                                                    {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="kt-menu flex-inline" data-kt-menu="true">
                                                    <div class="kt-menu-item" data-kt-menu-item-offset="0, 10px"
                                                        data-kt-menu-item-placement="bottom-end"
                                                        data-kt-menu-item-placement-rtl="bottom-start"
                                                        data-kt-menu-item-toggle="dropdown" data-kt-menu-item-trigger="click">
                                                        <button
                                                            class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                                            <i class="ki-filled ki-dots-vertical text-lg">
                                                            </i>
                                                        </button>
                                                        <div class="kt-menu-dropdown kt-menu-default w-full max-w-[175px]"
                                                            data-kt-menu-dismiss="true">
                                                            <div class="kt-menu-item">
                                                                <a href="{{ route('content-source.edit', Crypt::encrypt($s->id)) }}"
                                                                    class="kt-menu-link">
                                                                    <span class="kt-menu-icon">
                                                                        <i class="ki-filled ki-pencil">
                                                                        </i>
                                                                    </span>
                                                                    <span class="kt-menu-title">
                                                                        Edit
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            <div class="kt-menu-item">
                                                                <form
                                                                    action="{{ route('content-source.delete', Crypt::encrypt($s->id)) }}"
                                                                    method="POST" class="inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        onclick="return confirm('Yakin hapus, {{ $s->identifier }} dari sources?')"
                                                                        class="kt-menu-link">
                                                                        <span class="kt-menu-icon">
                                                                            <i class="ki-filled ki-trash">
                                                                            </i>
                                                                        </span>
                                                                        <span class="kt-menu-title">
                                                                            Remove
                                                                        </span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div class="kt-menu-item">
                                                                <form method="POST"
                                                                    action="{{ route('scrape', Crypt::encrypt($s->id)) }}">
                                                                    @csrf
                                                                    <button class="kt-menu-link">
                                                                        <span class="kt-menu-icon">
                                                                            <i class="ki-filled ki-search-list">
                                                                            </i>
                                                                        </span>
                                                                        <span class="kt-menu-title">
                                                                            Scrap Sekarang
                                                                        </span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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

        {{-- <div class="space-y-2 w-full flex-col row">
            @foreach ($sources as $s)
            <div class="kt-card border border-gray-200 w-full">
                <div class="kt-card-content px-4 py-2 w-full">
                    <div class="flex items-center justify-between text-sm w-full">

                        <div class="flex items-center gap-2 w-[220px] shrink-0">
                            <img src="{{ asset('assets/media/brand-logos/' . strtolower($s->platform) . '.svg') }}"
                                class="w-7 h-7" alt="{{ $s->platform }}">
                            <span class="font-medium whitespace-nowrap">
                                {{ $s->platform }}
                            </span>
                        </div>

                        <div class="flex-1">
                            <span class="px-2 py-0.5 border border-green-500 text-green-600 rounded text-xs">
                                {{ $s->identifier }}
                            </span>
                        </div>

                        <div class="flex items-center gap-3 w-[160px] shrink-0">
                            <span class="text-green-500">
                                Active
                            </span>

                            <input type="checkbox" checked class="accent-blue-500">
                        </div>

                        <div class="w-[60px] text-right shrink-0">
                            <a href="{{ route('content-source.edit', $s->id) }}" class="text-blue-500 hover:underline">
                                Edit
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div> --}}
