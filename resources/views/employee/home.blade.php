@extends('layouts.employee')


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
              <span class="info-box-text">Total Task</span>
              <span class="info-box-number">{{$totalTask+$assignedTask}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Assigned Task</span>
                <span class="info-box-number">{{$assignedTask}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total complete </span>
                <span class="info-box-number">{{$totalCompleteTask}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Running</span>
                <span class="info-box-number">{{ $totalRunningTask }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Pending Task</span>
                <span class="info-box-number">{{$totalPendingTask}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total visit</span>
                <span class="info-box-number">3000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total receive</span>
                <span class="info-box-number">1600</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">


              <div class="info-box-content">
                <span class="info-box-text">Total Due</span>
                <span class="info-box-number">1400</span>
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

