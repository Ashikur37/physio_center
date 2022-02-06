@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Assign Appointment</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/employee/appointment/list'}}" class="btn btn-success">Appointment List</a>
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

                    <form method="post" action="/employee/appointment/assign">
                      {{ csrf_field() }}
                      <input type="number" name="appointment_id" value={{$appointments[0]->id}} hidden />
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Patient Name</label>
                        <div class="col-sm-6">
                          <input  type="text"
                                  class="form-control"
                                  readonly="true"
                                  value="{{$appointments[0]->user_name}}" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Patient Phone</label>
                        <div class="col-sm-6">
                          <input  type="text"
                                  class="form-control"
                                  readonly="true"
                                  value="{{$appointments[0]->phone}}" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Details</label>
                        <div class="col-sm-6">
                          <input  id="name"
                                  type="text"
                                  class="form-control"
                                  readonly="true"
                                  value="{{$appointments[0]->details}}" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Appoint At</label>
                        <div class="col-sm-6">
                          <input  id="name"
                                  type="text"
                                  class="form-control"
                                  readonly="true"
                                  value="{{$appointments[0]->appoint_at}}" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="assign_doctor" class="col-sm-2 col-form-label">Assign Doctor*</label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="assign_doctor">
                              @foreach($doctor as $doc)
                                {{ $select = ($doc->userId == $appointments[0]->doctor_id) ? 'selected' : '' }}
                                <option value={{$doc->userId}} {{$select}}>
                                  {{$doc->dname}} -
                                  {{$doc->sname}} Specialist
                                </option>
                              @endforeach
                          </select>
                          @if ($errors->has('assign_doctor'))
                              <span class="text-danger">{{ $errors->first('assign_doctor') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                      </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
