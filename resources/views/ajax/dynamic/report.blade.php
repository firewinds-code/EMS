<div class="col-md-12 fv-row">
    <div class="form-check" name="reports[]" id="reports">
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="flexCheckDefault">

            @if (isset($reports) && isset($reportIDs))
                @foreach ($reports as $key => $value)
                    @php
                        $isChecked = false;
                    @endphp
                    @foreach ($reportIDs as $reportID)
                        @if ($reportID->reportID == $value->id)
                            @php
                                $isChecked = true;
                                break;
                            @endphp
                        @endif
                    @endforeach

                    <div class="form-check ">
                        <input class="form-check-input report" name="report[]" type="checkbox" value="{{ $value->id }}"
                            @if ($isChecked) checked @endif />
                        <span>{{ $value->report_name }} &emsp;&emsp;&emsp;</span>
                    </div>
                @endforeach
            @endif

        </label>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#formDrm').on('submit', function(events) {
            event.preventDefault();
            $('.error-message').remove();
            let isValid = true;
            var checkvalues = '';
            checkvalues = $("input[name='report[]']:checked")
                .map(function() {
                    return $(this).val();
                }).get();

            if (checkvalues == '') {

                toastr.warning('Please Choose atleast one report !', "warning", {
                    toastClass: "toast-warning",
                    progressBar: true
                });
                return false;
            }
        });
    });
</script>
