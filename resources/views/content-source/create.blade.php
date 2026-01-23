@extends('admin.layout')
@section('content')

<h1>Tambah Content Source</h1>

@include('partials.alert')

<form method="POST" action="{{ route('content-source.make') }}">
    @csrf

    <p>
        Platform:
        <select name="platform">
            <option value="instagram">Instagram</option>
            <option value="tiktok">TikTok</option>
        </select>
    </p>

    <p>
        Type:
        <select name="type">
            <option value="username">Username</option>
            <option value="hashtag">Hashtag</option>
        </select>
    </p>

    <p>
        Identifier:
        <input type="text" name="identifier">
    </p>

    <p>
        Category:
        <input type="text" name="category">
    </p>

    <button type="submit">Simpan</button>
</form>

@endsection
