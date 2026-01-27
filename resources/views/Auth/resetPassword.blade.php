@extends('Auth.layout')
@section('main')
@include('partials.alert')
<div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
   <div class="kt-card max-w-[370px] w-full">
    <form action="#" class="kt-card-content flex flex-col gap-5 p-10" id="reset_password_enter_email_form" method="post">
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
     <a class="kt-btn kt-btn-primary flex justify-center grow" href="html/demo1/authentication/classic/reset-password/check-email.html">
      Continue
      <i class="ki-filled ki-black-right">
      </i>
     </a>
    </form>
   </div>
  </div>
@endsection
