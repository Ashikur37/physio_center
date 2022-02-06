@extends('layouts.'.auth()->user()->role)

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add New Application</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{route('leave-application.index')}}" class="btn btn-success">My Leaves</a>
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


                    <form method="post" action="{{route('leave-application.store')}}">
                      {{ csrf_field() }}


                      <div class="form-group row">
                        <label for="end" class="col-sm-2 col-form-label"> Leave Type</label>
                        <div class="col-sm-6">
                            <select name="leave_type_id" class="form-control " id="">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
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
                        <label for="end" class="col-sm-2 col-form-label"> Start Date*</label>
                        <div class="col-sm-6">
                            <input required type="date" class="form-contorl" name="start_date">
                          @if ($errors->has('start_date'))
                              <span class="text-danger">{{ $errors->first('start_date') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="end" class="col-sm-2 col-form-label"> End Date*</label>
                        <div class="col-sm-6">
                            <input required type="date" class="form-contorl" name="end_date">
                          @if ($errors->has('end_date'))
                              <span class="text-danger">{{ $errors->first('end_date') }}</span>
                          @endif
                        </div>
                      </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Submit Application</button>
                            </div>
                        </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
