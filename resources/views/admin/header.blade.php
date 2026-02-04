   <header class="kt-header fixed top-0 z-10 start-0 end-0 flex items-stretch shrink-0 bg-background"
       data-kt-sticky="true" data-kt-sticky-class="border-b border-border" data-kt-sticky-name="header" id="header">
       <div class="kt-container-fixed flex justify-between items-stretch lg:gap-4" id="headerContainer">
           <!-- Mobile Logo -->
           <div class="flex gap-2.5 lg:hidden items-center -ms-1">
               <a class="shrink-0" href="html/demo1.html">
                   <img class="max-h-[25px] w-full" src="{{ asset('assets/media/app/mini-logo.svg') }}" />
               </a>
               <div class="flex items-center">
                   <button class="kt-btn kt-btn-icon kt-btn-ghost" data-kt-drawer-toggle="#sidebar">
                       <i class="ki-filled ki-menu">
                       </i>
                   </button>
                   <button class="kt-btn kt-btn-icon kt-btn-ghost" data-kt-drawer-toggle="#mega_menu_wrapper">
                       <i class="ki-filled ki-burger-menu-2">
                       </i>
                   </button>
               </div>
           </div>
           <!-- End of Mobile Logo -->
           <!--Megamenu Contaoner-->
           <div class="flex items-stretch" id="megaMenuContainer">
               <!--Megamenu Inner-->
               <div class="flex items-stretch [--kt-reparent-mode:prepend] [--kt-reparent-target:body] lg:[--kt-reparent-target:#megaMenuContainer] lg:[--kt-reparent-mode:prepend]"
                   data-kt-reparent="true">
                   <!--Megamenu Wrapper-->
                   <div class="hidden lg:flex lg:items-stretch [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]"
                       data-kt-drawer="true"
                       data-kt-drawer-class="kt-drawer kt-drawer-start fixed z-10 top-0 bottom-0 w-full me-5 max-w-[250px] p-5 lg:p-0 overflow-auto"
                       id="mega_menu_wrapper">
                       <!--Megamenu-->
                       <div class="kt-menu flex-col lg:flex-row gap-5 lg:gap-7.5" data-kt-menu="true" id="mega_menu">
                           <!--Megamenu Item-->
                           <div class="kt-menu-item active">
                               <a class="kt-menu-link text-sm text-secondary-foreground font-medium kt-menu-link-hover:text-primary kt-menu-item-active:text-mono kt-menu-item-show:text-primary kt-menu-item-here:text-mono kt-menu-item-active:font-semibold kt-menu-item-here:font-semibold"
                                   href="{{ route('dashboard') }}">
                                   <span class="kt-menu-title text-nowrap">
                                       Home
                                   </span>
                               </a>
                           </div>
                           <!--End of Megamenu Item-->
                           <!--Megamenu Item-->
                           <div class="kt-menu-item active">
                               <a class="kt-menu-link text-sm text-secondary-foreground font-medium kt-menu-link-hover:text-primary kt-menu-item-active:text-mono kt-menu-item-show:text-primary kt-menu-item-here:text-mono kt-menu-item-active:font-semibold kt-menu-item-here:font-semibold"
                                   href="{{ route('content-source.index') }}">
                                   <span class="kt-menu-title text-nowrap">
                                        All Sources
                                   </span>
                               </a>
                           </div>
                           <!--End of Megamenu Item-->
                           <!--Megamenu Item-->
                           <div class="kt-menu-item active">
                               <a class="kt-menu-link text-sm text-secondary-foreground font-medium kt-menu-link-hover:text-primary kt-menu-item-active:text-mono kt-menu-item-show:text-primary kt-menu-item-here:text-mono kt-menu-item-active:font-semibold kt-menu-item-here:font-semibold"
                                   href="{{ route('content-ideas.index') }}">
                                   <span class="kt-menu-title text-nowrap">
                                     Ideas Results
                                   </span>
                               </a>
                           </div>
                           <!--End of Megamenu Item-->
                       </div>
                       <!--End of Megamenu-->
                   </div>
               </div>
           </div>
           <div class="flex items-center gap-2.5">
               <!-- Search -->
               {{-- <button class="group kt-btn kt-btn-ghost kt-btn-icon size-9 rounded-full hover:bg-primary/10 hover:[&_i]:text-primary" data-kt-modal-toggle="#search_modal">
        <i class="ki-filled ki-magnifier text-lg group-hover:text-primary">
        </i>
       </button> --}}
               <!-- End of Search -->

               <!-- User -->
               <div class="shrink-0" data-kt-dropdown="true" data-kt-dropdown-offset="10px, 10px"
                   data-kt-dropdown-offset-rtl="-20px, 10px" data-kt-dropdown-placement="bottom-end"
                   data-kt-dropdown-placement-rtl="bottom-start" data-kt-dropdown-trigger="click">
                   <div class="cursor-pointer shrink-0" data-kt-dropdown-toggle="true">
                       <img alt="" class="size-9 rounded-full border-2 border-green-500 shrink-0"
                           src="{{ asset('assets/media/avatars/300-2.png') }}" />
                   </div>
                   <div class="kt-dropdown-menu w-[250px]" data-kt-dropdown-menu="true">
                       <div class="flex items-center justify-between px-2.5 py-1.5 gap-1.5">
                           <div class="flex items-center gap-2">
                               <img alt="" class="size-9 shrink-0 rounded-full border-2 border-green-500"
                                   src="{{ asset('assets/media/avatars/300-2.png') }}" />
                               @auth
                                   <div class="flex flex-col gap-1.5">
                                       <span class="text-sm text-foreground font-semibold leading-none">
                                           {{ auth()->user()->name }}
                                       </span>
                                       <a class="text-xs text-secondary-foreground hover:text-primary font-medium leading-none"
                                           href="#">
                                           {{ auth()->user()->email }}
                                       </a>
                                   </div>
                               </div>
                               <span class="kt-badge kt-badge-sm kt-badge-primary kt-badge-outline">
                                   {{ ucfirst(auth()->user()->role) }}
                               </span>
                           @endauth
                           @guest
                               <div class="flex flex-col gap-1.5">
                                   <span class="text-sm text-foreground font-semibold leading-none">
                                       Guest
                                   </span>
                                   <a class="text-xs text-secondary-foreground hover:text-primary font-medium leading-none"
                                       href="#">
                                       guest@example.com
                                   </a>
                               </div>
                           </div>
                       @endguest
                   </div>
                   <ul class="kt-dropdown-menu-sub">
                       <li>
                           <div class="kt-dropdown-menu-separator">
                           </div>
                       </li>
                       <li>
                           <a class="kt-dropdown-menu-link" href="{{ route('account-analytics.index') }}">
                               <i class="ki-filled ki-profile-circle">
                               </i>
                               My Account
                           </a>
                       </li>
                       {{-- <li>
                           <div class="kt-dropdown-menu-separator">
                           </div>
                       </li> --}}
                   </ul>
                   <div class="px-2.5 pt-1.5 mb-2.5 flex flex-col gap-3.5">
                       <div class="flex items-center gap-2 justify-between">
                           <span class="flex items-center gap-2">
                               <i class="ki-filled ki-moon text-base text-muted-foreground">
                               </i>
                               <span class="font-medium text-2sm">
                                   Dark Mode
                               </span>
                           </span>
                           <input class="kt-switch" data-kt-theme-switch-state="dark"
                               data-kt-theme-switch-toggle="true" name="check" type="checkbox"
                               value="1" />
                       </div>
                       @if (Auth::check())
                       <form action="{{ route('auth.logout') }}" method="POST">
                           @csrf
                           <button type="submit" class="kt-btn kt-btn-outline justify-center w-full">
                               Log out
                           </button>
                       </form>
                       @endif
                   </div>
               </div>
           </div>
           <!-- End of User -->
       </div>
       <!-- End of Topbar -->
       </div>
       <!-- End of Container -->
   </header>
   </header>
