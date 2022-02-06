@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add New App</b>
                      </div>
                       <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/employee/appointment/list'}}" class="btn btn-success">
                              Appointment List
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="/employee/appointment/add-store">
                      {{ csrf_field() }}
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="service_id">
                            <option selected>Select One</option>
                            @foreach ($services as $service)
                              <option value="{{ $service->id }}">
                                {{ $service->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">
                          Patient
                        </label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="patient_id">
                            <option selected>Select One</option>
                              @foreach ($patients as $patient)
                                <option value="{{ $patient->patient_id }}">
                                  {{ $patient->name }} - {{ $patient->rfid }}
                                </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">
                          Doctor
                        </label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="doctor_id">
                            <option selected>Select One</option>
                              @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->userId }}">
                                  {{ $doctor->dname }} --  ({{ $doctor->sname }} - Specialist)
                                </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-2 float-sm-left pt-0">Appoint Date</legend>
                        <div class="col-sm-6">
                          <input id="datepicker" class="form-control" name="appoint_date"/>
                        </div>
                      </fieldset>
                      <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-2 float-sm-left pt-0">Appoint Time</legend>
                        <div class="col-sm-6">
                          <input id="timepicker" class="form-control" name="appoint_time"/>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Details</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputPassword3" name="details">
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
