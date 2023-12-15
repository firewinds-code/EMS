@extends('includes.master')
@section('content')
@section('page-title', 'Adminstrator')
@section('page-heading', 'Manage Module Master')


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl ">
        <div class="card  cardOutline">
            <div class="card-body">
                <form id="form_module" action="{{route('addmodulemaster')}}" class="ui form segment" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Process</span>
                            </label>
                            <select class="form-select typeprocess" data-control="select2" data-hide-search="true" data-placeholder="--Select--" name="listProcess" id="listProcess">
                                <option></option>
                                <option value="1">Process Wise</option>
                                <option value="2">Employee ID</option>
                                <option value="3">Upload For EmployeeID</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-lg-6 fv-row" id="location1">
                            <label class="fs-6 fw-semibold"><span class="required">Select
                                    <span>Location</span>
                            </label>
                            <div class="col-md-12">
                                <select name="location" id="location" aria-label="Select a Location" data-control="select2" data-placeholder="--Select--" class="form-select">
                                    @foreach ($results as $list)
                                    <option></option>
                                    <option value="{{ $list->id }}">{{ $list->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 fv-row" id="process1">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Process</span>
                            </label>
                            <select class="form-select " data-control="select2" data-hide-search="true" data-placeholder="--select--" name="process" id="process">
                                <option value=""></option>
                            </select>
                        </div>


                        <div class="col-md-6 fv-row" id="level1">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Level</span>
                            </label>
                            <select class="form-select " data-control="select2" data-hide-search="true" data-placeholder="--select--" name="level" id="emplevel">
                                <option></option>
                                <option value="NA">---Select---</option>
                                <option value="1">One Level</option>
                                <option value="2">Two Level</option>
                            </select>
                        </div>




                        <div class="col-md-6 fv-row" id="module1">
                            <label for="exampleFormControlInput1" class="form-label">
                                <span class="required">Module</span>
                            </label>
                            <select class="form-select " data-control="select2" data-hide-search="true" data-placeholder="--select--" name="module">
                                <option></option>
                                <option value="NA">---Select---</option>
                                <option value="Exception">Exception</option>
                            </select>
                        </div>

                        <div class="col-md-6 fv-row" id="searchemp1">
                            <div id="data-container"></div>
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="txt_empid1">
                                <span class="required">Search Employee</span>
                            </label>
                            <input type="text" class="form-control searchEmployeeInput" data-suggestion="suggestionList" autocomplete="off" name="emp1" id="emp1" />

                            <div class="row g-6">
                                <div class="col-md-6 fv-row">
                                    <ul class="list-group mt-2 suggestionList" style="display: none; max-height: 200px; overflow-y: auto;"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 fv-row" id="searchemp2">
                            <div id="data-container"></div>
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="txt_empid1">
                                <span class="required">Search Employee</span>
                            </label>
                            <input type="text" class="form-control searchEmployeeInput" data-suggestion="suggestionList" autocomplete="off" name="emp2" id="emp2">
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <ul class="list-group mt-2 suggestionList" style="display: none; max-height: 200px; overflow-y: auto;"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 fv-row" id="searchemp3">
                            <div id="data-container"></div>
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="txt_empid1">
                                <span class="required">Search Employee</span>
                            </label>
                            <input type="text" class="form-control searchEmployeeInput" data-suggestion="suggestionList" autocomplete="off" name="emp3" id="emp3" />

                            <div class="row g-6">
                                <div class="col-md-6">
                                    <ul class="list-group mt-2 suggestionList" style="display: none; max-height: 200px; overflow-y: auto;"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 fv-row" id="uploadfile" name="uploadfile">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Upload File</span>
                            </label>
                            @if($errors->has('file'))
                            <span class="text-danger">{{$errors->first('file')}}</span>
                            @endif
                            <input type="file" class="form-control " name="excelfile" />
                            <br>

                            <div>
                                <a href="{{route('export')}}" class="btn btn-success  btn-sm">Download Sample</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center" id="submit">
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                        </button>
                    </div>

                </form>
            </div>
            <!-- <input type="text" name="EmployeeID" value="{{ session('EmployeeID') }}" hidden readonly>
            <div id="appendChild"></div> -->
        </div>
        <br>
    </div>
</div>

<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>
<script>
    $(function() {
        $("#location").on(' change', function() {
            var location_val = $(this).val();
            $.ajax({
                url: "{{ url('exceptionprocess') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    location_val: location_val,
                },
                success: function(response) {
                    $("#process").empty();
                    $('#process').append('<option value="' + '">' + ' Select' + '</option>');
                    for (val in response) {
                        var newOption = $('<option value="' + response[val]['cm_id'] + '">' + response[val][
                            'Process'
                        ] + '</option>');
                        $('#process').append(newOption);
                    }
                }
            });
         });


    $('#txt_location').change(function() {
        var val = $(this).val();
        $('#process').empty();
        $.ajax({
            url: "{{ route('searchemp') }}",
        }).done(function(data) { // data what is sent back by the php page
            $('#process').html(data);
            $('select').formSelect();
        });

    });


    $('#listProcess').click(function() {
        var validate = 0;
        if ($("#listProcess").val() == "1") {
            if ($('#location').val() == 'NA') {
                validate = 1;
                $('#location').addClass('has-error');
                //$('#txtID').parent('.select-wrapper').find('.select-dropdown').addClass("has-error");
                if ($('#spantxt_location').size() == 0) {
                    $('<span id="spantxt_location" class="help-block">Required *</span>').insertAfter('#txt_location');
                }
            }

            if ($('#txt_Process').val() == 'NA' || $('#txt_Process').val() == '') {
                validate = 1;
                $('#txt_Process').addClass('has-error');
                //$('#txtID').parent('.select-wrapper').find('.select-dropdown').addClass("has-error");
                if ($('#spantxt_Process').size() == 0) {
                    $('<span id="spantxt_Process" class="help-block">Required *</span>').insertAfter('#txt_Process');
                }
            }
        }

        if ($("#listProcess").val() == "2") {
            if ($('#txt_empid2').val() == '') {
                validate = 1;
                $('#txt_empid2').addClass('has-error');
                //$('#txtID').parent('.select-wrapper').find('.select-dropdown').addClass("has-error");
                if ($('#spantxt_empid2').size() == 0) {
                    $('<span id="spantxt_empid2" class="help-block">Required *</span>').insertAfter('#txt_empid2');
                }
            }
        }

        if ($("#listProcess").val() == "3") {
            if ($('#fileToUpload').val() == '') {
                validate = 1;

                $('#fileToUpload').addClass('has-error');
                //$('#txtID').parent('.select-wrapper').find('.select-dropdown').addClass("has-error");
                if ($('#spanfileToUpload').size() == 0) {
                    $('<span id="spanfileToUpload" class="help-block">Required *</span>').insertAfter('#fileToUpload');
                }
            }

        }

        if ($("#listProcess").val() != "3") {


            if ($('#txt_Module').val() == 'NA') {
                validate = 1;
                $('#txt_Module').addClass('has-error');
                //$('#txtID').parent('.select-wrapper').find('.select-dropdown').addClass("has-error");
                if ($('#spantxt_Module').size() == 0) {
                    $('<span id="spantxt_Module" class="help-block">Required *</span>').insertAfter('#txt_Module');
                }
            }

            if ($('#txt_Level').val() == 'NA') {
                validate = 1;
                $('#txt_Level').addClass('has-error');
                //$('#txtID').parent('.select-wrapper').find('.select-dropdown').addClass("has-error");
                if ($('#spantxt_Level').size() == 0) {
                    $('<span id="spantxt_Level" class="help-block">Required *</span>').insertAfter('#txt_Level');
                }
            }

            if ($('#txt_empid').val() == '') {
                validate = 1;
                $('#txt_empid').addClass('has-error');

                if ($('#spantxt_empid').size() == 0) {
                    $('<span id="spantxt_empid" class="help-block">Required *</span>').insertAfter('#txt_empid');
                }
            }

        }

        if ($('#txt_Level').val() == '2') {
            if ($('#txt_empid1').val() == '') {
                validate = 1;
                $('#txt_empid1').addClass('has-error');

                if ($('#spantxt_empid1').size() == 0) {
                    $('<span id="spantxt_empid1" class="help-block">Required *</span>').insertAfter('#txt_empid1');
                }
            }
        }

        if (validate == 1) {
            return false;
        }
    });
    const resultData = JSON.parse('{!! $result !!}');

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
            listItem.innerHTML = `<a href="#" style="text-decoration-color: currentColor; color: black; font-weight: bold;">${item.name} (${item.id})</a>`;


            listItem.addEventListener('click', () => {
                searchEmployeeInputs.forEach((input, index) => {
                    if (suggestionLists[index] === suggestionList) {
                        input.value = `${item.name} (${item.id})`;
                    }
                });
                suggestionList.style.display = 'none';
            });
            suggestionList.appendChild(listItem);
        });
    }


});

    $(document).ready(function() {
        $('#location1').hide();
        $('#process1').hide();
        $('#module1').hide();
        $('#level1').hide();
        $('#searchemp1').hide();
        $('#searchemp2').hide();
        $('#searchemp3').hide();
        $('#uploadfile').hide();
        $('#submit').hide();

        $('#listProcess').on('change', function() {
            var process = $(this).val();
            //    alert(process);
            if (process == "1") {
                $('#location1').show();
                $('#process1').show();
                $('#module1').show();
                $('#level1').show();
                $('#uploadfile').hide();
                $('#submit').show();
            } else if (process == "2") {
                $('#searchemp1').show();
                $('#module1').show();
                $('#level1').show();
                $('#location1').hide();
                $('#process1').hide();
                $('#submit').show();


            } else if (process == "3") {
                $('#uploadfile').show();
                $('#searchemp1').hide();
                $('#module1').hide();
                $('#level1').hide();
                $('#location1').hide();
                $('#process1').hide();
                $('#submit').show();
            } else {
                $('#searchemp1').hide();
                $('#module1').hide();
                $('#level1').hide();
                $('#uploadfile').hide();
                $('#submit').show();
            }
        });
        $("#emplevel").on('change', function() {

            var process = $(this).val();
            console.log(process);
            if (process == "1") {

                $('#searchemp2').show();
                $('#searchemp3').hide();

            } else if (process == "2") {
                $('#searchemp2').show();
                $('#searchemp3').show();
                // $('#searchemp3').show();
            }
             else {
                $('#searchemp2').hide();
                $('#searchemp3').hide();
            }
        })
    });

    // form validation

    $('#form_module').submit(function(event) {
        event.preventDefault();
        $('.error-message').remove();
        let isValid = true;

        $(this).find('.required').each(function() {
            const input = $(this).closest('.fv-row').find(
                '.form-control, select, textarea');
            const isHidden = $(this).closest('.fv-row').is(':hidden');
            const isTextarea = input.is('textarea');
            if (!input.val() && !isTextarea && !isHidden) {
                isValid = false;
                const fieldName = $(this).text();
                const errorMessage = fieldName + ' is required.';
                $('<div class="error-message text-danger">' + errorMessage + '</div>')
                    .insertAfter(input);
            }
        });
        if (!isValid) {
            return false;
        } else {
            // Serialize form data
            const formData = new FormData(this);
            // this.submit();
            // Send form data using AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false, // Prevent automatic data processing
                contentType: false, // Prevent automatic content-type header
                success: function(response) {
                    toastr.success(response.message, "", {
                        toastClass: "toast-success",
                        progressBar: true
                    })
                },
                error: function(xhr, status, error) {
                    toastr.error("Something went wrong !!", "Error", {
                        toastClass: "toast-error",
                        progressBar: true
                    });
                    console.error(error);
                }
            });
        }
    });
</script>
@endsection
