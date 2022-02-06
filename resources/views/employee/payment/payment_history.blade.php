@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Payment History</b>
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
