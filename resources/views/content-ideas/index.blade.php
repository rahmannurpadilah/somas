@extends('admin.layout')
@section('content')
    <div class="kt-container-fixed">
        <div class="kt-container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justif-ceter gap-2">
                    <h1 class="text-xl font-medium leading-none text-mono">
                        Content Ideas
                    </h1>
                </div>
                <div class="flex items-center">
                    <button type="button" class="kt-btn kt-btn-primary" data-kt-drawer-toggle="#admin_drawer">
                        Admin Curation
                    </button>
                </div>

            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Original --}}
            <div class="kt-card">
                <div class="kt-card-content lg:pt-9 lg:pb-7.5">
                    @if ($detail)

                                <div class="flex flex-col gap-1 mb-4">
                                    <h3 class="text-xl text-mono">Original Content</h3>
                                    <a class="text-sm text-primary font-medium" href="{{ $detail->original_url }}">
                                        {{ $detail->original_url }}
                                    </a>
                                </div>


                                <div class="flex items-start gap-2 text-sm text-secondary-foreground mb-3">
                                    <i class="ki-filled ki-abstract-41 text-muted-foreground mt-0.5"></i>
                                    <span>{{ $detail->original_caption }}</span>
                                </div>

                                <div class="flex items-start gap-2 text-sm text-secondary-foreground mb-6">
                                    Likes:
                                    <i class="ki-filled ki-sms text-muted-foreground mt-0.5"></i>
                                    <span>{{ $detail->original_stats['likes'] }}</span>
                                </div>

                                <div class="flex items-start gap-2 text-sm text-secondary-foreground mb-6">
                                    View:
                                    <i class="ki-filled ki-sms text-muted-foreground mt-0.5"></i>
                                    <span>{{ $detail->original_stats['views'] }}</span>
                                </div>
                            </div>

                            <div class="kt-card-footer">
                                <a class="kt-btn kt-btn-outline w-full">
                                    <i class="ki-filled ki-check-circle"></i>
                                    -
                                </a>
                            </div>
                        </div>

                        {{-- AI Generate --}}
                        <div class="kt-card">
                            <div class="kt-card-content lg:pt-9 lg:pb-7.5">

                                <div class="flex flex-col gap-1 mb-4">
                                    <h3 class="text-xl text-mono">AI Generated Content</h3>
                                    <span class="kt-badge kt-badge-sm kt-badge-success w-fit">
                                        AI
                                    </span>
                                </div>

                                <div class="mb-5">
                                    <p class="text-sm text-secondary-foreground leading-relaxed">
                                        {{ $detail->ai_generated_caption }}
                                    </p>
                                </div>

                                <div class="flex flex-col gap-3">
                                    <div class="border-dashed border rounded-md px-3 py-2">
                                        <span class="text-mono text-sm font-medium">ai generated script</span>
                                        <div class="text-xs text-secondary-foreground">{{ $detail->ai_generated_script }}</div>
                                    </div>

                                    <div class="border-dashed border rounded-md px-3 py-2">
                                        <span class="text-mono text-sm font-medium">ai status</span>
                                        <div class="text-xs text-secondary-foreground">{{ $detail->ai_status }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-card-footer flex">
                                <a class="kt-btn kt-btn-primary w-full">Approve</a>
                                {{-- <a class="kt-btn kt-btn-outline w-full">Regenerate</a> --}}
                            </div>
                    @endif

            </div>
        </div>
    </div>

    <div class="hidden kt-drawer kt-drawer-end card flex-col max-w-[90%] w-[450px] top-5 bottom-5 end-5 rounded-xl border border-border"
        data-kt-drawer="true" data-kt-drawer-container="body" id="admin_drawer">

        <div class="flex items-center justify-between px-5 py-3.5 border-b border-border">
            <h3 class="text-sm font-semibold text-mono">Admin Curation</h3>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-dim" data-kt-drawer-dismiss="true">
                <i class="ki-filled ki-cross"></i>
            </button>
        </div>

        <form method="POST" action="" class="flex flex-col grow overflow-y-auto px-5 py-4 gap-4">
            @csrf

            <div class="grid gap-1.5">
                <label class="kt-form-label">Final Caption</label>
                <textarea name="final_caption" class="kt-textarea w-full" rows="3"></textarea>
            </div>

            <div class="grid gap-1.5">
                <label class="kt-form-label">Final Media Path</label>
                <input type="text" name="final_media_path" class="kt-input w-full">
            </div>

            <div class="grid gap-1.5">
                <label class="kt-form-label">Admin Notes</label>
                <textarea name="admin_notes" class="kt-textarea w-full" rows="2"></textarea>
            </div>

            <div class="grid gap-1.5">
                <label class="kt-form-label">Status</label>
                <select name="status" class="kt-select w-full">
                    <option value="">Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="process">Process</option>
                    <option value="success">Success</option>
                    <option value="failed">Failed</option>
                </select>
            </div>

            <div class="grid gap-1.5">
                <label for="recorded_at">Tanggal</label>
                <input type="hidden" name="tanggal" value="">
                <div id="calendar"></div>
            </div>

            <div class="mt-4">
                <button type="submit" class="kt-btn kt-btn-primary w-full">
                    <i class="ki-filled ki-search-list"></i>
                    Approve
                </button>
            </div>
        </form>
    </div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css">
<style>
    #calendar {
        max-width: 100%;
    }
    .fc {
        font-family: inherit;
    }
    .fc .fc-button-primary {
        background-color: #3b82f6 !important;
        border-color: #3b82f6 !important;
    }
    .fc .fc-button-primary:hover {
        background-color: #2563eb !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            selectable: true,
            select: function(info) {
                document.querySelector('input[name="tanggal"]').value = info.startStr;
            }
        });
        calendar.render();
    });
</script>
@endpush
@endsection


