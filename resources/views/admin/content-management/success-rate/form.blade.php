<div class="my-3">
    <span class="error text-danger"></span>
</div>
<form
    id="{{ request()->is('admin/content-management/success-rate/create') ? 'success_rate_create_form' : 'success_rate_edit_form' }}">
    <div class="row">
        <input type="hidden" name="success_rate_id" id="success_rate_id" value="{{ isset($successRate) ? $successRate->id : '' }}">

        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Rate Count (ENG) <span class="text-danger">*</span></label>
                <input type="text" name="rate_count_eng" class="form-control rate_count_eng" placeholder="eg. 10 +"
                    value="{{ isset($successRate) ? $successRate->rate_count_eng : old('rate_count_eng') }}">
                <span class="text-danger rate_count_eng_err"></span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Rate Count (MM) <span class="text-danger">*</span></label>
                <input type="text" name="rate_count_mm" class="form-control rate_count_mm" placeholder="eg. ၁၀ +"
                    value="{{ isset($successRate) ? $successRate->rate_count_mm : old('rate_count_mm') }}">
                <span class="text-danger rate_count_mm_err"></span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Order Number <span class="text-danger">*</span></label>
                <input type="number" name="order_number" class="form-control order_number" placeholder="eg. 1"
                    value="{{ isset($successRate) ? $successRate->order_number : old('order_number') }}">
                <span class="text-danger order_number_err"></span>
            </div>
        </div>


        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Description (ENG) <span class="text-danger">*</span></label>
                <textarea name="description_eng" id="description_eng" cols="30" rows="5" class="form-control cke-editor description_eng" placeholder="Enter description in english ...">{{ isset($successRate) ? $successRate->description_eng : old('description_eng') }}</textarea>
                <span class="text-danger description_eng_err"></span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Description (MM) <span class="text-danger">*</span></label>
                <textarea name="description_mm" id="description_mm" cols="30" rows="5" class="form-control cke-editor description_mm" placeholder="Enter description in myanmar ...">{{ isset($successRate) ? $successRate->description_mm : old('description_mm') }}</textarea>
                <span class="text-danger description_mm_err"></span>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Cancel
        </button>
        <button class="btn btn-primary">Save</button>

    </div>
</form>
