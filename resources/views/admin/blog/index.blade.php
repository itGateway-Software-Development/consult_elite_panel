@extends('layouts.app')
@section('title', 'Blogs')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-bold' style="color: rgb(8, 184, 8);"></i>
        <div>Blogs</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Blogs List</span>
            @can('user_create')
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary text-decoration-none text-white"><i
                        class='bx bxs-plus-circle me-2'></i>
                    Create New Blog</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100" id="DataTable">
                <thead>
                    <th class="no-sort"></th>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Content</th>
                    <th class="no-sort text-nowrap">Action</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('js/activity/blog.js') }}"></script>
@endsection
