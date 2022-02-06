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
                        <b>Slot List</b>
                      </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 75vh;">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Start</th>
                        <th>End</th>

                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slots as $slot)
                            <tr>
                                <td>{{$slot->start}}</td>
                                <td>{{$slot->end}}</td>

                                <td>
                                <div class="btn-group">

                                    <a  class="btn btn-info btn-sm"
                                        href="{{route('slot.edit',$slot->id)}}">
                                        Edit
                                    </a> <br/>

                                    <a  class="btn btn-danger btn-sm"
                                    href="{{route('slot.remove',$slot->id)}}">
                                        Delete
                                    </a> <br/>

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
