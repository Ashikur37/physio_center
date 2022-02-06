@extends('layouts.accountant')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Payment for Requisition #{{$requisition->id}}</b>
                        <table class="table table-striped">
                            <tbody>
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
                      <div class="col-md-6">
                        <b>Payment history</b>
                        <table class="table table-striped">
                            <thead>
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
                  <div class="card-body">
                      <form action="{{route('requisition.paid',$requisition->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Type</label>
                            <select onchange="changed(this.value)" name="is_cash" id="" class="form-control">
                                <option value="1">Cash</option>
                                <option value="0">Mobile Agent</option>
                            </select>
                        </div>
                        <script>
                            function changed(value){
                                if(value=='0'){
                                    document.getElementById('mobile').style.display='block';
                                }else{
                                    document.getElementById('mobile').style.display='none';
                                }
                            }
                        </script>
                        <div id="mobile" style="display: none">
                            <div class="form-group" >
                                <label for="name">Mobile Agent</label>
                                <select name="mobile_agent_id" id="" class="form-control">
                                    @foreach($mobileAgents as $mobile_agent)
                                    <option value="{{$mobile_agent->id}}">{{$mobile_agent->number}} ({{$mobile_agent->type}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Receiver Type</label>
                                <select name="type" id="" class="form-control">
                                    <option value="Bkash">Bkash</option>
                                    <option value="Nagad">Nagad</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Receiver Number</label>
                                <input type="text" class="form-control" name="number">
                            </div>
                            <div class="form-group">
                                <label for="name">Transaction ID</label>
                                <input type="text" class="form-control" name="trans_id">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="name">Amount</label>
                            <input type="number" class="form-control" name="amount">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success">Pay</button>
                        </div>
                      </form>
                  </div>
                  </div>
                  </div>
    </div>
</div>
@endsection
