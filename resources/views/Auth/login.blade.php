@extends('Auth.layout')
@section('main')
<div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
      <div class="kt-card max-w-[370px] w-full">
          @include('partials.alert')

    <form action="{{ route('auth.login.post') }}" class="kt-card-content flex flex-col gap-5 p-10" id="sign_in_form" method="post">
        @csrf
     <div class="text-center mb-2.5">
      <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
       Sign in
      </h3>
      <div class="flex items-center justify-center font-medium">
       <span class="text-sm text-secondary-foreground me-1.5">
        Need an account?
       </span>
       {{-- <a class="text-sm link" href="{{ route('auth.register') }}">
        Sign up
       </a> --}}
      </div>
     </div>
     <div class="flex flex-col gap-1">
      <label class="kt-form-label font-normal text-mono">
       Email
      </label>
      <input class="kt-input" placeholder="email@email.com" type="text" name="email" value=""/>
     </div>
     <div class="flex flex-col gap-1">
      <div class="flex items-center justify-between gap-1">
       <label class="kt-form-label font-normal text-mono">
        Password
       </label>
       <a class="text-sm kt-link shrink-0" href="{{ route('auth.forgot-password') }}">
        Forgot Password?
       </a>
      </div>
      <div class="kt-input" data-kt-toggle-password="true">
       <input name="password" placeholder="Enter Password" type="password" value=""/>
       <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5" data-kt-toggle-password-trigger="true" type="button">
        <span class="kt-toggle-password-active:hidden">
         <i class="ki-filled ki-eye text-muted-foreground">
         </i>
        </span>
        <span class="hidden kt-toggle-password-active:block">
         <i class="ki-filled ki-eye-slash text-muted-foreground">
         </i>
        </span>
       </button>
      </div>
     </div>
     <label class="kt-label">
      <input class="kt-checkbox kt-checkbox-sm" name="check" type="checkbox" value="1"/>
      <span class="kt-checkbox-label">
       Remember me
      </span>
     </label>
     <button class="kt-btn kt-btn-primary flex justify-center grow">
      Sign In
     </button>
    </form>
   </div>
  </div>
@endsection
