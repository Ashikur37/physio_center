@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-2">
                        <b>Therapy List</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Blood</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Appointment To</th>
                            <th scope="col">Details</th>
                            <th scope="col" width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
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
                                        <a  class="btn btn-success my-1"
                                            href="{{'/doctor/therapy/update/'.$appointment->id.'/'.$appointment->p_id}}">
                                            Update Therapy
                                        </a>
                                        <a  class="btn btn-info"
                                            href="{{'/doctor/appointment/therapy/'.$appointment->id.'/'.$appointment->p_id}}">
                                            Add Another Therapy
                                        </a>
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
