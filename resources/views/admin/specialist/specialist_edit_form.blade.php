@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Edit Specialist</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/specialist/list'}}" class="btn btn-success">Specialist List</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="/admin/specialist/edit-store">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$specialist->id}}">
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Specialist Name*</label>
                        <div class="col-sm-6">
                          <input  
                            id="name"
                            type="text"
                            class="form-control"
                            name="name"
                            value="{{$specialist->name}}"
                          />
                          @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
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
