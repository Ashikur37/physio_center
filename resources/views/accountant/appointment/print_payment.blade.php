<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment {{$appoinmentPayment->id}}</title>
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
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                Patient
                            </th>

                                <td>
                                    {{$appoinmentPayment->appointment->user->name}}
                                </td>
                            </tr>
                        <tr>
                            <th>
                                Payment Date
                            </th>

                                <td>
                                    {{$appoinmentPayment->created_at->format('h:i a d-m-y')}}
                                </td>
                            </tr>
                                @if($appoinmentPayment->is_cash==1)
                                <tr>
                                    <th>
                                        Payment Method
                                    </th>
                                    <td>
                                            Cash
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <th>
                                        Payment Method
                                    </th>
                                    <td>
                                            {{$appoinmentPayment->sender_type}}
                                    </td>
                                </tr>
                               <tr>
                                <th>
                                    Sender Number
                                </th>
                                <td>
                                    {{$appoinmentPayment->sender_number}}
                                </td>
                               </tr>
                               <th>
                                Receiver Number
                            </th>
                            <td>
                                {{$appoinmentPayment->mobileAgent->number}}
                            </td>
                           </tr>
                                @endif
                                <tr>
                                    <th>
                                        Amount
                                    </th>
                                    <td>
                                        {{$appoinmentPayment->amount}}
                                    </td>
                                </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
