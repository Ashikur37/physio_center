@extends('layouts.app')

@section('content')
<!-- /.card-header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>RFID</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Blood</th>
                      <th>Gender</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($patients as $patient)
                        <tr>
                            <td>
                                {{$patient->name}}
                            </td>
                            <td>
                                {{$patient->phone}}
                            </td>
                            <td>
                                {{$patient->rfid}}
                            </td>
                            <td>
                                {{$patient->email}}
                            </td>
                            <td>
                                {{$patient->address}}
                            </td>
                            <td>
                                <?php
                                    if($patient->blood == 1){
                                        echo 'A+';
                                    } elseif(($patient->blood == 2)){
                                        echo 'A-';
                                    } elseif(($patient->blood == 3)){
                                        echo 'B+';
                                    } elseif(($patient->blood == 4)){
                                        echo 'B-';
                                    } elseif(($patient->blood == 5)){
                                        echo 'AB+';
                                    } elseif(($patient->blood == 6)){
                                        echo 'AB-';
                                    } elseif(($patient->blood == 7)){
                                        echo 'O+';
                                    } elseif(($patient->blood == 8)){
                                        echo 'O-';
                                    }
                                ?>
                            </td>
                            <td>
                                @if($patient->gender == 1)
                                    <b class="text-success">
                                        Male
                                    </b>
                                @elseif($patient->gender == 2)
                                    <b class="text-primary">
                                        Female
                                    </b>
                                @else($patient->gender == 0)
                                    <b class="text-danger">
                                        Undefined
                                    </b>
                                @endif
                            </td>
                            <td>
                                @if($patient->status == 1)
                                    <b class="text-success">
                                        Active
                                    </b>
                                @elseif($patient->status == 0)
                                    <b class="text-danger">
                                        In-active
                                    </b>
                                @else($patient->status == 2)
                                    <b class="text-danger">
                                        Block
                                    </b>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown float-right">
                                    <a class="btn btn-warning btn-sm" href="{{'/employee/patient/rfid/'.$patient->patient_id}}">
                                        Add RFID
                                    </a>
                                    <a class="btn btn-info btn-sm"
                                        href="{{'/employee/patient/edit/'.$patient->id.'/'.$patient->patient_id}}">
                                        Edit
                                    </a> <br/>
                                    <a class="btn btn-success btn-sm my-1"
                                        href="{{'/employee/patient/change-status/'.$patient->id}}">
                                        Change status
                                    </a> <br/>
                                    <a class="btn btn-danger btn-sm"
                                        href="{{'/employee/patient/delete/'.$patient->id}}">
                                        Delete
                                    </a> <br/>
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
<!-- /.card-body -->
@endsection
