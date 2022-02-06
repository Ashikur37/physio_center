@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Update RFID</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/patient/list'}}" class="btn btn-success">Patient List</a>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Menu
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{'/admin/home'}}">Home</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{'/admin/appointment/list'}}">Appointments</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{'/admin/patient/add'}}">Add Patient</a>
                                <a class="dropdown-item" href="{{'/admin/patient/list'}}">Patient List</a>
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

                    <form method="post" action="/admin/patient/updateRFID">
                      {{ csrf_field() }}
                      <input type="number" name="user_id" value={{$patient[0]->id}} hidden />
                      <div class="form-group row">
                        <label for="rfid" class="col-sm-2 col-form-label">RFID*</label>
                        <div class="col-sm-6">
                          <input id="rfid" type="text" class="form-control" name="rfid" value="{{$patient[0]->rfid}}"/>
                          @if ($errors->has('rfid'))
                              <span class="text-danger">{{ $errors->first('rfid') }}</span>
                          @endif
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
