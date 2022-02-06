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
                        <b>Group List</b>
                      </div>
                    </div>
                </div>
                <div class="card-body " >
                    <table id="d-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                        <th>Name</th>
                        <th>Therapies</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lists as $group)
                            <tr>
                                <td>{{$group->id}}</td>
                                <td>{{$group->name}}</td>
                                <td>
                                    @foreach($group->therapies as $therapy)
                                       <li>
                                        {{$therapy->therapy_name}}
                                       </li>
                                    @endforeach
                                </td>
                                <td>
                                <div class="btn-group">

                                    <a  class="btn btn-info btn-sm"
                                        href="{{route('group.edit',$group->id)}}">
                                        Edit
                                    </a>

                                    <a  class="btn btn-danger btn-sm"
                                    href="{{route('group.remove',$group->id)}}">
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
