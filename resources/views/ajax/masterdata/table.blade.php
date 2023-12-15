<div>
    <div class="card cardOutline">
        <div class="card-body align-items-center py-5 gap-2 gap-md-5">
            <div class="card-body pt-0">
                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                            id="master_data_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px sorting">S No</th>
                                    <th class="min-w-125px sorting">Employee ID</th>
                                    <th class="min-w-125px sorting">Employee Name</th>
                                    <th class="min-w-125px sorting">DOJ</th>
                                    <th class="min-w-125px sorting">Considered Date of Deployment</th>
                                    <th class="min-w-125px sorting">Designation</th>
                                    <th class="min-w-125px sorting">Client</th>
                                    <th class="min-w-125px sorting">Process</th>
                                    <th class="min-w-125px sorting">Sub Process</th>
                                    <th class="min-w-125px sorting">Employee Type</th>
                                    <th class="min-w-125px sorting">Payroll Type</th>
                                    <th class="min-w-125px sorting">Gender</th>
                                    <th class="min-w-125px sorting">Father's Name</th>
                                    <th class="min-w-125px sorting">Motehr's Name</th>
                                    <th class="min-w-125px sorting">Contact Number</th>
                                    <th class="min-w-125px sorting">DOB</th>
                                    <th class="min-w-125px sorting">Current Address</th>
                                    <th class="min-w-125px sorting">Permanent Address</th>
                                    <th class="min-w-125px sorting">CTC</th>
                                    <th class="min-w-125px sorting">Take Home</th>
                                    <th class="min-w-125px sorting">Aadhar Card Number</th>
                                    <th class="min-w-125px sorting">Pan Card Number</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @if (!@empty($result))
                                    @php  $i = 1; @endphp
                                    @foreach ($result as $row)
                                        @php
                                            $emptype = '';
                                            if ($row->rt_type == '1') {
                                                $emptype = 'Full Timer';
                                            } elseif ($row->rt_type == '3') {
                                                $emptype = 'Part Timer';
                                            } elseif ($row->rt_type == '4') {
                                                $emptype = 'Split';
                                            }
                                        @endphp

                                        <tr class="even">
                                            <td>{{ $i }}</td>
                                            <td>{{ $row->EmployeeID }}</td>
                                            <td>{{ $row->EmployeeName }}</td>
                                            <td>{{ $row->DOJ }}</td>
                                            <td>{{ $row->DOD }}</td>
                                            <td>{{ $row->designation }}</td>
                                            <td>{{ $row->client_name }}</td>
                                            <td>{{ $row->Process }}</td>
                                            <td>{{ $row->sub_process }}</td>
                                            <td>{{ $emptype }}</td>
                                            <td>{{ $row->emptype }}</td>
                                            <td>{{ $row->Gender }}</td>
                                            <td>{{ $row->FatherName }}</td>
                                            <td>{{ $row->MotherName }}</td>
                                            <td>{{ $row->mobile }}</td>
                                            <td>{{ $row->DOB }}</td>
                                            <td>{{ $row->address }}</td>
                                            <td>{{ $row->address_p }}</td>
                                            <td>{{ $row->ctc }}</td>
                                            <td>{{ $row->takehome }}</td>
                                            <td>{{ $row->AdharCard }}</td>
                                            <td>{{ $row->PanCard }}</td>
                                        </tr>
                                        @php  $i++; @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#master_data_table').DataTable({
            dom: 'Bfrtip',
            buttons: ['csv', 'excel'],
        });
    });
</script>
