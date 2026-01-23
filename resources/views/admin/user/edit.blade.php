@extends('admin.layout')

@section('content')

@include('partials.alert')
<div class="kt-container-fixed">
    <div class="grid gap-5 lg:gap-7.5">
        <div class="kt-card max-w-2xl">

            <div class="kt-card-header">
                <h3 class="kt-card-title">
                    Edit User
                </h3>
            </div>

            <div class="kt-card-content">
                <form action="{{ route('admin.user.update') }}" method="POST" class="grid gap-5">
                    @csrf

                    <input type="hidden" name="hash" value="{{ $hash }}">

                    <div class="grid gap-1.5">
                        <label class="kt-form-label">Nama</label>
                        <input
                            type="text"
                            name="name"
                            class="kt-input"
                            value="{{ $user->name }}"
                            required
                        >
                    </div>

                    <div class="grid gap-1.5">
                        <label class="kt-form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="kt-input"
                            value="{{ $user->email }}"
                            required
                        >
                    </div>

                    <div class="grid gap-1.5">
                        <label class="kt-form-label">
                            Password
                            <span class="text-xs text-muted-foreground">
                                (kosongkan jika tidak diubah)
                            </span>
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="kt-input"
                        >
                    </div>

                    <div class="grid gap-1.5">
                        <label class="kt-form-label">Role</label>
                        <select name="role" class="kt-select">
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                User
                            </option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                        </select>
                    </div>

                    <div class="flex items-center gap-2 pt-4">
                        <button type="submit" class="kt-btn kt-btn-primary">
                            Update
                        </button>

                        <a href="{{ route('admin.user.index') }}" class="kt-btn kt-btn-outline">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
