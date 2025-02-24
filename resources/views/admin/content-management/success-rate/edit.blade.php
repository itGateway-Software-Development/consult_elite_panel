@extends('layouts.app')
@section('title', 'Edit Success Rate')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-trophy' style="color: rgb(8, 184, 8);"></i>
        <div>Success Rate Edition</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">Success Rate Edition</span>

       @include('admin.content-management.success-rate.form')
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/content-management/success_rate.js')}}"></script>
@endsection
