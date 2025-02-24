@extends('layouts.app')
@section('title', 'Success Story')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-graduation' style="color: rgb(8, 184, 8);"></i>
        <div>Success Story</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Success Story List</span>
            @can('user_create')
                <a href="{{ route('admin.success-story.create') }}" class="btn btn-primary text-decoration-none text-white"><i
                        class='bx bxs-plus-circle me-2'></i>
                    Create New Success Story</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100" id="DataTable">
                <thead>
                    <th class="no-sort"></th>
                    <th>Date</th>
                    <th>Student Name</th>
                    <th>College Name</th>
                    <th class="no-sort">Image</th>
                    <th class="no-sort text-nowrap">Action</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('js/content-management/success_story.js') }}"></script>
@endsection
