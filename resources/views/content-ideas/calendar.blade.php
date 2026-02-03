@extends('admin.layout')

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

@section('content')
@include('partials.alert')
<div class="kt-container-fixed">
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-xl font-medium text-mono text-zinc-900 dark:text-zinc-100">Content Calendar</h1>
        <a href="{{ route('content-ideas.index') }}" class="kt-btn kt-btn-outline">
            Back to Table
        </a>
    </div>

    <div class="kt-card !overflow-visible">
        <div class="kt-card-content p-5">
            <div id="calendar" data-events='@json($calendarEvents)'></div>
        </div>
    </div>
</div>
@endsection
