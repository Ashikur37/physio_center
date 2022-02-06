@extends('layouts.app')

@section('content')
<!-- /.card-header -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <td>{{$task->title}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{$task->description}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($task->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($task->status == 1)
                                        <span class="badge badge-success">Progressing</span>
                                    @else
                                        <span class="badge badge-danger">Completed</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <form action="{{route('task.note.status',$task->id)}}">

                                    <th>
                                        <select name="status" id="" class="form-control">
                                            <option value="0">Pending</option>
                                            <option {{$task->status==0?'selected':''}} value="1">Progressing</option>
                                            <option {{$task->status==1?'selected':''}} value="2">Completed</option>

                                        </select>
                                    </th>
                                    <td>
                                        <button class="btn btn-success">Update</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
           <div class="card">
               <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Tracks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($task->statuses as $status)
                        <tr>
                            <th>
                                @if($status->status == 0)
                                <span class="badge badge-warning">Pending</span>
                            @elseif($status->status == 1)
                                <span class="badge badge-success">Progressing</span>
                            @else
                                <span class="badge badge-danger">Completed</span>
                            @endif

                          </th>
                          <th>
                            {{$status->created_at->diffForHumans()}}
                          </th>
                            <td>{{$status->user->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               </div>
           </div>
           <div class="card">
            <div class="card-body">
             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th colspan="2">Assigns</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($task->assigns as $assign)
                     <tr>
                         <td>
                            <b>{{$assign->assignedBy->name}}</b> assigned to <b>{{$assign->assignedTo->name}}</b>
                       </td>
                       <th>
                         {{$assign->created_at->diffForHumans()}}
                       </th>

                     </tr>
                     @endforeach

                 </tbody>
             </table>
            </div>
        </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task->notes as $note)
                            <tr>
                                <th>
                                    {{$note->user->name}}
                                    <br>
                                {{$note->created_at->diffForHumans()}}</th>
                                <td>{{$note->note}}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <th>Add Note</th>
                                <td>
                                    <form action="{{route('task.note.store',$task->id)}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="note" id="note" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">Add Note</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
