@extends('layouts.'.auth()->user()->role)
@section('content')

<div class="card">
    <div class="card-header">
        <a class="btn btn-info" href="{{route('conversation.create')}}">Start new</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Last Message</th>
                    <th>Send At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($conversations as $conversation)
                <tr>
                    <td>{{$conversation->id}}</td>
                    <td>{{$conversation->sender_id!=auth()->user()->id?$conversation->sender->name:$conversation->receiver->name}}</td>
                    <td>{{$conversation->messages->last()->message}}</td>
                    <td>
                        {{$conversation->messages->last()->created_at->diffForHumans()}}
                    </td>
                    <td>
                        <a href="{{route('conversation.chat',$conversation->id)}}" class="btn btn-primary">Chat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
