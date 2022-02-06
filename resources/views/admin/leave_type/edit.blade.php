@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Edit Leave Type</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/leave-type'}}" class="btn btn-success">Leave Type List</a>
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


                    <form method="post" action="{{route('leave-type.update',$leaveType->id)}}">
                      {{ csrf_field() }}
                      @method('PUT')
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> Name*</label>
                        <div class="col-sm-6">
                          <input id="name" type="text" class="form-control" name="name" value="{{$leaveType->name}}"/>
                          @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> Limit*</label>
                        <div class="col-sm-6">
                          <input id="limit" type="number" class="form-control" name="limit" value="{{$leaveType->limit}}"/>
                          @if ($errors->has('limit'))
                              <span class="text-danger">{{ $errors->first('limit') }}</span>
                          @endif
                        </div>
                      </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Update Leave Type</button>
                            </div>
                        </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
