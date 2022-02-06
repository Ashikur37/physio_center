@extends('layouts.accountant')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Payment for Appointment #{{$appointment->id}}</b>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Total</th>
                                    <td>{{$appointment->amount}}</td>
                                </tr>

                                <tr>
                                    <th>Discount</th>
                                    <td>{{$appointment->discount}}</td>
                                </tr>
                                <tr>
                                    <th>Given</th>
                                    <td>{{$appointment->given}}</td>
                                </tr>
                                <tr>
                                    <th>Due</th>
                                    <td>{{$appointment->amount-$appointment->discount-$appointment->given}}</td>
                                </tr>
                            </tbody>
                        </table>
                      </div>
                      <div class="col-md-6">
                        <b>Payment history</b>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Sender</th>
                                    <th>Received By</th>

                                </tr>
                            </thead>
                            <tbody>
                               @foreach($histories as $payment)
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
                                    <td>{{$payment->user->name}}</td>
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
</div>
@endsection
