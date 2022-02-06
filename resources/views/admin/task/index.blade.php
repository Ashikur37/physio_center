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
                        <b>Task List</b>
                      </div>
                    </div>
                </div>
                <div class="card-body"  >
                    <table id="d-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Employee</th>
                        <th>Created At</th>
                        <th>Due Date</th>

                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->title}}</td>
                                <td>{{$task->description}}</td>
                                <td>
                                    @if($task->user->image)
                                    <img style="width:70px" src="{{asset('images/'.$task->user->image)}}" alt="">
                                    @endif
                                    <br>
                                    {{$task->user->name}}({{$task->user->id}})
                                </td>
                                <th>
                                    {{$task->created_at->format('d-m-Y')}}
                                    <br>
                                    {{$task->created_at->format('h:i a')}}

                                </th>
                                <th>
                                    {{$task->date}}
                                </th>
                                <td>
                                    @if($task->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($task->status == 1)
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                <div class="btn-group">
                                    <a  class="btn btn-warning btn-sm"
                                    href="{{route('task.show',$task->id)}}">
                                    Show
                                </a>
                                    <a  class="btn btn-info btn-sm"
                                        href="{{route('task.edit',$task->id)}}">
                                        Edit
                                    </a>

                                    <a  class="btn btn-danger btn-sm"
                                    href="{{route('task.remove',$task->id)}}">
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
