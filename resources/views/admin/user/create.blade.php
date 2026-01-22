@extends('admin.layout')

@section('content')

<h3>Create User</h3>

@include('partials.alert')

<form action="{{ route('admin.user.make') }}" method="POST">
    @csrf

    <div>
        <label>Nama</label><br>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Role</label><br>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <button type="submit">Simpan</button>
</form>

@endsection
