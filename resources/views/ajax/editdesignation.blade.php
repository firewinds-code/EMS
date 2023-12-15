@if(isset($row))
<label class="required fs-6 fw-semibold mb-2">Name</label>
<input type="text" class="form-control form-control-solid" placeholder="Enter Department"  name="name" value="{{ $row->Designation }}">
<input type="hidden" class="form-control form-control-solid" placeholder="" name="designation_id" value="{{ $row->ID }}">
@endif
@include('includes.commonjs')
