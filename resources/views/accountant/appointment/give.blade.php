@extends('layouts.compounder')

@section('content')
<div class="container">
    <div class="row">
        <form action="">
            <div class="form-group">
                <textarea class="form-control" name="note" id=""   placeholder="note"></textarea>
            </div>
            @foreach($appointmentTherapy->therapy)
        </form>
    </div>
</div>
@endsection
