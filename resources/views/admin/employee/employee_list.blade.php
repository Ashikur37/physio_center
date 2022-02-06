@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Employee List</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/employee/add'}}" class="btn btn-success">Add Employee</a>
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
                                <th scope="col">Status</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $employee)
                                <tr>
                                    <th scope="row">
                                        {{$employee->name}}
                                    </th>
                                    <th scope="row">
                                        {{$employee->phone}}
                                    </th>
                                    <th scope="row">
                                        {{$employee->email}}
                                    </th>
                                    <td>
                                        @if($employee->status == 1)
                                            <b class="text-success">Active</b>
                                        @else($employee->status == 0)
                                            <b class="text-danger">In-Active</b>
                                        @endif
                                    </td>
                                    <th scope="row">
                                        {{$employee->created_at}}
                                    </th>
                                    <th scope="row">
                                        {{$employee->updated_at}}
                                    </th>
                                    <td>
                                        <a 
                                            class="btn btn-info"
                                            href="{{'/admin/employee/edit/'.$employee->user_id}}">
                                            Edit
                                        </a>
                                        <a  class="btn btn-warning my-1" 
                                            href="{{'/admin/employee/manage/'.$employee->user_id}}">
                                            Manage
                                        </a>
                                        <br>
                                        <a class="btn btn-success" 
                                           href="{{'/admin/employee/change-status/'.$employee->id}}">
                                           Change Status
                                        </a> 
                                        <br/>
                                        <a class="btn btn-danger my-1" 
                                           href="{{'/admin/employee/delete/'.$employee->id}}">
                                           Delete
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
