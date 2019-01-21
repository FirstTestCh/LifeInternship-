@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card my-2" >
            <div class="card-header bg-light text-primary">
                {{$ticket->full_name}}
            </div>
            <div class="card-body">
                <ul>
                    <li>Email: {{$ticket->email}}</li>
                    <li>Phone: {{$ticket->phone_num}}</li>
                    @if ($ticket->file) 
                        <li>{{$ticket->file}}</li>
                    @endif
                    <li>Category : {{$ticket->category->name}}</li>
                    <li class="{{ ($ticket->status->id) }}">
                    Status : {{$ticket->status->name}}</li>
                </ul>
                <p>Description</p>
                <p>{{$ticket->description}}</p>
               <form method="post" action="/ticket/{{$ticket->hash}}/process">
                    @csrf
                    <input type="submit" value="In Process">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
