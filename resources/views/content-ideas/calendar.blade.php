@extends('admin.layout')
@section('content')
<div class="kt-container-fixed">
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-xl font-medium text-mono">Content Calendar</h1>

        <a href="{{ route('content-ideas.index') }}" class="kt-btn kt-btn-outline">
            Back to Table
        </a>
    </div>

    <div class="kt-card !overflow-visible">
        <div class="kt-card-content">
            <div id="calendar"></div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css">
@endpush

@php
$calendarEvents = $contents->map(function ($c) {
    return [
        'id'    => $c->id,
        'title' => $c->platform,
        'start' => $c->tanggal,
        'extendedProps' => [
            'caption' => $c->original_caption,
            'status'  => $c->status ?? 'pending',
        ],
    ];
})->values();
@endphp

@push('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script> --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 650,
        editable: true,
        selectable: true,
        events: @json($calendarEvents),

        dateClick: function(info) {
            alert(info.dateStr);
        },

        eventClick: function(info) {
            alert(info.event.title + '\n' + info.event.extendedProps.caption);
        },

        eventDrop: function(info) {
            fetch(`/content-ideas/${info.event.id}/update-date`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    tanggal: info.event.startStr
                })
            }).catch(() => info.revert());
        }
    });

    calendar.render();
});
</script>
@endpush
@endsection
