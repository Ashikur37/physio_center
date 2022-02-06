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
                        Therapy Name : <b>{{$data->therapy_name}}</b>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Therapy Total Doses</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{$data->doses}}" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-4 col-form-label">Duration</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{$data->duration}}" readonly>
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
                    </form>
                  </div>
              </div>
          </div>
        <?php endforeach; ?>
    </div>
</div>

@endsection
