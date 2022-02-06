@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
           <div class="card">
               <div class="card-body">

                <table class="table table-striped">
                    <thead>
                       <tr>
                           <th colspan="2">Patient Profile</th>
                       </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <th>Name</th>
                            <th >{{$patient->user->name}}</th>


                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>
                                {{$patient->phone}}
                            </td>
                        </tr>
                       <tr>
                        <th>
                            RFID

                        </th>
                        <td>
                            {{$patient->rfid}}
                        </td>
                       </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                {{$patient->user->email}}
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                {{$patient->address}}
                            </td>
                        </tr>
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
                            <th colspan="2">Appointments</th>
                        </tr>
                     </thead>
                     <tbody>
                            @foreach ($patient->user->appointments as $appointment)
                            <tr>
                                <td>
                                    <a href="{{URL::to('admin/appointment/show/'.$appointment->id)}}">
                                        {{$appointment->doctor?$appointment->doctor->name:'No Doctor'}}
                                    </a>
                                </td>
                                <td>
                                    {{$appointment->created_at->diffForHumans()}}
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
