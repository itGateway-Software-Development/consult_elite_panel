@extends('layouts.app')
@section('title', 'Create Success Story')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-graduation' style="color: rgb(8, 184, 8);"></i>
        <div>Success Story Creation</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">Success Story Creation</span>

       @include('admin.content-management.success-story.form')
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/content-management/success_story.js')}}"></script>
@endsection
