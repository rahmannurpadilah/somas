@extends('admin.layout')
@section('content')
    @include('partials.alert')
    <div class="kt-container-fixed">
        <div class="grid gap-5 lg:gap-7.5">
            <div class="kt-card max-w-2xl">

                <div class="kt-card-header">
                    <h3 class="kt-card-title">
                        Edit Content Source
                    </h3>
                </div>

                <div class="kt-card-content">
                    <form action="{{ route('content-source.update') }}" method="POST" class="grid gap-5">
                        @csrf

                        <input type="hidden" name="hash" value="{{ $hash }}">


                        <div class="grid gap-1.5">
                            <label class="kt-form-label">Platform</label>
                            <select name="platform" class="kt-select">
                                <option value="instagram" {{ $source->platform == 'instagram' ? 'selected' : ''  }}>
                                    Instagram
                                </option>
                                <option value="tiktok" {{ $source->platform == 'tiktok' ? 'selected' : '' }}>
                                    Tiktok
                                </option>
                            </select>
                        </div>

                        <div class="grid gap-1.5">
                            <label class="kt-form-label">Type</label>
                            <select name="type" class="kt-select">
                                <option value="username" {{ $source->type == 'username' ? 'selected' : '' }}>
                                    Username
                                </option>
                                <option value="hashtag" {{ $source->type == 'hashtag' ? 'selected' : '' }}>
                                    Hashtag
                                </option>
                            </select>
                        </div>

                        <div class="grid gap-1.5">
                            <label class="kt-form-label">Identifier</label>
                            <input type="text" name="identifier" class="kt-input" value="{{ $source->identifier }}" required>
                        </div>

                        <div class="grid gap-1.5">
                            <label class="kt-form-label">Category</label>
                            <input type="text" name="category" class="kt-input" value="{{ $source->category }}" required>
                        </div>

                            <div class="grid gap-1.5">
                                <select name="is_active" class="kt-select">
                                    <option value="1" {{ $source->is_active  ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ $source->is_active ? 'selected' : '' }}>Nonaktif
                                    </option>
                                </select>
                                {{-- <div class="flex items-center justify-between flex-wrap gap-2 px-5 py-3.5">
                                    <div class="flex items-center flex-wrap gap-2">
                                        <label class="kt-form-label">Status</label>
                                    </div>
                                    <div class="flex items-center gap-2 lg:gap-5">
                                        <input checked type="checkbox" class="kt-switch" value="1"{{ $source->is_active ? 'chechked' : '' }}>
                                </div>
                            </div> --}}
                        </div>

                        <div class="flex items-center gap-2 pt-4">
                            <button type="submit" class="kt-btn kt-btn-primary">
                                Simpan
                            </button>

                            <a href="{{ route('content-source.index') }}" class="kt-btn kt-btn-outline">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
