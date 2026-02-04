@extends('admin.layout')
@section('content')
<div class="kt-container-fixed">
    <div class="kt-container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">
                    Prompt Management
                </h1>
            </div>
        </div>
    </div>
    <div class="grid gap-5 lg:gap-7.5">
        <div class="kt-card kt-card-grid min-w-full">
            <div class="kt-card-header flex-wrap gap-2">
                <h3 class="kt-card-title text-sm">
                    Showing {{ $prompts->count() }} prompts
                </h3>
                <div class="flex flex-wrap">
                    <div class="flex">
                        <label class="kt-input">
                            <i class="ki-filled ki-magnifier"></i>
                            <input data-kt-datatable-search="#prompt_table" placeholder="Search Prompts"
                                type="text"/>
                        </label>
                    </div>
                </div>
            </div>

            <div class="kt-card-content">
                <div data-kt-datatable="true" data-kt-datatable-state-save="false" id="prompt_table">
                    <div class="kt-scrollable-x-auto">
                        <table class="kt-table table-auto kt-table-border" data-kt-datatable-table="true">
                            <thead>
                                <tr>
                                    <th class="w-[60px] text-center">
                                        No
                                    </th>
                                    <th class="min-w-[300px]">Name</th>
                                    <th class="min-w-[180px]">Prompt Body</th>
                                    <th class="min-w-[180px]">Is active</th>
                                    <th class="min-w-[180px]">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prompts as $p)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="font-medium text-mono">
                                            {{-- {{ $p->name }} --}}
                                        </td>
                                        <td class="text-mono">
                                            {{-- {{ $p->prompt_body }} --}}
                                        </td>
                                        <td>
                                            <span class="kt-badge kt-badge-outline kt-badge-success">
                                                {{-- {{ $p->is_active ? 'Yes' : 'No' }} --}}
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
                                                                <a href=""
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
                                                                    action=""
                                                                    method="POST" class="inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        onclick="return confirm('Yakin hapus,?')"
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
                                                        </div>
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
    </div>
@endsection
