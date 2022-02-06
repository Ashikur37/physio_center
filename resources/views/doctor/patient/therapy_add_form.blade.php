@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Assign Therapy</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form 
                        method="post" 
                        action="/doctor/search-patient/store-therapy"
                        enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <input hidden type="text" value="{{$patient_id}}" name="patient_id">
                        <input hidden type="text" value="{{$appointment_id}}" name="appointment_id">
                        <div class="form-group row">
                          <label for="therapy_id" class="col-sm-2 col-form-label">Therapy*</label>
                          <div class="col-sm-6">
                            <select class="custom-select" name="therapy_id">
                              <option selected disabled value="0">Select</option>
                                @foreach($therapy as $data)
                                  <option value="{{$data->id}}">{{$data->therapy_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('therapy_id'))
                                <span class="text-danger">{{ $errors->first('therapy_id') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                    </form>
                  </div>
              </div>
          </div>
    </div>
</div>

@endsection
