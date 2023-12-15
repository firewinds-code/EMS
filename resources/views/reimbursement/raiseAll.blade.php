@extends('includes.master')
@section('content')
@section('page-title', 'Raise')
@section('page-heading', 'Reimbursement')
<style>
   .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 1000;
      display: none;
   }
</style>
<div class="overlay" id="pageOverlay"></div>
<div id="kt_app_content_container" class="app-container container-xxl">

   <div class="card cardheight cardOutline">
      <div class="card-body">
         <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
               <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" name="reimbursement_type">
                  <option value="null">--Select--</option>
                  <option value="food">Food</option>
                  <option value="travel">Travel</option>
                  <option value="hotel">Hotel</option>
                  @if ($checkCsk)
                  <option value="mobile">Mobile</option>
                  @endif
                  <option value="miscellaneous">Miscellaneous </option>
               </select>
            </div>
         </div>
      </div>
   </div>
   <br />
   <input type="text" name="EmployeeID" value="{{ session('EmployeeID') }}" hidden readonly>
   <div id="appendChild"></div>

</div>

<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}">
</script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>



<script>
   $(document).ready(function() {
      var $pageOverlay = $('#pageOverlay');

      $("select[name='reimbursement_type']").change(function() {
         var requestData = {
            EmployeeID: '{{ session("EmployeeID") }}'
         };

         var selectedOption = $(this).val();
         if (selectedOption === 'food') {
            $('#appendChild').html(`
            <div class="text-center my-3">
               <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
               </div>
            </div>
             `);
            $pageOverlay.show(); // Show the overlay

            $.ajax({
               url: "{{ route('getFoodData') }}",
               method: 'GET',
               data: requestData,
               success: function(response) {
                  $pageOverlay.hide();
                  $('#appendChild').html(response);
               },
               error: function(xhr, status, error) {
                  $pageOverlay.hide();
                  console.error(error);
               }
            });
         } else if (selectedOption === 'travel') {
            $('#appendChild').html(`
            <div class="text-center my-3">
               <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
               </div>
            </div>
             `);
            $pageOverlay.show(); // Show the overlay

            $.ajax({
               url: "{{ route('getTravelData') }}",
               method: 'GET',
               data: requestData,
               success: function(response) {
                  $pageOverlay.hide();
                  $('#appendChild').html(response);
               },
               error: function(xhr, status, error) {
                  $pageOverlay.hide();
                  console.error(error);
               }
            });
         } else if (selectedOption === 'hotel') {

            $('#appendChild').html(`
            <div class="text-center my-3">
               <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
               </div>
            </div>
             `);
            $pageOverlay.show(); // Show the overlay
            $.ajax({
               url: "{{ route('getHotelData') }}",
               method: 'GET',
               data: requestData,
               success: function(response) {
                  $pageOverlay.hide();
                  $('#appendChild').html(response);
               },
               error: function(xhr, status, error) {
                  $pageOverlay.hide();
                  console.error(error);
               }
            });
         } else if (selectedOption === 'mobile') {
            $('#appendChild').html(`
            <div class="text-center my-3">
               <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
               </div>
            </div>
             `);
            $pageOverlay.show(); // Show the overlay
            $.ajax({
               url: "{{ route('getMobileData') }}",
               method: 'GET',
               data: requestData,
               success: function(response) {
                  $pageOverlay.hide();
                  $('#appendChild').html(response);
               },
               error: function(xhr, status, error) {
                  $pageOverlay.hide();
                  console.error(error);
               }
            });
         } else if (selectedOption === 'miscellaneous') {
            $('#appendChild').html(`
            <div class="text-center my-3">
               <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
               </div>
            </div>
             `);
            $pageOverlay.show(); // Show the overlay
            $.ajax({
               url: "{{ route('getMiscellaneousData') }}",
               method: 'GET',
               data: requestData,
               success: function(response) {
                  $pageOverlay.hide();
                  $('#appendChild').html(response);
               },
               error: function(xhr, status, error) {
                  $pageOverlay.hide();
                  console.error(error);
               }
            });
         }
      });
   });
</script>






@endsection