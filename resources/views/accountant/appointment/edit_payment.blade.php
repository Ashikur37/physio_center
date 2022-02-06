@extends('layouts.accountant')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                        <h3>{{ __('Update Payment') }}</h3>
                  </div>
                  <div class="card-body">
                      <form action="{{route('payment.update',$appoinmentPayment->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Type</label>
                            <select onchange="changed(this.value)" name="is_cash" id="" class="form-control">
                                <option value="1">Cash</option>
                                <option {{$appoinmentPayment->is_cash==0?'selected':''}} value="0">Mobile Agent</option>
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
                        <div id="mobile" style="display: {{$appoinmentPayment->is_cash==0?'':'none'}}">
                            <div class="form-group" >
                                <label for="name">Mobile Agent</label>
                                <select name="mobile_agent_id" id="" class="form-control">
                                    @foreach($mobileAgents as $mobile_agent)
                                    <option {{$appoinmentPayment->mobile_agent_id==$mobile_agent->id?'selected':''}} value="{{$mobile_agent->id}}">{{$mobile_agent->number}} ({{$mobile_agent->type}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Sender Type</label>
                                <select name="type" id="" class="form-control">
                                    <option value="Bkash">Bkash</option>
                                    <option {{$appoinmentPayment->type=='Nagad'?'selected':''}} value="Nagad">Nagad</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Sender Number</label>
                                <input value="{{$appoinmentPayment->sender_number}}" type="text" class="form-control" name="number">
                            </div>
                            <div class="form-group">
                                <label for="name">Transaction ID</label>
                                <input value="{{$appoinmentPayment->trans_id}}" type="text" class="form-control" name="trans_id">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="name">Amount</label>
                            <input required value="{{$appoinmentPayment->amount}}" min="1"  type="number" class="form-control" name="amount">
                        </div>
                        <div class="form-group">
                            <label for="name">Note</label>
                            <textarea name="note" required id="" class="form-control"></textarea> 
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Receive</button>
                        </div>
                      </form>
                  </div>
                  </div>
                  </div>
    </div>
</div>
@endsection
