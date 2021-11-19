@extends(Auth::user()->role == 2 ? 'tutor.layouts.app' : 'student.layouts.app' )

<style>
.avatar {
    height: 50px;
    width: 50px;
}
.list-group-item:hover, .list-group-item:focus {
    background: rgba(24,32,23,0.37);
    cursor: pointer;
}
.chatbox {
    height: 80vh !important;
    overflow-y: scroll;
}
.message-box {
    height: 70vh !important;
    overflow-y: scroll;display:flex; flex-direction:column-reverse;
}
.single-message {
    background: #f1f0f0;
    border-radius: 12px;
    padding: 10px;
    margin-bottom: 10px;
    width: fit-content;
}
.received {
    margin-right: auto !important;
}
.sent {
    margin-left: auto !important;
    background :#3490dc;
    color: white!important;
}
.sent small {
    color: white !important;
}
.link:hover {
    list-style: none !important;
    text-decoration: none;
}
.online-icon {
    font-size: 11px !important;
}
</style>
@section('content')
<div>
	@livewire('messages')
</div>

@endsection