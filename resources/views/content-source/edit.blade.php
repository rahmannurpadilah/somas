@extends('admin.layout')
@section('content')

<h1>Edit Content Source</h1>

@include('partials.alert')

<form method="POST" action="{{ route('content-source.update') }}">
    @csrf

    <input type="hidden" name="hash" value="{{ $hash }}">

    <p>
        Platform:
        <select name="platform">
            <option value="instagram" {{ $source->platform == 'instagram' ? 'selected' : '' }}>Instagram</option>
            <option value="tiktok" {{ $source->platform == 'tiktok' ? 'selected' : '' }}>TikTok</option>
        </select>
    </p>

    <p>
        Type:
        <select name="type">
            <option value="username" {{ $source->type == 'username' ? 'selected' : '' }}>Username</option>
            <option value="hashtag" {{ $source->type == 'hashtag' ? 'selected' : '' }}>Hashtag</option>
        </select>
    </p>

    <p>
        Identifier:
        <input type="text" name="identifier" value="{{ $source->identifier }}">
    </p>

    <p>
        Category:
        <input type="text" name="category" value="{{ $source->category }}">
    </p>

    <p>
        Status:
        <select name="is_active">
            <option value="1" {{ $source->is_active ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !$source->is_active ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </p>

    <button type="submit">Update</button>
</form>

@endsection
