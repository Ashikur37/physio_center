@extends('layouts.accountant')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add Mobile Agent</b>
                      </div>
                      <div class="col-md-6">
                          <a class="btn btn-info" href="{{route('mobile-agent.index')}}">Mobile Agent List</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                      <form action="{{route('mobile-agent.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Type</label>
                            <select name="type" id="" class="form-control">
                                @foreach($mobileAgentTypes as $type)
                                <option value="{{$type->name}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Number</label>
                            <input type="text" name="number" class="form-control" placeholder="Enter Number" required>
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
