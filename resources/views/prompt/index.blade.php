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
                                type="text" />
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
                                        <td></td>
                                            <a href="" class="kt btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! me-2.5">
                                                <i class="ki-filled ki-pencil text-muted-foreground"></i>
                                            </a>
                                            <form action="" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="kt btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent!">
                                                    <i class="ki-filled ki-trash text-muted-foreground"></i>
                                                </button>
                                            </form>
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
