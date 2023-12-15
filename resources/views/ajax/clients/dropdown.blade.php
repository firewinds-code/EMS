 @if (!empty($statement) && isset($statement))
          <option value="" >---Select---</option>
           @foreach ($statement as  $list)
                @if ($list->EmployeeID)
                    <option value="{{ $list->EmployeeID }}"> {{ $list->EmployeeName }} - ({{ $list->EmployeeID }})</option>
                @endif
         @endforeach
@endif

@if(!empty($department) && isset($department))
          <option value="" >---Select---</option>
           @foreach ($department as  $list)
                @if ($list->dept_id)
                    <option value="{{ $list->dept_id }}"> {{ $list->dept_name }}</option>
                @endif
         @endforeach
@endif
