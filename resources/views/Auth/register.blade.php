@extends('Auth.layout')
@section('main')
  <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
      @include('partials.alert')
   <div class="kt-card max-w-[370px] w-full">
    <form action="{{ route('auth.register.post') }}" class="kt-card-content flex flex-col gap-5 p-10" id="sign_up_form" method="post">
        @csrf
     <div class="text-center mb-2.5">
      <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
       Sign up
      </h3>
      <div class="flex items-center justify-center">
       <span class="text-sm text-secondary-foreground me-1.5">
        Already have an Account ?
       </span>
       <a class="text-sm link" href="{{ route('auth.login') }}">
        Sign In
       </a>
      </div>
     </div>
     <div class="flex flex-col gap-1">
      <label class="kt-form-label text-mono">
       Email
      </label>
      <input class="kt-input" name="email" placeholder="email@email.com" type="text" value=""/>
     </div>
     <div class="flex flex-col gap-1">
      <label class="kt-form-label font-normal text-mono">
       Password
      </label>
      <div class="kt-input" data-kt-toggle-password="true">
       <input name="password" placeholder="Enter Password" type="password" value="">
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
       </input>
      </div>
     </div>
     <div class="flex flex-col gap-1">
      <label class="kt-form-label font-normal text-mono">
       Confirm Password
      </label>
      <div class="kt-input" data-kt-toggle-password="true">
       <input name="password_confirmation" placeholder="Re-enter Password" type="password" value=""/>
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
     <label class="kt-checkbox-group">
      <input class="kt-checkbox kt-checkbox-sm" name="check" type="checkbox" value="1"/>
      <span class="kt-checkbox-label">
       I accept
       <a class="text-sm link" href="#">
        Terms & Conditions
       </a>
      </span>
     </label>
     {{-- <button class="kt-btn kt-btn-primary flex justify-center grow">
      Sign up
     </button> --}}
    </form>
   </div>
  </div>
@endsection
