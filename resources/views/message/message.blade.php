@extends('includes.master')
@section('content')
@section('page-title', 'Message')
@section('page-heading', 'Message')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        @if (session('EmployeeID') == 'CE03070003')
            <div class="card cardheight cardOutline">
                <div class="card-body">
                    <form id="messageReport" action="" method="post">
                        @csrf
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <input class="form-control form-control-solid" placeholder="Pick date range"
                                    name="DateFrom" id="DateFrom_To" />
                            </div>
                            <div class="col-md-4 fv-row">
                                <button type="button" value="search" name="message_search" id="message_search"
                                    class="btn btn-primary" style="float: right;">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <br>
        <div class="d-flex justify-content-center text-primary">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <br>
        <div class="card" id = "messageTable">

        </div>
        <div class="modal fade" id="kt_modal_edit_customer" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ url('update-message') }}"
                        method="post" id="kt_modal_edit_customer_form" data-kt-redirect="">
                        @csrf

                        <div class="modal-header" id="kt_modal_edit_customer_header">
                            <h2 class="fw-bold">Reply Message</h2>
                            <div id="kt_modal_edit_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <div class="modal-body py-10 px-lg-17">
                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                                data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px"
                                style="">
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="required fs-6 fw-semibold mb-2">Acknowledgement</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Write Acknowledgement here..." name="message" required>
                                    <input type="hidden" name="message_id" id="message_id" value="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex-center">
                            <button type="reset" id="kt_modal_edit_customer_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_edit_customer_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@php
    use Illuminate\Support\Facades\Session;
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.spinner-border').hide();
        var enmp = "{{ Session::get('EmployeeID') }}";
        if (enmp == 'CE03070003') {
            $('#messageTable').hide();
        } else {
            $('.spinner-border').show();
            $('#messageTable').show();
            simpleurl = "{{ url('messageView') }}";
            $.get(simpleurl, function(response) {
                if (response.success) {
                    $('.spinner-border').hide();
                    $('#messageTable').html(response.html);
                }
            });
        }
        $('#message_search').on('click', function() {
            var date = $('#DateFrom_To').val();
            $('.spinner-border').show();
            url = "{{ url('get-data-by-admin') }}" + '/' + date;
            $.get(url, function(response) {

                if (response.success) {
                    $('.spinner-border').hide();
                    $('#messageTable').html(response.html);
                }
            });
            $('#messageTable').show();
        });
    });
</script>
