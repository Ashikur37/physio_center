@extends('layouts.app')

@section('content')
<!-- /.card-header -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <form action="{{route('user-attendence.store')}}" method="post">
                @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Attendence Shit for </b>
                            </div>
                            <div class="col-md-6">
                        <input onchange="updateDate(this.value)" type="date" id="date" value="{{$date}}" class="form-control">

                            </div>
                            <script>
                                function updateDate(date){
                                    window.location.href = "{{route('user-attendence.index')}}?date="+date;
                                }
                            </script>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn btn-info">Update Attendence</button>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <input  type="date" id="start" value="" class="form-control">

                      </div>
                      <div class="col-md-2">
                        <input  type="date" id="end" value="{{$date}}" class="form-control">

                      </div>
                      <div class="col-md-2">
                        <button onclick="viewReport()" type="button" class=" btn btn-info">View Report</button>

                      </div>
                      <script>
                        function viewReport(){
                            var start = document.getElementById('start').value;
                            var end = document.getElementById('end').value;

                            window.location.href = "{{URL::to('/admin/attendence/report')}}?start="+start+"&end="+end;
                        }
                    </script>

                    </div>
                </div>
                <div class="card-body " >

                    <div class="row">
                            <input type="hidden" name="date" value="{{$date}}">
                            @foreach($userAttendences as $attendence)
                        <div class="col-md-6">
                            <div class="row" style="width: 100%;">
                                <div class="col-md-6">
                                    <b>{{$attendence->user->name}} ({{$attendence->user->id}})</b>
                                </div>
                                <div class="col-md-6">
                                    <input {{$attendence->present == 1?'checked':''}} value="{{$attendence->user->id}}" type="checkbox" name="user[]" id="">

                                </div>
                            </div>
                        </div>
                        <hr>

                    @endforeach

                </div>

                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- /.card-body -->
@endsection
