@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Compounder List</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/doctor/add'}}" class="btn btn-success">Add Compounder</a>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">NID</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col" width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <th scope="row">
                                        {{$doctor->name}}
                                    </th>
                                    <th scope="row">
                                        {{$doctor->phone}}
                                    </th>
                                    <th scope="row">
                                        {{$doctor->email}}
                                    </th>
                                    <th scope="row">
                                        {{$doctor->nid}}
                                    </th>

                                    <td>
                                        @if($doctor->status == 1)
                                            <b class="text-success">Active</b>
                                        @else($doctor->status == 0)
                                            <b class="text-danger">In-Active</b>
                                        @endif
                                    </td>
                                    <th scope="row">
                                        {{$doctor->created_at}}
                                    </th>
                                    <th scope="row">
                                        {{$doctor->updated_at}}
                                    </th>
                                    <td>
                                        <a  class="btn btn-info"
                                            href="{{URL::to('/admin/coordinator/edit/'.$doctor->id).'/'.$doctor->user_id}}">
                                            Edit
                                        </a> <br/>
                                        <a  class="btn btn-danger my-1"
                                            href="{{URL::to('/admin/coordinator/delete/'.$doctor->id)}}">
                                            Delete
                                        </a> <br/>
                                        <a  class="btn btn-success"
                                            href="{{URL::to('/admin/coordinator/change-status/'.$doctor->id)}}">
                                            Change status
                                        </a>
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
