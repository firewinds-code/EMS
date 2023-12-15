<div class="col-md-12 fv-row">
    <div class="form-group">
        <select class="duallistbox" id="multipleSelect" name="process[]" multiple="multiple">

            @if (isset($processes) && isset($query))
                @php
                    $i = 0;
                @endphp
                @foreach ($processes as $list)
                    @php
                        $isSelected = false;
                    @endphp
                    @foreach ($query as $queryItem)
                        @if ($queryItem->cm_id == $list->cm_id)
                            @php
                                $isSelected = true;
                                break;
                            @endphp
                        @endif
                    @endforeach
                    <option value="{{ $list->cm_id }}" @if ($isSelected) selected @endif>
                        {{ $list->Process }}
                    </option>
                    @php
                        $i++;
                    @endphp
                @endforeach
            @endif

        </select>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('.duallistbox').bootstrapDualListbox({
            selectorMinimalHeight: 200,
            nonSelectedListLabel: '<span style="font-weight: bold; font-size: 16px;">All Processes</span>',
            selectedListLabel: '<span style="font-weight: bold; font-size: 16px;">Selected Processes</span>',
            infoText: 'Process {0}',
            infoTextEmpty: 'Please select at least one Process',
            infoTextFiltered: '<span class="label label-warning">Filtered</span> {0} from {1}', // Customize filtered info text
        });

        $('#formDrm').on('submit', function(events) {
            event.preventDefault();
            $('.error-message').remove();
            let isValid = true;
            var checkvalues = '';

            selected = $("#multipleSelect :selected").map(function(i, el) {
                return $(el).val();
            }).get();
            if (selected.length == 0) {
                toastr.warning('Please select atleast one process !', "warning", {
                    toastClass: "toast-warning",
                    progressBar: true
                });
                return false;
            }
        });

    });
</script>
