@extends('layouts.app')
@section('title', 'Success Rate Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-trophy' style="color: rgb(8, 184, 8);"></i>
        <div>Success Rate Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Success Rate Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th >Rate Count Eng</th>
                    <td>{{ $successRate->rate_count_eng }}</td>
                </tr>
                <tr>
                    <th>Rate Count MM</th>
                    <td>{{ $successRate->rate_count_mm }}</td>
                </tr>
                <tr>
                    <th>Order Number</th>
                    <td>{{ $successRate->order_number }}</td>
                </tr>
                <tr>
                    <th>Description Eng</th>
                    <td>
                        {!! $successRate->description_eng !!}
                    </td>
                </tr>
                <tr>
                    <th>Description MM</th>
                    <td>
                        {!! $successRate->description_mm !!}
                    </td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
