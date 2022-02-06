@extends('layouts.app')

@section('content')
<!-- /.card-header -->
<div class="row" style="height: 300px;">

        <div class="row" style="width:60%;margin-left:20%">
            <div class="col-md-5">
                <input class="form-control" type="date" name="from" id="">
            </div>
            <div class="col-md-5">
                <input class="form-control" type="date" name="to" id="">
            </div>
            <div class="col-md-2">
                <button class="btn btn-info">Submit</button>
            </div>
        </div>
        <br>
        <br>


    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <a href="{{URL::to('/patient/appointment/list')}}">
                <div class="info-box mb-3">


                    <div class="info-box-content">
                      <span class="info-box-text">Total Appointment</span>
                      <span class="info-box-number">{{count($appointments) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
            </a>
            <!-- /.info-box -->
          </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">


            <div class="info-box-content">
              <span class="info-box-text">Total Therapy</span>
              <span class="info-box-number">{{$therapyCounts}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Completed</span>
                <span class="info-box-number">{{$therapyCompletedCounts}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Bill </span>
                <span class="info-box-number">{{$totalBills}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Discount</span>
                <span class="info-box-number">{{$totalDiscount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Paid Amount</span>
                <span class="info-box-number">{{$totalGiven}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Due Amount</span>
                <span class="info-box-number">{{$totalBills-$totalDiscount- $totalGiven }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total canceled</span>
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>




        <!-- /.col -->
      </div>
      <!-- /.content -->
    </div>
    <!-- ./wrapper -->

@endsection
