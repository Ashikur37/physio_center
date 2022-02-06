@extends('layouts.accountant')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Mobile Agent List</b>
                      </div>
                      <div class="col-md-6">
                          <a class="btn btn-info" href="{{route('mobile-agent.create')}}">Add New</a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Balance</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mobileAgents as $agent)
                                <tr>
                                    <th scope="row">
                                        {{$agent->number}}
                                    </th>
                                    <th>
                                        {{$agent->type}}
                                    </th>
                                    <th>
                                        {{$agent->balance}}
                                    </th>


                                    <td>
                                        <a class="btn btn-info" href="{{route('mobile-agent.edit',$agent->id)}}">Edit</a>
                                        {{-- delete form  --}}
                                        <form action="{{route('mobile-agent.destroy',$agent->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
