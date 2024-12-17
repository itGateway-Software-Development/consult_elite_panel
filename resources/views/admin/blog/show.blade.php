@extends('layouts.app')
@section('title', 'Blog Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-bold' style="color: rgb(8, 184, 8);"></i>
        <div>Blog Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Blog Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th >Date</th>
                    <td>{{ $blog->date }}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $blog->title }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><img src="{{ asset('storage').$blog->images[0]->image }}" width="200"  /></td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td>
                        {!! $blog->content !!}
                    </td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
