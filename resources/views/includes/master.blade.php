<html lang="en">
<!--begin::Head-->

<head>
   <base href="" />
   <link rel="icon" href="https://cogenteservices.com/wp-content/themes/cogent/images/favicon.ico">
   <title>@yield('page-title') - Cogent EMS</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
   <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta property="og:locale" content="en_US" />
   <meta property="og:type" content="article" />
   <meta property="og:title" content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
   <meta property="og:url" content="https://keenthemes.com/metronic" />
   <meta property="og:site_name" content="Keenthemes | Metronic" />
   <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
   <link rel="shortcut icon" href="{{ asset('utills/dist/assets/media/logos/favicon.ico') }}" />
   <!--begin::Fonts(mandatory for all pages)-->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
   <!--end::Fonts-->
   <!--begin::Vendor Stylesheets(used for this page only)-->
   <link href="{{ asset('utills/src/customeCss/custome.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('utills/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
   <!--end::Vendor Stylesheets-->
   <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
   <link href="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('utills/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('utills/dist/assets/css/bootstrap-duallistbox.min.css') }}" rel="stylesheet" type="text/css" />
   <!--Data table-->
   <link href="{{ asset('utills/dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

   <!--end::Global Stylesheets Bundle-->
   <script>
      var defaultThemeMode = "light";
      var themeMode;
      if (document.documentElement) {
         if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode =
               document.documentElement.getAttribute("data-bs-theme-mode");
         } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
               themeMode = localStorage.getItem("data-bs-theme");
            } else {
               themeMode = defaultThemeMode;
            }
         }
         if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ?
               "dark" :
               "light";
         }
         document.documentElement.setAttribute("data-bs-theme", themeMode);
      }
   </script>
</head>
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
   <!--begin::App-->
   <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
      <!--begin::Page-->
      <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

         <!--begin::Header-->
         <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
            <!--begin::Header container-->
            <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
               <!--begin::Sidebar mobile toggle-->
               <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                  <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                     <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                     </i>
                  </div>
               </div>
               <!--begin::Mobile logo-->
               <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                  <a href="../../demo1/dist/index.html" class="d-lg-none">
                     <img alt="Logo" src="{{ asset('utills/dist/assets/media/logos/cogent_new_small.png') }}" class="h-30px" />
                  </a>
               </div>
               <!--end::Mobile logo-->
               <!--begin::Header wrapper-->
               <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                  <!--begin::Menu wrapper-->
                  <div class="app-header-menu app-header-mobile-drawer align-items-stretch mb-4" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                     <h1 class="fs-1hx fw-bold text-gray-700 text-center mb-13" style="margin-top: 1.5rem;">@yield('page-heading')</h1>
                  </div>


                  <!--end::Menu wrapper-->
                  <!--begin::Navbar-->
                  <div class="app-navbar flex-shrink-0">
                     <!--begin::Activities-->
                     <div class="app-navbar-item ms-1 ms-md-4">
                        
                        <!--begin::Drawer toggle-->
                        <a href="{{ route('messageView') }}">
                           <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" id="kt_activities_toggle">
                               <i class="ki-duotone ki-messages fs-2">
                                   <span class="path1"></span>
                                   <span class="path2"></span>
                                   <span class="path3"></span>
                                   <span class="path4"></span>
                                   <span class="path5"></span>
                               </i>
                           </div>
                       </a>
                       
                        <!--end::Drawer toggle-->
                        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
                           <i class="ki-duotone ki-notification-status fs-2">
                              <span class="path1"></span>
                              <span class="path2"></span>
                              <span class="path3"></span>
                              <span class="path4"></span>
                           </i>
                        </div>
                     </div>
                     <!--end::Activities-->



                     <!--begin::User menu-->
                     <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                           <img src="{{ asset('utills/dist/assets/media/avatars/default-small.png') }}" class="rounded-3" alt="user" />
                        </div>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">

                           <div class="menu-item px-5">
                              <a href="{{ route('profile') }}" class="menu-link px-5">
                                 <span class="menu-title">My Profile</span>
                                 <span class="ms-2">
                                    <i class="fas fa-user-circle"></i>
                                 </span>
                              </a>
                           </div>

                           <div class="menu-item px-5">
                              <a href="{{ route('holidaylist') }}" class="menu-link px-5">
                                 <span class="menu-title">Holiday List</span>
                                 <span class="ms-2">
                                    <i class="fa-solid fa-snowman"></i>
                                 </span>
                              </a>
                           </div>


                           <!--Anniversary begin::Menu item-->
                           <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                              <a href="#" class="menu-link px-5">
                                 <span class="menu-title">Anniversary</span>
                                 <span class="menu-arrow"></span>
                              </a>
                              <!--begin::Menu sub-->
                              <div class="menu-sub menu-sub-dropdown w-210px py-4">
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a class="menu-link px-5" href="{{ route('birthday') }}">
                                       <i class="fa fa-birthday-cake me-2"></i>Birthday
                                    </a>
                                 </div>

                                 <div class="menu-item px-3">
                                    <a class="menu-link px-5" href="{{ route('marriage') }}">
                                       <i class="fas fa-user-friends me-2"></i>
                                       Marriage
                                    </a>
                                 </div>
                                 <div class="menu-item px-3">
                                    <a class="menu-link px-5" href="{{ route('work') }}">
                                       <i class="fas fa-briefcase me-2"></i>Work
                                    </a>
                                 </div>



                              </div>
                              <!--end::Menu sub-->
                           </div>
                           <!--Anniversary end::Menu item-->

                           <!--begin::Menu item-->
                           <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                              <a href="#" class="menu-link px-5">
                                 <span class="menu-title">Change Security</span>
                                 <span class="menu-arrow"></span>
                              </a>
                              <!--begin::Menu sub-->
                              <div class="menu-sub menu-sub-dropdown w-210px py-4">
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a data-bs-toggle="modal" data-bs-target="#modalPassword" class="menu-link px-5">
                                       <i class="fa fa-lock me-2"></i> Change Password
                                    </a>
                                 </div>

                                 <div class="menu-item px-3">
                                    <a data-bs-toggle="modal" id="SecurityButton" data-bs-target="#ModalSecurity" class="menu-link px-5">
                                       <i class="fas fa-key me-2"></i> Change Security Key
                                    </a>
                                 </div>

                              </div>
                              <!--end::Menu sub-->
                           </div>
                           <!--end::Menu item-->

                           <!--begin::Menu item-->
                           <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                              <a href="#" class="menu-link px-5">
                                 <span class="menu-title position-relative">Mode
                                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                       <i class="ki-duotone ki-night-day theme-light-show fs-2">
                                          <span class="path1"></span>
                                          <span class="path2"></span>
                                          <span class="path3"></span>
                                          <span class="path4"></span>
                                          <span class="path5"></span>
                                          <span class="path6"></span>
                                          <span class="path7"></span>
                                          <span class="path8"></span>
                                          <span class="path9"></span>
                                          <span class="path10"></span>
                                       </i>
                                       <i class="ki-duotone ki-moon theme-dark-show fs-2">
                                          <span class="path1"></span>
                                          <span class="path2"></span>
                                       </i> </span></span>
                              </a>
                              <!--begin::Menu-->
                              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                       <span class="menu-icon" data-kt-element="icon">
                                          <i class="ki-duotone ki-night-day fs-2">
                                             <span class="path1"></span>
                                             <span class="path2"></span>
                                             <span class="path3"></span>
                                             <span class="path4"></span>
                                             <span class="path5"></span>
                                             <span class="path6"></span>
                                             <span class="path7"></span>
                                             <span class="path8"></span>
                                             <span class="path9"></span>
                                             <span class="path10"></span>
                                          </i>
                                       </span>
                                       <span class="menu-title">Light</span>
                                    </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                       <span class="menu-icon" data-kt-element="icon">
                                          <i class="ki-duotone ki-moon fs-2">
                                             <span class="path1"></span>
                                             <span class="path2"></span>
                                          </i>
                                       </span>
                                       <span class="menu-title">Dark</span>
                                    </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                       <span class="menu-icon" data-kt-element="icon">
                                          <i class="ki-duotone ki-screen fs-2">
                                             <span class="path1"></span>
                                             <span class="path2"></span>
                                             <span class="path3"></span>
                                             <span class="path4"></span>
                                          </i>
                                       </span>
                                       <span class="menu-title">System</span>
                                    </a>
                                 </div>
                                 <!--end::Menu item-->
                              </div>
                              <!--end::Menu-->
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-5">
                              <a href="#" class="menu-link px-5" onclick="showLogoutModal()">
                                 <span class="menu-title">Logout</span>
                                 <span class="ms-2">
                                    <i class="fas fa-sign-out-alt"></i>
                                 </span>
                              </a>
                              <form hidden id="LogOutsection" action="{{ route('logout') }}" method="GET" name="logOutForm">
                                 @csrf
                              </form>
                           </div>
                           <!--end::Menu item-->
                        </div>
                        <!--end::User account menu-->
                        <!--end::Menu wrapper-->
                     </div>
                     <!--end::User menu-->
                     <!--begin::Aside toggle-->
                     <!--end::Header menu toggle -->
                  </div>
                  <!--end::Navbar-->
               </div>
               <!--end::Header wrapper-->
            </div>
            <!--end::Header container-->
         </div>
         <!--end::Header-->

         <!--begin::Content-->
         <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Sidebar-->
            @include('includes.sidebar')
            <!--end::Sidebar-->

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
               <!--begin::Content wrapper-->
               <div class="d-flex flex-column flex-column-fluid">
                  @yield('content')
               </div>
               <!--end::Content wrapper-->
               <!--begin::Footer wrapper-->
               <div id="kt_app_footer" class="app-footer">
                  <!--begin::Footer container-->
                  <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                     <!--begin::Copyright-->
                     <div class="align-items-center justify-content-center">
                        <div class="footer" style="text-align: center; font-size: 14px; color: #555;">
                           &copy;<a href="http://www.cogenteservices.com" target="_blank" style="color: #007bff; text-decoration: none;">Cogent EMS</a> All rights reserved. {{ date('Y') }}
                        </div>
                     </div>
                     <!--end::Copyright-->
                  </div>
                  <!--end::Footer container-->
               </div>

               <!--End::Footer wrapper-->
            </div>
            <!--end::Main-->

         </div>
         <!--End::Content-->
      </div>
      <!--end::Page-->
   </div>
   <!--end::App-->
   <!--end::Global Javascript Bundle-->


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

   <script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
   <script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/usaLow.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
   <script src=" {{ asset('utills/dist/assets/Vendors/worldTimeZoneAreasLow.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/index.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/jquery.bootstrap-duallistbox.min.js')}}"></script>
   <!--end::Vendors Javascript-->
   <script src="{{ asset('utills/dist/assets/Vendors/xy.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/percent.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/radar.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/Animated.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/map.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/worldLow.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/continentsLow.js')}}"></script>
   <script src="{{ asset('utills/dist/assets/Vendors/worldTimeZonesLow.js')}}"></script>
   <!--begin::Custom Javascript(used for this page only)-->
   <script src=" {{ asset('utills/dist/assets/js/widgets.bundle.js') }}"></script>
   <script src=" {{ asset('utills/dist/assets/js/custom/widgets.js') }}"></script>
   <script src="{{ asset('utills/dist/assets/js/custom/apps/chat/chat.js') }}"></script>
   <script src=" {{ asset('utills/dist/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
   <script src="{{ asset('utills/dist/assets/js/custom/utilities/modals/create-app.js') }}"></script>
   <script src=" {{ asset('utills/dist/assets/js/custom/utilities/modals/new-target.js') }}"></script>
   <script src="{{ asset('utills/dist/assets/js/custom/utilities/modals/users-search.js') }}"></script>
   <!--Data table-->
   <script src=" {{ asset('utills/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
   <script src="{{ asset('utills/src/customeJs/custome.js')}}"></script>



		<script src="{{ asset('utills/dist/assets/js/custom/apps/ecommerce/customers/listing/listing.js') }}"></script>
		<script src="{{ asset('utills/dist/assets/js/custom/apps/ecommerce/customers/listing/add.js') }}"></script>
        <script src="{{ asset('utills/dist/assets/js/custom/apps/ecommerce/customers/listing/edit.js') }}"></script>
		<script src="{{ asset('utills/dist/assets/js/custom/apps/ecommerce/customers/listing/export.js') }}"></script>




 <script>

    $("#kt_datepicker_1").flatpickr();
      function showLogoutModal() {
         $("#logoutModal").modal("show"); // Show the logout confirmation modal
      }
      /*for Show and Hide Password */
      document.addEventListener("DOMContentLoaded", function() {
         var passwordToggle = document.getElementById("passwordToggle");
         var passwordToggle2 = document.getElementById("passwordToggle2");
         var passwordInput = document.getElementById("passwordInput");
         var passwordInput2 = document.getElementById("passwordInput2");

         passwordToggle.addEventListener("click", function() {
            if (passwordInput.type === "password") {
               passwordInput.type = "text";
               passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>'; // Change the icon to an open eye
            } else {
               passwordInput.type = "password";
               passwordToggle.innerHTML = '<i class="fa fa-eye"></i>'; // Change the icon to a closed eye
            }
         });

         passwordToggle2.addEventListener("click", function() {
            if (passwordInput2.type === "password") {
               passwordInput2.type = "text";
               passwordToggle2.innerHTML = '<i class="fa fa-eye-slash"></i>'; // Change the icon to an open eye
            } else {
               passwordInput2.type = "password";
               passwordToggle2.innerHTML = '<i class="fa fa-eye"></i>'; // Change the icon to a closed eye
            }
         });
      });
   </script>


   @if (session()->has('success'))
   <script>
      toastr.success("{!! session()->get('success')!!}", "Success", {
         toastClass: "toast-success",
         progressBar: true
      });
   </script>
   @endif
   @if (session()->has('error'))
   <script>
      toastr.error("{!! session()->get('error')!!}", "Error", {
         toastClass: "toast-error",
         progressBar: true
      });
   </script>
   @endif

</body>
<!-- For Change Password Modal -->
<div class="modal fade" tabindex="-1" id="modalPassword">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-primary py-3">
            <h3 class="modal-title text-light">Modal title</h3>

            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
               <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
         </div>

         <div class="modal-body">
            <form id="changePassForm" action="{{ route('changePassword') }}" method="POST">
               @csrf
               <div class="mb-3">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Password</span>
                  </label>
                  <div class="input-group">
                     <input type="password" name="password" class="form-control" placeholder="*****" id="passwordInput" />
                     <button class="btn btn-outline-secondary toggle-password" type="button" id="passwordToggle">
                        <i class="fa fa-eye"></i>
                     </button>
                  </div>
                  <div class="invalid-feedback" id="passwordFeedback">
                     Password must match the pattern "Abc@123".
                  </div>
               </div>
               <div class="mb-3">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Confirm Password</span>
                  </label>
                  <div class="input-group">
                     <input type="password" name="confirmpassword" class="form-control" placeholder="*****" id="passwordInput2" />
                     <button class="btn btn-outline-secondary toggle-password" type="button" id="passwordToggle2">
                        <i class="fa fa-eye"></i>
                     </button>
                  </div>
                  <div class="invalid-feedback" id="confirmPasswordFeedback">
                     Passwords do not match.
                  </div>
               </div>
               <div class="mb-3" style="float: right;">
                  <button type="button" id="closeModalBtn" hidden class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>

      </div>
   </div>
</div>

<!-- For Change Security Modal -->
<div class="modal fade" tabindex="-1" id="ModalSecurity">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-primary py-3">
            <h3 class="modal-title">Change Security Question</h3>

            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
               <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close-->
         </div>

         <div class="modal-body">
            <form id="changeSecForm" action="{{ route('changeSec') }}" method="POST">
               <div class="mb-3">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Question</span>
                  </label>
                  <div class="input-group">
                     <input type="text" name="Qns" class="form-control" placeholder="*****" id="Qns" />
                  </div>
                  <div class="invalid-feedback text-red" id="QnsFeedback">
                     Question is Required.
                  </div>
               </div>
               <div class="mb-3">
                  <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                     <span class="required">Answer</span>
                  </label>
                  <div class="input-group">
                     <input type="text" name="ans" class="form-control" placeholder="*****" id="ans" />
                  </div>
                  <div class="invalid-feedback text-red" id="ansFeedback">
                     Answer is Required.
                  </div>
               </div>
               <div class="mb-3" style="float: right;">
                  <button type="button" id="closeModalBtn2" hidden class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>

      </div>
   </div>
</div>

<!-- For Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            Are you sure you want to logout?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button id="confirmLogout" type="button" class="btn btn-danger">Logout</button>
         </div>
      </div>
   </div>
</div>
