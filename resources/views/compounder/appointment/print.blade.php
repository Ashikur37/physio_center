<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment {{$appointment->id}}</title>
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
</head>
<body onload="window.print()">
    <div style="">
        <div class="row">
            <div class="col-md-3">
                <img src="{{asset('images/logo.png')}}" alt="">
            </div>
            <div class="col-md-6" style="text-align: center">
                <h2>SUOXI HEALTHCARE</h2>
                <b>Century Arcade Shopping Center,3rd Floor</b><br>
                <b>Magbazar, Dhaka-120, Mobile: +8801720-020080</b><br>
                <b>Email: suoxigroup@gmail.com, www.suoxihealthcarelimited.com</b>
            </div>
        </div>
    </div>
    <div style="margin-left:20px;margin-right:40px;" class="row" style="background-image: url({{asset('images/logo.png')}});background-size:cover">
        <table class="table table-bordered">
            <tr>
                <td>Patient Name</td>
                <td>{{$appointment->user->name}}</td>
                <td>Age</td>
                <td>{{$patient->age}}</td>
                <td>Date</td>
                <td>{{\Carbon\Carbon::today()->format('d-M-y')}}</td>
            </tr>
            <tr>

                <td>Sex</td>
                <td>{{["","Male","Female"][$patient->gender]}}</td>
                <td>B/P</td>
                <td>

                </td>
                <td>Ref. By</td>
                <td></td>
            </tr>
        </table>
        <div style="text-align: center;width:100%;">
            <span style="background:blue;color:white;padding:3px;font-weight:bold;font-size:22; ">TREATMENT</span>
        </div>

        <br>
        <br>

        <div class="row" style="width: 100%">

            @foreach($therapies as $name=>$list)
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th style="text-align: center" colspan="4">{{$name}}</th>
                        </tr>
                        <tr>
                            <td>SL</td>
                            <td>Acupuncture
                                Methods</td>
                                <td>No Of
                                    Sessions</td>
                                    <td>Remarks</td>
                        </tr>
                        @php($i=1)
                        @foreach($list as $item)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->therapy->therapy_name}}</td>
                                <td>{{$item->total}}</td>
                                <td></td>
                            </tr>
                            @php($i++)
                        @endforeach
                    </table>
                </div>
            @endforeach
        </div>
        <div style="text-align: center;width:100%;">
            <span style="background:blue;color:white;padding:3px;font-weight:bold;font-size:22; ">Medicine</span>
        </div>
        <br>
       <div style="width: 100%;text-align: center;">
        @if($appointment->prescription)
        <?php
        $format_arr = [
            '1 + 1 + 1',
            '1 + 0 + 1',
            '0 + 1 + 1',
            '1 + 0 + 0',
            '0 + 0 + 1',
            '0 + 1 + 0'
        ];

        $medicine_name = json_decode($appointment->prescription->medicine_name)? json_decode($appointment->prescription->medicine_name):[];

        $taken = ($appointment->prescription->meal == 1) ? 'Before Meal':'After Meal';
        $how_many = json_decode($appointment->prescription->medicine_liquid);
        $format = json_decode($appointment->prescription->medicine_solid);
        $length = 0;
        $counter = -1;
?>
      <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <table class="table table-bordered">
              
                <tr>
                    <td>SL</td>
                    <td>Medicine</td>
                        <td>Time</td>
                            <td>Dose</td>
                </tr>
                @php($i=1)
                <?php
                foreach($medicine_name as $medicine){
                    $counter++;
                    $length++;
                    echo '<tr><td>'.$length.'</td><td>'. $medicine.' </td> ';
                    echo '  <td>  '.$taken.' - '.$how_many[$counter].'(spoon/pic) </td>';
                    echo '  <td>  '.$format_arr[$format[$counter]%3].'</td></tr>';
                }

            ?>
            </table>
        </div>
      </div>


    @endif

    <div style="text-align: center;width:100%;">
        <span style="background:blue;color:white;padding:3px;font-weight:bold;font-size:22; ">Tests</span>
    </div>
    <br>

   <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-6">
        <table class="table table-bordered">

            <tr>
                <td>SL</td>

                        <td>Name</td>
            </tr>
            @php($i=1)
            @foreach($appointment->tests as $item)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$item->name}}</td>
                </tr>
                @php($i++)
            @endforeach
        </table>
       </div>
   </div>
       </div>



    </div>

</body>
</html>
