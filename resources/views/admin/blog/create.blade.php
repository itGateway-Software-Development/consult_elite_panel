@extends('layouts.app')
@section('title', 'Create Blog')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-bold' style="color: rgb(8, 184, 8);"></i>
        <div>Blog Creation</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">Blog Creation</span>

       @include('admin.blog.form')
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/activity/blog.js')}}"></script>
@endsection
