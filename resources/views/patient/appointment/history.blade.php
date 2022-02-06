@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Therapy</th>
                        <td>{{$appointmentTherapy->therapy->therapy_name}}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>{{$appointmentTherapy->total}}</td>
                    </tr>
                    <tr>
                        <th>Given</th>
                        <td>{{$appointmentTherapy->given}}</td>
                    </tr>
                    <tr>
                        <th>Remaining</th>
                        <td>{{$appointmentTherapy->total-$appointmentTherapy->given}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            @foreach($appointmentTherapy->individuals as $individual)
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h4>{{$individual->created_at->format("h:i a d-m-y")}}</h4></div>
                        <div class="col-md-6">
                            {{$individual->user->name}}
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <h5>
                        Machine Used
                    </h5>
                    @foreach($individual->machines as $machine)
                    <li>{{$machine->machine->name}}</li>
                    @endforeach
                    <h5>
                        Note
                    </h5>
                    <p>
                        {{$individual->note}}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
