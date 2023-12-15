@if(isset($status) && isset($cmid))
<div class="modal-body py-10 px-lg-17">
    <div class="scroll-y me-n7 pe-7" id="kt_modal_edit_process_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_process_header" data-kt-scroll-wrappers="#kt_modal_edit_process_scroll" data-kt-scroll-offset="300px" style="">
     <div class="fv-row mb-7 fv-plugins-icon-container" id="edit_client">
         <label class="required fs-6 fw-semibold mb-2">Client Name</label>
         <select  aria-label="Select a Country" name="client" data-control="select2" data-placeholder="Select a Clients..." class="form-select form-select-solid form-select-lg fw-semibold">
             @php  $process = getprocess(); @endphp
             @foreach($process as $list)
                <option @if($list->cm_id == $cmid) selected  @endif value="{{ $list->cm_id }}">{{ $list->client_name }}|{{ $list->process }}|{{ $list->sub_process }}</option>

             @endforeach
         </select>
         <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
    </div>
</div>
<div class="col-lg-8 fv-row">
 <label class="required fs-6 fw-semibold mb-2">Status</label>
 <select  aria-label="Select a Country" data-control="select2" name="status" data-placeholder="Select a Status..." class="form-select form-select-solid form-select-lg fw-semibold">
     <option  @if($status == 0) selected  @endif  value="1">Active</option>
     <option  @if($status == 1) selected  @endif value="0">In-Active</option>
 </select>
 <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
</div>
</div>

 @endif

@include('includes.commonjs')




