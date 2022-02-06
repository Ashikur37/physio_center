@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Appointment List</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Patient Contact</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Appointment At</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <th scope="row">
                                        {{$appointment->user_name}}
                                    </th>
                                    <th>
                                        {{$appointment->phone}}
                                    </th>
                                    <th>
                                        {{$appointment->service_name}}
                                    </th>
                                    <th>
                                        {{$appointment->appoint_at}}
                                    </th>
                                    <td>
                                        @if($appointment->status == 1)
                                            <b class="text-success">Active</b>
                                        @elseif($appointment->status == 0)
                                            <b class="text-danger">Pending</b>
                                        @else($appointment->status == 3)
                                            <b class="text-dark">Prescribe</b>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{'/employee/appointment/edit/'.$appointment->id}}">Edit</a>
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
@endsection
