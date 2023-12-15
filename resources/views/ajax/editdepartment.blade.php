@if(isset($row))
<label class="required fs-6 fw-semibold mb-2">Name</label>
<input type="text" class="form-control form-control-solid" placeholder="Enter Department"  name="name" value="{{ $row->dept_name }}">
<input type="hidden" class="form-control form-control-solid" placeholder="" name="department_id" value="{{ $row->dept_id }}">
@endif
@include('includes.commonjs')
