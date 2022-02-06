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
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/appointment/add'}}" class="btn btn-success">
                                Add Appointment
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
                                <th scope="col">Patient Name</th>
                                <th scope="col">Patient Contact</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Applied At</th>

                                <th scope="col">Appointment At</th>
                                @if(request()->has('therapy'))
                                <th scope="col">Therapy</th>
                                <th scope="col">Given</th>

                                @else
                                <th scope="col">Total</th>
                                <th scope="col">Paid</th>
                                @endif
                                <th class="non" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{$appointment->id}}</td>
                                    <th scope="row">
                                        {{$appointment->user->name}} ({{$appointment->user->rfid}})
                                    </th>
                                    <th>
                                        {{$appointment->user->phone}}
                                    </th>
                                    <th>
                                        {{$appointment->service->name}}
                                    </th>
                                    <th>
                                        {{$appointment->created_at->format('d-m-Y')}}
                                        <br>
                                        {{$appointment->created_at->format('h:i a')}}

                                    </th>
                                    <th>
                                        {{Carbon\Carbon::parse($appointment->appoint_at)->format('d-M-y')}}
                                    </th>
                                    @if(request()->has('therapy'))
                                    <td>
                                        {{$appointment->therapies->sum('total')}}
                                     </td>
                                     <td>
                                        {{$appointment->therapies->sum('given')}}
                                      </td>

                                @else
                                <td>
                                    {{$appointment->amount}}
                                 </td>
                                 <td>
                                     {{$appointment->given}}
                                  </td>
                                @endif

                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-info" href="{{URL::to('/admin/appointment/edit/'.$appointment->id)}}">Edit</a>
                                            <a class="btn btn-success" href="{{URL::to('/admin/appointment/show/'.$appointment->id)}}">Show</a>

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
