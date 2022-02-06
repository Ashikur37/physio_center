@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
           <div class="card">
               <div class="card-body">

                <form  method="post" action="{{route('leave.update',$leaveApplication->id)}}">
                    @csrf
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Leave Application #{{$leaveApplication->id}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>User</th>
                                <td>{{$leaveApplication->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Leave Type</th>
                                <td>{{$leaveApplication->description}}</td>
                            </tr>
                            <tr>
                                <th>Start Date</th>
                                <td>
                                    <input name="start" type="date" class="form-control" value="{{$leaveApplication->start_date}}">
                                </td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td>
                                    <input name="end" type="date" class="form-control" value="{{$leaveApplication->end_date}}">
                                </td>
                            </tr>

                            <tr>
                                <th>Applied At</th>
                                <td>{{$leaveApplication->created_at->format('h:i a d-m-y')}}</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="form-group">
                        <button class="btn btn-info">Update</button>
                    </div>
                </form>
               </div>
           </div>
        </div>
        <div class="col-md-6">

            <div class="card">

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="5" >Leave Notes</th>
                            </tr>

                        </thead>
                        <tbody>
                           @foreach($leaveApplication->notes as $note)
                            <tr>
                                <td>{{$note->created_at->format('h:i a d-m-y')}}</td>
                                <td>{{$note->user->name}}</td>
                                <td>{{$note->note}}</td>

                            </tr>
                             @endforeach
                             <tr>
                                <th>Add Note</th>
                                <td>
                                    <form action="{{route('leave.note.store',$leaveApplication->id)}}" method="post">
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
