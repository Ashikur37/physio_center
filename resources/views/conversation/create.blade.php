@extends('layouts.'.auth()->user()->role)
@section('content')

<div class="card">
    <div class="card-header">
        Start new conversation
    </div>
    <div class="card-body">
        <form action="{{route('conversation.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">User</label>
                <select name="user_id" id="" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Message</label>
                <textarea name="message" id="" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
</div>

@endsection
