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
                        <b>Leave Type List</b>
                      </div>
                    </div>
                </div>
                <div class="card-body " >
                    <table id="d-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Limit</th>

                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveTypes as $leaveType)
                            <tr>
                                <td>{{$leaveType->name}}</td>
                                <td>{{$leaveType->limit}}</td>
                                <td>
                                <div class="btn-group">

                                    <a  class="btn btn-info btn-sm"
                                        href="{{route('leave-type.edit',$leaveType->id)}}">
                                        Edit
                                    </a>

                                    <a  class="btn btn-danger btn-sm"
                                    href="{{route('leave-type.remove',$leaveType->id)}}">
                                        Delete
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
