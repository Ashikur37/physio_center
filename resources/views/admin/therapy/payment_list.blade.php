@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Users List</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">RFID</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <th scope="row">
                                        {{$list->name}}
                                    </th>
                                    <th scope="row">
                                        {{$list->rfid}}
                                    </th>
                                    <th scope="row">
                                        {{$list->email}}
                                    </th>
                                    <th scope="row">
                                        {{$list->phone}}
                                    </th>
                                    <td>
                                        <a  class="btn btn-success" 
                                            href="{{'/admin/payment/new/'.$list->id}}">
                                            Add Payment
                                        </a>
                                        <a  class="btn btn-info" 
                                            href="{{'/admin/payment/history/'.$list->id}}">
                                            Payment History
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
