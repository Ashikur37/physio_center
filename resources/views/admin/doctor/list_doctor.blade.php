@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Doctor List</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/doctor/add'}}" class="btn btn-success">Add Doctors</a>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                   <div class="table-responsive">
                    <table id="d-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">NID</th>
                                <th scope="col">Specialist</th>
                                <th scope="col">Visit </th>
                                <th scope="col">Status </th>
                                <th scope="col" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <th>{{$doctor->id}}</th>
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
                                    <th scope="row">
                                        {{$doctor->specialist_list}}
                                    </th>

                                    <th scope="row">
                                        {{$doctor->visit}}
                                    </th>
                                    <td>
                                        @if($doctor->status == 1)
                                            <b class="text-success">Active</b>
                                        @else($doctor->status == 0)
                                            <b class="text-danger">In-Active</b>
                                        @endif
                                    </td>
                                    <td>
                                       <div class="btn-group btn-sm">
                                        <a  class="btn btn-info"
                                        href="{{'/admin/doctor/edit/'.$doctor->id.'/'.$doctor->user_id}}">
                                        Edit
                                    </a>
                                    <a  class="btn btn-danger  btn-sm"
                                        href="{{'/admin/doctor/delete/'.$doctor->id}}">
                                        Delete
                                    </a>
                                    <a  class="btn btn-success btn-sm"
                                        href="{{'/admin/doctor/change-status/'.$doctor->id}}">
                                        Change status
                                    </a>
                                       </div>
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
</div>
@endsection
