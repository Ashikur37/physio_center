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
                        <b>Attendence Report</b>
                      </div>
                    </div>
                </div>
                <div class="card-body " >
                    <table id="d-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Date</th>
                        <th>Prsent</th>
                        <th>On Leave</th>
                        <th>Absent</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userAttendences as $r)
                            <tr>
                                <td>{{$r->attendence_date}}</td>
                                <td>{{$r->present}}</td>

                                <td>{{$r->on_leave}}</td>
                                <td>{{$totalUser-$r->present-$r->on_leave}}</td>


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
