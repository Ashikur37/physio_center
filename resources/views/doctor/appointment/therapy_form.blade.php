@extends('layouts.app')

@section('content')
<div class="container">
    <div id="blue" style="display: none">
        <div class="row" style="margin-top:5px ">
            <div class="col-md-6">
                <select name="therapies[]" id="" class="form-control">
                    @foreach($therapies as $therapy)
                        <option value="{{$therapy->id}}">{{$therapy->therapy_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="quantities[]" class="form-control" placeholder="Quantity">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary" id="add">Remove</button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Assign Therapy</b>
                      </div>
                        {{-- <div class="col-md-6">
                            <button class="btn btn-warning" onclick="addMore()">Add more</button>
                        </div> --}}
                    </div>
                  </div>
                  <script>
                      function addMore(){
                          console.log('clicked');
                          $('#list').append($('#blue').html());
                      }
                  </script>
                  <div class="card-body">
                    <form method="post" action="{{URL::to('/doctor/appointment/therapy/store-another-therapy')}}"
                          enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <input hidden type="text" value="{{$patient_id}}" name="patient_id">
                        <input hidden type="text" value="{{$appointment_id}}" name="appointment_id">
                        <div id="list">

                            {{-- <div class="row" >
                                <div class="col-md-6">
                                    <select name="therapies[]" id="" class="form-control">
                                        @foreach($therapies as $therapy)
                                            <option value="{{$therapy->id}}">{{$therapy->therapy_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="quantities[]" class="form-control" placeholder="Quantity">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary" id="add">Remove</button>
                                </div>
                            </div> --}}
                            <table class="table">
                                <tbody>
                                    @foreach($groups as $group)
                                        <tr>
                                            <th>{{$group->name}}
                                            </th>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach($group->therapies as $therapy)
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col-md-1">
                                                                    <input
                                                                    @if(isset($exists[$therapy->id]))
                                                                        checked
                                                                    @endif
                                                                    type="checkbox" name="therapies[]" value="{{$therapy->id}}">

                                                                </div>
                                                                <div class="col-md-4">
                                                                    {{$therapy->therapy_name}}
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input
                                                                    @if(isset($exists[$therapy->id]))
                                                                        value="{{$exists[$therapy->id]}}"
                                                                    @endif

                                                                    type="text" name="quantities[{{$therapy->id}}]" class="form-control" placeholder="Quantity">
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <br>
                            <button type="submit" class="btn btn-primary" style="margin-top:10px">Save</button>
                        </div>
                    </form>
                  </div>
              </div>
          </div>
    </div>
</div>

@endsection
