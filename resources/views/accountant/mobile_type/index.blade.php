@extends('layouts.accountant')

@section('content')
<!-- /.card-header -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Mobile Agent Type List</b>
                      </div>
                      <div class="col-md-6">
                        <a class="btn btn-info" href="{{route('mobile-agent-type.create')}}">Add New</a>
                      </div>
                    </div>
                </div>
                <div class="card-body " >
                    <table id="d-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Name</th>

                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mobileAgentTypes as $mobileAgentType)
                            <tr>
                                <td>{{$mobileAgentType->name}}</td>
                                <td>
                                <div class="btn-group">

                                    <a  class="btn btn-info btn-sm"
                                        href="{{route('mobile-agent-type.edit',$mobileAgentType->id)}}">
                                        Edit
                                    </a>

                                    <a  class="btn btn-danger btn-sm"
                                    href="{{route('mobile-agent-type.remove',$mobileAgentType->id)}}">
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
