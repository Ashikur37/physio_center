@extends('layouts.app')

@section('content')
<!-- /.card-header -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Leave Applications</b>
                      </div>
                    </div>
                </div>
                <div class="card-body"  >
                    <table id="d-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Start</th>
                        <th>End</th>

                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveApplications as $application)
                            <tr>
                                <td>{{$application->id}}</td>
                                <td>{{$application->user->name}} ({{$application->user->id}})</td>
                                <td>{{$application->leaveType->name}}</td>
                                <td>{{$application->description}}</td>
                                <td>
                                    {{$application->start_date}}
                                </td>
                                <td>
                                    {{$application->end_date}}
                                </td>
                                <th>
                                    {{$application->created_at->format('d-m-Y')}}
                                    <br>
                                    {{$application->created_at->format('h:i a')}}

                                </th>
                                <td>
                                    @if($application->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($application->status == 1)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                <div class="btn-group">
                                    @if($application->status == 0)
                                    <a href="{{route('leave.approve',$application->id)}}" class="btn btn-success btn-sm">Approve</a>
                                    @endif
                                    <a href="{{route('leave.show',$application->id)}}" class="btn btn-success btn-info">Show</a>


                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card-body -->
@endsection
