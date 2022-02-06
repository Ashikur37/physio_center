@extends('layouts.app')

@section('content')

<?php 
    $type = 0;
    $value = isset($query['value'])?$query['value']:'';
    
    if($query['type'] > 0){
        $type = $query['type'];
    }
?>

<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- select -->
                                <div class="form-group">
                                    <select class="form-control" name="type">
                                        <option value="1" {{($type==1)?"selected":""}}> Search By - RFID </option>
                                        <option value="2" {{($type==2)?"selected":""}}> Search By - Phone No </option>
                                        <option value="3" {{($type==3)?"selected":""}}> Search By - ID </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <input
                                            type="text" name="data" 
                                            class="form-control" 
                                            placeholder="Write here"
                                            value={{$value}}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-info">Search Patient</button>
                            </div>
                        </div>
                    </form>
                </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">RFID</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">
                                        {{$user->name}}
                                    </th>
                                    <td>
                                        {{$user->rfid}}
                                    </td>
                                    <td>
                                        {{$user->phone}}
                                    </td>
                                    <td>
                                        <a  class="btn-sm btn-success"
                                            href="{{'/doctor/patient/history/'.$user->id}}">
                                            View History
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
