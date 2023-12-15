@extends('includes.master')
@section('content')
@section('page-title', 'Manage Report Module')
@section('page-heading', 'Manage Report Module')

<style>
    .bootstrap-duallistbox-container .list-group-item {
        font-size: 14px !important;
    }
</style>
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


<div id="kt_app_content_container" class="app-container container-xxl mt-5">
    <div class="card cardOutline" id="food">
        <div class="card-body">
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <form id="formDrm" action="{{ url('drmUpdate') }}" method="POST">
                    @csrf
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row" id="searchemp1">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="txt_empid1">
                                <span class="required">Search Employee</span>
                            </label>
                            <input type="text" class="form-control searchEmployeeInput" name="searchEmp"
                                data-suggestion="suggestionList" autocomplete="off" id="searchEmp" />
                        </div>
                        <div class="row g-6">
                            <div class="col-md-6">
                                <ul class="list-group mt-2 suggestionList"
                                    style="display: none; max-height: 200px; overflow-y: auto;"></ul>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center text-primary">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <h3>Report Section</h3>
                    <hr>
                    <div class="row g-9 mb-8" id="report-section">


                    </div>
                    <br>
                    <div class="row g-9 mb-8" id="show_hide_">

                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>
<link href="{{ asset('utills/dist/assets/css/bootstrap-duallistbox.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('utills/dist/assets/Vendors/jquery.bootstrap-duallistbox.min.js') }}"></script>



<script>
    $(document).ready(function() {
        // var $pageOverlay = $('#loader');
        $('.spinner-border').hide();
        const resultData = JSON.parse('{!! $result !!}');
        // console.log(resultData);
        const searchEmployeeInputs = document.querySelectorAll('.searchEmployeeInput');
        const suggestionLists = document.querySelectorAll('.suggestionList');

        searchEmployeeInputs.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                const searchKey = event.target.value.toLowerCase();
                const filteredResults = resultData.filter(item =>
                    item.name.toLowerCase().includes(searchKey) ||
                    item.id.includes(searchKey)
                );

                displaySuggestions(filteredResults, suggestionLists[index]);
            });
        });

        function displaySuggestions(suggestions, suggestionList) {
            suggestionList.innerHTML = '';

            if (suggestions.length === 0) {
                suggestionList.style.display = 'none';
                return;
            }

            suggestionList.style.display = 'block';

            suggestions.forEach(item => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item');
                listItem.innerHTML =
                    `<a href="#" class="text-decoration-none">${item.name} (${item.id})</a>`;
                listItem.addEventListener('click', () => {
                    searchEmployeeInputs.forEach((input, index) => {
                        if (suggestionLists[index] === suggestionList) {
                            input.value = `${item.name} (${item.id})`;

                            $('.spinner-border').show();
                            $('#show_hide_').show();

                            var url = "{{ url('get-edit-id') }}/" + `${item.id}`;
                            $.get(url, function(response) {
                                $('.spinner-border').hide();
                                $('#report-section').html(response.reports);
                                $('#show_hide_').html(response.process);

                            });
                        }
                    });
                    suggestionList.style.display = 'none';
                });
                suggestionList.appendChild(listItem);


            });
        }
    });
</script>


<script>
    $('#show_hide_').hide();
    $('#formDrm').on('submit', function(events) {
        event.preventDefault();
        $('.error-message').remove();
        let isValid = true;

        $(this).find('.required').each(function() {
            const input = $(this).closest('.fv-row').find(
                '.form-control, check, group');
            if (!input.val()) {
                isValid = false;
                const fieldName = $(this).text();
                const errorMessage = fieldName + ' is required.';
                $('<div class="error-message text-danger">' + errorMessage + '</div>')
                    .insertAfter(input);
            }
        });
        if (isValid == true) {
            var url = $(this).attr('action');
            var form = $(this).serialize();
            $.post(url, form, function(response) {
                if (response.success) {
                    toastr.success(response.message, "Success", {
                        toastClass: "toast-success",
                        progressBar: true
                    });
                    location.reload();
                } else {
                    toastr.error(response.message, "Error", {
                        toastClass: "toast-error",
                        progressBar: true
                    });
                }
            });
        } else {
            return false;
        }
    });
</script>
@endsection
