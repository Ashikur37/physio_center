@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Your Appointment List</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{URL::to('/patient/appointment')}}" class="btn btn-success">
                                New Appointment
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="d-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                            <th scope="col" >Category</th>
                            <th scope="col" >Details</th>
                            <th scope="col" >Appointment To</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td scope="row">
                                        {{$appointment->id}}
                                    </td>
                                    <td scope="row">
                                        {{$appointment->name}}
                                    </td>
                                    <td>
                                        {{$appointment->details}}
                                    </td>
                                    <td>
                                        {{$appointment->appoint_at}}
                                    </td>
                                    <td>
                                        @if($appointment->status == 1)
                                            <b class="text-success">Active</b>
                                        @elseif($appointment->status == 0)
                                            <b class="text-primary">Pending</b>
                                        @elseif($appointment->status == 2)
                                            <b class="text-danger">Complete</b>
                                        @elseif($appointment->status == 3)
                                            <b class="text-dark">Prescribe</b>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="{{route('patient.appointment.show',$appointment->id)}}">View</a>
                                        <?php
                                            if(isset($appointment->status)):
                                                if($appointment->status == 0):
                                        ?>
                                            <a class="btn btn-info" href="{{URL::to('/patient/appointment/edit/'.$appointment->id)}}">Edit</a>
                                            <a class="btn btn-danger" href="{{URL::to('#')}}">Delete</a>
                                        <?php elseif($appointment->status == 1): ?>
                                               
                                        <?php endif; endif;
                                        ?>
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
