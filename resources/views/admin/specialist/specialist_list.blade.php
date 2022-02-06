@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Specialist List</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
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
                                        {{$list->name}}
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
                                        <div class="dropdown float-right">
                                            <a  class="btn btn-info"
                                                href="{{'/admin/specialist/edit/'.$list->id}}">
                                                Edit
                                            </a>
                                            <a  class="btn btn-info"
                                                href="{{'/admin/specialist/change-status/'.$list->id}}">
                                                Change status
                                            </a>
                                            <a  class="btn btn-danger"
                                                href="{{'/admin/specialist/delete/'.$list->id}}">
                                                Delete
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
