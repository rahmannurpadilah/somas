@extends('admin.layout')
@section('content')
@include('partials.alert')
      <div class="kt-container-fixed">
      <div class="grid gap-5 lg:gap-7.5">
       <!-- begin: grid -->
       <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-1">
         <div class="grid grid-cols-2 gap-5 lg:gap-7.5 h-full items-stretch">
          <style>
           .channel-stats-bg {
		background-image: url('{{ asset('assets/media/images/2600x1600/bg-3.png') }}');
	}
	.dark .channel-stats-bg {
		background-image: url('{{ asset('assets/media/images/2600x1600/bg-3-dark.png') }}');
	}
          </style>
          <div class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="{{ asset('assets/media/brand-logos/linkedin-2.svg') }}"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-mono">
             9.3k
            </span>
            <span class="text-sm font-normal text-secondary-foreground">
             Total Konten
            </span>
           </div>
          </div>
          {{-- Yt --}}
          <div class="kt-card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="{{ asset('assets/media/brand-logos/youtube-2.svg') }}"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-mono">
             Status
            </span>
            <span class="text-sm font-normal text-secondary-foreground">
             Processed
            </span>
           </div>
          </div>
         </div>
        </div>
        <div class="lg:col-span-2">
         <style>
          .entry-callout-bg {
		background-image: url('{{ asset('assets/media/images/2600x1600/2.png') }}');
	}
	.dark .entry-callout-bg {
		background-image: url('{{ asset('assets/media/images/2600x1600/2-dark.png') }}');
	}
         </style>
        </div>
       </div>
       <!-- end: grid -->
      </div>
     </div>

@endsection
