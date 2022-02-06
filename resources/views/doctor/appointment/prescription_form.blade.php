@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add Prescription</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Menu
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{'/patient/home'}}">Home</a>
                              <a class="dropdown-item" href="{{'/patient/profile'}}">Profile</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="{{'/patient/appointment'}}">New Appointment</a>
                              <a class="dropdown-item" href="{{'/patient/appointment/list'}}">Appointment List</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">History</a>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    @if(session('error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    <form method="post" action="{{URL::to('/doctor/appointment/prescription/store')}}"
                          enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <input hidden type="text" value="{{$patient_id}}" name="patient_id">
                        <input hidden type="text" value="{{$appointment_id}}" name="appointment_id">
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-2 col-form-label">Advice</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPassword3" name="details">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-2 col-form-label">Medicine</label>
                          <div class="col-sm-10" id="medicine_list">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPassword4" class="col-sm-2 col-form-label">Upload Prescription</label>
                          <div class="col-md-10">
                              <input type="file" name="image" class="form-control">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                          <div class="col-sm-10">
                            <button type="button" class="btn btn-success" id="addMedicine">
                              Add Another
                            </button>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="doses" class="col-sm-2 col-form-label">Test</label>
                            <div class="col-sm-6">
                                <select  multiple name="tests[]" id="" class="select2 form-control">
                                    @foreach($tests as $test)
                                        <option value="{{$test->id}}">{{$test->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="doses" class="col-sm-2 col-form-label">BP</label>
                            <div class="col-sm-6">
                                <input type="text" name="bp" class="form-control" value="{{$profile->bp}}">
                            </div>
                          </div>
                        <div class="form-group row">
                          <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Add</button>
                          </div>
                        </div>
                    </form>
                  </div>
              </div>
          </div>
    </div>
</div>

@endsection


@section('script')

<script>
    $(document).ready(function(){
        $('.select2').select2();
       $("#addMedicine").on('click', function(event){
          event.preventDefault();
          var element = '<div class="row">'+
                                '<div class="col-md-3">'+
                                  '<input type="text" placeholder="Medicine name" class="form-control" name="medicine_name[]"><br>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                  '<select class="custom-select" name="meal[]">'+
                                    '<option value="1">Before Meal</option>'+
                                    '<option value="2">After Meal</option>'+
                                  '</select>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                  '<input type="number" class="form-control" name="medicine_liquid[]" min="0" placeholder="Doses spoon/pic ">'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                  '<select class="custom-select" name="medicine_solid[]">'+
                                    '<option value="1">1 + 1 + 1</option>'+
                                    '<option value="2">1 + 0 + 1</option>'+
                                    '<option value="6">0 + 1 + 1</option>'+
                                    '<option value="3">1 + 0 + 0</option>'+
                                    '<option value="4">0 + 0 + 1</option>'+
                                    '<option value="5">0 + 1 + 0</option>'+
                                  '</select>'+
                                '</div>'+
                              '</div>';
        $("#medicine_list").append(element);
       })
    });
  </script>
  @endsection
