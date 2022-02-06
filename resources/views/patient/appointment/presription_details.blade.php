@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Prescription</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Advice</th>
                                <th scope="col">Medicine Details</th>
                                <th scope="col">Prescription</th>
                                <th scope="col">Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <th scope="row">
                                        {{$list->details}}
                                    </th>
                                    <td>
                                        <?php
                                            $format_arr = [
                                                '1 + 1 + 1',
                                                '1 + 0 + 1',
                                                '0 + 1 + 1',
                                                '1 + 0 + 0',
                                                '0 + 0 + 1',
                                                '0 + 1 + 0'
                                            ];

                                            $medicine_name = json_decode($list->medicine_name);
                                            $taken = ($list->meal == 1) ? 'Before Meal':'After Meal';
                                            $how_many = json_decode($list->medicine_liquid);
                                            $format = json_decode($list->medicine_solid);
                                            $length = 0;
                                            $counter = -1;

                                            foreach($medicine_name as $medicine){
                                                $counter++;
                                                $length++;
                                                echo '<strong>'.$length.'. '.$medicine.' </strong> <br>';
                                                echo '  -  '.$taken.'<br> - '.$how_many[$counter].'(spoon/pic)<br> ';
                                                echo '  -  '.$format_arr[$format[$counter]].'<br>';
                                            }

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if(isset($list->image)){
                                                echo '<a href="/uploads/'.$list->image.'" target="_blank"> View Prescription </a>';
                                            } else {
                                                echo 'Prescription Not Assign';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        {{$list->appoint_at}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
              </div>
          </div>
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Therapy</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Service</th>
                            <th scope="col">Deatils</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Doctor Name</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($therapy as $data)
                                <tr>
                                    <th scope="row">
                                        {{$data->service_name}}
                                    </th>
                                    <td>
                                        {{$data->details}}
                                    </td>
                                    <td>
                                        {{$data->created_at}}
                                    </td>
                                    <td>
                                        {{$data->doctor_name}}
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="{{'/patient/appointment/therapy/'.$data->id}}">
                                            Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
