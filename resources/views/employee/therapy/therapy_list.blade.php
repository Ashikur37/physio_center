@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Therapy List</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                        <div class="dropdown float-right">
                            <a href="{{'/employee/therapy/add'}}" class="btn btn-success">Add Therapy</a>
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
                                <th scope="col">price</th>
                                <th scope="col">duration</th>
                                <th scope="col">doses</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <th scope="row">
                                        {{$list->therapy_name}}
                                    </th>
                                    <th scope="row">
                                        {{$list->price}}
                                    </th>
                                    <th scope="row">
                                        {{$list->duration}}
                                    </th>
                                    <th scope="row">
                                        {{$list->doses}}
                                    </th>
                                    <td>
                                        @if($list->status == 1)
                                            <b class="text-success">Active</b>
                                        @else($list->status == 0)
                                            <b class="text-danger">In-Active</b>
                                        @endif
                                    </td>
                                    <th scope="row">
                                        {{$list->created_at}}
                                    </th>
                                    <th scope="row">
                                        {{$list->updated_at}}
                                    </th>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                            href="{{'/employee/therapy/edit/'.$list->id}}">
                                            Edit
                                        </a> <br/>
                                        <a class="btn btn-success btn-sm my-1"
                                            href="{{'/employee/therapy/change-status/'.$list->id}}">
                                            Change status
                                        </a> <br/>
                                        <a class="btn btn-danger btn-sm"
                                            href="{{'/employee/therapy/delete/'.$list->id}}">
                                            Delete
                                        </a> <br/>
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
