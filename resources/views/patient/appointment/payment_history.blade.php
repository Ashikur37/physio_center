@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Your Payment History</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Sender</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->created_at->format('h:i a d-m-y')}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td>
                                        @if($payment->is_cash==1)
                                            Cash
                                        @else
                                        {{$payment->sender_type}}
                                        <br>
                                        {{$payment->mobileAgent->number}}

                                        @endif
                                    </td>
                                    <td>
                                        @if($payment->is_cash==1)
                                        Cash
                                        @else
                                        {{$payment->sender_type}}
                                        <br>
                                        {{$payment->sender_number}}
                                    @endif
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
