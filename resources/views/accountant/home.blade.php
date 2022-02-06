@extends('layouts.accountant')
@section('content')
<!-- /.card-header -->
<div class="row" style="height: 300px;">


    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">

        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="">
            <div class="info-box mb-3">
                <div class="info-box-content">
                  <span class="info-box-text">Total Registered</span>
                  <span class="info-box-number">{{$totalRegisteredUsers}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
          </a>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <a href="{{URL::to('accountant/appointment/list')}}">
                <div class="info-box mb-3">


                    <div class="info-box-content">
                      <span class="info-box-text">Total Appointment</span>
                      <span class="info-box-number">{{count($appointments)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{URL::to('accountant/appointment/list')}}">
                <div class="info-box mb-3">
                    <div class="info-box-content">
                      <span class="info-box-text">Total Therapy</span>
                      <span class="info-box-number">{{$therapyCounts}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="">
                <div class="info-box mb-3">


                    <div class="info-box-content">
                      <span class="info-box-text">Total Bill</span>
                      <span class="info-box-number">{{$totalBill}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="">
                <div class="info-box mb-3">


                    <div class="info-box-content">
                      <span class="info-box-text">Total Discount</span>
                      <span class="info-box-number">{{$totalDiscount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="">
                <div class="info-box mb-3">


                    <div class="info-box-content">
                      <span class="info-box-text">Total Given</span>
                      <span class="info-box-number">{{$totalGiven}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="">
                <div class="info-box mb-3">


                    <div class="info-box-content">
                      <span class="info-box-text">Total Experience</span>
                      <span class="info-box-number">{{$new}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="">
                <div class="info-box mb-3">


                    <div class="info-box-content">
                      <span class="info-box-text">Total Requisition</span>
                      <span class="info-box-number">{{$totalRequisition}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
            </a>
            <!-- /.info-box -->
          </div>

        <!-- /.col -->
      </div>
      <!-- /.content -->
    </div>
    <!-- ./wrapper -->

@endsection
