@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <?php foreach($therapy as $data): ?>
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6">
                        <b>Update Therapy</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form 
                        method="post" 
                        action="/doctor/therapy/update/store"
                        enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <input hidden type="text" value="{{$patient_id}}" name="patient_id">
                        <input hidden type="text" value="{{$appointment_id}}" name="appointment_id">
                        <input hidden type="text" value="{{$data->doese_history}}" name="doses_history">
                        <input hidden type="number" value="{{$data->assign_id}}" name="assign_id">
                        <input hidden type="number" value="{{$data->therapy_id}}" name="therapy_id">
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Therapy Name</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{$data->therapy_name}}" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Therapy Total Doses</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{$data->no_doses}}" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Duration</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{$data->duration}}" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Patient Details</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{$data->details}}" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Doses Complete</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="doses_complete" value="{{$data->doese_complete}}" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-2 col-form-label">History</label>
                            <div class="col-sm-8">
                              <div class="row">
                                <?php
                                    $history = (array) json_decode($data->doese_history);
                                    if(sizeof($history) > 0) {
                                      foreach($history as $item){
                                ?>
                                  <div class="col-sm-6">
                                    <input  type="text"
                                            class="form-control"
                                            value="Does {{$item->does}} # {{$item->date}}"
                                            readonly >
                                  </div>
                                  <div class="col-sm-4">
                                    <small>
                                        <?php echo isset($item->note) ? 'Note* : '.$item->note : ''; ?>
                                    </small>
                                  </div>
                                <?php } } ?>
                              </div>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Update Doses</label>
                          <div class="col-sm-8">
                            <input type="number" min="1" class="form-control" name="doses_given" value="1" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Write Note</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="note" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Status</label>
                          <div class="col-sm-8">
                            <select class="custom-select" name="status">
                              <option selected value="1">Running</option>
                              <option value="2">Complete</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-10 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Update Therapy</button>
                          </div>
                        </div>
                    </form>
                  </div>
              </div>
          </div>
        <?php endforeach; ?>
    </div>
</div>

@endsection
