@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add New Accountant</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{URL::to('/admin/accountant/list')}}" class="btn btn-success">Accountant List</a>
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


                    <form method="post" action="{{URL::to('/admin/accountant/add')}}">
                      {{ csrf_field() }}
                      <input type="number" name="patient_id" value={{auth()->user()->id}} hidden />
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Accountant Name*</label>
                        <div class="col-sm-6">
                          <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}"/>
                          @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Contact Number*</label>
                        <div class="col-sm-6">
                          <input id="phone" type="text" class="form-control" name="phone" value="{{old('phone')}}"/>
                          @if ($errors->has('phone'))
                              <span class="text-danger">{{ $errors->first('phone') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email*</label>
                        <div class="col-sm-6">
                          <input id="email" type="email" class="form-control" name="email" value=""/>
                          @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password*</label>
                        <div class="col-sm-6">
                          <input id="password" type="password" class="form-control" name="password" value=""/>
                          @if ($errors->has('password'))
                              <span class="text-danger">{{ $errors->first('password') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender*</label>
                        <div class="col-sm-6">
                          <select class="custom-select" name="gender">
                            <option selected disabled value="0">Select Gender</option>
                              <option value="1">Male</option>
                              <option value="2">Female</option>
                          </select>
                          @if ($errors->has('gender'))
                              <span class="text-danger">{{ $errors->first('gender') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="nid" class="col-sm-2 col-form-label">NID Number*</label>
                        <div class="col-sm-6">
                          <input id="nid" type="text" class="form-control" name="nid" min="1"  value="{{old('nid')}}"/>
                          @if ($errors->has('nid'))
                              <span class="text-danger">{{ $errors->first('nid') }}</span>
                          @endif
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Add Accountant</button>
                      </div>
                    </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
