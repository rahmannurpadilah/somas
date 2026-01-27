@extends('Auth.layout')
@section('main')
@include('partials.alert')
  <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
   <div class="kt-card max-w-[440px] w-full">
    <div class="kt-card-content p-10">
     <div class="flex justify-center py-10">
      <img alt="image" class="dark:hidden max-h-[130px]" src="{{ asset('assets/media/illustrations/30.svg') }}"/>
      <img alt="image" class="light:hidden max-h-[130px]" src="{{ asset('assets/media/illustrations/30-dark.svg') }}"/>
     </div>
     <h3 class="text-lg font-medium text-mono text-center mb-3">
      Check your email
     </h3>
     <div class="text-sm text-center text-secondary-foreground mb-7.5">
      Please click the link sent to your email
      <a class="text-sm text-foreground font-medium hover:text-primary" href="#">
       bob@reui.io
      </a>
      <br/>
      to reset your password. Thank you
     </div>
     <div class="flex justify-center mb-5">
      <a class="kt-btn kt-btn-primary flex justify-center" href="html/demo1/authentication/classic/reset-password/change-password.html">
       Skip for now
      </a>
     </div>
     <div class="flex items-center justify-center gap-1">
      <span class="text-xs text-secondary-foreground">
       Didn’t receive an email?
      </span>
      <a class="text-xs font-medium link" href="html/demo1/authentication/classic/reset-password/enter-email.html">
       Resend
      </a>
     </div>
    </div>
   </div>
  </div>
@endsection
