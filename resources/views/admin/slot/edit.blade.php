@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Edit Slot</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/slot'}}" class="btn btn-success">Slot List</a>
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


                    <form method="post" action="{{route('slot.update',$slot->id)}}">
                      {{ csrf_field() }}
                      @method('PUT')
                      <div class="form-group row">
                        <label for="start" class="col-sm-2 col-form-label"> Start*</label>
                        <div class="col-sm-6">
                          <input id="name" type="text" class="form-control" name="start" value="{{$slot->start}}"/>
                          @if ($errors->has('start'))
                              <span class="text-danger">{{ $errors->first('start') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> End*</label>
                        <div class="col-sm-6">
                          <input id="end" type="text" class="form-control" name="end" value="{{$slot->end}}"/>
                          @if ($errors->has('end'))
                              <span class="text-danger">{{ $errors->first('end') }}</span>
                          @endif
                        </div>
                      </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Update Slot</button>
                            </div>
                        </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
