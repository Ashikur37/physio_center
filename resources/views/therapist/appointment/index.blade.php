@extends('layouts.therapist')

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
                    <table id="d-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Patient Contact</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Appointment At</th>
                                <th>Total</th>
                                <th>Discount</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{$appointment->id}}</td>

                                    <th scope="row">
                                        {{$appointment->user->name}}
                                    </th>
                                    <th>
                                        {{$appointment->user->phone}}
                                    </th>
                                    <th>
                                        {{$appointment->service->name}}
                                    </th>
                                    <th>
                                        {{$appointment->appoint_at}}
                                    </th>
                                    <th>{{$appointment->amount}}</th>
                                    <th>{{$appointment->discount}}</th>

                                    <td>
                                        <a class="btn btn-info" href="{{route('therapist.appointment.show',$appointment->id)}}">View</a>
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
