@extends('layouts.accountant')

@section('content')
<style>
    @media print {
 .no-print {
      display: none;
  }
}
</style>
<div class="container">

            <form action="{{URL::to('/accountant/report/appointment-pay')}}">
                <div class="row no-print" id="">
                    <div class="col-md-4">
                        <input type="date" name="start" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="end" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success">Submit</button>
                    </div>
                    <div class="col-md-2">
                        <button onclick="window.print()" type="button" class="btn btn-info">Print</button>
                    </div>
                </div>
            </form>
            <br>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            @if(isset($start)&&isset($end))
                            <tr>
                                <th colspan="4" style="text-align: center;">
                                    Appointment payment from {{$start}} to {{$end}}
                                </th>
                            </tr>
                            @endif
                            <tr>
                                <th>Date</th>
                                <th>Total Appointment</th>
                                <th>Total Paid</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenses as $expense)
                            <tr>
                                <td>{{$expense->date}}</td>
                                <td>{{$expense->app}}</td>
                                <td>{{$expense->total}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

</div>
@endsection
