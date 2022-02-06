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
                        <b>Machine List</b>
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
                        @foreach($machines as $machine)
                            <tr>
                                <td>{{$machine->name}}</td>
                                <td>
                                <div class="btn-group">

                                    <a  class="btn btn-info btn-sm"
                                        href="{{route('machine.edit',$machine->id)}}">
                                        Edit
                                    </a>

                                    <a  class="btn btn-danger btn-sm"
                                    href="{{route('machine.remove',$machine->id)}}">
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
