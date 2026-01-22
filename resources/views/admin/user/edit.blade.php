@extends('admin.layout')

@section('content')

<h3>Edit User</h3>

@include('partials.alert')


<form action="{{ route('admin.user.update') }}" method="POST">
    @csrf

    <input type="hidden" name="hash" value="{{ $hash }}">

    <div>
        <label>Nama</label><br>
        <input type="text" name="name" value="{{ $user->name }}" required>
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ $user->email }}" required>
    </div>

    <div>
        <label>Password (kosongkan jika tidak diubah)</label><br>
        <input type="password" name="password">
    </div>

    <div>
        <label>Role</label><br>
        <select name="role">
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <button type="submit">Update</button>
</form>

@endsection
