@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Employee Role Management</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/employee/list'}}" class="btn btn-success">Employee List</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">

                    <form method="post" action="/admin/employee/manage/update_role">
                      {{ csrf_field() }}
                        <input type="hidden" name="user_id" value={{$id}}>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Options Can Access</label>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input" type="checkbox" name="appointment"
                                            <?php
                                                if($role_manage->appointment == 1){
                                                    echo 'checked';
                                                }
                                            ?>
                                        >
                                        <label class="form-check-label">Appointment</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input" type="checkbox" name="patient"
                                            <?php
                                                if($role_manage->patient == 1){
                                                    echo 'checked';
                                                }
                                            ?>
                                        >
                                        <label class="form-check-label">Patient</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input" type="checkbox" name="doctor"
                                            <?php
                                                if($role_manage->doctor == 1){
                                                    echo 'checked';
                                                }
                                            ?>
                                        >
                                        <label class="form-check-label">Doctor</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input" type="checkbox" name="therapy"
                                            <?php
                                                if($role_manage->therapy == 1){
                                                    echo 'checked';
                                                }
                                            ?>
                                        >
                                        <label class="form-check-label">Therapy</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input" type="checkbox" name="payment"
                                            <?php
                                                if($role_manage->payment == 1){
                                                    echo 'checked';
                                                }
                                            ?>
                                        >
                                        <label class="form-check-label">Payment</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Update Role</button>
                            </div>
                        </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
