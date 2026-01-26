@extends('admin.layout')
@section('content')

@include('partials.alert')
<div class="kt-container-fixed">
      <div class="grid gap-5 lg:gap-7.5">
        <div class="kt-card max-w-2xl">

            <div class="kt-card-header">
                <h3 class="kt-card-title">
                    Add New Source Content
                </h3>
            </div>

            <div class="kt-card-content">
                <form action="{{ route('content-source.make') }}" method="POST" class="grid gap-5">
                    @csrf

                     <div class="grid gap-1.5">
                        <label class="kt-form-label">Platform</label>
                        <select name="platform" class="kt-select">
                            <option value="instagram">
                                Instagram
                            </option>
                            <option value="tiktok">
                                Tiktok
                            </option>
                        </select>
                    </div>

                     <div class="grid gap-1.5">
                        <label class="kt-form-label">Type</label>
                        <select name="type" class="kt-select">
                            <option value="username">
                                Username
                            </option>
                            <option value="hashtag">
                                Hashtag
                            </option>
                        </select>
                    </div>
                    
                    <div class="grid gap-1.5">
                        <label class="kt-form-label">Identifier</label>
                        <input
                            type="text"
                            name="identifier"
                            class="kt-input"
                            required
                        >
                    </div>

                    <div class="grid gap-1.5">
                        <label class="kt-form-label">Category</label>
                        <input
                            type="text"
                            name="category"
                            class="kt-input"
                            required
                        >
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
