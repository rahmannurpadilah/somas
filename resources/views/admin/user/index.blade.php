@extends('admin.layout')

@section('content')

@include('partials.alert')

 <div class="kt-container-fixed">
      <div class="grid gap-5 lg:gap-7.5">
       <div class="kt-card kt-card-grid min-w-full">
        <div class="kt-card-header flex-wrap gap-2">
         <h3 class="kt-card-title text-sm">
          Showing 20 of 34 users
         </h3>
         <div class="flex flex-wrap gap-2 lg:gap-5">
          <div class="flex">
           <label class="kt-input">
            <i class="ki-filled ki-magnifier">
            </i>
            <input data-kt-datatable-search="#team_crew_table" placeholder="Search users" type="text" value=""/>
           </label>
          </div>
          <div class="flex flex-wrap gap-2.5">
           <select class="kt-select w-36" data-kt-select="true" data-kt-select-placeholder="Select a status">
            <option value="1">
             Active
            </option>
            <option value="2">
             Disabled
            </option>
            <option value="2">
             Pending
            </option>
           </select>
           <select class="kt-select w-36" data-kt-select="true" data-kt-select-placeholder="Select a sort">
            <option value="1">
             Latest
            </option>
            <option value="2">
             Older
            </option>
            <option value="3">
             Oldest
            </option>
           </select>
           <button class="kt-btn kt-btn-outline kt-btn-primary">
            <i class="ki-filled ki-setting-4">
            </i>
            Filters
           </button>
          </div>
         </div>
        </div>
           <div class="kt-card-content">
         <div data-kt-datatable="true" data-kt-datatable-state-save="false" id="team_crew_table">
          <div class="kt-scrollable-x-auto">
           <table class="kt-table table-auto kt-table-border" data-kt-datatable-table="true">
            <thead>     {{-- TR --}}
             <tr>
             @foreach($users as $u)
              <th class="w-[60px] text-center">
               <input class="kt-checkbox kt-checkbox-sm" data-kt-datatable-check="true" type="checkbox"/>
              </th>
              <th class="min-w-[300px]">
               <span class="kt-table-col">
                <span class="kt-table-col-label">
                 {{$loop->iteration}}
                </span>
                <span class="kt-table-col-sort">
                </span>
               </span>
              </th>
              <th class="min-w-[180px]">
               <span class="kt-table-col">
                <span class="kt-table-col-label">
                 Role
                </span>
                <span class="kt-table-col-sort">
                </span>
               </span>
              </th>
              <th class="min-w-[180px]">
               <span class="kt-table-col">
                <span class="kt-table-col-label">
                 Status
                </span>
                <span class="kt-table-col-sort">
                </span>
               </span>
              </th>
              <th class="min-w-[180px]">
               <span class="kt-table-col">
                <span class="kt-table-col-label">
                 Location
                </span>
                <span class="kt-table-col-sort">
                </span>
               </span>
              </th>
              <th class="min-w-[180px]">
               <span class="kt-table-col">
                {{-- <span class="kt-table-col-label">
                 Action
                </span> --}}
                <span class="kt-table-col-sort">
                </span>
               </span>
              </th>
              <th class="w-[60px]">
              </th>
             </tr>
            </thead>
            <tbody>
                {{-- tbody --}}
             <tr>
             </tr>
            </tbody>
           </table>
          </div>
          <div class="kt-card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-secondary-foreground text-sm font-medium">
           <div class="flex items-center gap-2 order-2 md:order-1">
            Show
            <select class="kt-select w-16" data-kt-datatable-size="true" data-kt-select="" name="perpage">
            </select>
            per page
           </div>
           <div class="flex items-center gap-4 order-1 md:order-2">
            <span data-kt-datatable-info="true">
            </span>
            <div class="kt-datatable-pagination" data-kt-datatable-pagination="true">
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>

     <div class="kt-container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justif-ceter gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">
         Manage User
        </h1>
            </div>
              <div class="flex items-center gap-2.5">
        <a class="kt-btn kt-btn-outline" href="#">
         Import CSV
        </a>
        <a class="kt-btn kt-btn-primary" href="{{ route('admin.user.create') }}">
         Add Users
        </a>
       </div>
        </div>
     </div>

<table border="1" cellpadding="10" cellspacing="0" class="table table-bordered table-responsive">
    <tr class="table-dark">
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    @foreach ($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>
            <a href="{{ route('admin.user.edit', Crypt::encrypt($user->id)) }}">Edit</a>

            <form action="{{ route('admin.user.delete', Crypt::encrypt($user->id)) }}"
                  method="POST"
                  style="display:inline;">
                @csrf
                <button type="submit" onclick="return confirm('Yakin hapus?')">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
