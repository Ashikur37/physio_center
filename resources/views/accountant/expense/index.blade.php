@extends('layouts.'.auth()->user()->role)

@section('content')
<!-- /.card-header -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Expense  List</b>
                      </div>
                    </div>
                </div>
                <div class="card-body " >
                    <table id="d-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <td>Type</td>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Paid</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{$expense->id}}</td>
                                <td>{{$expense->title}}</td>
                                <td>{{$expense->expenseType->name}}</td>
                                <td>{{$expense->description}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{$expense->paid}}</td>

                                <td>
                                <div class="btn-group">
                                    <a class="btn btn-warning btn-sm" href="{{route('expense.pay',$expense->id)}}">Pay</a>
                                    <a  class="btn btn-info btn-sm"
                                        href="{{route('expense.edit',$expense->id)}}">
                                        Edit
                                    </a>

                                    <a  class="btn btn-danger btn-sm"
                                    href="{{route('expense.remove',$expense->id)}}">
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
<!-- /.card-body -->
@endsection
