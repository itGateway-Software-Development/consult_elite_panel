<div class="my-3">
    <span class="error text-danger"></span>
</div>
<form
    id="{{ request()->is('admin/content-management/success-story/create') ? 'success_story_create_form' : 'success_story_edit_form' }}">
    <div class="row">
        <input type="hidden" name="success_story_id" id="success_story_id" value="{{ isset($successStory) ? $successStory->id : '' }}">

        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Date <span class="text-danger">*</span></label>
                <input type="text" class="form-control date bg-transparent" value="{{isset($successStory) ? $successStory->date : old('date')}}" name="date" placeholder="YYYY-MM-DD">
                <span class="text-danger date_err"></span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Student name <span class="text-danger">*</span></label>
                <input type="text" name="stu_name" class="form-control stu_name" placeholder="eg. Aung Aung"
                    value="{{ isset($successStory) ? $successStory->stu_name : old('stu_name') }}">
                <span class="text-danger stu_name_err"></span>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">College Name <span class="text-danger">*</span></label>
                <input type="text" name="college_name" class="form-control college_name" placeholder="eg. Oxford"
                    value="{{ isset($successStory) ? $successStory->college_name : old('college_name') }}">
                <span class="text-danger college_name_err"></span>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Image <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control image" value="" >
                <span class="text-danger image_err"></span>
                <img src="{{isset($successStory) ? asset('storage').$successStory->image : ''}}" class="mt-2" width="150"  style="object-fit: cover;" alt="" id="preview_img">
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
