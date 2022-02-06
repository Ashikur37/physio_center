@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add New Payment</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/therapy/payment-list'}}" class="btn btn-success">Payment List</a>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    @if(session('error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <form method="post" action="/admin/payment/new/store">
                                {{ csrf_field() }}
                                <input hidden name="user_id" value="{{$user_id}}"/>
                                <div class="form-group row">
                                    <label for="amount" class="col-sm-2 col-form-label">Amount*</label>
                                    <div class="col-sm-6">
                                        <input  id="amount" type="number" min="0"
                                                class="form-control" name="amount" value="" placeholder="Add Amount"/>
                                        @if ($errors->has('amount'))
                                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Save Payment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Payment History
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 5px">SL</th>
                                                <th style="width: 40px">Name</th>
                                                <th style="width: 50px">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $due = 0;
                                                $pay = 0;
                                                $total = 0;
                                                $type = "Due";
                                            ?>
                                            @foreach($history as $index => $item)
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td>
                                                        @if($item->type == 3)
                                                            <?php $due = $due + $item->amount; ?>
                                                            <span class="badge bg-danger">Due</span>
                                                        @elseif($item->type == 4)
                                                            <?php $pay = $pay + $item->amount; ?>
                                                            <span class="badge bg-success">Paid</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong>Tk. {{$item->amount}}</strong>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <?php
                                                    $total = $due-$pay;
                                                    if($total < 0){
                                                        $type = "Pay";
                                                    }
                                                ?>
                                                <td></td>
                                                <td>
                                                    {{$type}}
                                                </td>
                                                <td>
                                                    <strong>
                                                        Tk. <?php echo abs($total); ?>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                </div>
          </div>
    </div>
</div>
@endsection
