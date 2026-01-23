@extends('admin.layout')

@section('content')

<h1>Content Sources</h1>

@include('partials.alert')

<a href="{{ route('content-source.create') }}">Tambah Data</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Platform</th>
            <th>Type</th>
            <th>Identifier</th>
            <th>Category</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($sources as $source)
            <tr>
                <td>{{ $source->platform }}</td>
                <td>{{ $source->type }}</td>
                <td>{{ $source->identifier }}</td>
                <td>{{ $source->category ?? '-' }}</td>
                <td>{{ $source->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                <td>
                    <a href="{{ route('content-source.edit', Crypt::encrypt($source->id)) }}">
                        Edit
                    </a>

                    <form
                        action="{{ route('content-source.delete', Crypt::encrypt($source->id)) }}"
                        method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?');"
                    >
                        @csrf
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Data belum tersedia</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
