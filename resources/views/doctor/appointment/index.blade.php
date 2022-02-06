@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-2">
                        <b>Your Appointment List</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="d-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Blood</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Appointment To</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>
                                        {{$appointment->id}}
                                    </td>
                                    <th scope="row">
                                        {{$appointment->user_name}}
                                    </th>
                                    <td>
                                        {{$appointment->age}}
                                    </td>
                                    <td>
                                        {{$bloods[$appointment->blood]}}
                                    </td>
                                    <td>
                                        @if($appointment->gender == 1)
                                            <b class="text-success">Male</b>
                                        @else
                                            <b class="text-danger">Female</b>
                                        @endif
                                    </td>
                                    <td>
                                        {{$appointment->appoint_at}}
                                    </td>
                                    <td>
                                       {{$appointment->details}}
                                    </td>
                                    <td>
                                        <div class="btn btn-group">
                                            <a class="btn btn-warning btn-sm" href="{{route('doctor.appointment.show',$appointment->id)}}">
                                                Show
                                            </a>
                                            <a
                                                class="btn btn-info btn-sm"
                                                href="{{URL::to('/doctor/appointment/refer/'.$appointment->id.'/'.$appointment->p_id)}}">
                                                Refer
                                            </a>
                                            <a
                                                class="btn btn-primary btn-sm"
                                                href="{{URL::to('/doctor/appointment/therapy/'.$appointment->id.'/'.$appointment->p_id)}}">
                                                Therapy
                                            </a>
                                            <a
                                                class="btn btn-success btn-sm"
                                                href="{{URL::to('/doctor/appointment/prescription/'.$appointment->id.'/'.$appointment->p_id)}}">
                                                Prescription
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
@endsection
