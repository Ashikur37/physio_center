@extends('layouts.'.auth()->user()->role)

@section('content')
<!-- /.card-header -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Requisition List</b>
                      </div>
                    </div>
                </div>
                <div class="card-body"  >
                    <table id="d-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Created By</th>
                        <th>Assigned to</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requisitions as $requisition)
                            <tr>
                                <td>{{$requisition->id}}</td>
                                <td>{{$requisition->title}}</td>
                                <td>{{$requisition->user->name}}({{$requisition->user->id}})</td>
                                <td>{{$requisition->employee->name}}({{$requisition->employee->id}})</td>

                                <th>
                                    {{$requisition->created_at->format('d-m-Y')}}
                                    <br>
                                    {{$requisition->created_at->format('h:i a')}}

                                </th>
                                <td>
                                    @if($requisition->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($requisition->status == 1)
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                <div class="btn-group">
                                    @if($requisition->employee->id==auth()->user()->id&&$requisition->emp_approved==0)
                                    <a class="btn btn-warning btn-sm" href="{{route('requisition.approve',$requisition->id)}}">
                                        Approve
                                    </a>
                                    @endif
                                    <a  class="btn btn-info btn-sm"
                                        href="#">
                                        Show
                                    </a>

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
