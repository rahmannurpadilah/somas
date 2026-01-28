@extends('Auth.layout')
@section('main')
<div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
    <div class="kt-card max-w-[370px] w-full">
       @include('partials.alert')
    <form action="/forgot-password" class="kt-card-content flex flex-col gap-5 p-10" id="reset_password_enter_email_form" method="post">
        @csrf
     <div class="text-center">
      <h3 class="text-lg font-medium text-mono">
       Your Email
      </h3>
      <span class="text-sm text-secondary-foreground">
       Enter your email to reset password
      </span>
     </div>
     <div class="flex flex-col gap-1">
      <label class="kt-form-label font-normal text-mono">
       Email
      </label>
      <input class="kt-input" placeholder="email@email.com" type="text" value=""/>
     </div>
     <a class="kt-btn kt-btn-primary flex justify-center grow" href="/forgot-password">
      Continue
      <i class="ki-filled ki-black-right">
      </i>
     </a>
     {{-- <button class="kt-btn kt-btn-primary flex justify-center grow">
      Continue
      <i class="ki-filled ki-black-right">
      </i>
     </button> --}}
    </form>
   </div>
  </div>
@endsection
