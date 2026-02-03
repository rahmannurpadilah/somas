@extends('admin.layout')
@section('content')
@include('partials.alert')

<div class="kt-container-fixed">
    <div class="flex flex-col gap-5">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Account Management</h1>
            {{-- <nav class="text-sm text-gray-500">
                <a href="#" class="hover:text-primary">Dashboard</a> / <span class="text-gray-400">Add Account</span>
            </nav> --}}
        </div>

        <div class="kt-card overflow-hidden shadow-sm">
            <div class="grid lg:grid-cols-3">
                <div class="bg-light dark:bg-coal-100 p-8 lg:p-12 border-b lg:border-b-0 lg:border-r border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col gap-5">
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-primary/10 text-primary">
                            <i class="ki-duotone ki-user-tick fs-1">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                            </i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Connect Account</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed">
                                Masukkan username akun sosial media Anda untuk mulai memantau analitik secara real-time.
                            </p>
                        </div>
                        <ul class="flex flex-col gap-3 text-xs text-gray-500">
                            <li class="flex items-center gap-2">
                                <i class="ki-duotone ki-check-circle text-success"><span class="path1"></span><span class="path2"></span></i>
                                Mendukung Instagram & TikTok
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ki-duotone ki-check-circle text-success"><span class="path1"></span><span class="path2"></span></i>
                                Update data setiap 24 jam
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="lg:col-span-2 p-8 lg:p-12 channel-stats-bg bg-cover bg-no-repeat">
                    <form action="" method="post" enctype="multipart/form-data" class="flex flex-col gap-8">
                        @csrf
                        <div class="grid gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-bold text-gray-700 dark:text-gray-300">Username</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">@</span>
                                    <input type="text" class="kt-input pl-10 bg-white/60 dark:bg-black/20 backdrop-blur-sm focus:bg-white" placeholder="username" required>
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-bold text-gray-700 dark:text-gray-300">Platform</label>
                                <select name="platform" class="kt-select bg-white/60 dark:bg-black/20 backdrop-blur-sm">
                                    <option value="instagram">Instagram</option>
                                    <option value="tiktok">Tiktok</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200/50 dark:border-gray-700/50">
                            <a href="{{ route('account-analytics.index') }}" class="kt-btn kt-btn-light btn-sm">Cancel</a>
                            <button type="submit" class="kt-btn kt-btn-primary btn-sm px-8 shadow-lg shadow-primary/20">
                                <i class="ki-duotone ki-save-2 fs-3"><span class="path1"></span><span class="path2"></span></i>
                                Simpan Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .channel-stats-bg {
        background-image: url('{{ asset('assets/media/images/2600x1600/bg-3.png') }}');
        background-position: right bottom;
    }
    .dark .channel-stats-bg {
        background-image: url('{{ asset('assets/media/images/2600x1600/bg-3-dark.png') }}');
    }
    .kt-input:focus {
        border-color: var(--kt-primary) !important;
        box-shadow: 0 0 0 3px rgba(0, 149, 232, 0.1);
    }
</style>
@endsection
