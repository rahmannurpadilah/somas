@if ($errors->any())
<div class="flex justify-center">
    <div class="kt-alert kt-alert-danger mb-5 flex items-start justify-between gap-3  max-w-2xl w-full">
        <ul class="list-disc pl-5 flex-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button
            type="button"
            onclick="this.parentElement.remove()"
            class="text-lg font-bold leading-none opacity-60 hover:opacity-100"
            aria-label="Close"
        >
            &times;
        </button>
    </div>
</div>
@endif

@if (session('success'))
<div class="flex justify-center">
    <div class="kt-alert kt-alert-success mb-5 flex items-center justify-between gap-3  max-w-2xl w-full">
        <span>{{ session('success') }}</span>
        <button
            type="button"
            onclick="this.parentElement.remove()"
            class="font-bold leading-none opacity-60 hover:opacity-100"
            aria-label="Close"
        >
            &times;
        </button>
    </div>
</div>
@endif

@if (session('error'))
<div class="flex justify-center">
    <div class="kt-alert kt-alert-danger mb-5 flex items-center justify-between gap-3  max-w-2xl w-full">
        <span>{{ session('error') }}</span>

        <button
            type="button"
            onclick="this.parentElement.remove()"
            class="text-lg font-bold leading-none opacity-60 hover:opacity-100"
            aria-label="Close"
        >
            &times;
        </button>
    </div>
</div>
@endif
