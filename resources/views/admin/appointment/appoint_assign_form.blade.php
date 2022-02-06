@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Assign Appointment</b>
                      </div>
                      <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{'/admin/appointment/list'}}" class="btn btn-success">Appointment List</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    @if(session('error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif

                    <?php  //dd($appointments); ?>

                    <form method="post" action="{{URL::to('/admin/appointment/assign')}}">
                      {{ csrf_field() }}
                      <input type="number" name="appointment_id" value={{$appointments[0]->id}} hidden />
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Patient Name</label>
                        <div class="col-sm-6">
                          <input  type="text"
                                  class="form-control"
                                  readonly="true"
                                  value="{{$appointments[0]->user_name}}" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Patient Phone</label>
                        <div class="col-sm-6">
                          <input  type="text"
                                  class="form-control"
                                  readonly="true"
                                  value="{{$appointments[0]->phone}}" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Details</label>
                        <div class="col-sm-6">
                          <input  id="name"
                                  type="text"
                                  class="form-control"
                                  readonly="true"
                                  value="{{$appointments[0]->details}}" />
                        </div>
                      </div>
                      {{-- <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Appoint At</label>
                        <div class="col-sm-6">
                          <input  id="name"
                                  type="text"
                                  class="form-control"
                                  readonly="true"
                                  value="{{$appointments[0]->appoint_at}}" />
                        </div>
                      </div> --}}
                      <div class="form-group row">
                        <label for="assign_doctor" class="col-sm-2 col-form-label">Assign Doctor*</label>
                        <div class="col-sm-6">
                          <select onchange="loadSlot()" class="custom-select" name="doctor_id" id="doctor_id">
                              @foreach($doctor as $doc)
                                {{ $select = ($doc->userId == $appointments[0]->doctor_id) ? 'selected' : '' }}
                                <option value={{$doc->userId}} {{$select}}>
                                  {{$doc->dname}} - ({{$doc->sname}} Specialist)
                                  <!-- - {{$doc->userId}} - {{$appointments[0]->doctor_id}} -->
                                </option>
                              @endforeach
                          </select>
                          @if ($errors->has('assign_doctor'))
                              <span class="text-danger">{{ $errors->first('assign_doctor') }}</span>
                          @endif
                        </div>
                      </div>
                      <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-2 float-sm-left pt-0">Appoint Date</legend>
                        <div class="col-sm-6">
                          <input value="{{Carbon\Carbon::parse($appointments[0]->appoint_at)->format('Y-m-d')}}" onchange="loadSlot()" id="datepicker" class="form-control" name="appoint_date"/>
                          <input type="hidden" id="slot_value" name="slot_id" value="{{$slot_id}}">
                        </div>
                      </fieldset>
                      <script>
                        function loadSlot(){
                          $.ajax({
                            url: "{{URL::to('/admin/appointment/load-slot')}}",
                            type: "GET",
                            data: {
                              date: $('#datepicker').val(),
                              doctor:$('#doctor_id').val()
                            },
                            success: function(data){
                              $("#slot").html(data);
                            }
                          });
                        }
                      </script>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Slot</label>
                            <div id="slot" class="col-sm-10">
                                @include('admin.appointment.slot')
                            </div>
                        </div>
                      <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                      </div>
                  </form>
                  </div>
              </div>
          </div>
    </div>
</div>
<script>
    function updateSlot(id){
        let sbuttons=document.getElementsByClassName('slot-button');
        for(let i=0;i<sbuttons.length;i++){
            if(sbuttons[i].classList.contains('btn-warning')){
                sbuttons[i].classList.remove('btn-warning');
                sbuttons[i].classList.add('btn-success');
            }
        }
        document.getElementById('slot_value').value = id;
        document.getElementById('sl-'+id).classList.remove('btn-success');
        document.getElementById('sl-'+id).classList.remove('btn-danger');

        document.getElementById('sl-'+id).classList.add('btn-warning');

    }
    updateSlot({{$slot_id}});
</script>
@endsection
