@extends('layouts.app')
@section('title', 'Success Story Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-graduation' style="color: rgb(8, 184, 8);"></i>
        <div>Success Story Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Success Story Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th >Date</th>
                    <td>{{ $successStory->date }}</td>
                </tr>
                <tr>
                    <th>Student Name</th>
                    <td>{{ $successStory->stu_name }}</td>
                </tr>
                <tr>
                    <th>College Name</th>
                    <td>{{ $successStory->college_name }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        <img src="{{ $successStory->image ? asset('storage').$successStory->image : asset('storage/images/default.jpg') }}" width="200"  />
                    </td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
