@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if ($tickets->count() > 0)
                        @foreach ($tickets as $ticket)
                            <div class="card my-2" >
                                <div class="card-header bg-light text-primary">
                                    {{$ticket->full_name}}
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Email: {{$ticket->email}}</li>
                                        <li>Номер: {{$ticket->phone_num}}</li>
                                        @if ($ticket->file) 
                                            <li>{{$ticket->file}}</li>
                                        @endif
                                        <li>Категория: {{$ticket->category->name}}</li>
                                        <li class="{{ $ticket->statusColor() }}">Статус: {{$ticket->status->name}}</li>
                                        @if ($ticket->admin_id)
                                            <li>Админ: {{ $ticket->admin->name }}</li>
                                        @endif
                                    </ul>
                                    <p>Описание</p>
                                    <p>{{$ticket->description}}</p>
                                    @if (Auth::user()->isAdmin())
                                        <a href="/ticket/{{$ticket->hash}}"><button>Ответить</button></a>
                                    @endif
                                </div>
                            </div>
                        @endforeach 
                    @else
                        <div>Пусто :(</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
