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
                            <a href="{{'/admin/therapy/add'}}" class="btn btn-success">Add Therapy</a>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="d-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">price</th>
                                <th scope="col">duration</th>
                                <th scope="col">doses</th>
                                <th scope="col">Status</th>
                                <th scope="col">Machines</th>

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
                                        @foreach($list->machines as $machine)
                                            {{$machine->name}}
                                            <br>
                                        @endforeach
                                    </th>

                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-info btn-sm"
                                           href="{{'/admin/therapy/edit/'.$list->id}}">
                                           Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                           href="{{'/admin/therapy/delete/'.$list->id}}">
                                           Delete
                                        </a>
                                        <a class="btn btn-success btn-sm"
                                           href="{{'/admin/therapy/change-status/'.$list->id}}">
                                           Change Status
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
@endsection
