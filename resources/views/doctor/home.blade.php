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

    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">

        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">


            <div class="info-box-content">
              <span class="info-box-text">Total Appointment</span>
              <span class="info-box-number">{{count($appointments)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Patient</span>
                <span class="info-box-number">{{$totalPatient}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Referred</span>
                <span class="info-box-number">{{$refer}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Therapy </span>
                <span class="info-box-number">{{$therapyCounts}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Given</span>
                <span class="info-box-number">{{$therapyCompletedCounts }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Remain</span>
                <span class="info-box-number">{{$therapyCounts-$therapyCompletedCounts }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Visit</span>
                <span class="info-box-number">{{$doctor->visit*count($appointments)}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Task</span>
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
