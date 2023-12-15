<div class="card-body pt-0">
    <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
                <thead>
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-80px sorting">S No.</th>
                        <th class="min-w-125px sorting">Sender</th>
                        <th class="min-w-125px sorting">Message</th>
                        <th class="min-w-125px sorting">Message Date</th>
                        <th class="min-w-125px sorting">Status</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600">
                    @if (!empty($messages))
                        @php  $i = 1; @endphp
                        @foreach ($messages as $result)
                            <tr class="even">
                                <td>{{ $i }}</td>
                                <td>{{ $result->sender_name }}</td>
                                <td>{{ $result->text_msg }}</td>
                                <td>{{ $result->msg_date }}</td>
                                <td>
                                    @if ($result->ackstatus == 1)
                                        Acknowledged
                                    @elseif ($result->ackstatus == 0)
                                        <a href="{{ __('javaScript::void(0)') }}" id="{{ $result->ID }}"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_edit_customer"
                                            class="menu-link px-3 edit-message">Pending</a>
                                    @endif
                                </td>
                            </tr>
                            @php  $i++; @endphp
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#kt_customers_table').DataTable({
            dom: 'Bfrtip',
            buttons: [''],
        });
        $('.edit-message').on('click', function() {
            var editid = $(this).attr('id');
            $('#message_id').val(editid);
        });
    });
</script>
