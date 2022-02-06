@extends('layouts.app')

@section('content')
<style>
    .select2-selection{
        height: 40px !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Add New App</b>
                      </div>
                       <div class="col-md-6">
                        <div class="dropdown float-right">
                            <a href="{{URL::to('/admin/appointment/list')}}" class="btn btn-success">
                              Appointment List
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="post" action="{{URL::to("/admin/appointment/add-store")}}">
                      {{ csrf_field() }}
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-6">
                            <select class="select2 custom-select form-control" name="service_id">
                                <option selected>Select One</option>
                                @foreach ($services as $service)
                                  <option value="{{ $service->name }}">
                                    {{ $service->name }}
                                  </option>
                                @endforeach
                              </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">
                          Patient
                        </label>
                        <div class="col-sm-6">
                          <select required class="custom-select" name="patient_id">
                            <option selected>Select One</option>
                              @foreach ($patients as $patient)
                                <option value="{{ $patient->patient_id }}">
                                  {{ $patient->name }} - {{ $patient->rfid }}
                                </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">
                          Doctor
                        </label>
                        <div class="col-sm-6">
                          <select required required onchange="loadSlot()" class="custom-select" name="doctor_id" id="doctor_id">
                            <option selected>Select One</option>
                              @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->userId }}">
                                  {{ $doctor->dname }} --  ({{ $doctor->sname }} - Specialist)
                                </option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-2 float-sm-left pt-0">Appoint Date</legend>
                        <div class="col-sm-6">
                          <input onchange="loadSlot()" id="datepicker" class="form-control" name="appoint_date"/>
                          <input required type="hidden" id="slot_value" name="slot_id" >
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
                            </div>
                        </div>

                      {{-- <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-2 float-sm-left pt-0">Appoint Time</legend>
                        <div class="col-sm-6">
                          <input id="timepicker" class="form-control" name="appoint_time"/>
                        </div>
                      </fieldset> --}}
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Details</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputPassword3" name="details">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Waiver</label>
                        <div class="col-sm-10">
                          <input style="margin-left: -48%;" type="checkbox" class="form-control" id="inputPassword3" name="is_waiver">
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Add</button>
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
        document.getElementById('sl-'+id).classList.add('btn-warning');

    }
</script>
@endsection
@section('script')
    <script>
         $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
  tags: true
})
         });
        </script>
@endsection
