@extends('admin.layout')

@section('content')

<a href="{{ route('admin.user.create') }}">Create User</a>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
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
