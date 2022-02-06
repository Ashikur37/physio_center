@extends('layouts.app')

@section('content')
<!-- /.card-header -->
<div class="row" style="height: 300px;">

  @if(auth()->user()->role === 'admin')
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clinic-medical"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pending Appointment</span>
              <span class="info-box-number">{{$appointment}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Todays Income</span>
              <span class="info-box-number">{{$income}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Todays Appointment</span>
              <span class="info-box-number">{{$today}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Patient</span>
              <span class="info-box-number">{{$new}}</span>
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
  @endif
@endsection
