@extends('layouts.app')
@section('title', 'Success Rates')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-trophy' style="color: rgb(8, 184, 8);"></i>
        <div>Success Rates</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Success Rates List</span>
            @can('user_create')
                <a href="{{ route('admin.success-rate.create') }}" class="btn btn-primary text-decoration-none text-white"><i
                        class='bx bxs-plus-circle me-2'></i>
                    Create New Success Rate</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100" id="DataTable">
                <thead>
                    <th class="no-sort"></th>
                    <th>Order Number</th>
                    <th>Rate Count ENG</th>
                    <th>Rate Count MM</th>
                    <th>Description ENG</th>
                    <th>Description MM</th>
                    <th class="no-sort text-nowrap">Action</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('js/content-management/success_rate.js') }}"></script>
@endsection
