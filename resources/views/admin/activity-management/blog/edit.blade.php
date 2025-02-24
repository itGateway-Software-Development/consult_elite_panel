@extends('layouts.app')
@section('title', 'Edit Blog')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-bold' style="color: rgb(8, 184, 8);"></i>
        <div>Blog Edition</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">Blog Edition</span>

       @include('admin.activity-management.blog.form')
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/activity/blog.js')}}"></script>
@endsection
