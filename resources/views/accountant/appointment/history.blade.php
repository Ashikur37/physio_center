@extends('layouts.compounder')

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
                    <tr>
                        <th colspan="2">
                            <a href="{{route('appointment.therapy.give',$appointmentTherapy->id)}}" class="btn btn-info ">Give Now</a>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
