@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add New Task</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/task'}}" class="btn btn-success">Task List</a>
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


                    <form method="post" action="{{route('task.store')}}">
                      {{ csrf_field() }}
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> Title*</label>
                        <div class="col-sm-6">
                          <input required id="title" type="text" class="form-control" name="title" value="{{old('title')}}"/>
                          @if ($errors->has('title'))
                              <span class="text-danger">{{ $errors->first('title') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="end" class="col-sm-2 col-form-label"> Description*</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="description" id="" cols="10" rows="3">{{old('description')}}</textarea>
                          @if ($errors->has('description'))
                              <span class="text-danger">{{ $errors->first('description') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="end" class="col-sm-2 col-form-label"> Employee</label>
                        <div class="col-sm-6">
                            <select name="user_id" class="form-control" id="">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} ({{$user->id}})</option>
                                @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="end" class="col-sm-2 col-form-label"> Due Date</label>
                        <div class="col-sm-6">
                            <input required  type="date" name="date" class="form-control">
                        </div>
                      </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Add Task</button>
                            </div>
                        </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
