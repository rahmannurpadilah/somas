@extends('admin.layout')

@section('content')
    @include('partials.alert')

    <div class="kt-container-fixed">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justif-ceter gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Manage User
                    </h1>
                </div>
                <div class="flex items-center">
                    {{-- <a class="kt-btn kt-btn-outline" href="#">
                        Import CSV
                    </a> --}}
                    <a class="kt-btn kt-btn-primary" href="{{ route('admin.user.create') }}">
                        Add Users
                        <i class="ki-filled ki-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-5 lg:gap-7.5">
            <div class="kt-card kt-card-grid min-w-full">
                <div class="kt-card-header flex-wrap gap-2">
                    <h3 class="kt-card-title text-sm">
                        Showing {{ $users->count() }} users
                    </h3>
                    <div class="flex flex-wrap">
                        <div class="flex">
                            <label class="kt-input">
                                <i class="ki-filled ki-magnifier"></i>
                                <input data-kt-datatable-search="#team_crew_table" placeholder="Search users"
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
                                        <th class="min-w-[300px]">Name</th>
                                        <th class="min-w-[180px]">Email</th>
                                        <th class="min-w-[180px]">Role</th>
                                        <th class="min-w-[180px]">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="font-medium text-mono">
                                                {{ $user->name }}<br>
                                                <span class="text-sm text-secondary-foreground"></span>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="kt-badge kt-badge-outline kt-badge-primary">
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                            
                                            <td>
                                                <a href="{{ route('admin.user.edit', Crypt::encrypt($user->id)) }}"
                                                    class="kt-btn kt-btn-sm kt-btn-outline kt-btn-primary">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.user.delete', Crypt::encrypt($user->id)) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Yakin hapus, {{ $user->name }} dari users?')"
                                                        class="kt-btn kt-btn-sm kt-btn-outline kt-btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
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
