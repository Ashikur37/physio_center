@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Update Employee</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/employee/list'}}" class="btn btn-success">
                              Employee List
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="/admin/employee/edit-store">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$employee[0]->id}}"/>
                      <input type="hidden" name="user_id" value="{{$employee[0]->user_id}}"/>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                          <input 
                            id="name" type="text" class="form-control" name="name" 
                            value="{{$employee[0]->name}}"/>
                          @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Contact Number</label>
                        <div class="col-sm-6">
                          <input 
                            id="phone" type="text" class="form-control" name="phone"
                            value="{{$employee[0]->phone}}"/>
                          @if ($errors->has('phone'))
                              <span class="text-danger">{{ $errors->first('phone') }}</span>
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
                          <input
                            id="email" type="email" class="form-control" name="email" 
                            value="{{$employee[0]->email}}"/>
                          @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="gender">
                              <option selected disabled value="0">Select Gender</option>
                              <option 
                                value="1" 
                                {{($employee[0]->gender == 1)?'selected':''}} >
                                Male
                              </option>
                              <option
                                value="2"
                                {{($employee[0]->gender == 2)?'selected':''}} >
                                Female
                              </option>
                          </select>
                          @if ($errors->has('gender'))
                              <span class="text-danger">{{ $errors->first('gender') }}</span>
                          @endif
                        </div>
                      </div>
                        <div class="form-group row">
                          <div class="col-sm-10 offset-sm-2">
                              <button type="submit" class="btn btn-primary">
                                Update Employee
                              </button>
                          </div>
                        </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
