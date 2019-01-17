@extends('layouts.app')

@php
    function color($id){
        $col = "";
        switch($id){
            case(1):
                $col = "text-primary";
            break;
            case(2):
                $col = "text-info";
            break;
            case(3):
                $col = "text-danger";   
            break;
            case(4):
                $col = "text-success";   
            break;
            case(5):
                $col = "text-muted";
            break;
        }
        return $col;
    }    
@endphp

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @foreach ($tickets as $ticket)
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
                                    <li class="{{ color($ticket->status->id) }}">
                                    Status : {{$ticket->status->name}}</li>
                                </ul>
                                <p>Description</p>
                                <p>{{$ticket->description}}</p>
                            </div>
                        </div>
                    @endforeach 
                </div>

            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
