@extends('Auth.layout')
@section('main')
@include('partials.alert')
 <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
   <div class="kt-card max-w-[370px] w-full">
    <form action="#" class="kt-card-content flex flex-col gap-5 p-10" id="reset_password_change_password_form" method="post">
     <div class="text-center">
      <h3 class="text-lg font-medium text-mono">
       Reset Password
      </h3>
      <span class="text-sm text-secondary-foreground">
       Enter your new password
      </span>
     </div>
     <div class="flex flex-col gap-1">
      <label class="kt-form-label text-mono">
       New Password
      </label>
      <label class="kt-input" data-kt-toggle-password="true">
       <input name="user_new_password" placeholder="Enter a new password" type="password" value=""/>
       <div class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5" data-kt-toggle-password-trigger="true">
        <span class="kt-toggle-password-active:hidden">
         <i class="ki-filled ki-eye text-muted-foreground">
         </i>
        </span>
        <span class="hidden kt-toggle-password-active:block">
         <i class="ki-filled ki-eye-slash text-muted-foreground">
         </i>
        </span>
       </div>
      </label>
     </div>
     <div class="flex flex-col gap-1">
      <label class="kt-form-label font-normal text-mono">
       Confirm New Password
      </label>
      <label class="kt-input" data-kt-toggle-password="true">
       <input name="user_confirm_password" placeholder="Re-enter a new Password" type="password" value=""/>
       <div class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5" data-kt-toggle-password-trigger="true">
        <span class="kt-toggle-password-active:hidden">
         <i class="ki-filled ki-eye text-muted-foreground">
         </i>
        </span>
        <span class="hidden kt-toggle-password-active:block">
         <i class="ki-filled ki-eye-slash text-muted-foreground">
         </i>
        </span>
       </div>
      </label>
     </div>
     <button class="kt-btn kt-btn-primary flex justify-center grow">
      Submit
     </button>
    </form>
   </div>
  </div>
@endsection
