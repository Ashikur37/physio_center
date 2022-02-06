@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Payment List</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <div class="dropdown float-right">
                                 <a href="{{'/admin/therapy/payment-list'}}" class="btn btn-success">Payment List</a>
                                <button class="btn btn-secondary dropdown-toggle"
                                        type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{'/admin/home'}}">Home</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{'/admin/appointment/list'}}">Appointments</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{'/admin/patient/add'}}">Add Patient</a>
                                    <a class="dropdown-item" href="{{'/admin/patient/list'}}">Patient List</a>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Amount</th>
                                <th scope="col">Type</th>
                                <th scope="col">Pay At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <th scope="row">
                                        {{$list->amount}}
                                    </th>
                                    <th scope="row">
                                        @if($list->type == 2)
                                            <strong>Advanced</strong>
                                        @elseif($list->type == 3)
                                            <strong>Due</strong>
                                        @elseif($list->type == 4)
                                            <strong>Pay</strong>
                                        @endif
                                    </th>
                                    <th scope="row">
                                        {{$list->created_at}}
                                    </th>
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
