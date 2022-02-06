@extends('layouts.'.auth()->user()->role)

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add New Expense</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/accountant/expense'}}" class="btn btn-success">Expense List</a>
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


                    <form method="post" action="{{route('expense.store')}}">
                      {{ csrf_field() }}
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> Type*</label>
                        <div class="col-sm-6">
                          <select name="expense_type_id" id="" class="form-control">
                              @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                              @endforeach
                          </select>
                          @if ($errors->has('expense_type_id'))
                              <span class="text-danger">{{ $errors->first('expense_type_id') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"> Title*</label>
                        <div class="col-sm-6">
                          <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}"/>
                          @if ($errors->has('title'))
                              <span class="text-danger">{{ $errors->first('title') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"> Description</label>
                        <div class="col-sm-6">
                            <textarea  name="description" id="" class="form-control"></textarea>
                          @if ($errors->has('description'))
                              <span class="text-danger">{{ $errors->first('description') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label"> Amount*</label>
                        <div class="col-sm-6">
                          <input required id="amount" type="number" class="form-control" name="amount" value="{{old('amount')}}"/>
                          @if ($errors->has('amount'))
                              <span class="text-danger">{{ $errors->first('amount') }}</span>
                          @endif
                        </div>
                      </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Add Expense</button>
                            </div>
                        </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
