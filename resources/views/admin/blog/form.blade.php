<div class="my-3">
    <span class="error text-danger"></span>
</div>
<form id="{{request()->is('admin/activity-management/blogs/create') ? 'blog_create_form' : 'blog_edit_form'}}">
    <div class="row">
        <input type="hidden" name="blog_id" id="blog_id" value="{{isset($blog) ? $blog->id : ''}}">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12" id="series_select">
            <div class="form-group mb-4">
                <label for="">Date <span class="text-danger">*</span></label>
                <input type="text" class="form-control date bg-transparent" value="{{isset($blog) ? $blog->date : old('date')}}" name="date" placeholder="YYYY-MM-DD">
                <span class="text-danger date_err"></span>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control title" value="{{isset($blog) ? $blog->title : old('title')}}">
                <span class="text-danger title_err"></span>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Image <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control image" value="" >
                <span class="text-danger image_err"></span>
                <img src="{{isset($blog) ? asset('storage').$blog->images[0]->image : ''}}" class="mt-2" width="150"  style="object-fit: cover;" alt="" id="preview_img">
            </div>
        </div>

        <div class="col-md-8 col-sm-12 col-12">
            <div class="form-group mb-4">
                <label for="">Content</label>
                <textarea name="content" id="content" cols="30" rows="5" class="form-control cke-editor content">{{isset($blog) ? $blog->content : old('content')}}</textarea>
                <span class="text-danger content_err"></span>
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
