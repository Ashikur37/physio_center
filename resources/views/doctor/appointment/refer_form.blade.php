@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Refer Doctro</b>
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
                    <form method="post" action="{{URL::to('/doctor/appointment/refer/store')}}">
                        {{ csrf_field() }}
                        <input hidden type="text" value="{{$patient_id}}" name="patient_id">
                        <input hidden type="text" value="{{$appointment_id}}" name="appointment_id">
                        <div class="form-group row">
                          <label for="refer_doctor_id" class="col-sm-2 col-form-label">
                            Refer Doctor
                          </label>
                          <div class="col-sm-4">
                              <select class="custom-select" name="refer_doctor_id">
                                <option selected disabled value="0">Select</option>
                                @foreach($doctors as $doctor)
                                  <option value={{$doctor->id}}>{{$doctor->name}}</option>
                                @endforeach
                              </select>
                              @if ($errors->has('refer_doctor_id'))
                                  <span class="text-danger">{{ $errors->first('refer_doctor_id') }}</span>
                              @endif
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
