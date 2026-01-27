@extends('Auth.layout')
@section('main')
@include('partials.alert')
 <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
   <div class="kt-card max-w-[440px] w-full">
    <div class="kt-card-content p-10">
     <div class="flex justify-center mb-5">
      <img alt="image" class="dark:hidden max-h-[180px]" src="{{ asset('assets/media/illustrations/32.svg') }}"/>
      <img alt="image" class="light:hidden max-h-[180px]" src="{{ asset('assets/media/illustrations/32-dark.svg') }}"/>
     </div>
     <h3 class="text-lg font-medium text-mono text-center mb-4">
      Your password is changed
     </h3>
     <div class="text-sm text-center text-secondary-foreground mb-7.5">
      Your password has been successfully updated.
      <br/>
      Your account's security is our priority.
     </div>
     <div class="flex justify-center">
      <a class="kt-btn kt-btn-primary" href="html/demo1/authentication/classic/sign-in.html">
       Sign in
      </a>
     </div>
    </div>
   </div>
  </div>
@endsection
