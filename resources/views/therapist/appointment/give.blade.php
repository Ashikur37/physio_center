@extends('layouts.therapist')

@section('content')
<div class="container">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                <b>Give Therapy</b>
            </div>
            <div class="card-body">
                <form action="{{route('therapy.give',$appointmentTherapy->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="note" id=""   placeholder="note"></textarea>
                    </div>
                        @foreach($appointmentTherapy->therapy->machines as $machine)
                           <div class="form-group">
                               <label>
                                {{$machine->name}}
                               </label>

                               <input type="checkbox" name="machines[]" value="{{$machine->id}}">
                           </div>
                        @endforeach
                        <div class="form-group">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
