@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">

                <div class="card-header">
                    <h5><u>Patient Info</u></h5>
                    <strong>Name :</strong>
                    {{isset($user[0])? $user[0]->name : '*'}} <br/>
                    <strong>Age :</strong>
                    {{isset($user[0])? $user[0]->age : '*'}} <br/>
                    <strong>Gender :</strong>
                    {{isset($user[0])? ($user[0]->gender == 1)? 'Male':'Female' : '*'}} <br/>
                    <strong>Blood :</strong>
                    <?php
                        switch(isset($user[0]->blood)):
                            case 1:
                                echo 'A+';
                                break;
                            case 2:
                                echo 'A-';
                                break;
                            case 3:
                                echo 'B+';
                                break;
                            case 4:
                                echo 'B-';
                                break;
                            case 5:
                                echo 'AB+';
                                break;
                            case 6:
                                echo 'AB-';
                                break;
                            case 7:
                                echo 'O+';
                                break;
                            case 8:
                                echo 'O-';
                                break;
                            default:
                                echo '*';
                        endswitch
                    ?>
                </div>

                <div class="card-body">
                    <h5>Prescription History</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Service Name</th>
                            <th scope="col">Details</th>
                            <th scope="col">Created</th>
                            <th scope="col" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prescription as $prescrip)
                                <tr>
                                    <th scope="row">
                                        {{$prescrip->service_name}}
                                    </th>
                                    <td>
                                        {{$prescrip->details}}
                                    </td>
                                    <td>
                                        {{date('d M, Y', strtotime($prescrip->created_at))}}
                                    </td>
                                    <td>
                                        <a class="btn-sm btn-success"
                                           href="{{'/doctor/patient-appointment/view-history/'.$prescrip->id}}">
                                           Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <h5>Therapy History</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Service Name</th>
                            <th scope="col">Therapy Name</th>
                            <th scope="col">Details</th>
                            <th scope="col">Created</th>
                            <th scope="col" width="30%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histories as $history)
                                <tr>
                                    <th scope="row">
                                        {{$history->service_name}}
                                    </th>
                                    <td>
                                        {{$history->therapy_name}}
                                    </td>
                                    <td>
                                        {{$history->details}}
                                    </td>
                                    <td>
                                        {{date('d M, Y', strtotime($history->created_at))}}
                                    </td>
                                    <td>
                                        <a class="btn-sm btn-success mx-2"
                                            href="{{'/doctor/search-patient/update-therapy-form/'.$history->id.'/'.$user[0]->patient_id}}">
                                            Update Therapy
                                        </a>
                                        {{-- <a  class="btn-sm btn-info"
                                            href="{{'/doctor/search-patient/add-therapy/'.$history->id.'/'.$user[0]->patient_id}}">
                                            Add New Therapy
                                        </a> --}} 
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
