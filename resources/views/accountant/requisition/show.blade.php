@extends('layouts.'.auth()->user()->role)

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
           <div class="card">
               <div class="card-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Requisition</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Title</th>
                            <td>{{$requisition->title}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$requisition->description}}</td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td>{{$requisition->user->name}}</td>
                        </tr>
                        <tr>
                            <th>Assigned Employee</th>
                            <td>{{$requisition->employee->name}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$requisition->created_at->format('h:i a d-m-y')}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>{{$requisition->amount}}</td>
                        </tr>
                        <tr>
                            <th>Paid</th>
                            <td>{{$requisition->paid}}</td>
                        </tr>
                        <tr>
                            <th>Due</th>
                            <td>{{$requisition->amount-$requisition->paid}}</td>
                        </tr>
                    </tbody>
                </table>
               </div>
           </div>
        </div>
        <div class="col-md-6">

            <div class="card">

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="5" >Payment history</th>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Sender</th>
                                <th>Paid By</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($requisition->payments as $payment)
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

@endsection
