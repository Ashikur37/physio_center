@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Edit Appointment</b>
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
                    <form method="post" action="{{URL::to('/patient/appointment-update')}}">
                      {{ csrf_field() }}
                      <input name="id" type="hidden" value={{$appointment[0]->id}}>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="service_id">
                            <option selected>Select One</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                  {{ ($service->id == $appointment[0]->service_id) ? 'selected' : '' }}
                                >
                                    {{ $service->name }}
                                </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-2 float-sm-left pt-0">Appoint Date</legend>
                        <div class="col-sm-6">
                          <input id="datepicker"
                            class="form-control"
                            name="appoint_date"
                            value={{date('m/d/Y', strtotime($appointment[0]->appoint_at))}}
                            />
                        </div>
                      </fieldset>
                      <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-2 float-sm-left pt-0">Appoint Time</legend>
                        <div class="col-sm-6">
                          <input id="timepicker"
                            class="form-control"
                            name="appoint_time"
                            value={{date('H:i', strtotime($appointment[0]->appoint_at))}} />
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Details</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputPassword3"
                            name="details" value="{{$appointment[0]->details}}">
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-success">Update Appointment</button>
                      </div>
                    </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
