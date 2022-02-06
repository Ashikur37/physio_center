@extends('layouts.'.auth()->user()->role)
@section('content')
<style>
    body{
background-color: #f7f7f7;
}
.active-box{
background:#eee;
}
.container{
max-width: 1440px;
}

.media {
padding: 0.80rem;
font-size: 14.4px;
}
.media:hover {
color: black;
background: #f5f5f5;
}
.media .media-body {
overflow: hidden;
text-overflow: ellipsis;
}
.media .media-body .emojioneemoji {
width: 17px;
margin-top: -1px;
margin-left: 2px;
margin-right: 1px;
}

.custom-scroll {
height: calc(90vh - 50px);
overflow-y: auto;
overflow-x: hidden;
}

a {
color: black;
text-decoration: none;
background-color: transparent;
-webkit-text-decoration-skip: objects;
}
a:hover {
color: #0056b3;
text-decoration: none;
}
.messages-content-left {
height: calc(65vh - 81px);
overflow-y: auto;
overflow-x: hidden;
}

#wrap{
padding:25px;
}

#example1{
width:100%;
resize:none;
box-shadow: 0 1px 5px 0 rgba(0,0,0,.1) !important;
}
.emojionearea{
border: 1px solid #e7e7e7 !important;
border-radius: 5px !important;
-webkit-box-shadow: 0 1px 5px 0 rgba(0,0,0,.1);
box-shadow: 0 1px 5px 0 rgba(0,0,0,.1) !important;
}

input[type="file"] {
z-index: -1;
position: absolute;
opacity: 0;
}

input[type="file"] + label {
cursor: pointer;
width: 50px;
text-align: center;
}

.modal-body .request-proposals-list {
padding: 15px;
}
.modal-body .request-proposals-list .proposal-picture img {
border-radius: 2%;
width: 74px !important;
height: 53px !important;
}
.modal-body .request-proposals-list .proposal-title {
margin-left: 135px;
margin-top: -50px;
font-size: 14px;
line-height: 20px;
color: #0e0e0f;
padding-bottom: 20px;
}

@media(min-width:576px){
.modal-dialog {
    max-width: 600px;
    margin: 1.75rem auto;
}
}
.input-form-control{
width: 170px;
border-radius: 6px;
}
.input-group-addon{
width: 30px;
text-align: center;
line-height: 35px;
background-color: #e9ecef;
border: 1px solid #ced4da;
border-top-left-radius: 5px;
border-bottom-left-radius: 5px;
}

.modal-body .radio-custom:checked + .radio-custom-label::before {
background: #ccc;
box-shadow: inset 0px 0px 0px 4px #fff;
}
.modal-body .radio-custom + .radio-custom-label::before {
content: '';
background: #fff;
border: 2px solid #ddd;
border-radius: 50%;
display: inline-block;
vertical-align: middle;
width: 20px;
height: 20px;
padding: 2px;
margin-right: 10px;
}

.modal-body .radio-custom, .modal-body .radio-custom-label {
margin: 5px;
cursor: pointer;
}
.modal-body .radio-custom {
opacity: 0;
position: absolute;
outline: 0px;
}
</style>
    <div class="card">
        <div class="card-body">
            <ul class="list-unstyled messages mb-0  messages-content-left">
                @foreach($conversation->messages as $message)
            <li href="#" class="inboxMsg media inboxMsg">

                <div class="media-body">
                    <h6 class="mt-0 mb-1">
                        <a href="#">

                            {{$message->user->name}}

                        </a>
                        <small style="margin-left:10px;">
                            {{$message->created_at->format('h:i a M d, Y')}}
                            </small>

                    </h6>

                    {{$message->message}}



                </div>
            </li>
            @endforeach
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('conversation.store')}}" method="post">
                @csrf
                <div class="form-group">

                    <input type="hidden" name="user_id" value="{{$conversation->sender_id==auth()->user()->id?$conversation->receiver_id:$conversation->sender_id}}">
                </div>
                <div class="form-group">

                    <textarea name="message" id="" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection
