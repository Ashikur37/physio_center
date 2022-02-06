@extends('layouts.accountant')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Edit Mobile Agent</b>
                      </div>
                      <div class="col-md-6">
                          <a class="btn btn-info" href="{{route('mobile-agent.index')}}">Mobile Agent List</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                      <form action="{{route('mobile-agent.update',$mobileAgent->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Type</label>
                            <select name="type" id="" class="form-control">
                                @foreach($mobileAgentTypes as $type)
                                <option {{$mobileAgent->type==$type->name?'selected':''}} value="{{$type->name}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Number</label>
                            <input value="{{$mobileAgent->number}}" type="text" name="number" class="form-control" placeholder="Enter Number" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Submit</button>
                        </div>
                      </form>
                  </div>
                  </div>
                  </div>
    </div>
</div>
@endsection
