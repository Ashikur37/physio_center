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
                            <a href="{{'/employee/patient/list'}}" class="btn btn-success">Patient List</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="/employee/patient/updateRFID">
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
