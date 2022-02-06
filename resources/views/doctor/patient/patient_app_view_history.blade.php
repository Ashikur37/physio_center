@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <?php foreach($therapy as $data):?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                        <div class="col-md-6">
                            <b>Therapy History</b>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$therapy[0]->therapy_name}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Total Doses</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$therapy[0]->no_doses}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Duration</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$therapy[0]->duration}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Patient Details</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$therapy[0]->details}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Doses Complete</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="doses_complete" value="{{$therapy[0]->doese_complete}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">History</label>
                                <div class="col-sm-9">
                                    <?php
                                        $history = (array) json_decode($data->doese_history);
                                        // dd($history);
                                        if(sizeof($history) > 0) {
                                        foreach($history as $item){
                                    ?>
                                        <input  type="text"
                                                class="form-control"
                                                value="Does {{$item->does}} # {{$item->date}}"
                                                readonly >

                                    <?php } } ?>
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
