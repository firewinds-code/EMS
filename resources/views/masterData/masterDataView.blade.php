@extends('includes.master')
@section('content')
@section('page-title', 'Master Data Report')
@section('page-heading', 'Master Data Report')

    <div id="kt_app_content_container" class="app-container container-xxl">
        
            <div class="card cardOutline">
                <div class="card-body">
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold"><span class="required">Status</span></label>
                            <select class="form-select form-select-solid status_type" data-control="select2"
                                data-placeholder="Select an option" name="status_type" id="status_type">
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-6 fv-row" id='DOJHS'>
                            <label class="fs-6 fw-semibold"><span class="required">DOJ Year</span></label>
                            <select class="form-select form-select-solid status_type" data-control="select2"
                                data-placeholder="Select an Year" name="txt_dateYear" id="txt_dateYear">
                                @php
                                    $year_range = date('Y');
                                    $Year = '';
                                @endphp
                                @for ($i = 0; $i <= 18; $i++)
                                    @php
                                        $year = $year_range - $i;
                                    @endphp
                                    <option {{ $Year == $year ? 'selected' : '' }} value='{{ $year }}'>
                                        {{ $year }}</option>
                                @endfor
                                <option {{ $Year == 'All' ? 'selected' : '' }} value='0'>All</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center my-3">
                <div class="spinner-border text-primary" role="status">
                   <span class="visually-hidden">Loading...</span>
                </div>
             </div>
            <br>
            
   
        <div id="table"></div>
    </div>

@endsection
<script src="{{ asset('utills/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('utills/dist/assets/js/scripts.bundle.js') }}"></script>


<script>
    $(document).ready(function() {
        $('#table').hide();
        $('.spinner-border').hide();
        $('#DOJHS').hide();
        $('.status_type').on('change', function() {
            var selectedOption = $(this).val();
            if (selectedOption == 'Active') {
                $('#table').show();
                $('#DOJHS').hide();
                $('.spinner-border').show();
                $.ajax({
                    url: "{{ url('getActiveData') }}",
                    method: 'GET',
                    success: function(response) {
                        $('.spinner-border').hide();
                        $('#table').html(response.table);
                    },
                    error: function(xhr, status, error) {
                        $('.spinner-border').hide();
                        console.error(error);
                    }
                });
            }
            if (selectedOption == 'Inactive') {
                $('#DOJHS').show();
                $('#table').hide();
            }
        });

        $('#txt_dateYear').on('change', function() {
            $('#table').show();
            var year = $(this).val();
            $('.spinner-border').show();

            $.ajax({
                url: "{{ route('getInactiveData') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'year': year
                },

                success: function(response) {
                    $('.spinner-border').hide();
                    $('#table').html(response.table);
                },
                error: function(xhr, status, error) {
                    $('.spinner-border').hide();
                    console.error(error);
                }
            });

        });
    });
</script>
