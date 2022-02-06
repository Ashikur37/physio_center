<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Services</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <!-- jQuery -->
    <style>
        [class*=sidebar-dark-] {
    background-color: #00963e;
  }
  .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      background-color: #e40613;
      color: #fff;
  }
  .navbar-dark {
      background-color: #00963e;
      border-color: #00963e;
  }
 .table-striped tbody tr:nth-of-type(odd) {
    background-color: #ddeefe;
    color: #080000;
}
.table-striped tbody tr:nth-of-type(even) {
    background-color: #ffffff;
    color: #080000;
}
.info-box {
    background-color: #4050b5;
    color: white;
}
.select2-selection{
        height: 40px !important;
    }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img
                class="animation__wobble"
                src="{{asset('dist/img/AdminLTELogo.png')}}" alt="Loader" height="60" width="60">
        </div>

        <!-- Authentication Links -->
        @guest
            @yield('content')
        @else
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link"
                       data-widget="pushmenu"
                       href="#"
                       role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"

                       href="{{URL::previous()}}"
                      >
                        Go Back
                    </a>
                  </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                  <!-- Navbar Search -->
                    <div class="btn-group">
                        <a  class="btn btn-block btn-primary"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Sidebar -->
                <div class="sidebar">
                  <!-- Sidebar user panel (optional) -->
                  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                      <a href="#" class="d-block">
                        @if(auth()->user()->image)
                            <img src="{{asset('images/'.auth()->user()->image)}}" alt="User Image" class="img-circle elevation-2" style="width:30px;height:30px;">
                            @endif
                        {{ Auth::user()->name }}{{Auth::user()->rfid?'('.Auth::user()->rfid.')':''}}</a>
                    </div>
                  </div>

                  <!-- Sidebar Menu -->
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column"
                        data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a href="{{URL::to('/admin/home')}}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Appointments<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/appointment/list')}}" class="nav-link active">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Appointment List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/appointment/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Appointment</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>Specialist<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Specialist</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/specialist/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Specialist List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-stethoscope"></i>
                                    <p>Doctor<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/doctor/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Doctor</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/doctor/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Doctor List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-briefcase-medical"></i>
                                    <p>Therapy<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('group.create')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Therapy Group</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('group.index')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Therapy Group List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/therapy/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Therapy</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/therapy/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Therapy List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-briefcase-medical"></i>
                                    <p>Machine<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('machine.create')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Machine</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('machine.index')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Machine List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-briefcase-medical"></i>
                                    <p>Test<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('test.create')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Test</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('test.index')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Test List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Employee<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/employee/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Employee</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/employee/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Employee List</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('user-attendence.index')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Attendence</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('user.leave')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Leave Management</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-stethoscope"></i>
                                    <p>Leave<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('leave-type.create')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Leave Type</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('leave-type.index')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Leave Type</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-money-bill-alt"></i>
                                    <p>Payment<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/therapy/payment-list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Payment</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{URL::to('/admin/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Patient<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/patient/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Patient</p>
                                        </a>
                                        <a href="{{URL::to('/admin/patient/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Patient List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Coordinator<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/coordinator/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Coordinator</p>
                                        </a>
                                        <a href="{{URL::to('/admin/coordinator/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Coordinator List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Therapist<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/therapist/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Therapist</p>
                                        </a>
                                        <a href="{{URL::to('/admin/therapist/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Therapist List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Accountant<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/admin/accountant/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Accountant</p>
                                        </a>
                                        <a href="{{URL::to('/admin/accountant/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Accountant List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Slot<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('slot.index')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Slot List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('slot.create')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Slot</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Task<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item menu-is-opening menu-open">
                                        <a href="#" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>
                                           Task List
                                            <i class="right fas fa-angle-left"></i>
                                          </p>
                                        </a>
                                        <ul class="nav nav-treeview" style="display: block;">
                                            <li class="nav-item">
                                                <a href="{{route('task.index')}}" class="nav-link">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>All Task</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('task.index')}}?status=0" class="nav-link">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>Pending Task</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('task.index')}}?status=1" class="nav-link">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>Running Task</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('task.index')}}?status=2" class="nav-link">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>Completed Task</p>
                                                </a>
                                            </li>

                                        </ul>
                                      </li>

                                    <li class="nav-item">
                                        <a href="{{route('task.create')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Task</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @elseif(Auth::user()->role == 'doctor')
                            <li class="nav-item">
                                <a href="{{URL::to('/doctor/home')}}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/conversation')}}" class="nav-link">
                                    <i class="nav-icon fas fa-inbox"></i>
                                    <p>Chat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/doctor/search/patient')}}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Search Patient</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/doctor/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Appointments<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/doctor/appointment/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Appointment List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a href="{{URL::to('/coordinator/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Task<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/employee/task')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Task List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/employee/task/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Task</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a href="{{URL::to('/coordinator/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Requisition<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/employee/requisition/add')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Add Requisition</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/employee/requisition/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Requisition List</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a href="{{URL::to('/coordinator/specialist/add')}}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Leave Management<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('leave-application.index')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>My Leaves</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('leave-application.create')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>New Application</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Therapy<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/doctor/therapy/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Therapy Lists</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}

                        @elseif(Auth::user()->role == 'patient')
                            <li class="nav-item">
                                <a href="{{URL::to('/patient/home')}}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{URL::to('/patient/profile')}}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Appointments<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/patient/appointment')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>New Appointment</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{URL::to('/patient/appointment/list')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Appointment List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Payment<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{URL::to('/patient/payment/history')}}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Payment History</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @elseif(Auth::user()->role == 'employee')
                            <li class="nav-item">
                                <a href="{{URL::to('/employee/home')}}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <?php
                                if($role_manage->appointment == 1):
                            ?>
                                <li class="nav-item menu-open">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-calendar-check"></i>
                                        <p>Appointments<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{URL::to('/employee/appointment/list')}}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Appointment List</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{URL::to('/employee/appointment/add')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Appointment</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php
                                if($role_manage->patient == 1):
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Patient<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{URL::to('/employee/patient/add')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Patient</p>
                                            </a>
                                            <a href="{{URL::to('/employee/patient/list')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Patient List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <?php
                                if($role_manage->doctor == 1):
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-stethoscope"></i>
                                        <p>Doctor<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{URL::to('/employee/doctor/add')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Doctor</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{URL::to('/employee/doctor/list')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Doctor List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <?php
                                if($role_manage->therapy == 1):
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-briefcase-medical"></i>
                                        <p>Therapys<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{URL::to('/employee/therapy/add')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Therapy</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{URL::to('/employee/therapy/list')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Therapy List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            <?php
                                if($role_manage->payment == 1):
                            ?>
                                {{-- <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-money-bill-alt"></i>
                                        <p>Payment<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{URL::to('/employee/payment/payment-list')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Payment</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li> --}}
                            @endif
                        @endif
                    </ul>
                  </nav>
                  <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1> </h1>
                      </div>
                    </div>
                  </div><!-- /.container-fluid -->
                </section>

                <section class="content">
                    <div class="container-fluid">
                       @yield('content')
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                  <b>Version</b> 3.2.0-rc
                </div>
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">SUO XI HEALTHCARE</a>.
                </strong> All rights reserved.
            </footer>
        @endguest
    </div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
    $('#timepicker').timepicker();
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
    $(function () {
  $("#d-table").DataTable({
        "aaSorting": [],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: { columns: ':visible:not(:last-child)' } ,
                customize: function ( win ) {
$( win.document.body )

.find('.non').css('display', 'none');
}
            }
        ]
    });

  });
</script>
@yield('script')
</body>
</html>
