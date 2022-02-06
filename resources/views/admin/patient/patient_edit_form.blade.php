@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Update Patient</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/patient/list'}}" class="btn btn-success">Patient List</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="/admin/patient/edit-store">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$patient[0]->id}}" />
                      <input type="hidden" name="patient_id" value="{{$patient[0]->patient_id}}" />
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                          <input id="name" type="text" class="form-control" name="name" value="{{$patient[0]->name}}"/>
                          @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-6">
                          <input id="phone" type="text" class="form-control" name="phone" value="{{$patient[0]->phone}}"/>
                          @if ($errors->has('phone'))
                              <span class="text-danger">{{ $errors->first('phone') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="age" class="col-sm-2 col-form-label">Age</label>
                        <div class="col-sm-6">
                          <input id="age" type="number" class="form-control" name="age" min="1" value="{{$patient[0]->age}}"/>
                          @if ($errors->has('age'))
                              <span class="text-danger">{{ $errors->first('age') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-6">
                          <input id="password" type="password" class="form-control" name="password" value=""/>
                          @if ($errors->has('password'))
                              <span class="text-danger">{{ $errors->first('password') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-6">
                          <input id="email" type="email" class="form-control" name="email" value="{{$patient[0]->email}}"/>
                          @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-6">
                          <input 
                            id="text" type="address" class="form-control" name="address" 
                            value="{{$patient[0]->address}}"/>
                          @if ($errors->has('address'))
                              <span class="text-danger">{{ $errors->first('address') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="blood" class="col-sm-2 col-form-label">Blood Group</label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="blood">
                            <option selected disabled value="0">Select Blood Group</option>
                              <option value="1" {{($patient[0]->blood == 1)?'selected':''}}>A+</option>
                              <option value="2" {{($patient[0]->blood == 2)?'selected':''}}>A-</option>
                              <option value="3" {{($patient[0]->blood == 3)?'selected':''}}>B+</option>
                              <option value="4" {{($patient[0]->blood == 4)?'selected':''}}>B-</option>
                              <option value="5" {{($patient[0]->blood == 5)?'selected':''}}>AB+</option>
                              <option value="6" {{($patient[0]->blood == 6)?'selected':''}}>AB-</option>
                              <option value="7" {{($patient[0]->blood == 7)?'selected':''}}>O+</option>
                              <option value="8" {{($patient[0]->blood == 8)?'selected':''}}>O-</option>
                          </select>
                          @if ($errors->has('blood'))
                              <span class="text-danger">{{ $errors->first('blood') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="gender">
                            <option selected disabled value="0">Select Gender</option>
                              <option value="1" {{($patient[0]->gender == 1)?'selected':''}}>Male</option>
                              <option value="2" {{($patient[0]->gender == 2)?'selected':''}}>Female</option>
                          </select>
                          @if ($errors->has('gender'))
                              <span class="text-danger">{{ $errors->first('gender') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="nid" class="col-sm-2 col-form-label">NID Number</label>
                        <div class="col-sm-6">
                          <input id="nid" type="text" class="form-control" name="nid" min="1"  value="{{$patient[0]->nid}}"/>
                          @if ($errors->has('nid'))
                              <span class="text-danger">{{ $errors->first('nid') }}</span>
                          @endif
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                      </div>
                    </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
