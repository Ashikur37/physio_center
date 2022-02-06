@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <form action="{{URL::to('admin/calendar')}}">
                <div class="row">
                    <div class="col-md-6">
                        <input name="date" type="date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="4">মাসের নাম</th>
                        <th colspan="4">{{$date->format('M')}}</th>
                        <th colspan="4">তারিখ</th>
                        <th colspan="2">{{$date->format('d')}}</th>

                    </tr>
                    <tr>
                        <th colspan="2">সিট নং</th>
                        <th colspan="2">সকাল ৮:00</th>
                        <th colspan="2">সকাল ৯:১৫</th>
                        <th colspan="2">বিকাল ৩:৩০</th>
                        <th colspan="2">বিকাল ৫:০০</th>
                        <th colspan="2">সন্ধ্যা ৬:৩০</th>
                        <th colspan="2">সন্ধ্যা ৮:০০</th>
                    </tr>
                     @for($j=0;$j<9;$j++)
                    <tr>
                        <th colspan="2">{{$j+1}}</th>

                        @for($i=0;$i<6;$i++)
                            <td colspan="2" class="pick" data-id="{{($j*6)+$i+1}}">
                                <table class="table table-bordered">
                                    <tbody>
                                        @if(\App\Models\PatientCalendar::where('slot',($j*6)+$i+1)->where('date',$date->format('Y-m-d'))->first())
                                        <tr>
                                            <td style="background: #e94949;">কোড</td>
                                            <td style="background: #e94949;">{{\App\Models\PatientCalendar::where('slot',($j*6)+$i+1)->where('date',$date->format('Y-m-d'))->first()->patient->user->id}}</td>
                                        </tr>
                                        <tr>
                                            <td style="background: #e94949;">নাম</td>
                                            <td style="background: #e94949;">{{\App\Models\PatientCalendar::where('slot',($j*6)+$i+1)->where('date',$date->format('Y-m-d'))->first()->patient->user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td style="background: #e94949;">মোবাইল নং</td>
                                            <td style="background: #e94949;">{{\App\Models\PatientCalendar::where('slot',($j*6)+$i+1)->where('date',$date->format('Y-m-d'))->first()->patient->user->phone}}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>কোড</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>নাম</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>মোবাইল নং</td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </td>
                        @endfor

                    </tr>
                    @endfor
                </thead>
            </table>
        </div>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Select Patient</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('calendar.set')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <select name="patient_id" id="" class="form-control">
                            @foreach ($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="date" value="{{$date}}">
                    <input type="hidden" name="slot" id="slot">
                    <div class="form-group">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
@endsection

@section('script')
    <script>
        $(".pick").click(function(){
            $("#slot").val($(this).data('id'));
            $("#myModal").modal('show');
        })
    </script>
@endsection
